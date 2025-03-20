@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1 class="m-0">Raporlama</h1>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
        <h3>{{ $currentMonthOrderCount }}</h3>
        <p>Toplam Sipariş (Aylık)</p>
        </div>
        <div class="icon">
        <i class="nav-icon fas fa-edit"></i>
        </div>
        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER')
      <a href="{{ route(name: 'orders') }}" class="small-box-footer">Siparişler
      <i class="fas fa-arrow-circle-right"></i></a>
    @endif
      </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $assemblyCount }}</h3>
        <p>Montajdaki Ürünler</p>
        </div>
        <div class="icon">
        <i class="nav-icon fas fa-angle-left"></i>
        </div>
        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER')
      <a href="{{ route(name: 'assembly') }}" class="small-box-footer">Montaj Hattı <i
        class="fas fa-arrow-circle-right"></i></a>
    @endif
      </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{ $accountingCount }}</h3>
        <p>Muhasebedeki Ürünler</p>
        </div>
        <div class="icon">
        <i class="nav-icon fas fa-money-bill"></i>
        </div>
        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER')
      <a href="{{ route(name: 'accounting') }}" class="small-box-footer">Muhasebe Birimi <i
        class="fas fa-arrow-circle-right"></i></a>
    @endif
      </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{ $shippingCount }}</h3>
        <p>Kargodaki Ürünler</p>
        </div>
        <div class="icon">
        <i class="nav-icon fas fa-box"></i>
        </div>
        @if (Auth::user()->userType == 'ADMIN' || Auth::user()->unit == 'MANAGER')
      <a href="{{ route(name: 'shipping') }}" class="small-box-footer">Kargo Depo <i
        class="fas fa-arrow-circle-right"></i></a>
    @endif
      </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Firma Durumu</h3>
          <p class="ml-auto d-flex flex-column text-right">
          <span class="{{ $percentageChange >= 0 ? 'text-success' : 'text-danger' }}">
            <i class="fas {{ $percentageChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
            {{ number_format($percentageChange, 1) }}%
          </span>
          <span class="text-muted">
            {{ $percentageChange >= 0 ? 'Yükselişte' : 'Düşüşte' }}
          </span>
          </p>
        </div>
        </div>
        <div class="card-body">
        <div class="position-relative mb-4">
          <canvas id="sales-chart" height="200"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
          <span class="mr-2">
          <i class="fas fa-square text-primary"></i> Bu Yıl
          </span>
          <span>
          <i class="fas fa-square text-gray"></i> Geçen Yıl
          </span>
        </div>
        </div>
      </div>
      <!-- /.card -->
      </div>

      <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
        <h3 class="card-title">
          <i class="ion ion-clipboard mr-1"></i>
          Personeller
        </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <ul class="todo-list" data-widget="todo-list">
          @php
        $badgeClasses = [
        'MANAGER' => 'badge-success',
        'ACCOUNTING' => 'badge-warning',
        'SALES' => 'badge-danger',
        'MANUFACTURING' => 'badge-secondary',
        'ASSEMBLY' => 'badge-primary',
        'CARGO' => 'badge-info',
        ];

        $unitLabels = [
        'MANAGER' => 'Yönetici',
        'ACCOUNTING' => 'Muhasebe',
        'SALES' => 'Satış',
        'MANUFACTURING' => 'İmalat',
        'ASSEMBLY' => 'Montaj',
        'CARGO' => 'Kargo',
        ];
        $unitIcons = [
        'MANAGER' => 'fa-user-tie',
        'ACCOUNTING' => 'fa-file',
        'SALES' => 'fa-chart-line',
        'MANUFACTURING' => 'fa-industry',
        'ASSEMBLY' => 'fa-wrench',
        'CARGO' => 'fa-truck-loading',
        ];
      @endphp
          @foreach ($employees as $employee)
        <li>
        <span class="handle">
        <i class="fas fa-ellipsis-v"></i>
        </span>
        <span class="text">{{ $employee->name }}</span>
        <small class="badge {{ $badgeClasses[$employee->unit] ?? 'badge-secondary' }}">
        <i class="fas {{ $unitIcons[$employee->unit] ?? 'fa-file' }}"></i>
        {{ $unitLabels[$employee->unit] ?? $employee->unit }}
        </small>
        </li>
      @endforeach
        </ul>
        </div>
        <!-- /.card-body -->
      </div>
      </div>

    </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection

@section('customcss')

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css" />
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />

  <div class="text-center">
    @if (isset($message))
    <div class="alert alert-danger"><strong>{{ $message }}</strong></div>
  @endif
  </div>
@endsection

@section('customjs')
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="/js/adminlte.js"></script>
  <!-- OPTIONAL SCRIPTS -->
  <script src="/plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="{{ asset('/js/pages/dashboard3.js') }}"></script> -->

  <!-- Page specific script -->
  <script>
    $(function () {
    'use strict'

    // Controller'dan gelen PHP dizilerini JS dizilerine dönüştürme
    var dataCurrentYear = @json($dataCurrentYear);
    var dataPreviousYear = @json($dataPreviousYear);

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index';
    var intersect = true;

    var $salesChart = $('#sales-chart');
    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
      labels: ['OCK', 'ŞBT', 'MRT', 'NSN', 'MYS', 'HAZ', 'TEM', 'AĞU', 'EYL', 'EKM', 'KAS', 'ARL'],
      datasets: [
        {
        backgroundColor: '#007bff',
        borderColor: '#007bff',
        // Bu Yıl (sipariş adedi)
        data: dataCurrentYear
        },
        {
        backgroundColor: '#ced4da',
        borderColor: '#ced4da',
        // Geçen Yıl (sipariş adedi)
        data: dataPreviousYear
        }
      ]
      },
      options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        gridLines: {
          display: true,
          lineWidth: '4px',
          color: 'rgba(0, 0, 0, .2)',
          zeroLineColor: 'transparent'
        },
        ticks: $.extend({
          beginAtZero: true,
          // Sadece adet göstereceğimiz için "₺" gibi sembolleri kaldırabilirsiniz
          callback: function (value) {
          return value;
          }
        }, ticksStyle)
        }],
        xAxes: [{
        display: true,
        gridLines: {
          display: false
        },
        ticks: ticksStyle
        }]
      }
      }
    });
    });
  </script>

@endsection