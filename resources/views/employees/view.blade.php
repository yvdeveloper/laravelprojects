@extends('adminlte::page')
@section('plugins.DateRangePicker', true)
@section('plugins.BootstrapSelect', true)
@section('title', 'View Employee')

@section('content_header')
    <h1>View Employee</h1>
@stop

@section('content')

    <div class="card card-secondary card-outline">
        <form action="{{ route('employee.update', ["employee"=>$employee]) }}" method="post" id="employee_form">
        @csrf
        @method('put')
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <x-adminlte-input value="{{$employee->first_name}}" name="first_name" id="first_name" label="Firstname" placeholder="Enter firstname" label-class="text-gray">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-gray"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-6">
                        <x-adminlte-input value="{{$employee->last_name}}" name="last_name" id="last_name" label="Lastname" placeholder="Enter lastname" label-class="text-gray">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-gray"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <x-adminlte-select-bs name="gender" id="gender" label="Gender" label-class="text-gray"
                            igroup-size="md" data-title="Please choose gender..." data-live-search
                            data-live-search-placeholder="Search..." data-show-tick>
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gray">
                                    <i class="fas fa-venus-mars"></i>
                                </div>
                            </x-slot>
                            <option value="1" data-icon="fa fa-fw fa-mars" {{$employee->gender == 1? "selected" : ""}}>Male</option>
                            <option value="2" data-icon="fa fa-fw fa-venus" {{$employee->gender == 2? "selected" : ""}}>Female</option>
                        </x-adminlte-select-bs>
                    </div>
                    <div class="col-6">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        @php
                        $birthdatePicker = [
                            "singleDatePicker" => true,
                            "showDropdowns" => true,
                            "startDate" => $employee->birthdate,
                            "minYear" => 2000,
                            "maxYear" => "js:parseInt(moment().format('YYYY'),10)",
                            "timePicker" => false,
                            "locale" => ["format" => "YYYY-MM-DD"],
                        ];
                        @endphp
                        <x-adminlte-date-range value="{{$employee->birthdate}}" name="birthdate" id="birthdate" label="Birthdate" label-class="text-gray" igroup-size="md" :config="$birthdatePicker">
                            <x-slot name="appendSlot">
                                <div class="input-group-text bg-gray">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-date-range>
                        
                    </div>
                    <div class="col-6">
                        <x-adminlte-input value="{{$employee->monthly_salary}}" name="monthly_salary" id="monthly_salary" label="Monthly Salary" placeholder="Enter monthly salary" label-class="text-gray">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-money-bill text-gray"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <x-adminlte-button type="submit" id="btn-submit" class="btn-md float-right" label="Update" theme="warning" icon="fas fa-lg fa-save"/>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop