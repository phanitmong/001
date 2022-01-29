@extends('layouts.master')
@section('style')
    <style>
        .hide
        {
            display: none !important;
        }
    </style>
@endsection
@section('content')
<form>
    @csrf
    <input type="hidden" id="id" value="{{$in->id}}">
    <div class="card p-2">
        <div class=" container-fluid toolbox mt-2 p-2">
            <a href="{{url('scrap/create')}}" class="btn btn-success btn-sm btn-oval">
                <i class="fa fa-plus-circle"></i> បង្កើត
            </a>
            <a href="{{url('scrap')}}" class="btn btn-warning btn-sm btn-oval">
                <i class="fa fa-reply-all"></i> ត្រលប់
            </a>
            <a href="{{url('scrap/delete/'.$in->id)}}" class="btn btn-danger btn-sm btn-oval"
                onclick="return confirm('You want to delete?')">
                <i class="fa fa-trash"></i> លុប
            </a>
            <a href="{{url('scrap/print/'.$in->id)}}" class="btn btn-primary btn-sm btn-oval"
                target="_blank">
                <i class="fa fa-print"></i> បោះពុម្ភ
            </a>
        </div>
        <hr>
        <div class="card-block">
            <div class="row">
               <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="in_date" class="col-sm-3">កាលបរិច្ឆេទ</label>
                        <div class="col-sm-9">

                            <span id="lb_in_date">: {{$in->scrap_date}}</span>
                            <input type="date" class="form-control hide" id="in_date"
                                value="{{$in->scrap_date}}">
                        </div>
                    </div>
               </div>
               <div class="col-sm-6">
                <div class="form-group row">
                    <label for="reference" class="col-sm-3">លេខយោង</label>
                    <div class="col-sm-9">
                        <span id="lb_reference">: {{$in->reference_no}}</span>
                        <input type="text" class="form-control hide" id="reference"
                            value="{{$in->reference_no}}">
                    </div>
                </div>
            </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="description" class="col-sm-3">ពិពណ៍នា</label>
                        <div class="col-sm-9">
                            <span id="lb_description">: {{$in->description}}</span>
                            <input type="text" class="form-control hide" id="description"
                                value="{{$in->description}}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-info btn-sm btn-oval" type="button"
                        id='btnEdit' onclick="editMaster()">
                        <i class="fa fa-edit"></i> កែប្រែ
                    </button>
                    <button class="btn btn-success btn-sm btn-oval hide" type="button"
                        id='btnSave' onclick="saveMaster()">
                        <i class="fa fa-save"></i> រក្សាទុក
                    </button>
                    <button class="btn btn-danger btn-sm btn-oval hide" type="button"
                        id='btnCancel' onclick="cancelEdit()">
                        <i class="fa fa-times"></i> ខកខាន
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <h5>ទំនិញ</h5>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-sm btn-success btn-oval" type="button"
                        data-toggle="modal" data-target="#addItem">
                        <i class="fa fa-plus"></i> បន្ថែម
                    </button>
                </div>
            </div>

            <div class="row">
               <div class="col-sm-12">
                   <p></p>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>កូដ</th>
                                <th>ឈ្មោះ</th>
                                <th>ចំនួន</th>
                                <th>ខ្នាត</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            @php($i=1)

                            @foreach($in->detail as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->product->code}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-sm btn-oval"
                                            onclick="removeItem(event, this, {{$item->id}})">
                                            លុប
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addItem" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{url('scrap/item/save')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$in->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="item" class="col-sm-3">ទំនិញ<span class="text-danger">*</span></label>
                        <div class="col-sm-8">

                            <select name="item" class="form-control chosen-select" id="item" required>
                                <option value="">ជ្រើសរើស</option>
                                @foreach($products as $p)
                                    <option value="{{$p->id}}">{{$p->code}}  {{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty1" class="col-sm-3">ចំនួន</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.1" min="0" class="form-control"
                                name="quantity" id="qty1" value="1">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div style='padding: 5px'>
                        <button class="btn btn-success btn-sm btn-oval">រក្សាទុក</button>
                        <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">បិទ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')

    <script>
        var url = "{{url('/')}}";
        $(document).ready(function(){
            $('#scrap_menu').addClass('active');

        });
        function editMaster()
        {
            $("#lb_in_date, #lb_warehouse, #lb_po_no, #lb_reference, #lb_description").addClass('hide');
            $('#in_date, #warehouse, #po_no, #reference, #description').removeClass('hide');
            // hide button
            $("#btnEdit").addClass('hide');
            $("#btnSave, #btnCancel").removeClass('hide');
        }
        function cancelEdit()
        {
            $("#lb_in_date, #lb_warehouse, #lb_po_no, #lb_reference, #lb_description").removeClass('hide');
            $('#in_date, #warehouse, #po_no, #reference, #description').addClass('hide');
            // hide button
            $("#btnEdit").removeClass('hide');
            $("#btnSave, #btnCancel").addClass('hide');
        }
        function saveMaster()
        {
            let token = $("input[name='_token']").val();
            let data = {
                id: $("#id").val(),
                in_date: $("#in_date").val(),
                warehouse_id: $("#warehouse").val(),
                po_no: $("#po_no").val(),
                reference: $("#reference").val(),
                description: $("#description").val()
            };
            let con = confirm('You want to save?');
            if(con)
            {
                $.ajax({
                    type: "POST",
                    url: url + "/scrap/master/save",
                    data: data,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', token);
                    },
                    success: function (sms) {

                        if(sms>0)
                        {
                            location.href = url + "/scrap/detail/" + sms;
                        }
                        else{
                            alert("Fail to save stock, please check again!");
                        }
                        console.log(sms);
                    }
                });
            }

        }
        function removeItem(evt,obj, id)
        {
            evt.preventDefault();
            let con = confirm('You want to delete?');
            if(con)
            {
                $.ajax({
                    type: 'GET',
                    url: url + "/scrap/item/delete/" + id,
                    success: function(sms)
                    {
                        if(sms)
                        {
                            $(obj).parent().parent().remove();
                        }
                    }
                });
            }
        }
    </script>
@endsection
