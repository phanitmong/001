@extends('layouts.master')
@section('content')
<div class="card mt-2">
    <div class="container-fluid">
        <a href="{{ route('stock_in.create') }}" class="btn btn-sm btn-success mt-2 mb-2"><i class="fa fa-plus-circle"></i> បន្ថែម</a>
        <button class="btn-sm btn-success btn" id="btnExport"><i class="fa fa-download"></i> ទាញយក Excel</button>
        <table class="table table-sm table-hover table-bordered" id="tblData">
            <thead>
                <tr>
                    <th>កូដ</th>
                    <th>លេខយោង</th>
                    <th>អ្នកបង្កើត</th>
                    <th>សកម្មភាព</th>
                </tr>
            </thead>

           <tbody>
                @foreach ($stock_in as $ins )
                    <tr>
                        <td>{{$ins->IN_ID}}</td>
                        <td>{{$ins->reference_no}}</td>
                        <td>{{@$ins->user->name}}</td>
                        <td>
                            <a href="{{ url('stock-in/detail/'.$ins->id) }}" class="btn btn-sm btn-info">ពិនិត្យ</a>
                            <a href="" class="btn btn-sm btn-danger"> លុប</a>
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
        $('#stock_in_menu').addClass('active');
          $('#tblData').DataTable(
              {
                "searching": false,
                "dom": 'ftipr',
                'bSort':true,
                'bInfo' : false,
                language: {
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
                    filename: "Stock-In", //do not include extension
                    fileext: ".xls" // file extension
             });
        });
      });
    </script>
@endsection
