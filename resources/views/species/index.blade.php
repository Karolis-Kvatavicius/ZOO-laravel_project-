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
                
            <div class="card-header">Enter New Species</div>

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
                        <label for="species">Name</label><br>
                        <input type="text" name="species" value="{{old('species')}}"><br><br>
                        <input type="submit" name="submit" value="Add">
                    </form>  
                </div>
            </div><br><br>
            <div class="card">
                <div class="card-header">Species supported by ZooPark</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ol>
                            @foreach ($species as $type)
                                <li>{{$type->type}} <a href="{{route('deleteSpecies', $type-> id)}}">Delete</a></li><br>
                            @endforeach
                        </ol>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
