@extends('layouts.master')
@section('content')
<div class="card mt-2">
    <div class="container-fluid">
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-success mt-2 mb-2"><i class="fa fa-plus-circle"></i> បន្ថែម</a>
        <button class="btn-sm btn-success btn" id="btnExport"><i class="fa fa-download"></i> ទាញយក Excel</button>
        <table class="table table-sm table-hover table-bordered" id="tblData">
            <thead>

                    <th>#</th>
                    <th>ឈ្មោះ</th>
                    <th>ឈ្មោះចូលប្រព័ន្ធ</th>
                    <th>អុីម៉ែល</th>
                    <th>លេខទូរស័ព្ទ</th>
                    <th>តួនាទី</th>
                    <th>សកម្មភាព</th>

            </thead>
            @php
                $i = 1;
            @endphp
           <tbody>
            @foreach ($user as $user)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{@$user->role->name}}</td>
                <td>
                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-success">កែប្រែ</a>
                    <a href="{{route('user.delete',$user->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('តើអ្នកចង់លុបមែនទេ???')">លុប</a>
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
        $('#user_menu').addClass('active');
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
                    filename: "Student-list", //do not include extension
                    fileext: ".xls" // file extension
             });
        });
      });
    </script>
@endsection
