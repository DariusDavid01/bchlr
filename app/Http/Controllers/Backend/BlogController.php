<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use App\Models\BlogPost;
use Image;

class BlogController extends Controller
{
    public function BlogCategory(){
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view',compact('blogcategory'));
    }

    public function BlogCategoryStore(Request $request){
        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_ro' => 'required',
        ],
    [
        'blog_category_name_en.required' => 'You have to input the name of the blog category in english!',
        'blog_category_name_ro.required' => 'You have to input the name of the blog category in romanian!',
    ]);

        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_ro' => $request->blog_category_name_ro,
            'blog_category_slug_en' => strtolower(str_replace(' ','-',$request->blog_category_name_en)),
            'blog_category_slug_ro' => strtolower(str_replace(' ','-',$request->blog_category_name_ro)),
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'Blog category inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function BlogCategoryEdit($id){
        $blogcategory = BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.category_edit',compact('blogcategory'));
    }

    public function BlogCategoryUpdate(Request $request){
        $blogcat_id = $request->id;
        BlogPostCategory::findOrFail($blogcat_id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_ro' => $request->blog_category_name_ro,
            'blog_category_slug_en' => strtolower(str_replace(' ','-',$request->blog_category_name_en)),
            'blog_category_slug_ro' => strtolower(str_replace(' ','-',$request->blog_category_name_ro)),
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'Blog category updated successfully',
        'alert-type' =>'info');

        return redirect()->route('blog.category')->with($notification);
    }

    public function BlogCategoryDelete($id){
        BlogPostCategory::findOrFail($id)->delete();
        $notification = array('message' => 'Blog category deleted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }
    public function ListBlogPost(){
        $blogpost = BlogPost::with('category')->latest()->get();
        return view('backend.blog.post.post_list',compact('blogpost'));
    }
    // blog post
    public function AddBlogPost(){
        $blogpost = BlogPost::latest()->get();
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.post.post_view',compact('blogpost','blogcategory'));
    }

    public function BlogPostStore(Request $request){
        $request->validate([
            'post_title_en' => 'required',
            'post_title_ro' => 'required',
            'post_image' => 'required',
        ],
    [
        'post_title_en.required' => 'You have to input the title of the post!',
        'post_title_ro.required' => 'You have to input the title of the post!',
        'post_image.required' => 'You have to insert the post image!',
    ]);
    $image = $request->file('post_image');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
    $save_url = 'upload/post/'.$name_gen;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_title_ro' => $request->post_title_ro,
            'post_slug_en' => strtolower(str_replace(' ','-',$request->post_title_en)),
            'post_slug_ro' => strtolower(str_replace(' ','-',$request->post_title_ro)),
            'post_image' => $save_url,
            'post_details_en' => $request->post_details_en,
            'post_details_ro' => $request->post_details_ro,
            'created_at' => Carbon::now(),
        ]);

    $notification = array('message' => 'Post inserted successfully',
        'alert-type' =>'success');

        return redirect()->route('list.post')->with($notification);

    }

    public function BlogPostDelete($id){
        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        unlink($img);
        BlogPost::findOrFail($id)->delete();
        $notification = array('message' => 'Post deleted successfully',
                'alert-type' =>'info');
        
        return redirect()->back()->with($notification);
    }
    
    public function BlogPostEdit($id){
        $post = BlogPost::findOrFail($id);
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.post.post_edit',compact('post','blogcategory'));
    }

    public function BlogPostUpdate(Request $request){
        $blogpost_id = $request->id;
        BlogPost::findOrFail($blogpost_id)->update([
            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_title_ro' => $request->post_title_ro,
            'post_slug_en' => strtolower(str_replace(' ','-',$request->post_title_en)),
            'post_slug_ro' => strtolower(str_replace(' ','-',$request->post_title_ro)),
            'post_details_en' => $request->post_details_en,
            'post_details_ro' => $request->post_details_ro,
        ]);

    $notification = array('message' => 'Post updated successfully',
        'alert-type' =>'success');

        return redirect()->route('list.post')->with($notification);
    }

    public function BlogPostImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;
        BlogPost::findOrFail($pro_id)->update([
            'post_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('message' => 'Post image updated successfully',
        'alert-type' =>'info');

        return redirect()->back()->with($notification);
    }
}
