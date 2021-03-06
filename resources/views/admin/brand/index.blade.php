<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Brands
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card bg-dark text-white">
                        @if(session('success'))
                        <div class="alert alert-info" role="alert">
                            {{session('success')}}
                          </div>
                          @endif
                        <div class="card-header">All Brands</div>
                <table class="table table-dark table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL Number</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <!--@php($i=1)-->
                        @foreach($brands as $brand)
                      <tr>

                        <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                        <td>{{$brand->brand_name}} </td>
                        <td><img src="{{asset($brand->brand_image)}}" alt="" width = "50px"></td>
                        <td>@if($brand->created_at == NULL)
                            <span class="text-danger">No date set</span>
                            @else
                            {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                            @endif
                        </td>
                        <td>
                        <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                        <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger"
                            onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                    </table>
                    {{ $brands->links() }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-white">
                    <div class="card-header">Add Brand</div>
                         <div class="card-body">
                            <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Brand Name</label>
                                  <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                  @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('brand_image')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>


                                <button type="submit" class="btn btn-primary">Add Brand</button>
                              </form>
                         </div>

                </div>
            </div>

           </div>

        </div>



<!-- Trash Part -->

<!--End Trash -->

   </div>
</x-app-layout>
