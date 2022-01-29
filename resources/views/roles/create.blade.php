@extends('layouts.master')
@section('style')
<style>
    .error
{
    font-size: 12px;
    color: red;
}
</style>
@endsection
@section('content')
<div class="card">
    <div class="container-fluid mt-2">
        <form action="{{route('role.store')}}" id="sendform" method="POST">
            @csrf
            <button class="btn btn-sm btn-success"><i class="fa fa-save"></i> រក្សាទុក</button>
            <a href="" class="btn btn-sm btn-warning"><i class="fa fa-reply-all"></i> ត្រលប់</a>
            <hr>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group row">
                        <label for="" class="col-sm-4">ឈ្មោះតួនាទី</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" placeholder="បញ្ចូលឈ្មោះតួនាទី" required>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
                     $('#role_menu').addClass('active');

                    $("#sendform").validate({
                // Specify validation rules
                rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                name: "required",

                },
                // Specify validation error messages
                messages: {
                name: "សូមបញ្ចូលឈ្មោះ",
                },

                submitHandler: function(form) {
                form.submit();
                }
            });
        });
    </script>
@endsection
