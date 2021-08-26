@extends('admin.admin_master')


@section('title','Ubah Profile')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Ubah Profile</h2>
    </div>

  <article class="sign-up">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{session('success')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <div class="card-body">
        <form method="POST" action="{{route('update.user.profile')}}" class="form-pill" enctype="multipart/form-data">
            @csrf
            <input type="text" name="old_image" value="{{$user['profile_photo_path']}}">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nama</label>
                <input type="text" class="form-control" name="name" id="current_password" value="{{$user['name']}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" id="current_password" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="top-cat-title">Ubah Gambar</label>
                <input type="file" name="profile_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user['profile_photo_path']}}">

                  @error('profile_image')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror

            </div>
            <div class="form-group">
                <img src="{{asset($user->profile_photo_path)}}" style="width: 400px; height200px;">
            </div>

            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Ubah</button>
            </div>
        </form>
    </div>
</div>
@endsection
