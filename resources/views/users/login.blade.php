@extends('layouts.main')
@section('title', 'Login')
@section('content')
<div class="col-md-12 d-flex flex-column align-items-center justify-content-center vh-100 gap-3">
    <h2 class="m-0">Realizar login</h2>
    <div class="d-flex flex-row gap-2">
        <form id="form_user" action="/users/auth" method="POST">
        @csrf
            <div class="bg-white d-flex flex-column p-4 gap-2 border rounded shadow-lg">
                <div class="d-flex flex-column">
                    <label class="label-default">Email</label>
                    <input type="email" name="email" class="form-control px-3 py-2 input-default w-100" required>
                </div>
                <div class="d-flex flex-column">
                    <label class="label-default">Senha</label>
                    <input type="password" name="password" class="form-control px-3 py-2 input-default w-100" required>
                </div>
                <div class="d-flex flex-column align-items-center gap-3">
                    @if ($errors->has('login'))
                        <span class="text-danger">{{ $errors->first('login') }}</span>
                    @endif
                    <button type="submit" class=" btn btn-warning py-2 px-3 small d-flex flex-row align-items-center gap-2 ">
                        <p class="m-0">Entrar</p>
                    </button>
                    <h6>Não tem conta ainda? Faça seu cadastro <a href="{{ route('users.create') }}" class="a-default fc-blue">aqui</a></h6>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection