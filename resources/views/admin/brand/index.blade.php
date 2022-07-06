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
                                <button type="button" class="btn-close text-black" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    <!-- End of alert Tag -->
                        <div class="card-header">
                            All Brand
                        </div>


                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">Serial No</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brands->firstItem()+ $loop->index }}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td><img src="{{asset('image/brand/'.$brand->brand_image)}}" style="height: 40px; width: 70px" alt=""></td>
                                    <td>{{$brand->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{route('edit.brand',$brand->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('delete.brand',$brand->id)}}" onclick="return confirm('Are you Sure you want to Delete this?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{$brands->links() }}

                    </div>
                </div>

                <!--Start of Form -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            New Brand
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                    @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group py-3">
                                    <label for="exampleInputEmail">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                    @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <button type="submit" class=" text-black btn btn-primary">Add Brand</button>
                            </form>

                        </div>
                    </div>
                </div>
                <!--End of Form of Category-->

            </div>




            </div>


        </div>
</x-app-layout>
