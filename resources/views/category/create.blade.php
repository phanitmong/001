@extends('layouts.master')
@section('title')
  Create Category
@endsection
@section('style')
<style>
.button-wrapper  {
  z-index: 0;

  display: inline-block;
  position: relative;
  width: 120px;
  cursor: pointer;
  color: #fff;
  text-transform:uppercase;

}
.error
{
    font-size: 12px;
    color: red;
}
input , select
{
    font-size: 12px !important;
}
#file-input {
    display: inline-block;
    position: absolute;
    z-index: 3;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    opacity: 0;
    cursor: pointer;
}
.camera {

    position: absolute;
    z-index: 2;
    left: 55%;
    border-radius: 50%;
    color: rgb(133, 134, 133);
    text-align: center;
    top: 40%;
    font-size: 20px;
    cursor: pointer;
}
#img
{
    object-fit: cover;
    border-radius: 50%;

}
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-sm-7">
                <form action="{{ route('category.store') }}"  method="POST" enctype="multipart/form-data" id="sendform">
                    @csrf
                    <button class=" btn btn-success btn-sm"><i class="fa fa-download"></i> Save</button>
                    <a href="{{route('category.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-reply-all"></i> Back</a>
                    <hr>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ឈ្មោះ : <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="បញ្ចូលឈ្មោះប្រភេទ" name="name" value="" autofocus>
                        </div>
                    </div>
            </div>
        </form>
        </div>
       </div>
@endsection
@section('script')
<script src="{{ asset('backend/js/preview.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
     $(document).ready(function () {
    $('#category_menu').addClass("active");
    $("#sendform").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      cost: {
          required : true,
          number:true,
      },
      price:
      {
        required: true,
        number: true,
      },
      category:"required",
    },
    // Specify validation error messages
    messages: {
      name: "សូមបញ្ចូលឈ្មោះប្រភេទ",
    },

    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection
