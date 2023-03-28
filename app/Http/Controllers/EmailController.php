<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmail;
use Illuminate\Support\Facades\DB;


class EmailController extends Controller
{
    public function enviar(Request $request)
    {
        $email = new Email();
        $email->email = $request->email;
        $email->mensagem = $request->mensagem;

        try {
            DB::beginTransaction();
            $email->save();
            DB::commit();

            return back()->with('success','E-mail enviado com sucesso!!');

        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','Erro ao enviar email');
        }
    }
}
