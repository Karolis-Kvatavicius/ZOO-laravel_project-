@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="greeting">
                <h1>Hello, {{Auth::user()->name}}</h1>
                <a id="goBack" href="{{route('animals')}}">Go back</a><br><br>
            </div>
            <div class="card">
                
            <div class="card-header">Edit Selected Animal</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('updateAnimal', $animal-> id)}}" method="post">
                        @csrf
                        <label for="species">Species</label><br>
                        <select name="species" id="selectSpecies">
                                @foreach ($species as $specimen)
                                    <option value="{{$specimen->id}}" {{$specimen->id == $animal->type_id ? 'selected' : ''}}>
                                        {{$specimen->type}}
                                    </option>
                                @endforeach 
                        </select><br><br>
                        <label for="birth_year">Birth Date</label><br>
                        <input type="date" name="birth_year" value="{{$animal->birth_year}}"><br><br>
                        <label for="animal_book">Notes</label><br>
                        <textarea name="animal_book" id="" cols="90" rows="10">{{strip_tags($animal->animal_book)}}</textarea><br>
                        <label for="manager">Manager</label><br>
                        <select name="manager" id="selectManager">
                            @foreach ($managers as $manager)
                                <option value="{{$manager->id}}" {{$manager->id == $animal->manager_id ? 'selected' : ''}}>
                                    {{$manager->name}} {{$manager->surname}}
                                </option>
                            @endforeach 
                        </select><br><br>
                        <input type="submit" name="submit" value="Edit">
                    </form>  
                </div>
            </div><br><br>
        </div>
    </div>
</div>
@endsection
