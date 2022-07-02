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


                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Serial No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem()+ $loop->index }}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->user->name}}</td>
                            <td>{{$category->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{route('category.softDelete',$category->id)}}" class="btn btn-danger">Move To Trash</a>
                            </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                        {{$categories->links() }}

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

            <!--Start of Trash Part-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Trashed Category
                            </div>


                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Serial No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($trashCat as $category)
                                    <tr>
                                        <td>{{ $trashCat->firstItem()+ $loop->index }}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$category->user->name}}</td>
                                        <td>{{$category->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="" class="btn btn-danger">Permanently Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            {{$trashCat->links() }}

                        </div>
                    </div>



                </div>

                <!--End of Trash Part -->

        </div>


    </div>
</x-app-layout>
