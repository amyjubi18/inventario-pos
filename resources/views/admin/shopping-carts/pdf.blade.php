<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Carrito de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .titlle{
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .section{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="titlle">
        Detalle de Carrito de Compras #{{ $model->id }}
    </div>
    <div>
        <strong>Fecha:</strong> {{  \Carbon\Carbon::parse($model->created_at)->format('d/m/Y') }} <br>
        <strong>Cliente:</strong> {{ $model->customer->name ?? '-'}} <br>
        {{-- <strong>Almacén:</strong> {{ $model->warehouse->name ?? '-'}} <br> --}}
        <strong>Forma de Pago:</strong> {{ $model->payment_method ?? '-'}} <br>
        <strong>Monto Pagado:</strong> S/ {{ number_format($model->amount_paid, 2) }} <br>
        <strong>Cambio:</strong> S/ {{ number_format($model->change, 2) }} <br>
    </div>
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>ITBIS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model->products ?? [] as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>S/ {{ number_format($product['price'], 2) }}</td>
                    <td>S/ {{ number_format($product['price'] * 0.18, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="section" style="text-align: right;">
        <strong>Total: </strong> S/ {{ number_format($model->total, 2) }}
    </div>
</body>
</html>
