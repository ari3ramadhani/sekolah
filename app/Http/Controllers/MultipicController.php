<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

// resize
use Image;

class MultipicController extends Controller
{
    //
    public function Multipic(){

        $images = Multipic::all();

        return view('admin.multipic.index',compact('images'));
    }

    public function StoreImage(Request $request){
       
        $image = $request->file('banyak_gambar');
        
        foreach($image as $multi_img){
            

                // cara resize
                // untuk resize gambar buka link http://image.intervention.io/getting_started/installation
                // install composer composer.phar require intervention/image
                // tambahim di config/app        Intervention\Image\ImageServiceProvider::class
                // sama ini dipaling bawah  config/app   'Image' => Intervention\Image\Facades\Image::class
                // php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
                $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
                Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);

                $last_img = 'image/multi/'.$name_gen;
                // resize sampe sini
                
                Multipic::insert([
                    'image'=>$last_img,
                    'created_at'=> Carbon::now()
                ]);
                
        }
        return Redirect()->back()->with('success', 'Gambar berhasil ditambahkan');
    }

}
