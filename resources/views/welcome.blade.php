@extends('layouts.main')

@section('title', 'Meus Contatos')

@section('content')
<div class="container">
    <div class="area_pagina_inicial">
        <div class="info_pagina_inicial">
            <h1 class="section-title">Agenda De Emails</h1>
        </div>
        <div class="img_pagina_inicial">
            <a href="/contacts/dashboard/list">
                <img src="/img/meus_contatos.svg" alt="Meus Contatos">
            </a>
        </div>


    </div>

</div>

<script src="{{URL::asset('js/main.js')}}"></script>

@endsection