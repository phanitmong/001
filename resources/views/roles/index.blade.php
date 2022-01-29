@extends('layouts.master')
@section('content')
<div class="card mt-2">
    <div class="container-fluid">
        <a href="{{ route('role.create') }}" class="btn btn-sm btn-success mt-2 mb-2"><i class="fa fa-plus-circle"></i> បន្ថែម</a>
        <button class="btn-sm btn-success btn" id="btnExport"><i class="fa fa-download"></i> ទាញយក Excel</button>
        <table class="table table-sm table-hover table-bordered" id="tblData">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ឈ្មោះ</th>
                    <th>សកម្មភាព</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
           <tbody>
                @foreach ($role as $role)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <a href="{{route('role.detail',$role->id)}}" class="btn btn-sm btn-info">ពិនិត្យ</a>
                            <a href="{{route('role.edit',$role->id)}}" class="btn btn-sm btn-success">កែប្រែ</a>
                            <a href="" class="btn btn-sm btn-danger">លុប</a>
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
<script src="{{asset('Backend/js/export.js')}}"></script>


    <script>
      $(document).ready(function () {
        $('#role_menu').addClass('active');
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
                    filename: "role", //do not include extension
                    fileext: ".xls" // file extension
             });
        });
      });
    </script>
@endsection
