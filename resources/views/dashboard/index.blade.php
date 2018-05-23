@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">{{ Auth::user()->name }}</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <p>Nombre:</p>
                        <p><strong>{{ Auth::user()->name }}</strong></p>
                        <hr>
                        <p>Email:</p>
                        <p><strong>{{ Auth::user()->email }}</strong></p>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset(Auth::user()->avatar) }}" style="width: 45px, height:45px" alt="{{ Auth::user()->name }}" class="img-responsive img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
                Has ingresado a nuestro sistema correctamente!
            </div>
        </div>
    </div>
</div>
@endsection