<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ChangePass extends Controller
{
    //

    public function Cpass(){

        return view('admin.body.change_password');
    }

    public function UpdatePass(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return Redirect()->route('login')->with('success', 'Password berhasil diubah');
        }else{
            return Redirect()->back()->with('error', 'Password salah');

        }
    }

    public function PUpdate(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request){
        // $user = User::find(Auth::user()->id);
        // if($user){
        //     $user->name = $request['name'];
        //     $user->email= $request['email'];

        //     $user->save();
        //     return Redirect()->back()->with('success','Profile Berhasil diubah');
        // }else{
        //     return Redirect()->back();
        // }

        $user = User::find(Auth::user()->id);
        $validatedData = $request->validate([
            'name' => 'required|max:255|min:2',
            'email' => 'required|max:255|min:2',

        ],[

            'name.min' => 'Minimal 2 karakter',
            'profile_image.required' => 'Masukan gambar profile',
        ]);

        $old_image = $request->old_image;

        $profile_image = $request->file('profile_image');

        if($profile_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($profile_image->getClientOriginalExtension());
            $img_name = $name_gen .'.'.$img_ext;
            $up_location = 'image/profile/';
            $last_img = $up_location.$img_name;

            $profile_image->move($up_location,$img_name);

            unlink($old_image);
            User::find(Auth::user()->id)->update([

                'name'=>$request->name,
                'email'=>$request->email,
                'profile_photo_path'=>$last_img,
                'created_at'=> Carbon::now()
            ]);

        }else{
            User::find(Auth::user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'created_at'=> Carbon::now()
            ]);
        }

        return Redirect()->back()->with('success', 'Profile  berhasil diubah');


    }
}
