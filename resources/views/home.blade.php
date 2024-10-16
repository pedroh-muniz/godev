@extends('layouts.main')
@section('title', 'Home')
@section('content')
<div class="col-md-12 d-flex flex-column align-items-center justify-content-center vh-100 gap-3">
    <h2 class="m-0">Seja bem vindo</h2>
    <div class="bg-white d-flex flex-column p-4 gap-2 border rounded shadow-lg">
        <p>O que você deseja fazer ?</p>
        <div class="d-flex flex-row justify-content-between">
            <a href="{{ route('login') }}" class="btn btn-warning">Login</a>
            <a href="{{ route('users.create') }}" class="btn btn-warning">Cadastrar</a>
        </div>
    </div>
</div>
@endsection