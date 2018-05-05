<?php

namespace App\Services;
use Artistas\PagSeguro\PagSeguroException;
use PagSeguro as PagseguroFacade;

class Pagseguro implements GatewayContract
{
    private $nome = '';
    private $phone = '';
    private $email = '';
    private $hash = '';
    private $cpf_cnpj = '';
    private $paymentMethod = 'boleto';
    private $bank = null;
    private $itens = [
        [
            'itemId' => 'ID',
            'itemDescription' => 'Nome do Item',
            'itemAmount' => 12.14, //Valor unitário
            'itemQuantity' => '1', // Quantidade de itens
        ],
    ];

    public function addItem()
    {
        //todo: faltar implementar
    }

    public function __construct(String $nome, String $phone,String $email,String $hash, String $cpf, $valor)
    {
        $this->nome = $nome;
        $this->phone = $phone;
        $this->email = $email;
        $this->hash = $hash;
        $this->cpf_cnpj = $cpf;
        $this->itens[0]['itemAmount'] = $valor;
    }


    public function getPagamento()
    {
        try {
            $pagseguro = PagseguroFacade::setReference('2')
                ->setSenderInfo([
                    'senderName' => $this->nome,
                    'senderPhone' => $this->phone,
                    'senderEmail' => $this->email,
                    'senderHash' => $this->hash,
                    'senderCPF' => $this->cpf_cnpj,
                ])
                ->setItems($this->itens)
                ;
//            ->send([
//                    'paymentMethod' => $this->paymentMethod,
//                    'bankName' => $this->bank,
//                ]);
        }
        catch(PagSeguroException $e) {
            $e->getCode(); //codigo do erro
            dd($e->getMessage()); //mensagem do erro
        }
        return $pagseguro;
    }
}