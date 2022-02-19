<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Categories
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
                        <div class="card-header">All Categories</div>
                <table class="table table-dark table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL Number</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <!--@php($i=1)-->
                        @foreach($categories as $category)
                      <tr>

                        <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                        <td>{{$category->category_name}} </td>
                        <td>{{$category->user->name}}</td>
                        <td>@if($category->created_at == NULL)
                            <span class="text-danger">No date set</span>
                            @else
                            {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                            @endif
                        </td>
                        <td>
                        <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
                        <a href="{{url('softdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                    </table>
                    {{ $categories->links() }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-white">
                    <div class="card-header">Add Category</div>
                         <div class="card-body">
                            <form action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Category Name</label>
                                  <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                  @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Add Category</button>
                              </form>
                         </div>

                </div>
            </div>

           </div>

        </div>
<!-- Trash Part -->

        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card bg-dark text-white">

                        <div class="card-header">Trash List</div>
                <table class="table table-dark table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL Number</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <!--@php($i=1)-->
                        @foreach($trashCat as $category)
                      <tr>

                        <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                        <td>{{$category->category_name}} </td>
                        <td>{{$category->user->name}}</td>
                        <td>@if($category->created_at == NULL)
                            <span class="text-danger">No date set</span>
                            @else
                            {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                            @endif
                        </td>
                        <td>
                            <a href="{{url('category/restore/'.$category->id)}}" class="btn btn-info">Restore</a>
                            <a href="{{url('pdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                    </table>
                    {{ $trashCat->links() }}
                </div>
            </div>

            <div class="col-md-4">

            </div>

           </div>

        </div>

<!--End Trash -->

   </div>
</x-app-layout>