@extends('admin.admin_master')


@section('title','Home About')

@section('admin')


<a href="{{route('add.about')}}"><button class="btn btn-info">+ Data</button></a><br><br>
    <div class="py-12">
        <div class="container">

          <div class="row">
            <div class="col-md-12">

              <div class="card">

                @if (session('success'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                {{-- <div class="card-header"> All about </div> --}}

                <div class="users-table table-wrapper">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" width="3%">No</th>
                            <th scope="col" width="12%">Judul</th>
                            <th scope="col" width="20%">Deskripsi Pendek</th>
                            <th scope="col" width="30%">Deskripsi Panjang</th>
                            <th scope="col" width="15%">Dibuat</th>
                            <th scope="col" width="15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        {{-- @php($i = 1) --}}
                                @php($i = 1)
                        @foreach ($homeabout as $about)

                        <tr>
                            {{-- <td scope="col">{{$i++}}</td> --}}
                            <td scope="col">{{$i++}}</td>
                            <td scope="col">{{$about->title}}</td>
                            <td scope="col">{{$about->short_dis}}</td>
                            <td scope="col">{{$about->long_dis}}</td>
                            <td scope="col">
                            @if ($about->created_at==NULL)
                                <span class="text-danger"> Tidak terdeteksi</span>
                            @else
                            {{-- dengan Eloquent ORM --}}
                            {{-- {{$category->created_at->setTimezone('Asia/jakarta')->diffForHumans()}} --}}

                            {{-- dengan query builder --}}
                            {{ Carbon\Carbon::parse($about->created_at)->setTimezone('Asia/jakarta')->diffForHumans()}}

                            </td>
                            <td>
                            <a href="{{ url('about/edit/'.$about->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('about/delete/'.$about->id)}}" onclick="return confirm('Yakin ingin menghapus {{$about->title}}')" class="btn btn-danger">Delete</a>
                            </td>
                            @endif
                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
          </div>


          </div>
        </div>





    </div>
@endsection
