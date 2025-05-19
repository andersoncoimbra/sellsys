<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório Diário</title>
</head>
<body>
    <h2>Olá, {{ $vendedor->nome }}</h2>

    <p>Segue abaixo o resumo das suas vendas de hoje ({{ now()->format('d/m/Y') }}):</p>

    <ul>
        @foreach ($vendas as $venda)
            <li>{{ \Carbon\Carbon::parse($venda->data)->format('H:i') }} - R$ {{ number_format($venda->valor, 2, ',', '.') }}</li>
        @endforeach
    </ul>

    <p><strong>Total de vendas:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>
    <p><strong>Total da comissão (8,5%):</strong> R$ {{ number_format($comissao, 2, ',', '.') }}</p>

    <p>Obrigado e boas vendas!</p>
</body>
</html>
