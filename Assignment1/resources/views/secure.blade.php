@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="/">
                <legend><h1>Welcome back, {{ Auth::user()->name }}!</h1></legend>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary">Home Page</button>
                </div>
            </form>
        </div>
    </div>

@endsection
