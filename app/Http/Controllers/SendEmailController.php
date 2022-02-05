<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    public function send(Request $request)
    {

        $request->validate(
            [
                //'nome' => ['required', 'min:3', 'max:40'],
                'email' => ['required', 'email'],
                'remetente'=> ['required', 'min:3', 'max:40']
            ],
            [
                //'nome.required' => 'Error: O campo nome precisa ser preenchido',
                //'nome.min' => 'Error: O campo nome precisa ser no mínimo 3 caracteres',
                //'nome.max' => 'Error: O campo nome deve ter no máximo 40 caracteres',
                'email.required' => 'Error: O campo email precisa ser preenchido',
                'email.email' => 'Error: O campo email precisa receber um email válido',
                'required' => 'Error: O campo precisa ser preenchido',
                'remetente.required' => 'Error: O campo remetente precisa ser preenchido',
                'remetente.min' => 'Error: O campo remetente precisa ser no mínimo 3 caracteres',
                'remetente.max' => 'Error: O campo remetente deve ter no máximo 40 caracteres',
            ]
        );

        $data = array(
            //'nome' => $request->nome,
            'email' => $request->email,
            'message' => $request->message,
            'remetente' => $request->remetente
        );

        Mail::to($data['email'])
            ->send(new SendMail($data));

        return back()
            ->with('success', 'Mensagem Enviada Com Sucesso!');
    }
}
