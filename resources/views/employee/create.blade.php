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
    <div id="error">
    </div>

    <form action="javascript:void(0)" method="POST" id="emp_form">
        @csrf

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name" class="form-control"  >
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" id="email" class="form-control"  >
                </div>
            </div>

           
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Basic:</strong>
                    <input type="text" name="basic" id="basic" class="form-control"  >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>HRA:</strong>
                    <input type="text" name="hra" id= "hra" class="form-control"  >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Special Allowance:</strong>
                    <input type="text" name="allowance" id="allowance" class="form-control"  >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>PF:</strong>
                    <input type="text" name="pf" id="pf" class="form-control"  >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Total:</strong>
                    <input type="text" readonly name="total" id="total" class="form-control"  >
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
    var mobile = $('#mobile').val();
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('employee/save') }}",   
            method: 'post',
            data: { "name" : name, "email" :email, "mobile":mobile, "basic" :basic, 'hra':hra, "allowance" :allowance,'pf':pf,"_token": $('#token').val()},
            success: function(response){
                window.location = '{{ route('employee.index')}}';
            },
            error: function(jqXhr, json, errorThrown){// this are default for ajax errors 
                var errors = jqXhr.responseJSON;
                $('#error').empty();
                var errorsHtml = '';
                errorsHtml += '<div class="alert alert-danger">';
                $.each(errors['errors'], function (index, value) {
                    errorsHtml += '<ul><li>' + value + '</li></ul>';
                });
                errorsHtml += '<div>';
                $('#error').append(errorsHtml);
            }
       });
 });
 
    $('#pf').keyup(function(event){
        var basic = $('#basic').val();
        var hra = $('#hra').val();
        var allowance = $('#allowance').val();
        var pf = $('#pf').val(); 
        var total = '';
        total = (parseInt(basic) + parseInt(hra) + parseInt(allowance)) - parseInt(pf);
        $('#total').val(total);
      });
        
});
        
    </script>
@endsection