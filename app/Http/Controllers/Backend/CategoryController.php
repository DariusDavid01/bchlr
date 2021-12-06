<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
        $categories = Category::latest()->get();
        return view('backend.category.category_view',compact('categories'));
    }

    public function CategoryStore(Request $request){
        $request->validate([
            'category_name_en' => 'required',
            'category_name_ro' => 'required',
            'category_icon' => 'required',
        ],
    [
        'category_name_en.required' => 'You have to input the name of the category in english!',
        'category_name_ro.required' => 'You have to input the name of the category in romanian!',
        'category_icon.required' => 'You have to insert the category icon!',
    ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_ro' => $request->category_name_ro,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_ro' => strtolower(str_replace(' ','-',$request->category_name_ro)),
            'category_icon' => $request->category_icon,
        ]);
    $notification = array('message' => 'Category inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    }

    public function CategoryUpdate(Request $request, $id){
        Category::findOrFail($id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ro' => $request->category_name_ro,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_ro' => strtolower(str_replace(' ','-',$request->category_name_ro)),
            'category_icon' => $request->category_icon,
        ]);
    $notification = array('message' => 'Category updated successfully',
        'alert-type' =>'success');

        return redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id){
        Category::findOrFail($id)->delete();
        $notification = array('message' => 'Category deleted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }
}
