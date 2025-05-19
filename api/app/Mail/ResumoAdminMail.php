<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResumoAdminMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $vendas;
    public $total;
    public $quantidade;
    public $resumoPorVendedor;

    public function __construct()
    {
        $this->vendas = \App\Models\Venda::whereDate('data', now()->toDateString())->get();
        $this->total = $this->vendas->sum('valor');
        $this->quantidade = $this->vendas->count();

        $this->resumoPorVendedor = $this->vendas->groupBy('vendedor_id')->map(function ($vendas) {
            return [
                'nome' => $vendas->first()->vendedor->nome ?? 'Desconhecido',
                'total' => $vendas->sum('valor'),
                'quantidade' => $vendas->count()
            ];
        });
    }

    public function build()
    {
        return $this->subject('Resumo Diário de Vendas')
                    ->view('emails.resumo_admin');
    }
}
