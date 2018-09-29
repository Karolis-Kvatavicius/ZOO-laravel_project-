<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Species;
use App\Manager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use App\Http\Requests\AnimalRequest;
use Illuminate\Http\Request;

class AnimalController extends Controller
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
        $managers = Manager::all();
        return view('animals.index', ['species' => Species::all(), 'managers' => $managers, 'animals' => Animal::all()]);
    }

    public function ajax($species_id) {
        $suitable_managers = Manager::where('animals_type', $species_id)->get();
        return response()->json(['managers' => $suitable_managers]);
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
    public function store(AnimalRequest $request)
    {
            if(Manager::where('id', $request->input('manager'))->first()->animals_type != $request->input('species')) {
            $errors = new MessageBag;
            $errors->add('error', 'Chosen manager don\'t have sufficient qualification to nurture this animal');
            return redirect()->route('animals')->withErrors($errors);
        }
        if(Animal::where('birth_year', '=', Input::get('birth_year'))->exists()) {
            $errors = new MessageBag;
            $errors->add('error', 'An animal born on this date already exists in ZooPark');
            return redirect()->route('animals')->withErrors($errors);
        }
        $animal = new Animal;
        $animal->birth_year = $request->input('birth_year');
        $animal->type_id = $request->input('species');
        $animal->species = Species::where('id', $request->input('species'))->first()->type;
        $animal->animal_book = strip_tags($request->input('animal_book'));
        $animal->manager_id = $request->input('manager');
        $animal->save();
        return redirect()->route('animals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $animal = Animal::where('id', $id)->first();
        $managers = Manager::where('animals_type', $animal->type_id)->get();
        return view('animals.edit', ['animal' => $animal, 'species' => Species::all(), 'managers' => $managers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, $id)
    {
        $animal = Animal::where('id', $id)->first();
        if(Manager::where('id', $request->input('manager'))->first()->animals_type != $request->input('species')) {
            $errors = new MessageBag;
            $errors->add('error', 'Chosen manager don\'t have sufficient qualification to nurture this animal');
            return redirect()->route('editAnimal', $animal->id)->withErrors($errors);
        }
        if(Animal::where('birth_year', '=', Input::get('birth_year'))->exists() && $animal->birth_year != $request->input('birth_year')) {
            $errors = new MessageBag;
            $errors->add('error', 'An animal born on this date already exists in ZooPark');
            return redirect()->route('editAnimal', $animal->id)->withErrors($errors);
        }
        $animal->birth_year = $request->input('birth_year');
        $animal->type_id = $request->input('species');
        $animal->species = Species::where('id', $request->input('species'))->first()->type;
        $animal->animal_book = strip_tags($request->input('animal_book'));
        $animal->manager_id = $request->input('manager');
        $animal->update();
        return redirect()->route('animals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::where('id', $id)->first();
        $animal->delete();
        return redirect()->route('animals');
    }
}
