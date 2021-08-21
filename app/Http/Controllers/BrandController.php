<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use Illuminate\Support\Carbon;

// resize
use Image;


class BrandController extends Controller
{
    //
    public function AllBrand(){

        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255|min:2',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'brand_name.required' => 'Masukan nama brand',
            'brand_name.unique' => 'Sudah terpakai',
            'brand_name.min' => 'Minimal 2 karakter',
            'brand_image.required' => 'Masukan gambar brand',
        ]);

        $brand_image = $request->file('brand_image');
        
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen .'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        // cara resize
        // untuk resize gambar buka link http://image.intervention.io/getting_started/installation
        // install composer composer.phar require intervention/image
        // tambahim di config/app        Intervention\Image\ImageServiceProvider::class
        // sama ini dipaling bawah  config/app   'Image' => Intervention\Image\Facades\Image::class
        // php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;
        // resize sampe sini
        
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_img,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->back()->with('success', 'Brand berhasil ditambahkan');

    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id){
        $validatedData = $request->validate([
            'brand_name' => 'required|max:255|min:2',
          
        ],[
            
            'brand_name.min' => 'Minimal 2 karakter',
            'brand_image.required' => 'Masukan gambar brand',
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen .'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
    
            $brand_image->move($up_location,$img_name);
    
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'brand_image'=>$last_img,
                'created_at'=> Carbon::now()
            ]);
    
        }else{
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'created_at'=> Carbon::now()
            ]);
        }
        
        return Redirect()->back()->with('success', 'Brand berhasil diubah');
    }

    public function Delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand berhasil dihapus');
    }
}
