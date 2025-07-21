<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura Venta #{{ $venta->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Factura de Venta</h2>

    <p><strong>Cliente:</strong> {{ $venta->cliente->persona->razon_social }}</p>
    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha_hora)->format('d/m/Y H:i') }}</p>
    <p><strong>Comprobante:</strong> {{ $venta->comprobante->tipo_comprobante }} #{{ $venta->numero_comprobante }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->productos as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->pivot->cantidad }}</td>
                    <td>{{ number_format($item->pivot->precio_venta, 2) }}</td>
                    <td>{{ number_format($item->pivot->descuento, 2) }}</td>
                    <td>{{ number_format($item->pivot->cantidad * $item->pivot->precio_venta - $item->pivot->descuento, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $subtotal = $venta->productos->sum(function ($p) {
            return $p->pivot->cantidad * $p->pivot->precio_venta - $p->pivot->descuento;
        });
        $iva = $venta->impuesto;
        $total = $subtotal + $iva;
    @endphp

    <p><strong>Subtotal:</strong> {{ number_format($subtotal, 2) }}</p>
    <p><strong>IVA:</strong> {{ number_format($iva, 2) }}</p>
    <p><strong>Total:</strong> {{ number_format($total, 2) }}</p>

</body>
</html>