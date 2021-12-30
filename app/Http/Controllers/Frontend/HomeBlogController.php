<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;

class HomeBlogController extends Controller
{
    public function AddBlogPost(){
        $blogpost = BlogPost::latest()->get();
        $blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_list',compact('blogpost','blogcategory'));
    }

    public function DetailsBlogPost($id){
        $blogpost = BlogPost::findOrFail($id);
        $blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_details',compact('blogpost','blogcategory'));
    }

    public function HomeBlogCatPost($category_id){
        $blogpost = BlogPost::where('category_id',$category_id)->orderBy('id','DESC')->get();
        $blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_cat_list',compact('blogpost','blogcategory'));
    }
}
