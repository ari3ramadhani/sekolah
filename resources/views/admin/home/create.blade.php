@extends('admin.admin_master')


@section('title','Tambah Home About')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Form Tambah About Home</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.about')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Judul</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Judul">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Deskripsi Pendek</label>
                    <textarea class="form-control" name="short_dis" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Deskripsi Panjang</label>
                    <textarea class="form-control" name="long_dis" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>

                </div>
            </form>
        </div>
    </div>


</div>

@endsection
