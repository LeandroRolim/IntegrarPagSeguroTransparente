<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagarRequest;
use App\Services\Pagseguro;
use Illuminate\Http\Request;

class PagarController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function create(PagarRequest $request)
    {
//        dd($request->all());
        $pagseguro = new Pagseguro(
            $request->input('nome'),
            $request->input('phone'),
            $request->input('email'),
            $request->input('hash'),
            $request->input('cpf'),
            $request->input('valor')
        );
        return redirect($pagseguro->getPagamento()->send([
            'paymentMethod' => $request->input('paymentMethod'),
            'bank' => 'itau',
        ])->paymentLink);

//        dd($pagseguro->getPagamento());
//        return view('pagar', [
//            'pagseguro' => $pagseguro->getPagamento()->send([
//                    'paymentMethod' => 'boleto',
//                ])->paymentLink
//        ]);
    }
}
