<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Image;
use Auth;
// resize


class HomeController extends Controller
{
    //
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){
        $slider_image = $request->file('image');


        // cara resize
        // untuk resize gambar buka link http://image.intervention.io/getting_started/installation
        // install composer composer.phar require intervention/image
        // tambahim di config/app        Intervention\Image\ImageServiceProvider::class
        // sama ini dipaling bawah  config/app   'Image' => Intervention\Image\Facades\Image::class
        // php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;
        // resize sampe sini

        Slider::insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$last_img,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->route('home.slider')->with('success', 'Slider berhasil ditambahkan');

    }
}
