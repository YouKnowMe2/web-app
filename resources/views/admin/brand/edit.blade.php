<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Hi,<b> {{Auth::user()->name }} </b>
            <b style="float:right;">Edit Brand</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">


                <!--Start of Form -->
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Well Done!</strong> {{session('success')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">
                            Update Brand
                        </div>
                        <div class="card-body">
                            <form action="{{route('update.brand',$brand->id)}}" method="POST" enctype="multipart/form-data">@csrf
                                <input type="hidden" name="old_image" value="{{'image/brand/'.$brand->brand_image}}">
                                <input type="hidden" name="old_name" value="{{$brand->brand_image}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail">brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="{{$brand->brand_name}}">
                                    @error('brand_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail">brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                                    @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset('image/brand/'.$brand->brand_image) }}" style="width: 100px; height:100px;" alt="">
                                </div>

                                <button type="submit" class=" text-black btn btn-primary">Update Category</button>
                            </form>

                        </div>
                    </div>
                <!--End of Form of Category-->

            </div>

        </div>


    </div>
</x-app-layout>
