<?php

namespace App\Http\Controllers;

use App\Games;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::all();
        return view('fourm.index', ['games'=>$games]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fourm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validateData = request()->validate([
            'title' => 'required'
        ]);
        $validateData['slug'] = str_slug($request['title']);
        $validation = 1;

        if (Games::where('slug', $validateData['slug'])->exists()){
            return view('fourm.create', ['validation' => $validation,
                                         'title' => $validateData['title']]);
        } else {
            Games::create($validateData);  
        }

        
        return redirect()->route('games_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $games)
    {
       
        return view('fourms.categories'. ['categories'-> $games]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $games = Games::where('slug', $slug) ->firstOrFail();
        
        return view('fourm.create', ['games' => $games]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validateData = request()->validate([
            'title' => 'required'
        ]);
        $validateData['slug'] = str_slug($request['title']);
        $games = Games::where('slug', $slug) -> first();
        $validation = 1;


        if (Games::where('slug', $validateData['slug'])->exists()){
            return view('fourm.create', ['validation' => $validation,
                                         'title' => $validateData['title'],
                                         'games' => $games]);
        } else {
            $games ->update($validateData);
        }

        
        return redirect(route('games_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy($game_slug)
    {
        Games::where('slug', $game_slug)->delete();
        return redirect(route('games_index'));
    }

}
