@extends('layouts.main')

@section('title', 'Meus Contatos')

@section('content')
<div class="container">

    <div class="menu-section">
        <h1 class="section-title">Meus Contatos</h1>

        <ul class="menu-section-options">
            <li class="btn-default">
                <a href="/contacts/create">
                    <span>+</span>Adicionar Novo Contato
                </a>
            </li>
            <li class="search-default">
                <h1>Filtro de contato</h1>
                <form action="">
                    <input type="text" id="search_name" name="search_name" class="" placeholder="Nome">
                    <input type="text" id="search_email" name="search_email" class="" placeholder="Email">
                    <input class="btn-input" type="submit" value="Pesquisar">
                </form>
            </li>
        </ul>
    </div>

    <div class="area-dashboard">
        @if (count($contacts) > 0)
        <div class="contact-dashboard list" id="list">
            @foreach ($contacts as $contact)
            <a class="contact-item" id="item" href="/contacts/{{ $contact->id }}">
                <div class=""><img src="/img/contacts/{{ $contact->image }}" alt="Foto"></div>
                <div class="contact-info">
                    <p>{{ $contact->name }}</p>
                    <p class="">{{ $contact->email }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="centraliza area-pagination">
        {{ $contacts->links('shared.pagination') }}
    </div>
    <!---->
    @else
    <div class="area-error">
        <p>
            Não há contatos cadastrados ou não correspondem a pesquisa.
        </p>
    </div>
</div>

@endif
<script src="{{URL::asset('js/main.js')}}"></script>

@endsection
