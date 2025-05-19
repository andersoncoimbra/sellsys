<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComissaoDiariaMail;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();

        return response()->json([
            'data' => $vendedores
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:vendedores,email',
        ]);

        $vendedor = Vendedor::create($validated);

        return response()->json([
            'message' => 'Vendedor cadastrado com sucesso.',
            'data' => $vendedor,
        ], 201);
    }

    public function reenviarComissao($vendedor_id)
    {
        $vendedor = Vendedor::findOrFail($vendedor_id);

        // lógica de envio de e-mail de comissão aqui
        Mail::to($vendedor->email)->send(new ComissaoDiariaMail($vendedor));

        return response()->json(['message' => 'E-mail reenviado com sucesso.']);
    }

}
