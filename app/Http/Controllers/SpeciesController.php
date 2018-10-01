<?php

namespace App\Http\Controllers;

use App\Species;
use Illuminate\Http\Request;
use App\Http\Requests\SpeciesRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;

class SpeciesController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('species.index', ['species' => Species::all()]);
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
    public function store(SpeciesRequest $request)
    {
        if(Species::where('type', '=', Input::get('species'))->exists()) {
            $errors = new MessageBag;
            $errors->add('error', 'This species already exists in ZooPark');
            return redirect()->route('animalSpecies')->withErrors($errors);
        }
        $species = new Species;
        $species->type = $request->input('species');
        $species->save();
        return redirect()->route('animalSpecies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function show(Species $species)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $species)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function destroy(Species $species)
    {
        if($species->managers->count() > 0) {
            $errors = new MessageBag;
            $errors->add('error', 'This species can\'t be deleted,
             because there is at least one manager with this qualification in ZooPark');
            return redirect()->route('animalSpecies')->withErrors($errors);
        }
        if($species->animals->count() > 0) {
            $errors = new MessageBag;
            $errors->add('error', 'This species can\'t be deleted,
             because there is at least one animal of this species in ZooPark');
            return redirect()->route('animalSpecies')->withErrors($errors);
        }
        $species->delete();
        return redirect()->route('animalSpecies');
    }
}
