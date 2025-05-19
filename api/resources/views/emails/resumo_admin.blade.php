<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resumo Diário</title>
</head>
<body>
    <h2>Resumo diário de vendas - {{ now()->format('d/m/Y') }}</h2>

    <p><strong>Total de vendas:</strong> {{ $quantidade }}</p>
    <p><strong>Valor total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>

    <h3>Por vendedor:</h3>
    <ul>
        @foreach ($resumoPorVendedor as $v)
            <li>{{ $v['nome'] }}: {{ $v['quantidade'] }} venda(s), R$ {{ number_format($v['total'], 2, ',', '.') }}</li>
        @endforeach
    </ul>

    <p>Atenciosamente,<br>Sistema de Vendas</p>
</body>
</html>
