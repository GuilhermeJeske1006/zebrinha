<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmail;

class EmailController extends Controller
{
    public function enviar(Request $request)
    {
        $dados = [
            'email' => $request->input('email'),
            'mensagem' => $request->input('mensagem')
        ];

        Mail::to('guilhermeieski@gmail.cm')->send(new EnviarEmail($dados));

        return redirect()->back()->with('sucesso', 'E-mail enviado com sucesso!');
    }
}
