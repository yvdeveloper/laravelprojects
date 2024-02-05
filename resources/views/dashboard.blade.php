@extends('adminlte::page')
@section('plugins.Chartjs', true)
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">
    <div class="col-4">
        <x-adminlte-info-box title="Total Monthly Salary" text="{{$salary_report->total_salary}}" icon="fas fa-lg fa-money-bill text-white" theme="gradient-teal"/>
        <x-adminlte-info-box title="Employees Average Age" text="{{$age_report->average_age}} years old" icon="fas fa-lg fa-users text-dark" theme="primary"/>
    </div>
    <div clas="col-5">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employees Gender</h3>
        
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="250"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fas fa-mars text-danger"></i> Male</li>
                    <li><i class="fas fa-venus text-success"></i> Female</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Male
                    <span class="float-right text-danger">
                      <i class="fas fa-mars text-sm"></i>
                      {{$gender_report->Male}}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Female
                    <span class="float-right text-success">
                      <i class="fas fa-venus text-sm"></i> {{$gender_report->Female}}
                    </span>
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.footer -->
        </div>
        
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')
    <script>
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');

        var pieData = {
            labels: [
                'Male',
                'Female'
            ],
            datasets: [
                {
                    data: [{{$gender_report->Male}}, {{$gender_report->Female}}],
                    backgroundColor: ['#f56954', '#00a65a']
                }
            ]
        }
        var pieOptions = {
            legend: {
            display: false
            }
        }
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

    </script>
@stop