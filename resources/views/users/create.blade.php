@extends('layouts.master')
@section('title')
  Create User
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
                <form action="{{ route('user.store') }}"  method="POST" enctype="multipart/form-data" id="sendform">
                    @csrf

                    <button class=" btn btn-success btn-sm"><i class="fa fa-download"></i> Save</button>
                    <a href="" class="btn btn-warning btn-sm"><i class="fa fa-reply-all"></i> Back</a>
                    <hr>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ឈ្មោះ : <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="បញ្ចូលឈ្មោះ" name="name" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">ឈ្មោះចូលគណនី : <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required placeholder="បញ្ចូលឈ្មោះគណនី" name="username" value="" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">អុីម៉ែល :</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email"  placeholder="បញ្ចូលអុីម៉ែល" name="email"  value="">
                        </div>
                    </div>
    

                    <div class="form-group row">
                        <label for="" class=" col-sm-4">តួនាទី: <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <select name="role" id="" class="form-control">
                               <option value="">តូនាទី</option>
                                @foreach ($role as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class=" col-sm-4">លេខសម្ងាត់: <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="បញ្ចូលលេខសម្ថាត់" autocomplete="off" name="password">
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
     $('#user_menu').addClass("active");

    $("#sendform").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      username: "required",
      phone:"required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      role: 'required',
    },
    // Specify validation error messages
    messages: {
      name: "សូមបញ្ចូលឈ្មោះ",
      username: "សូមបញ្ចូលឈ្មោះចូលគណនី",
      phone: "សូមបញ្ចូលលេខទូរស័ព្ទ",
      role:"សូមជ្រើសរើស",
      password: {
        required: "សូមបញ្ចូល លេខសម្ថាត់",
        minlength: "លេខសម្ងាត់តិចបំផុត ៥ តួរ"
      },
      email: "សូមបញ្ចូលអុីម៉ែលអោយបានត្រឹមត្រូវ"
    },

    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endsection
