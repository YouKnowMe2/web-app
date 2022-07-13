<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multiplepic;
use Illuminate\Http\Request;
use Image;

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
        //intervation package used
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        //intervation end

//        $name_gen = hexdec(uniqid());
//        $img_ext =strtolower($brand_image->getClientOriginalExtension());
//        $img_name = $name_gen.'.'.$img_ext;
//        $up_location = 'image/brand/';
//        $last_img = $up_location.$img_name;
//        $brand_image->move($up_location,$last_img);
        //End of Image Upload
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $name_gen;
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
    //It's for Multi image Methods
    public function Multipic(){
        $images = Multiplepic::all();
        return view('admin.multipic.index',[
            'images' => $images
        ]);
    }
    public function store_images(Request $request){

        $image = $request->file('images');


        foreach($image as $multi_img){


        //intervation package used
        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen);
        //intervation end

            $multi = new Multiplepic();
        $multi->image = 'image/multi/'.$name_gen;
        $multi->save();
        }
        //end of foreach
        return redirect()->back()->with('success','Your Image Has been Uploaded successfully');
    }
}
