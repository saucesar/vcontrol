@extends('email_service.base')

@section('content')
<h3>Olá {{ $name }}!</h3>

<p>Estes produtos estão proximos do vencimento.</p>
<br>
<table style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #04AA6D; color: white;">
        <th style="border: 1px solid #000;padding: 8px;">EAN</th>
        <th style="border: 1px solid #000;padding: 8px;">DESCRIÇÂO</th>
        <th style="border: 1px solid #000;padding: 8px;">DATA</th>
        <th style="border: 1px solid #000;padding: 8px;">QUANTIDADE</th>
        <th style="border: 1px solid #000;padding: 8px;">CATEGORIA</th>
    </thead>
    <tbody>            
    @foreach ($products as $product)
    <tr style="background-color: #fff;">
        <td style="border: 1px solid #000;padding: 8px;">{{ $product->ean }}</td>
        <td style="border: 1px solid #000;padding: 8px;">{{ $product->description }}</td>
        <td style="border: 1px solid #000;padding: 8px;">{{ $product->date }}</td>
        <td style="border: 1px solid #000;padding: 8px;">{{ $product->amount }}</td>
        <td style="border: 1px solid #000;padding: 8px;">{{ $category_name }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<br>
<b>Atenciosamente,</b>
<br>
<b>Equipe VControl</b>
@endsection