<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$invoice->invoice_no}}</title>
</head>
<body>
    <h3 >COMPANY NAME</h3>
    <h4>Invoice No : {{$invoice->invoice_no}}</h4>
    <table>
        <thead>
            <th>No</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </thead>
        <tbody>
            @foreach ($invoice->details as $item)
                <tr>
                    <td>1</td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->quantity*$item->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($invoice->invoice_no, 'C39')}}" alt="barcode" width="80px"/>


<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        window.print();
        $(document).ready(function()
        {

           $i = setTimeout(function()
           {
               window.close();
           }, 650)

        });
   </script>
</body>
</html>
