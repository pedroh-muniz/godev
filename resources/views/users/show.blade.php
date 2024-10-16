@extends('layouts.main')
@section('title', 'Pontos')
@section('content')
<div class="col-md-12 d-flex flex-column align-items-center justify-content-center h-100 gap-3 py-2">
    <h2 class="m-0">Olá {{auth()->user()->name}}</h2>
    <div class="col-md-6 bg-white d-flex flex-column align-items-center p-4 gap-2 border rounded shadow-lg">
        <h3 class="m-0">Pontos</h3>
        <div class="d-flex flex-column align-items-center col-md-6 gap-1">
            <h5 class="m-0">Total</h5>
            <div class="bg-primary col-md-3 d-flex flex-column align-items-center py-1 rounded">
                <p class="m-0 text-white">{{ $esquerdo + $direito }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex flex-row justify-content-between">
            <div class="d-flex flex-column align-items-center col-md-6 gap-1">
                <h5 class="m-0">Lado Esquerdo</h5>
                <div class="bg-secondary col-md-3 d-flex flex-column align-items-center py-1 rounded">
                    <p class="m-0 text-white">{{ $esquerdo }}</p>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center col-md-6 gap-1">
                <h5 class="m-0">Lado Direito</h5>
                <div class="bg-info col-md-3 d-flex flex-column align-items-center py-1 rounded">
                    <p class="m-0 text-white">{{ $direito }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 bg-white rounded shadow-lg p-3 d-flex flex-column gap-3">
        <h6>Usuários atrelados direta ou indiretamente</h6>
        @if(count($users)>0)
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col"><h6 class="m-0">Nome</h6></th>
                        <th scope="col"><h6 class="m-0">Pontos</h6></th>
                        <th scope="col"><h6 class="m-0">Lado</h6></th>
                    </tr>
                </thead>
                <tbody id="table-content">
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->point }}</td>
                            <td>{{ $user->lado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="d-flex pt-2">
                <p class="m-0">Nenhum usuário foi indicado por você.</p>
            </div>
        @endif
    </div>
    <div class="col-md-6 d-flex flex-row-reverse">
        <a href="{{route('users.logout')}}" class="btn btn-warning" >Sair</a>        
    </div>
</div>
@endsection