@extends('adminlte::page')
@section('plugins.DateRangePicker', true)
@section('plugins.BootstrapSelect', true)
@section('plugins.Datatables', true)

@section('title', 'Manage Employees')

@section('content_header')
    <h1>Manage Employees</h1>
@stop

@section('content')

    <div class="card card-secondary card-outline">
        <div class="card-body">
            <div class="row">
                @php
                    $heads = [
                        ['label' => 'Fullname', 'width' => 15],
                        ['label' => 'Birthdate', 'width' => 5],
                        ['label' => 'Gender', 'width' => 5],
                        ['label' => 'Monthly Salary', 'width' => 10],
                        ['label' => 'Actions', 'no-export' => true, 'width' => 10]
                    ];
                @endphp
                <div class="col-12">
                    <x-adminlte-datatable id="table1" :heads="$heads">
                        @foreach($employees as $row => $col)
                            <tr>
                                <td>{{$col->first_name.' '.$col->last_name}}</td>
                                <td>{{$col->birthdate}}</td>
                                <td>{{($col->gender == 1 ? "Male":"Female")}}</td>
                                <td>{{$col->monthly_salary}}</td>
                                <td>
                                    <button onclick="window.location.href='{{route('employee.view',['id'=>Crypt::encrypt($col->id)])}}'" class="btn btn-xs btn-default text-primary mx-1" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>
                                    <button onclick="window.location.href='{{route('employee.destroy',['id'=>Crypt::encrypt($col->id)])}}'" class="btn btn-xs btn-default text-danger mx-1" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop