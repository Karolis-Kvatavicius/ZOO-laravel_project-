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
                
            <div class="card-header">Enter New Manager</div>

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
                        <label for="name">Name</label><br>
                        <input type="text" name="name" value="{{old('name')}}"><br><br>
                        <label for="surname">Surname</label><br>
                        <input type="text" name="surname" value="{{old('surname')}}"><br><br>
                        <label for="qualification">Qualification</label><br>
                        <select name="qualification" id="">
                            @foreach ($species as $specimen)
                                <option value="{{$specimen->id}}" {{old('qualification') == $specimen->id ? 'selected' : ''}}>
                                    {{$specimen->type}}
                                </option>
                            @endforeach 
                        </select><br><br>
                        <input type="submit" name="submit" value="Add">
                    </form>  
                </div>
            </div><br><br>
            <div class="card">
                <div class="card-header">Managers working in ZooPark</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ol>
                            @foreach ($managers as $manager)
                                <li>{{$manager->name}} {{$manager->surname}}
                                    <a href="{{route('deleteManager', $manager-> id)}}">Delete</a>
                                <div>Qualification: {{$manager->qualification->type}}</div> 
                                <a href="{{route('editManager', $manager-> id)}}">Edit</a>    
                                </li><br>
                            @endforeach
                        </ol>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
