@extends('admin.admin_master')


@section('title','Tambah Home Kontak')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Form Tambah Kontak Home</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.contact')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Judul">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">No HP</label>
                    <input type="text" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Judul">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>

                </div>
            </form>
        </div>
    </div>


</div>

@endsection
