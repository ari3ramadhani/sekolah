@extends('admin.admin_master')


@section('title','Ubah Password')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Ubah Profile</h2>
    </div>

  <article class="sign-up">
    @if (session('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{session('error')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <div class="card-body">
        <form method="POST" action="{{route('password.update')}}" class="form-pill">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Current Password</label>
                <input type="password" class="form-control" name="oldpassword" id="current_password" placeholder="Current Password">
            @error('oldpassword')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword">New Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>

            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
