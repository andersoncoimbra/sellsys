<?php
namespace App\Mail;

use App\Models\Vendedor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComissaoDiariaMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $vendedor;
    public $vendas;
    public $total;
    public $comissao;

    public function __construct(Vendedor $vendedor)
    {
        $this->vendedor = $vendedor;

        $this->vendas = $vendedor->vendas()->whereDate('data', now()->toDateString())->get();
        $this->total = $this->vendas->sum('valor');
        $this->comissao = $this->total * 0.085;
    }

    public function build()
    {
        return $this->subject('Relatório Diário de Vendas')
                    ->view('emails.comissao_diaria');
    }
}
