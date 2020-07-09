<?php

namespace App\Http\Controllers;

use App\Category;
use App\Games;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
       

        $game = Games::where('slug', $slug)->firstOrFail();
        $categories = $game -> category;
        return view('category.index', [ 'slug'=> $slug,
                                        'categories' => $categories,
                                        'game' => $game]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        
        return view('category.create', ['slug'=>$slug]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $game = Games::where('slug', $slug)->firstOrFail();
        $validateData = request()->validate([
            'title' => 'required',
        ]);
        $validateData['slug'] = str_slug($request['title']);
        $validateData['games_id'] = $game->id;
        $checkUnique = $game -> category;
        $validation = 1;
        foreach($checkUnique as $check)
        {

            if($check->slug == $validateData['slug'])
            {
                return view('category.create', ['validation' => $validation,
                                                'slug'=> $slug,
                                                'title'=> $validateData['title']]);
            }
        }   
        Category::create($validateData);
        return redirect(route('category_list', $slug));

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($game_slug, $category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $game = Games::where('slug', $game_slug) -> firstOrFail();
        return view('category.create', ['category' => $category,
                                        'game' => $game]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $game_slug, $category_slug)
    {
        $game = Games::where('slug', $game_slug)->first();
        $category = Category::where([['games_id', $game->id],
                                     ['slug', $category_slug]])->first();
        $validateData = request()->validate([
            'title' => 'required'
        ]);
        $validateData['slug'] = str_slug($request['title']);
        $validation = 1;
        foreach ($game->category as $check)
        {

            if ($check->slug != $validateData['slug'])
            {
                $category -> update($validateData);
                return redirect(route('category_list', $game_slug));
            }
        }
        return view('category.create', ['category' => $category,
                                        'game' => $game,
                                        'title' => $validateData['title'],
                                        'validation' => $validation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    private function checkUnique($game)
    {
        foreach($game->category as $check)
        {

            if($check->slug == $validateData['slug'])
            {
                return true;
            }
        }  
        return false; 
    }

    public function showAll(Category $category)
    {

        $comments = $category -> comment;
        return view('category.comments', ['comments' => $comments,
                                          'category' => $category]);

    }
}



// $post1 = null;
//if($post1==null){
//    dd('works');
