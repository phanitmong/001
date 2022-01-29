<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://fonts.googleapis.com/css2?family=Bayon&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>POS</title>
    <style>
        *{
            font-family: 'Bayon';
        }
        .main
        {

            min-height: 1005px;
            color: rgb(8, 7, 7);
            /* padding: 20px; */
            padding-top: 10px;
            padding-left: 25px;
            padding-right: 25px;
        }
        .m
        {

            width: 100%;
        }
        .foot
        {
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            border-top: 10px solid white;
            padding-top: 10px;
            padding-left: 25px;
            padding-right: 25px;
            height: 250px;
            width: 100%;
            margin: auto;
        }
        .sale
        {

            color: black;
        }
    </style>
</head>
<body id="body">
<div class="bg-light m " >
    <div class="main  ">
        <div class="container-fluid">
            <div class="d-flex justify-content-between pt-2">
                <b><i class="fa fa-sign-out-alt"></i> ចាកចេញ</b>
                <h3 class="pl-5">ប្រព័ន្ធគ្រប់គ្រងការលក់</h3>
                <b>
                    <i class="fa fa-user"></i> អ្នកលក់ : Mong Phanit
                </b>
            </div>
        </div>
        <hr>
       <div class="sale" style="height: 600px !important;overflow-y:auto">
        <table class="table table-sm w-100  mt-2 table-bordered bg-white" >
            <thead class="text-center text-dark">
                <th>កូដ</th>
                <th>ឈ្មោះទំនិញ</th>
                <th>ចំនួន</th>
                <th>តម្លៃ</th>
                <th>តម្លៃសរុប</th>
                <th>សកម្មភាព</th>
            </thead>
            <tbody>

            </tbody>
        </table>
       </div>

      <div class="container-fluid ">
        <div class="foot mt-2 bg-info fixed-bottom ">
            <div class="row">
                <div class="col-sm-4 pt-5">
                   <div class="row ">
                       <div class="col-sm-4 text-white"><label for="">បញ្ចូលលកូដទំនីញ :</label></div>
                       <div class="col-sm-8">
                           <input type="text" class="form-control form-control-sm" id="bar_code" placeholder="ស្តែនកូដទំនិញ" autofocus>

                           <small id="message_label" class="text-white" style="font-size: 10px"> ទំនិញមិនមានក្នុងបញ្ជី សូមបញ្ចូលជាមុនសិន</small>
                       </div>
                   </div>
                <div class="row">
                    <div class="col-sm-4 text-white"><label for=""></label></div>
                    <div class="col-sm-8">
                       <button class="btn-sm btn-success btn mt-2"><i class="fa fa-plus-circle"></i> បន្ថែមទំនិញ</button>
                    </div>
                </div>
                </div>
                <div class="col-sm-4 pt-5">
                    <div class="row ">
                        <div class="col-sm-4 text-white"><label for="">ប្រាក់ដុល្លា + ប្រាក់រៀល:</label></div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" placeholder="ប្រាក់ដុល្លា" >
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" placeholder="ប្រាក់រៀល" >
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-4 text-white"><label for="">ប្រាក់ដុល្លា :</label></div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" placeholder="ប្រាក់ដុល្លា" >
                        </div>
                    </div>

                 </div>
                 <div class="col-sm-4 pt-5">
                    <div class="row ">
                        <div class="col-sm-4 text-white"><label for="">ប្រាក់ដុល្លា + ប្រាក់រៀល:</label></div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" placeholder="ប្រាក់ដុល្លា" id="triel" readonly value="0">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" placeholder="ប្រាក់រៀល" id="tusd" readonly value="0">
                        </div>
                    </div>
                 <div class="row">
                     <div class="col-sm-4 text-white"><label for=""></label></div>
                     <div class="col-sm-8">
                        <button class="btn btn btn-success btn-sm mt-2" onclick="payment()"><i class="fa fa-times"></i> គិតប្រាក់</button>
                        <input type="hidden" id="rate" value='4000'>
                     </div>
                 </div>
                 </div>
               </div>
           </div>
      </div>
    </div>
</div>
@csrf
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $('#message_label').hide();
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
         });
    $("#bar_code").change(function(e){
       let code = $('#bar_code').val();
        $.ajax({
           type:'POST',
           url:"{{ route('pos.get') }}",
           data:{code:code, },
           success:function(data){
            let td = $("tbody tr[pid="+data.id+"]");
            if(td.length>=1)
            {
                    let unit = td.children('td:eq(2)').text();
                    let total = td.children('td:eq(3)').text();
                    let count = parseFloat(unit)+1;
                    let re_total = parseFloat(total)*count;
                    td.children('td:eq(2)').text(count);
                    td.children('td:eq(4)').text(re_total);
                    $('#bar_code').val('');
                    $('#message_label').hide();
                    balance();
            }
            else if(data!='')
            {
                $('#no_data').remove();
                let html = "<tr pid="+data.id+">"+"<td>"+data.code+"</td><td>"+data.name+"</td><td>1</td><td>"+data.price+"</td><td>"+data.price+"</td>"+"<td><button class='btn btn-sm btn-danger' onclick=(removeItem(this))>លុប</button></td></tr>";
                $('tbody').append(html);
                $('#bar_code').val('');
                $('#message_label').hide();
                balance();
            }
            else
            {
                $('#message_label').show();
                $('#bar_code').val('');

            }

           }
        });
    });

    function payment()
    {
        let items = [];
        let trs = $("tbody tr");
        let total = 0;
        for(let i=0; i<trs.length; i++)
        {
            let tds = $(trs[i]).children();
            let item = {
                product_id: $(trs[i]).attr('pid'),
                quantity: $(tds[2]).html(),
                price:$(tds[3]).html()
            }
            items.push(item);
            if(i>0)
            {
                let price = item.price;
                let qty = item.quantity;
                total += qty*price;
            }

        }
     

        let data = {items: items,amount: $('#tusd').val()};
        let token = $("input[name='_token']").val();
        if(trs.length>0)
        {
            $.ajax({
            type: "POST",
            url:  "/pos/save",
            data: data,
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', token);
            },
            success: function (sms) {

                if(sms>0)
                {
                    window.open("/pos/invoice/" + sms,"_blank");
                    $('tbody tr').remove();
                    $('#tusd').val(0);
                    $('#triel').val(0);
                    $('#bar_code').focus();

                }
                else{
                    alert("បរាជ័យ សួមព្យាយាមម្តងទៀត!");
                }

            }
        });
        }
        else
        {
            alert('មិនមានទំនិញណាមួយទេ! សូមស្កែនទំនិញជាមុនសិន');
        }
    }
    function balance()
    {
        let items = [];
        let trs = $("body tr");
        let total = 0;
        let rate = $('#rate').val();
        for(let i=0; i<trs.length; i++)
        {
            let tds = $(trs[i]).children();
            let item = {
                product_id: $(trs[i]).attr('pid'),
                quantity: $(tds[2]).html(),
                price:$(tds[3]).html()
            }

            if(i>0)
            {
                let price = item.price;
                let qty = item.quantity;
                total += qty*price;
            }

        }
        $('#tusd').val(total);
        $('#triel').val((total*rate).toFixed(2));

    }

    function removeItem(obj)
    {
        $(obj).parent().parent().remove();
        balance();
    }

    $(document).ready(function()
    {
        $('body').keypress(function(e)
        {
            if(e.which==43)
            {
                payment();
            }
        })

    });



</script>
</body>
</html>
