@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="greeting">
                        <h1>Hello, {{Auth::user()->name}}</h1>
                    </div>
            <div class="card">
                
            <div class="card-header">Animal species</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('animalSpecies')}}">Animal species!</a>   
                </div>
            </div><br><br>
            <div class="card">
                <div class="card-header">Managers</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('managers')}}">Managers!</a>
                    </div>
            </div><br><br>
            <div class="card">
                <div class="card-header">Animals</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <a href="{{route('animals')}}">Animals!</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
