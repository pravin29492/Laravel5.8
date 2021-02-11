@extends('employee.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Add</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="javascript:void(0)" method="POST" id="emp_form">
        @csrf

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name" class="form-control"  required>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" id="email" class="form-control"  required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Mobile:</strong>
                    <input type="text" name="mobile" id="mobile" class="form-control"  required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Basic:</strong>
                    <input type="text" name="basic" id="basic" class="form-control"  required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>HRA:</strong>
                    <input type="text" name="hra" id= "hra" class="form-control"  required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Special Allowance:</strong>
                    <input type="text" name="allowance" id="allowance" class="form-control"  required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>PF:</strong>
                    <input type="text" name="pf" id="pf" class="form-control"  required>
                </div>
            </div>
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                <button type="submit" id="send_form" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
    <script>
$(document).ready(function(){
 $('#send_form').click(function(e){
      e.preventDefault();
      
   var name = $('#name').val();
   var email = $('#email').val();
   var basic = $('#basic').val();
   var hra = $('#hra').val();
   var allowance = $('#allowance').val();
   var pf = $('#pf').val();
   

    if(name == '') {
        $('#name').focus().css('border-color', 'red');
        return false;
    } else {
        $('#name').css('border-color', '');
    }

    if(email == '') {
        $('#email').focus();
        return false;
    } else {
        if( !isEmail(email)) { 
            $('#email').focus().css('border-color', 'red');
            return false;
        }
    } 
    if(basic == '') {
        $('#basic').focus().css('border-color', 'red');
        return false;
    } else {
        $('#basic').css('border-color', '');
    }
    if(hra == '') {
        $('#hra').focus().css('border-color', 'red');
        return false;
    } else {
        $('#hra').css('border-color', '');
    }
    if(allowance == '') {
        $('#allowance').focus().css('border-color', 'red');
        return false;
    } else {
        $('#allowance').css('border-color', '');
    }
    if(pf == '') {
        $('#pf').focus().css('border-color', 'red');
        return false;
    } else {
        $('#pf').css('border-color', '');
    }
   
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     $.ajax({
      url: "{{ url('employee/save') }}",   
      method: 'post',
      data: { "name" : name, "email" :email, "basic" :basic, 'hra':hra, "allowance" :allowance,'pf':pf,"_token": $('#token').val()},
      success: function(response){
        window.location = '{{ route('employee.index')}}';
      }});
   });

   function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}



      $('#basic, #pf, #allowance, #hra ').keypress(function(event){
        if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }});
});
        
    </script>
@endsection