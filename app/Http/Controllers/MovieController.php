<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->input('take') && !$request->input('skip') && !$request->input('title')){
            return Movie::all();
        }else{
            $movies = Movie::all();
        }

        if($request->input('title')){
            $movies = $this->search($request->input('title'));
        }
        if($request->input('skip')){
            $movies = $this->skip($request->input('skip'), $movies);
        }
        if($request->input('take')){
            $movies = $this->take($request->input('take'), $movies);
        }


        return $movies;
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

    public function search($title)
    {
        $movies = Movie::where('title', 'LIKE', '%'.$title.'%')->get();

        return $movies;
    }

    public function take($number, $movies)
    {
        \Log::info($movies);
        $newMovie = [];
        for($i = 0; $i < $number; $i++){
            array_push($newMovie, $movies[$i]);
        }

        return $newMovie;
    }

    public function skip($number, $movies)
    {

        $newMovie = [];
        // \Log::info($movies);
        // $newMovie = array_slice($movies, $number);
        for($i = $number-1; $i < $movies->count(); $i++){
            array_push($newMovie, $movies[$i]);
        }


        return $newMovie;
    }

    public function checkIfExists($title, $date)
    {
        if(Movie::where('title', $title)->first()){
            if(Movie::where('releaseDate', $date)->first())
            {
                return true;
            }
        }

        return false;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        $request->duration = intval($request->duration);
        if($this->checkIfExists($request->input('title'), $request->input('releaseDate'))){
            print_r('Postoji film sa tim imenom i isti datum');
            return;
        }

        $this->validate(request(), Movie::STORE_RULES);

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $movie = Movie::findOrFail($id);
        $this->validate(request(), Movie::STORE_RULES);

        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = intval($request->input('duration'));
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        $string = 'Movie ' . $movie->title . ' was deleted';

        $movie->delete();

        return $string;
    }
}
