<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        Ubah Brand
            
        </h2>
    </x-slot>
    <div class="py-12">
     
        <div class="container">
             
          <div class="row">
         

          <div class="col-md-8">
            
    @if (session('success'))
                  
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{session('success')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif    
            <div class="card">
              <div class="card-header"> Ubah Brand </div>
              <div class="card-body">
              <form action="{{url('brand/update/'.$brands->id)}}" method="POST"  enctype="multipart/form-data">
                <input type="text" name="old_image" value="{{$brands->brand_image}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Ubah Nama Brand</label>
                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brands->brand_name}}">
  
                      @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
  
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Ubah Gambar Brand</label>
                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brands->brand_image}}">
  
                      @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
  
                  </div>
                  
                <div class="form-group">
                    <img src="{{asset($brands->brand_image)}}" style="width: 400px; height200px;" alt="">
                  </div>
                 
                   
                <button type="submit" class="btn btn-primary">Ubah Kategori</button>
              </form>
            </div>
            </div>
          </div>
              
        </div>
      </div>
    </div>
</x-app-layout>
