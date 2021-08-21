<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
            All Category
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              
              <div class="card">

                @if (session('success'))
                  
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                <div class="card-header"> All Brand </div>
              
          
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Brand Kategori</th>
                    <th scope="col">Brand Image</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  {{-- @php($i = 1) --}}
                      
                  @foreach ($brands as $brand)
                      
                  <tr>
                    {{-- <td scope="col">{{$i++}}</td> --}}
                    <td scope="col">{{$brands->firstItem()+$loop->index}}</td>
                    <td scope="col">{{$brand->brand_name}}</td>
                    <td scope="col">
                        <img src="{{asset($brand->brand_image)}}" style="height: 40px; width:70px" alt="">
                    </td>
                    <td scope="col">
                      @if ($brand->created_at==NULL)
                          <span class="text-danger"> Tidak terdeteksi</span>
                      @else   
                       {{-- dengan Eloquent ORM --}}
                       {{-- {{$category->created_at->setTimezone('Asia/jakarta')->diffForHumans()}} --}}
                    
                       {{-- dengan query builder --}}
                       {{ Carbon\Carbon::parse($brand->created_at)->setTimezone('Asia/jakarta')->diffForHumans()}}
                    
                    </td>
                    <td>
                      <a href="{{ url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                      <a href="{{ url('brand/delete/'.$brand->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                    @endif
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>
              {{$brands->links()}}
            
            </div>
          </div>

          <div class="col-md-4">
              
            <div class="card">
              <div class="card-header"> Add Brand </div>
              <div class="card-body">
              <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Brand name</label>
                  <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">

                    @error('brand_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand image</label>
                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  
                      @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
  
                  </div>
               
                <button type="submit" class="btn btn-primary">Add Brand</button>
              </form>
            </div>
            </div>
          </div>
              
          </div>
        </div>





    </div>
</x-app-layout>
