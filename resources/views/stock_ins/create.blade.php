@extends('layouts.master')
@section('content')

        <div class="card">
            <div class="container-fluid mt-2">
            <form>
            <div class="toolbox">
                <button class="btn btn-success btn-sm b" type="button" onclick="save()">
                    <i class="fa fa-save"></i> រក្សាទុក
                </button>
                <a href="{{url('stock_in')}}" class="btn btn-warning btn-sm ">
                    <i class="fa fa-reply-all"></i> ត្រលប់
                </a>
            </div>
            <hr>
            <div class="card-block">
                @csrf
                <div class="row">
                   <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="in_date" class="col-sm-3">បរិច្ឆេទ <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control form-control-sm" id="in_date" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                   </div>
                   <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="reference" class="col-sm-3">លេខយោង</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="reference"​ placeholder="លេខយោង">
                        </div>
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="description" class="col-sm-3">ពិពណ៍នា</label>
                            <div class="col-sm-9">
                                <textarea id="description" cols="30" rows="2" class="form-control form-control-sm"​ placeholder="ពិពណ៍នា"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <div class="row">

                </div>
                <hr>
                <div class="row">

                   <div class="col-sm-1">
                       <label for="">ទំនិញ</label>
                   </div>
                   <div class="col-sm-3">
                    <select id="product" class="form-control form-control-sm">
                        <option value="">ជ្រើសរើសទំនិញ</option>
                        @foreach($product as $p)
                        <option value="{{$p->id}}" uname="{{$p->unit->name}}"
                            pcode="{{$p->code}}" pname="{{$p->name}}" >{{$p->code}} - {{$p->name}}</option>
                        @endforeach
                    </select>
               </div>
                    <div class="col-sm-1">
                        <label for="">ចំនួន</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" id="qty" onkeypress="pressEnter(event)">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success btn-sm" type="button"
                            onclick="addItem()"> <i class="fa fa-plus-circle"></i> បន្ថែម</button>
                    </div>
                </div>
                <div class="row">
                   <div class="col-sm-12">
                       <p></p>
                        <table class="table table-sm ">
                            <thead class="bg-light">
                                <tr>
                                    <th>កូដ</th>
                                    <th>ឈ្មោះ</th>
                                    <th>ចំនួន</th>
                                    <th>ខ្នាត</th>
                                    <th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody id="data">

                            </tbody>
                        </table>
                   </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal for edit option -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">កែប្រែ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="item" class="col-sm-3">ទំនិញ<span class="text-danger">*</span></label>
                        <div class="col-sm-8">

                            <select name="item" class="form-control chosen-select" id="item" required>
                                <option value="">ទំនិញ</option>
                                @foreach($product as $p)
                                <option value="">ជ្រើសរើសទំនិញ</option>
                                    <option value="{{$p->id}}" uname="hhh" pcode="{{$p->code}}" pname="{{$p->name}}" >{{$p->code}} - {{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="qty1" class="col-sm-3">ចំនួន</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.1" min="0" class="form-control" name="qty1" id="qty1" value="1">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div style='padding: 5px'>
                        <button type="button" class="btn btn-success btn-sm btn-oval"
                        id="btn" onclick="saveEdit()">រក្សាទុក</button>
                        <button type="button" class="btn btn-danger btn-sm btn-oval" data-dismiss="modal">បិទ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('backend/js/stock_in.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#stock_in_menu').addClass('active');
        });
    </script>
@endsection
