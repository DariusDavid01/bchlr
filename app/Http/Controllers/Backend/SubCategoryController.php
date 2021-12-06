<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subcategories','categories'));
    }

    public function SubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_ro' => 'required',
        ],
    [
        'category_id.required' => 'Please select an option!',
        'subcategory_name_en.required' => 'You have to input the name of the subcategory in english!',
        'subcategory_name_ro.required' => 'You have to input the name of the subcategory in romanian!',
    ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ro' => $request->subcategory_name_ro,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_ro' => strtolower(str_replace(' ','-',$request->subcategory_name_ro)),
        ]);
    $notification = array('message' => 'SubCategory inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    }

    public function SubCategoryUpdate(Request $request){
        $subcat_id = $request->id;
        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ro' => $request->subcategory_name_ro,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_ro' => strtolower(str_replace(' ','-',$request->subcategory_name_ro)),
        ]);
    $notification = array('message' => 'SubCategory updated successfully',
        'alert-type' =>'info');

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function SubCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();
        $notification = array('message' => 'SubCategory deleted successfully',
        'alert-type' =>'info');

        return redirect()->back()->with($notification);
    }




    // subsubcategory

    public function SubSubCategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view',compact('subsubcategory','categories'));
    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function GetSubSubCategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
    }

    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_ro' => 'required',
        ],
    [
        'category_id.required' => 'Please select an option!',
        'subcategory_id.required' => 'Please select an option!',
        'subsubcategory_name_en.required' => 'You have to input the name of the subsubcategory in english!',
        'subsubcategory_name_ro.required' => 'You have to input the name of the subsubcategory in romanian!',
    ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ro' => $request->subsubcategory_name_ro,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_ro' => strtolower(str_replace(' ','-',$request->subsubcategory_name_ro)),
        ]);
    $notification = array('message' => 'SubSubCategory inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit',compact('categories','subcategories','subsubcategories'));
    }

    public function SubSubCategoryUpdate(Request $request){
        $subsubcat_id = $request->id;

        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ro' => $request->subsubcategory_name_ro,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_ro' => strtolower(str_replace(' ','-',$request->subsubcategory_name_ro)),
        ]);
    $notification = array('message' => 'SubSubCategory updated successfully',
        'alert-type' =>'info');

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id){
        SubSubCategory::findOrFail($id)->delete();
        $notification = array('message' => 'SubSubCategory deleted successfully',
        'alert-type' =>'info');

        return redirect()->back()->with($notification);
    }
}
