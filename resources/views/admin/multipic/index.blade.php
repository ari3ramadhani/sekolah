<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
            Multi Picture
            
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

              <div class="card-group">
                  @foreach ($images as $multi)
                  <div class="col-md-4 mt-5">'
                        <div class="card">  
                            <img src="{{asset($multi->image)}}" alt="">
                        </div>

                  </div>
                      
                  @endforeach
              </div>
            
            </div>
        

          <div class="col-md-4">
              
            <div class="card">
              <div class="card-header"> Add Brand </div>
              <div class="card-body">
              <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                @csrf
               
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand image</label>
                    <input type="file" name="banyak_gambar[]" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">
  
                      @error('banyak_gambar')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
  
                  </div>
               
                <button type="submit" class="btn btn-primary">Add Image</button>
              </form>
            </div>
            </div>
          </div>
              
          </div>
        </div>





    </div>
</x-app-layout>
