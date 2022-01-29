@extends('layouts.master')
@section('content')
<div class="container-fluid">
    @component('reports.tap')

    @endcomponent
    <div class="row mb-1">
        <div class="col-sm-4">
            <button class="btn-sm btn-info btn" id="btnExport"><i class="fa fa-file-excel"></i> ទាញយក</button>
        </div>
        <div class="col-sm-4 text-center text-info"><h6>របាយការណ៍ស្តុកចូល</h6></div>
    </div>
    <div class="">
        <table class="table table-sm table-bordered table-hover" id="tblData">
            <thead>
                <th>#</th>
                <th>ឈ្មោះទំនិញ</th>
                <th>ចំនួនសរុប</th>
                <th>ខ្នាត</th>
                <th>ប្រភេទ</th>
            </thead>
            <tbody>
                @php
                    $total =0;
                @endphp
                @foreach ($stock_out as $out)
                @php
                    $total +=$out->total;
                @endphp
                    <tr>
                        <td>9</td>
                        <td>{{$out->product->name}}</td>
                        <td>{{$out->total}}</td>
                        <td>{{$out->product->unit->name}}</td>
                        <td>{{$out->product->category->name}}</td>
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
        <script src="{{asset('backend/js/export.js')}}"></script>
    <script>

         $(document).ready(function () {
            $('#report_menu').addClass('active');
            $('#stock_out').addClass('btn btn-sm btn-success');

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
                    filename: "Stock-Out", //do not include extension
                    fileext: ".xls" // file extension
             });
          });
      });
    </script>
@endsection
