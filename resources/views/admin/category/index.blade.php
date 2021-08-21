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

                <div class="card-header"> All Category </div>
              
          
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  {{-- @php($i = 1) --}}
                      
                  @foreach ($categories as $category)
                      
                  <tr>
                    {{-- <td scope="col">{{$i++}}</td> --}}
                    <td scope="col">{{$categories->firstItem()+$loop->index}}</td>
                    <td scope="col">{{$category->category_name}}</td>
                    <td scope="col">
                       {{-- dengan Eloquent ORM --}}
                      {{$category->user->name}}

                       {{-- dengan query builder --}}
                       {{-- {{$category->name}}  --}}
                    </td>
                    <td scope="col">
                      @if ($category->created_at==NULL)
                          <span class="text-danger"> Tidak terdeteksi</span>
                      @else   
                       {{-- dengan Eloquent ORM --}}
                       {{-- {{$category->created_at->setTimezone('Asia/jakarta')->diffForHumans()}} --}}
                    
                       {{-- dengan query builder --}}
                       {{ Carbon\Carbon::parse($category->created_at)->setTimezone('Asia/jakarta')->diffForHumans()}}
                    
                    </td>
                    <td>
                      <a href="{{ url('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
                      <a href="{{ url('softdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                    @endif
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>
              {{$categories->links()}}
            
            </div>
          </div>

          <div class="col-md-4">
              
            <div class="card">
              <div class="card-header"> Add Category </div>
              <div class="card-body">
              <form action="{{route('store.category')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Category name</label>
                  <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    @error('category_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
               
                <button type="submit" class="btn btn-primary">Add Category</button>
              </form>
            </div>
            </div>
          </div>
              
          </div>
        </div>



{{-- bagian dari Trash  --}}
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              
              <div class="card">

              

                <div class="card-header"> Data Trash </div>
              
          
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  {{-- @php($i = 1) --}}
                      
                  @foreach ($trashCat as $category)
                      
                  <tr>
                    {{-- <td scope="col">{{$i++}}</td> --}}
                    <td scope="col">{{$categories->firstItem()+$loop->index}}</td>
                    <td scope="col">{{$category->category_name}}</td>
                    <td scope="col">
                       {{-- dengan Eloquent ORM --}}
                      {{$category->user->name}}

                       {{-- dengan query builder --}}
                       {{-- {{$category->name}}  --}}
                    </td>
                    <td scope="col">
                      @if ($category->created_at==NULL)
                          <span class="text-danger"> Tidak terdeteksi</span>
                      @else   
                       {{-- dengan Eloquent ORM --}}
                       {{-- {{$category->created_at->setTimezone('Asia/jakarta')->diffForHumans()}} --}}
                    
                       {{-- dengan query builder --}}
                       {{ Carbon\Carbon::parse($category->created_at)->setTimezone('Asia/jakarta')->diffForHumans()}}
                    
                    </td>
                    <td>
                      <a href="{{ url('category/restore/'.$category->id)}}" class="btn btn-info">Restore</a>
                      <a href="{{ url('pdelete/category/'.$category->id)}}" class="btn btn-danger">P Delete</a>
                    </td>
                    @endif
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>
              {{$trashCat->links()}}
            
            </div>
          </div>

            <div class="col-md-4">
            
            </div>
              
            {{-- End Trash --}}
          </div>
        </div>



    </div>
</x-app-layout>
