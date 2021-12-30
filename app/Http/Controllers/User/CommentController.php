<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Comment;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function CommentStore(Request $request){
        $post = $request->blogpost_id;
        $request->validate([
            'summary' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        Comment::insert([
            'blogpost_id' => $post,
            'user_id' => Auth::id(),
            'email' => $request->email,
            'comment' => $request->comment,
            'summary' => $request->summary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Comment added',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
