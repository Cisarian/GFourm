<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Games;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($game_slug, $category_slug)
    {
        $game = Games::where('slug', $game_slug)->first();  
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();                        

        $posts = $category -> post;
        return view('post.index', ['posts' => $posts,
                    'game' => $game,
                    'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($game_slug, $category_slug)
    {
        if (Auth::check()) {
        $game = Games::where('slug', $game_slug)->first();
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();

        return view('post.create',['game' => $game,
                                   'category' => $category]);
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $game_slug, $category_slug)
    {
        $game = Games::where('slug', $game_slug)->first();
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();
        $validateData = request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $validateData['user_id'] = Auth::user()->id;
        $validateData['slug'] = str_slug($request['title']);
        $validateData['categories_id'] = $category->id;
        Post::create($validateData);
        return redirect(route('post_list', [$game->slug, $category->slug]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($game_slug, $category_slug, $post_slug)
    {
        $game = Games::where('slug', $game_slug)->first();
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();
        $post = Post::where([['categories_id', $category->id],
                              ['slug', $post_slug]])->first();
        $user = User::where('id', $post->user_id)->first();                 
        $comments = $post->comment;                        
        return view('post.post_detail', ['post' => $post,
                                         'comments'=> $comments,
                                         'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($game_slug, $category_slug, $post_slug)
    {
        if(Auth::check()){
        $game = Games::where('slug', $game_slug)->first();
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();
        $post = Post::where([['categories_id', $category->id],
                             ['slug', $post_slug]])->first();
        return view('post.create', ['game' => $game,
                                    'category' => $category,
                                    'post' => $post]);
        } else {
            return redirect(route('login'));
        }                          
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $game_slug, $category_slug, $post_slug)
    {
        $game = Games::where('slug', $game_slug)->first();
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();
        $post = Post::where([['categories_id', $category->id],
                             ['slug', $post_slug]])->first();
        $validateData = request()->validate([
            'title' => 'required',
            'body' =>  'required',
        ]);
        $post->update($validateData);
        return redirect(route('post_list', [$game->slug, $category->slug]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        Post::where('id', $post_id)->delete();
        return redirect()->back();
    }
}
