@extends('layouts.master')
@section('title')
  Edit Invoice
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
    <div class="container-fluid card mt-3">
        <div class="row p-2">
            <div class="col-sm-7">
                <form action="{{ route('invoice.update',$details->id) }}"  method="POST" enctype="multipart/form-data" id="sendform">
                    @csrf
                    @method('PATCH')
                    <button class=" btn btn-success btn-sm"><i class="fa fa-download"></i> រក្សាទុក</button>
                    <a href="{{route('category.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-reply-all"></i> ត្រលប់</a>
                    <hr>
                    <h5 class="text-center text-success"><u>{{$details->invoice->invoice_no}} ->{{$details->product->name}}</u></h5>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ចំនួន : <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="ចំនួន" name="quantity" value="{{$details->quantity}}" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">តម្លៃ: <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="ចំនួន" name="price" value="{{$details->price}}" autofocus>
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
    $('#invoice_menu').addClass("active");
    $("#sendform").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side

      price:
      {
        required: true,
        number: true,
      },
      quantity:
      {
        required: true,
        number: true,
      },

    },
    // Specify validation error messages
    messages: {
        price: {
          required: "សូមបញ្ចូលលតម្លៃ",
          number: "មិនអនុញ្ញាតជាអក្សរ"
      },
      quantity: {
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
