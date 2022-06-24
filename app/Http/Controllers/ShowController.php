<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Show;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //with index.blade.php
        $shows = Show::all();
        // dd($shows);
        return view('index', compact('shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //with create.blade.php
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //when creating in create.blade.php
        $validateData = $request->validate([
            'show_name' => 'required|max:255',
            'genre' => 'required|max:255',
            'imdb_rating' => 'required|numeric',
            'leader_actor' => 'required|max:255'
        ]);

        $show = Show::create($validateData);

        return redirect('/shows')->with('success', 'show is successfuly saved.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //when clicking the edit button in index.blade.php
        $show = Show::findOrFail($id);
        // dd($show);
        return view('edit', compact('show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'show_name' => 'required|max:255',
            'genre' => 'required|max:255',
            'imdb_rating' => 'required|numeric',
            'leader_actor' => 'required|max:255'
        ]);

        Show::whereId($id) -> update($validateData);
        return redirect('/shows')->with('success', 'Show is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $show = Show::findOrFail($id);
        $show->delete();

        return redirect('/shows')->with('success', 'Show is successfully deleted.');
    }
}
