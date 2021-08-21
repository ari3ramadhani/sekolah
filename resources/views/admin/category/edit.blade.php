<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        Ubah Kategori
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
          <div class="row">
         

          <div class="col-md-8">
              
            <div class="card">
              <div class="card-header"> Ubah Kategori </div>
              <div class="card-body">
              <form action="{{url('category/update/'.$categories->id)}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Ubah Nama Kategori</label>
                  <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$categories->category_name}}">

                    @error('category_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror

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
