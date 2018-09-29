@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="greeting">
                <h1>Hello, {{Auth::user()->name}}</h1>
                <a id="goBack" href="{{route('managers')}}">Go back</a><br><br>
            </div>
            <div class="card">
                
            <div class="card-header">Edit Manager: {{$manager->name}} {{$manager->surname}}</div>

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
                    <form action="{{route('updateManager', $manager-> id)}}" method="post">
                        @csrf
                        <label for="name">Name</label><br>
                        <input type="text" name="name" value="{{$manager->name}}"><br><br>
                        <label for="surname">Surname</label><br>
                        <input type="text" name="surname" value="{{$manager->surname}}"><br><br>
                        <label for="qualification">Qualification</label><br>
                        <select name="qualification" id="">
                            @foreach ($species as $specimen)
                                <option value="{{$specimen->id}}" @if ($specimen->id == $manager->animals_type) selected @endif>
                                    {{$specimen->type}}
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
