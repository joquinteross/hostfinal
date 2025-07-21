<!-- resources/views/compra/factura.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Compra #{{ $compra->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        .header { font-weight: bold; margin-top: 15px; }
    </style>
</head>
<body>
    <h2>Factura Compra #{{ $compra->id }}</h2>

    <p class="header">Proveedor:</p>
    <p>{{ $compra->proveedore->persona->razon_social }}</p>

    <p class="header">Comprobante:</p>
    <p>{{ $compra->comprobante->tipo_comprobante }} - {{ $compra->numero_comprobante }}</p>

    <p class="header">Fecha:</p>
    <p>{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($compra->productos as $index => $item)
                @php
                    $subtotal = $item->pivot->cantidad * $item->pivot->precio_compra;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->pivot->cantidad }}</td>
                    <td>{{ number_format($item->pivot->precio_compra, 2) }}</td>
                    <td>{{ number_format($item->pivot->precio_venta, 2) }}</td>
                    <td>{{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="header">Impuesto ({{ $compra->impuesto }}):</p>
    <p>${{ number_format($compra->impuesto, 2) }}</p>

    <p class="header">Total:</p>
    <p><strong>${{ number_format($total + $compra->impuesto, 2) }}</strong></p>

</body>
</html>