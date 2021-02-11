@extends('employee.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Employee</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('employee.create') }}"> Add</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success closable">
            {{ $message }}
        </div>
    @endif

    @if(sizeof($employees) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Basic</th>
                <th>HRA</th>
                <th>Allowance</th>
                <th>PF</th>
                <th>total</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ ++$j }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->basic }}</td>
                    <td>{{ $employee->hra }}</td>
                    <td>{{ $employee->allowance }}</td>
                    <td>{{ $employee->pf }}</td>
                    <td>{{ $total = ($employee->basic +  $employee->hra + $employee->allowance ) - ($employee->pf) }}</td>

                    
                    <td>
                        <form action="{{ route('employee.destroy',$employee->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('employee.edit',$employee->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-alert">Start Adding to the Database.</div>
    @endif

    {!! $employees->links() !!}

@endsection