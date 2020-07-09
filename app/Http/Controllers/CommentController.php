<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Category;
use App\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        if(Auth::check()){
        $validateData = request()->validate([
            'user_comment' => 'required',
        ]);
        $validateData['posts_id'] = $post->id;
        $validateData['user_id'] = Auth::user()->id;
        $validateData['name'] = Auth::user()->name;
        Comment::create($validateData);
        return redirect()->back();
        } else {
            return redirect(route('login'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        return view('comment.edit', ['post'=>$post,
                                     'comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id)
        {
        $category = Category::where('id', $post->categories_id)->first();
        $game = Games::where('id', $category->games_id)->first();

        $validateData = request()->validate([
            'user_comment' => 'required'
        ]);

        $comment ->update($validateData);
        return redirect(route('post_detail', [$game->slug, $category->slug, $post->slug]));
        } else {
            return redirect(route('games_index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment_id)
    {
        Comment::where('id', $comment_id)->delete();
        return redirect()->back();
    }

    
}
