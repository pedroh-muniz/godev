@extends('layouts.main')
@section('title', 'Cadastro usuário')
<div class="col-md-12 d-flex flex-column align-items-center justify-content-center vh-100 gap-3">
    <h2 class="m-0">Cadastrar usuário</h2>
    <div class="d-flex flex-row gap-2">
        <form id="form_user" action="/users" method="POST">
        @csrf
            <div class="bg-white d-flex flex-column p-4 gap-2 border rounded shadow-lg">
                <div class="d-flex flex-column">
                    <label class="label-default">Nome</label>
                    <input type="text" name="user[name]" class="form-control px-3 py-2 input-default w-100" required>
                </div>
                <div class="d-flex flex-column">
                    <label class="label-default">Email</label>
                    <input type="email" name="user[email]" class="form-control px-3 py-2 input-default w-100" required>
                </div>
                @if(!$users->isEmpty())
                    <div class="d-flex flex-column">
                        <label class="label-default">Indicado por</label>
                        <select name="user[indication]" class="form-control px-3 py-2 input-default w-100">
                            <option value="">Nenhum</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="d-flex flex-column">
                    <label class="label-default">Senha</label>
                    <input type="password" name="user[password]" class="form-control px-3 py-2 input-default w-100" required>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <button type="submit" class="btn btn-warning"><p class="m-0">Salvar</p></button>
                </div>
            </div>
        </form>
    </div>
</div>
@section('content')
@endsection
@section('script')
<script>
    $('#form_user').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(response) {
                toastr.success(response.message, 'Sucesso');

                setTimeout(function() {
                     window.location.href = `/users/login`;
                }, 3000);
            },
            error: function(xhr, status, error) {
                if(xhr.status == 400){
                    toastr.error(xhr.responseJSON.message);                        
                }else{
                    toastr.error('Erro ao cadastrar usuário!', 'Erro');
                }
            }
        });
    });
</script>
@endsection