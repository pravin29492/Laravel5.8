@extends('employee.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Edit</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employee.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name"  value={{$employee->name}}  class="form-control"  required>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" id="email" class="form-control" value={{$employee->email}} >
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Basic:</strong>
                    <input type="number" name="basic" id="basic" class="form-control" value={{$employee->basic}}   required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>HRA:</strong>
                    <input type="number" name="hra" id= "hra" class="form-control" value={{$employee->hra}}   required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Special Allowance:</strong>
                    <input type="number" name="allowance" id="allowance" class="form-control" value={{$employee->allowance}}  required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>PF:</strong>
                    <input type="number" name="pf" id="pf" class="form-control"  value={{$employee->pf}}  required>
                </div>
            </div>
            
            
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                <button type="submit" id="send_form" class="btn btn-primary">Submit</button>
            </div>
        </div>
            
        </div>

    </form>
@endsection