<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Hi,<b> {{Auth::user()->name }} </b>
            <b style="float:right;">All Category</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <!-- Start of alert Tag -->
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Well Done!</strong> {{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <!-- End of alert Tag -->
                        <div class="card-header">
                            All Category
                        </div>


                       <h1 class="d-none">{{ $i = 1 }} </h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Serial No</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$category->user_id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>

                    </div>
                </div>

                <!--Start of Form -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            New Category
                        </div>
                        <div class="card-body">
                <form action="{{route('store.category')}}" method="POST">@csrf
                    <div class="form-group">
                        <label for="exampleInputEmail">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                        @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class=" text-black btn btn-primary">Add Category</button>
                </form>

                        </div>
                    </div>
                </div>
                <!--End of Form of Category-->

            </div>

        </div>


    </div>
</x-app-layout>
