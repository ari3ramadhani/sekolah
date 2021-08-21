<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;


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
        
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->get->getClientOriginalExtension());
        $img_name = $name_gen .'.'.$img_ext;
    }
}
