@extends('admin.admin_master')


@section('title','Slider')

@section('admin')


<a href="{{route('add.slider')}}"><button class="btn btn-info">+ Slider</button></a><br><br>
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

                {{-- <div class="card-header"> All slider </div> --}}

                <div class="users-table table-wrapper">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" width="3%">No</th>
                            <th scope="col" width="12%">Judul</th>
                            <th scope="col" width="50%">Deskripsi</th>
                            <th scope="col" width="5%">Gambar</th>
                            <th scope="col" width="15%">Dibuat</th>
                            <th scope="col" width="15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        {{-- @php($i = 1) --}}
                                @php($i = 1)
                        @foreach ($sliders as $slider)

                        <tr>
                            {{-- <td scope="col">{{$i++}}</td> --}}
                            <td scope="col">{{$i++}}</td>
                            <td scope="col">{{$slider->title}}</td>
                            <td scope="col">{{$slider->description}}</td>
                            <td scope="col">
                                <img src="{{asset($slider->image)}}" style="height: 40px; width:70px" alt="">
                            </td>
                            <td scope="col">
                            @if ($slider->created_at==NULL)
                                <span class="text-danger"> Tidak terdeteksi</span>
                            @else
                            {{-- dengan Eloquent ORM --}}
                            {{-- {{$category->created_at->setTimezone('Asia/jakarta')->diffForHumans()}} --}}

                            {{-- dengan query builder --}}
                            {{ Carbon\Carbon::parse($slider->created_at)->setTimezone('Asia/jakarta')->diffForHumans()}}

                            </td>
                            <td>
                            <a href="{{ url('slider/edit/'.$slider->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('slider/delete/'.$slider->id)}}" onclick="return confirm('Yakin ingin menghapus {{$slider->title}}')" class="btn btn-danger">Delete</a>
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
