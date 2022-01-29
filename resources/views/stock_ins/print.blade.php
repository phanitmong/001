<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock In</title>
</head>
<body>
    <h1 style="text-align:center">Company Name</h1>
    <p style="text-align:center">
        Date: {{date('Y-m-d')}}
    </p>
    <hr>

    <table border="0" width="100%">
        <tr>
            <td>In Date</td>
            <td>:</td>
            <td>{{$in->in_date}}</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>:</td>
            <td>{{$in->description}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <h4>Items</h4>
    <table width="100%" border='1' cellspacing="0">
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit</th>
        </tr>
        @php($i=1)
        @foreach($items as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->code}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->qty}}</td>
                <td>{{$item->uname}}</td>
            </tr>
        @endforeach
    </table>
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        window.print();
        $(document).ready(function()
        {
            $i = setTimeout(function()
           {
               window.close();
           }, 1800);
        })
    </script>
</body>
</html>
