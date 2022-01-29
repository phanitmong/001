@extends('layouts.master')
@section('content')
<div class="card mt-2">
    <div class="container-fluid">
    <form action="">
      <div class="d-flex justify-content-between">
          <div class="">
            <button class="btn-sm btn-info btn" id="btnExport" type="button"><i class="fa fa-upload"></i> ទាញយក Excel</button>
            <a href="{{url('pos/invoice/'.$invoice->id)}}" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print"></i> ព្រីនវិក្កយបត្រ</a>
          </div>
          <div class="mt-2 text-success">
             <u><h4>វិក្កយបត្រលេខ : {{$invoice->invoice_no}}</h4></u>
          </div>
          <div class="mt-2 mb-2 d-flex">
            <input type="text" placeholder="ស្វែងរក" style="border-radius: 0px;width:250px" class="form-control form-control-sm" name="q" value="{{@$_GET['q']}}">
            <button class="btn btn-light btn-sm" style="border-radius: 0px;" ><i class="fa fa-search"></i></button>
          </div>

      </div>
    </form>
        <table class="table table-sm table-hover table-bordered" id="tblData">
            <thead>
                <tr>
                    <th>លេខវិក្កយបត្រ</th>
                    <th>ចំនួន</th>
                    <th>តម្លៃ</th>
                    <th>សរុប</th>
                    <th>សកម្មភាព</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
           <tbody>
                @foreach ($invoice->details as $product)
                    <tr>
                        <td>{{$product->product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{number_format($product->price*$product->quantity,2)}}</td>
                        <td>
                            <a href="{{route('invoice.edit',$product->id)}}" class="btn btn-sm btn-info">កែប្រែ</a>
                            <a href="{{url('invoice/delete/'.$product->id)}}" class="btn btn-sm btn-danger">លុប</a>
                        </td>
                    </tr>
                @endforeach
           </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js ')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('backend/js/export.js')}}"></script>

    <script>
      $(document).ready(function () {
        $('#invoice_menu').addClass('active');
          $('#tblData').DataTable(
              {
                "searching": false,
                'iDisplayLength': 15,
                "dom": 'ftipr',
                'bSort':true,
                'bInfo' : false,
                language: {
                    lengthMenu:    "បង្ហាញ _MENU_ ចំនួន",
                    paginate: {

                    next: 'បន្ទាប់', // or '→'
                    previous: 'ត្រលប់' // or '←'
                    }
                },
              }
          );
          $("#btnExport").click(function(){
                $("#tblData").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "Product List", //do not include extension
                    fileext: ".xls" // file extension
             });
        });
      });
    </script>
@endsection
