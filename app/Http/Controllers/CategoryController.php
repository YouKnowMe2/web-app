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
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index',[
                'categories' => $categories,
                'trashCat' => $trashCat,
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

        $category = new Category();
        $category->category_name= $request->category_name;
        $category->user_id= Auth::user()->id;
        $category->save();


        return redirect()->back()->with('success','Your category has been added successfully');
    }

    public function edit($id){
            $category = Category::findOrFail($id);
            return view('admin.category.edit',[
                'category' => $category,
            ]);
    }
    public function update(Request $request,$id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name
        ]);
        return redirect()->route('all_category')->with('success','Category has been updated');
    }
    public function softDelete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success','Your category has been Trashed successfully');
    }
    public function restore($id){
        $category = Category::onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Your category has been Restored successfully');
    }
    public function delete($id){
        $category = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Your category has been Deleted successfully');
    }
}
