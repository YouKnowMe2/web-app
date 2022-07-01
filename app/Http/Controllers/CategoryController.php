<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('user_id')->paginate(5);
            return view('admin.category.index',[
                'categories' => $categories
            ]);
    }
    public function store(Request $request){
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Input Cateogry Name',
            'category_name.max' => 'Category limit has been reached'
        ]);

//        Category::insert([
//            'category_name' => $request->category_name,
//            'user_id' => Auth::user()->id,
//            'created_at' => Carbon::now()
//        ]);
        $category = new Category();
        $category->category_name= $request->category_name;
        $category->user_id= Auth::user()->id;
        $category->save();


        return redirect()->back()->with('success','Your category has been added successfully');
    }
}
