<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Hi,<b> {{Auth::user()->name }} </b>
            <b style="float:right;">Multi Pictures</b>
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
                            All Pictures
                        </div>
                        <div class="card-group">
                            @foreach($images as $image)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{ asset($image->image) }}" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <!--Start of Form -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multi Image
                        </div>
                        <div class="card-body">

                            <form action="{{route('store.images')}}" method="POST" enctype="multipart/form-data">@csrf
                                <div class="form-group py-3">
                                    <label for="exampleInputEmail">Multiple Image</label>
                                    <input type="file" name="images[]"  class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" multiple >
                                    @error('images')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                                <button type="submit" class=" text-black btn btn-primary">Add Images</button>
                            </form>

                        </div>
                    </div>
                </div>
                <!--End of Form of Image-->

            </div>


            </div>


        </div>
</x-app-layout>
