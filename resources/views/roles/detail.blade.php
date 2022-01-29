@extends('layouts.master')
@section('content')
      <div class="card">
        <div class="container-fluid">
            <a href="{{ route('role.index') }}" class="btn btn-sm btn-warning mt-2">
                <i class="fa fa-reply-all"></i> Back
            </a>
            <br>
            <span class="text-success">Set Permission {{$role->name}}</span>
            @csrf
            <div class="">
                <div class="">
                    <table class="table-sm table-hover table mt-2 table-bordered">
                        <thead>

                                <th>#</th>
                                <th>Name</th>
                                <th>View</th>
                                <th>Create</th>
                                <th>Edit</th>
                                <th>Delete</th>

                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($permission as $p)
                            <tr rid="{{$role->id}}" rpid="{{$p->id?$p->id:'0'}}" pid="{{$p->pid}}">
                                <td>{{$i++}}</td>
                                <td>{{$p->alias}}</td>
                                <td>
                                    <input type="checkbox" value="{{$p->view?'1':'0'}}" {{$p->view?'checked':''}}
                                        onchange="save(this)">
                                </td>
                                <td>
                                    <input type="checkbox" value="{{$p->create?'1':'0'}}" {{$p->create?'checked':''}}
                                    onchange="save(this)">
                                </td>
                                <td>
                                    <input type="checkbox" value="{{$p->edit?'1':'0'}}" {{$p->edit?'checked':''}}
                                    onchange="save(this)">
                                </td>
                                <td>
                                    <input type="checkbox" value="{{$p->delete?'1':'0'}}" {{$p->delete?'checked':''}}
                                    onchange="save(this)">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
      </div>
@endsection
@section('script')
      <script>
        var burl = "{{url('admin/')}}";
        $('#role_menu').addClass('active');
        function save(obj)
        {
            let token = $("input[name='_token']").val()
            let val = $(obj).val();
            if(val==1)
            {
                $(obj).val(0);
            }
            else{
                $(obj).val(1);
            }
            let tr = $(obj).parent().parent();
            let rid = $(tr).attr('rid');
            let rpid = $(tr).attr('rpid');
            let pid = $(tr).attr('pid');
            let tds = $(tr).find('td');
            let list = $(tds[2]).children('input').val();
            let create = $(tds[3]).children('input').val();
            let edit = $(tds[4]).children('input').val();
            let del = $(tds[5]).children('input').val();
            let data = {
                pid: pid,
                role_id: rid,
                rpid: rpid,
                list: list,
                create: create,
                edit: edit,
                del: del
            };
            $.ajax({
                type: 'POST',
                url:  "/role/save_permission",
                data: data,
                beforeSend: function(request){
                    return request.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(sms)
                {
                    console.log(sms);
                    $(tr).attr('rpid', sms);
                }
            });
        }
    </script>
@endsection
