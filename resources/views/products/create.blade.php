@extends('layouts.master')
@section('title')
  Create Product
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
                <form action="{{ route('product.store') }}"  method="POST" enctype="multipart/form-data" id="sendform">
                    @csrf
                    <button class=" btn btn-success btn-sm"><i class="fa fa-download"></i> រក្សាទុក</button>
                    <a href="{{route('product.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-reply-all"></i> ត្រលប់</a>
                    <hr>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">កូដ : <span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  placeholder="បញ្ចូលកូដទំនិញ" name="code" value="" autofocus >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ឈ្មោះ : <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="បញ្ចូលឈ្មោះទំនិញ" name="name" value="" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class=" col-sm-4">តម្លៃដើម : <span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="បញ្ចូលតម្លៃដើម" name="cost" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">តម្លៃលក់ : <span class="text-danger"></span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="បញ្ចូលតម្លៃលក់" name="price" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ប្រភេទ: <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <select name="category" id="" class="form-control">
                               <option value="">ប្រភេទ</option>
                                @foreach ($category as $cats)
                                    <option value="{{$cats->id}}">{{$cats->name}}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ខ្នាត: <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <select name="unit" id="" class="form-control">
                               <option value="">ខ្នាត</option>
                                @foreach ($unit as $cats)
                                    <option value="{{$cats->id}}">{{$cats->name}}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>

            </div>
            <div class="col-sm 4">
                <div class="row mt-5">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5"> <div class="form-group row">

                        <div class="button-wrapper ">
                         <img src="" alt="" width="150px" id="img" height="150px" >
                         <input id="file-input" type="file" accept="image/*" name="photo" class="upload-box"   value="{{old('upload')}}" onchange="preview(event)">
                         <i class="fa fa-camera camera"></i>
                       </div>
                    </div></div>
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
    $('#product_menu').addClass("active");
    $("#sendform").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      cost: {
          number:true,
      },
      code: {
          required : true,
          number:true,
      },
      price:
      {
        required: true,
        number: true,
      },
      category:"required",
      unit: {
          required:true
      },
    },
    // Specify validation error messages
    messages: {
      name: "សូមបញ្ចូលឈ្មោះទំនិញ",
      cost: {
          required: "សូមបញ្ចូលលតម្លៃដើម",
          number: "មិនអនុញ្ញាតជាអក្សរ"
      },
      category:"សូមជ្រើសរើស",
      unit:"សូមជ្រើសរើស",

      price: {
          required: "សូមបញ្ចូលលតម្លៃ",
          number: "មិនអនុញ្ញាតជាអក្សរ"
      },
      code: {
          required: "សូមបញ្ចូលលតម្លៃ",
          number: "មិនអនុញ្ញាតជាអក្សរ"
      },

    },

    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection
