@extends('layouts.main')

@section('title', 'Envio De E-mail')

@section('content')
<div class="container">



    @if ($errors->any())
    @foreach ($errors->all() as $error)
    {{ $error }} <br />
    @endforeach
    @endif

    <div class="info-contato">
        <div class="info-contato-img">
            <img src="/img/contacts/{{ $contact->image }}" alt="Foto">
        </div>
        <div class="info-contato-dados">
            <p><span>Destinatário:</span>{{ $contact->name }}</p>
            <p><span>Email:</span>{{ $contact->email }}</p>
        </div>
        <div class="info-contato-opcoes">
            <div class="grid-item"><a href="#"><ion-icon name="create-outline"></ion-icon>Editar</a></div>
            <form action="/contacts/{{ $contact->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tem Certeza Da Exclusão?')"><ion-icon name="trash-outline" ></ion-icon>Excluir</button>
            </form>
        </div>



    </div>
    <div class="menu-section">
        <h1 class="section-title">Envio De Mensagem</h1>
    </div>
    @if ($message = Session::get('success'))
    <div>
        <strong>Obrigado!</strong> {{ $message }}
        <button type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="form-cadastro">
        <form method="post" action="{{ url('sendmail/send') }}">
            @csrf

            <div class="area-input">
                <label for="remetente">De:</label>
                <input type="text" placeholder="remetente" name="remetente" value="{{ $user->name }}">
            </div>
            <div class="area-input">
                <label for="message">Para:</label>
                <input type="text" placeholder="E-mail" name="email" value="{{ $contact->email }}">
            </div>
            <div class="area-input">
                <label for="message">Mensagem:</label>
                <textarea type="text" placeholder="mensagem" name="message">Preencha aqui a sua mensagem...</textarea>
            </div>
            <button class="btn-input" type="submit" name="send" value="Send">Enviar</button>
        </form>
    </div>

</div>

@endsection
