<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',[
            'brands' => $brands
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes: jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Please Input Cateogry Name',
                'brand_name.min' => 'Brand Name Must be longer than 4 character'
            ]);
        //image file upload
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext =strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$last_img);
        //End of Image Upload
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $img_name;
        $brand->save();

        return redirect()->back()->with('success','Your Brand Has been created successfully');

    }
    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit',[
            'brand' => $brand
        ]);
    }


    public function update(Request $request,$id){
        $validate = $request->validate([
            'brand_name' => 'required|min:4',

        ],
            [
                'brand_name.required' => 'Please Input Cateogry Name',
                'brand_name.min' => 'Brand Name Must be longer than 4 character'
            ]);
        //image file upload
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext =strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$last_img);
            //End of Image Upload
            unlink($old_image);

            $brand =Brand::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->brand_image = $img_name;
            $brand->save();

        }else{
            $brand =Brand::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->save();
        }





        return redirect()->back()->with('success','Your Brand Has been Updated successfully');
    }

    public function delete($id){
        $brand = Brand::find($id);
        $old_image = $brand->brand_image;
        unlink('image/brand/'.$old_image);
        $brand->delete();

        return redirect()->back()->with('success','Your Brand Has been Deleted successfully');
    }
}
