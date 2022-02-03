@extends('layouts.main')

@section('title', 'Adição de Contatos')

@section('content')
<div class="container">

    <div class="menu-section">
        <h1 class="section-title">Novo Contato</h1>
    </div>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    {{ $error }} <br />
    @endforeach
    @endif

    <div class="form-cadastro">
        <form action="/contacts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="area-input">
                <label for="name">Nome Completo:</label>
                <input type="text" name="name" id="">
            </div>
            <div class="area-input">
                <label for="email">Email:</label>
                <input type="text" name="email" id="">
            </div>
            <div class="area-input">
                <label for="image">Foto do Contato:</label>
                <input type="file" name="image" id="image">
            </div>
            <input class="btn-input" type="submit" value="Enviar">
        </form>
    </div>
</div>
@endsection
