<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Species;
use Illuminate\Http\Request;
use App\Http\Requests\ManagerRequest;
use Illuminate\Support\MessageBag;

class ManagerController extends Controller
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
        return view('managers.index', ['species' => Species::all(), 'managers' => Manager::all()]);
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
    public function store(ManagerRequest $request)
    {
        // if(Manager::where('type', '=', Input::get('manager'))->exists()) {
        //     $errors = new MessageBag;
        //     $errors->add('error', 'This manager already exists in ZooPark');
        //     return redirect()->route('animalmanager')->withErrors($errors);
        // }
        $manager = new Manager;
        $manager->name = $request->input('name');
        $manager->surname = $request->input('surname');
        $manager->animals_type = $request->input('qualification');
        $manager->save();
        return redirect()->route('managers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = Manager::where('id', $id)->first();
        return view('managers.edit', ['manager' => $manager, 'species' => Species::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerRequest $request, $id)
    {
        $manager = Manager::where('id', $id)->first();
        if($manager->animals->count() > 0) {
            $errors = new MessageBag;
            $errors->add('error', 'This manager can\'t change qualification. He has unfinished responsibilities in
             ZooPark');
            return redirect()->route('editManager', $manager->id)->withErrors($errors);
        }
        $manager->name = $request->input('name');
        $manager->surname = $request->input('surname');
        $manager->animals_type = $request->input('qualification');
        $manager->update();
        return redirect()->route('managers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manager = Manager::where('id', $id)->first();
        if($manager->animals->count() > 0) {
            $errors = new MessageBag;
            $errors->add('error', 'This manager can\'t be deleted. He has unfinished responsibilities in ZooPark');
            return redirect()->route('managers')->withErrors($errors);
        }
        // if($species->animals->count() > 0) {
        //     $errors = new MessageBag;
        //     $errors->add('error', 'This species can\'t be deleted,
        //      because there is at least one animal of this species in ZooPark');
        //     return redirect()->route('animalSpecies')->withErrors($errors);
        // }
        $manager->delete();
        return redirect()->route('managers');
    }
}
