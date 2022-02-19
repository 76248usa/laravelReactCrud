<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Edit Brand
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-info" role="alert">
        {{session('success')}}
      </div>
      @endif

    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-8">
                <div class="card bg-dark text-white">
                    <div class="card-header">Edit Brand</div>
                         <div class="card-body">
                            <form action="{{url('brand/update/'.$brand->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brand->brand_image}}">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Update Brand Name</label>
                                  <input type="text" name="brand_name" class="form-control"
                                  id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brand->brand_name}}">
                                  @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brand->brand_image}}">
                                    @error('brand_image')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <img src={{asset($brand->brand_image)}} style="width:200px;" alt="old image">
                                </div>
                                  <button type="submit" class="btn btn-primary">Update Brand</button>
                              </form>
                         </div>

                </div>
            </div>

           </div>

        </div>

    </div>
</x-app-layout>
