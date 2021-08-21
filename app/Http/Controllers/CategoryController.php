<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCate(){

        // Join table dengan query builder tidak perlu menggunakan model
        // $categories = DB::table('categories')
        //                 ->join('users','categories.user_id','users.id')
        //                 ->select('categories.*','users.name')
        //                 ->latest()->paginate(5);

        // dengan Eloquent ORM
        $categories = Category::latest()->paginate(5);

        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        // dengan query builder
        // $categories = DB::table('categories')->latest()->paginate(5);
        
        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCate(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255|min:2',
        ],[
            'category_name.required' => 'Masukan nama kategori',
            'category_name.unique' => 'Sudah terpakai',
            'category_name.min' => 'Minimal 2 karakter',
        ]);

        // Category adalah nama dari model
        // dengan  ORM
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at'=>Carbon::now()
            
        // ]);

        // dengan eloquent
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();



        // dengan query builder
            $data = array();
            $data['category_name']=$request->category_name;
            $data['user_id']=Auth::user()->id;
            $data['created_at']=Carbon::now();
            DB::table('categories')->insert($data);
            
        return Redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }


    public function Edit($id){
        // dengan eloquent ORM
        $categories = Category::find($id);

        // Dengan Query builder
        $categories = DB::table('categories')->where('id',$id)->first();


        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request, $id){
           // dengan eloquent ORM
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        // Dengan Query builder        
        $data = array();
        $data['category_name']=$request->category_name;
        $data['user_id']=Auth::user()->id;
        $data['updated_at']=Carbon::now();
        DB::table('categories')->where('id',$id)->update($data);


        return Redirect()->route('all.category')->with('success', 'Kategori berhasil diubah');

    }


    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Kategori soft delete berhasil');
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Kategori di restore berhasil');
    }


    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Kategori berhasil dihapus permanen');
    }
}
