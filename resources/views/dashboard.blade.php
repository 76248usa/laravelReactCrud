<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Hello <b>{{ Auth::user()->name }}</b>
           <b style="float:right;">Total users
            <span class="badge badge-danger">{{count($users)}}
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row>

                <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>

                <table class="table table-dark table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created_at</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($users as $user)

                      <tr>

                        <th scope="row">{{$i++}}</th>
                        <td> {{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                      </tr>

                      @endforeach
                    </tbody>
                  </table>

           </div>

        </div>

    </div>
</x-app-layout>
