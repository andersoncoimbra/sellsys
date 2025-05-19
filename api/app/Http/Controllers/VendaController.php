<?php


namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function index()
    {
        $vendas = Venda::with('vendedor')
            ->orderBy('data', 'desc')
            ->get()
            ->map(function ($venda) {
            return [
                'id' => $venda->id,
                'vendedor' => [
                'id' => $venda->vendedor->id,
                'nome' => $venda->vendedor->nome,
                'email' => $venda->vendedor->email,
                ],
                'valor' => $venda->valor,
                'data' => $venda->data,
                'comissao' => round($venda->comissao, 2),
            ];
            });

        return response()->json([
            'data' => $vendas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendedor_id' => 'required|exists:vendedores,id',
            'valor' => 'required|numeric|min:0',
            'data' => 'required|date',
        ]);

        $venda = Venda::create($validated);

        return response()->json([
            'message' => 'Venda cadastrada com sucesso.',
            'data' => $venda,
        ], 201);
    }

    public function vendasPorVendedor($vendedor_id)
{
    $vendedor = Vendedor::findOrFail($vendedor_id);

    $vendas = $vendedor->vendas()->get()->map(function ($venda) {
        return [
            'id' => $venda->id,
            'valor' => $venda->valor,
            'data' => $venda->data,
            'comissao' => round($venda->comissao, 2),
        ];
    });

    return response()->json([
        'vendedor' => [
            'id' => $vendedor->id,
            'nome' => $vendedor->nome,
            'email' => $vendedor->email
        ],
        'vendas' => $vendas
    ]);
}
}
