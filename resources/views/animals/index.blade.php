@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="greeting">
                <h1>Hello, {{Auth::user()->name}}</h1>
                <a id="goBack" href="{{route('home')}}">Go back</a><br><br>
            </div>
            <div class="card">
                
            <div class="card-header">Enter New Animal</div>

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
                    <form action="" method="post">
                        @csrf
                        <label for="species">Species</label><br>
                        <select name="species" id="selectSpecies">
                                @foreach ($species as $specimen)
                                    <option value="{{$specimen->id}}" {{old('species') == $specimen->id ? 'selected' : ''}}>
                                        {{$specimen->type}}
                                    </option>
                                @endforeach 
                        </select><br><br>
                        <label for="birth_year">Birth Date</label><br>
                        <input type="date" name="birth_year" value="{{old('birth_year')}}"><br><br>
                        <label for="animal_book">Notes</label><br>
                        <textarea name="animal_book" id="" cols="90" rows="10">{{old('animal_book')}}</textarea><br>
                        <label for="manager">Manager</label><br>
                        <select name="manager" id="selectManager">
                            @foreach ($managers as $manager)
                            @if ($manager->animals_type == old('species', 1) )
                            <option value="{{$manager->id}}" {{old('manager') == $manager->id ? 'selected' : ''}}>
                                {{$manager->name}} {{$manager->surname}}
                            </option>
                            @endif
                            @endforeach
                            {{-- jquery ajax code from public/js/script.js --}}
                        </select><br><br>
                        <input type="submit" name="submit" value="Add">
                    </form>  
                </div>
            </div><br><br>
            <div class="card">
                <div class="card-header">Animals living in ZooPark</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ol>
                            @foreach ($animals as $animal)
                                <li><strong>Birth Date:</strong> {{$animal->birth_year}}
                                    <div><strong>Species:</strong> {{$animal->species}}</div>
                                    <div><strong>Manager:</strong> {{$animal->manager->name}} {{$animal->manager->surname}}</div>
                                    <div><strong>Notes:</strong> {{strip_tags($animal->animal_book)}}</div> 
                                    <a class="animalEdit" href="{{route('editAnimal', $animal-> id)}}">Edit</a> 
                                    <a href="{{route('deleteAnimal', $animal-> id)}}">Delete</a>    
                                </li><br>
                            @endforeach
                        </ol>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
