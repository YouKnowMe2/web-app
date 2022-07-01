<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Hi,<b> {{Auth::user()->name }} </b>
            <b style="float:right;">Edit Category</b>
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
                            New Category
                        </div>
                        <div class="card-body">
                            <form action="{{route('update.category',$category->id)}}" method="POST">@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="{{$category->category_name}}">
                                    @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
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
