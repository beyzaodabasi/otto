@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yönetim</h1>
          </div>
          <!-- /.col -->
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
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Firma Durumu</h3>
                  <a href="javascript:void(0);">Detaylı Raporlama</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">₺18,230.00</span>
                    <span>Ortalama Satış Durumu</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Yükselişte</span>
                  </p>
                </div>
                <!-- /.d-flex -->

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
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Personel Durum Çizelgesi</h3>
                  <a href="javascript:void(0);">Detaylı Raporlama</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">200</span>
                    <span>Personel</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted"
                      >Çalışma Performansı Arttı</span
                    >
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Bu Hafta
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Geçen Hafta
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
                  Personel İzin Talepleri
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item">
                      <a href="#" class="page-link">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">&raquo;</a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                      <input
                        type="checkbox"
                        value=""
                        name="todo1"
                        id="todoCheck1"
                      />
                      <label for="todoCheck1"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text"
                      >Personel İzin Talebi (Ahmet AYDOĞAN)</span
                    >
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"
                      ><i class="far fa-clock"></i> 1 Hafta</small
                    >
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input
                        type="checkbox"
                        value=""
                        name="todo2"
                        id="todoCheck2"
                        checked
                      />
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text"
                      >Personel İzin Talebi (Mehmet ÇAKIR)</span
                    >
                    <small class="badge badge-info"
                      ><i class="far fa-clock"></i> 2 Saat</small
                    >
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input
                        type="checkbox"
                        value=""
                        name="todo3"
                        id="todoCheck3"
                      />
                      <label for="todoCheck3"></label>
                    </div>
                    <span class="text"
                      >Personel İzin Talebi (Yüksel SÖZER)</span
                    >
                    <small class="badge badge-warning"
                      ><i class="far fa-clock"></i> 1 Gün</small
                    >
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="icheck-primary d-inline ml-2">
                      <input
                        type="checkbox"
                        value=""
                        name="todo4"
                        id="todoCheck4"
                      />
                      <label for="todoCheck4"></label>
                    </div>
                    <span class="text"
                      >Personel İzin Talebi (Erdin ÇALIŞKAN)</span
                    >
                    <small class="badge badge-success"
                      ><i class="far fa-clock"></i> 1 Ay</small
                    >
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('customcss')

<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
/>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css" />
<!-- IonIcons -->
<link
  rel="stylesheet"
  href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
/>
<!-- Theme style -->
<link rel="stylesheet" href="/css/adminlte.css" />
<!-- DataTables -->
<link
  rel="stylesheet"
  href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
/>
<link
  rel="stylesheet"
  href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
/>
<link
  rel="stylesheet"
  href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
/>

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
<script src="{{ asset('/js/pages/dashboard3.js') }}"></script>
@endsection
