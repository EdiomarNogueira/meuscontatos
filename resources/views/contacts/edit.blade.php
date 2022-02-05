@extends('layouts.main')

@section('title', 'Adição de Contatos')

@section('content')
<div class="container">

    <div class="menu-section">
        <h1 class="section-title">Editar Contato</h1>
    </div>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    {{ $error }} <br />
    @endforeach
    @endif

    <div class="form-cadastro">
        <form action="/contacts/update/{{ $contact->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="area-preview">
                <div class="preview-dados">
                    <div class="area-input">
                        <label for="name">Nome Completo:</label>
                        <input type="text" name="name" id="" value="{{ $contact->name }}">
                    </div>
                    <div class="area-input">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="" value="{{ $contact->email }}">
                    </div>
                </div>

                <div class="preview-img">
                    <img src="/img/contacts/{{ $contact->image }}" alt="Foto">
                </div>
            </div>
            <div class="flex">
                <div class="area-input">
                    <label for="image">Foto do Contato:</label>
                    <input type="file" name="image" id="image">

                </div>
                <div class="area-input">
                    <input class="btn-input" type="submit" value="Editar Contato">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
