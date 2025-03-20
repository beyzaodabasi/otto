@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Personel Detayı</h3>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h4 class="card-title">Personel Güncelle</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateEmployee', ['id' => $employee->id]) }}">
                            @csrf
                            @method('POST')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Hata! Lütfen aşağıdaki alanları kontrol edip tekrar deneyiniz.</strong>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Email"
                                            value="{{ old('email', $employee->email) }}" @if (Auth::user()->userType != 'ADMIN') disabled @endif />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Ad Soyad</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Ad Soyad"
                                            value="{{ old('name', $employee->name) }}" @if (Auth::user()->userType != 'ADMIN') disabled @endif />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="userName">Kullanıcı Adı</label>
                                        <input type="text" class="form-control @error('userName') is-invalid @enderror"
                                            id="userName" name="userName" placeholder="Kullanıcı Adı"
                                            value="{{ old('userName', $employee->userName) }}" @if (Auth::user()->userType != 'ADMIN') disabled @endif />
                                        @error('userName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="unit">Birim</label>
                                        <select id="unit" class="form-control @error('unit') is-invalid @enderror"
                                            name="unit" @if (Auth::user()->userType != 'ADMIN') disabled @endif>
                                            @foreach (['MANAGER' => 'Yönetici', 'ACCOUNTING' => 'Muhasebe', 'SALES' => 'Satış', 'MANUFACTURING' => 'İmalat', 'ASSEMBLY' => 'Montaj', 'CARGO' => 'Kargo'] as $key => $label)
                                                <option value="{{ $key }}" {{ old('unit', $employee->unit) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (Auth::user()->userType == 'ADMIN')
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password">Parola</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="Parola" />
                                        </div>
                                    </div>
                                @endif

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Durum</label>
                                        <select id="status" class="form-control @error('status') is-invalid @enderror"
                                            name="status" @if (Auth::user()->userType != 'ADMIN') disabled @endif>
                                            <option value="ACTIVE" {{ old('status', $employee->status) == 'ACTIVE' ? 'selected' : '' }}>Aktif</option>
                                            <option value="PASSIVE" {{ old('status', $employee->status) == 'PASSIVE' ? 'selected' : '' }}>Pasif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->userType == 'ADMIN')
                                <div class="d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-primary">
                                        Güncelle
                                    </button>
                                </div>
                            @endif
                        </form>
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
    <!-- DataTables  & Plugins -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page specific script -->
    <script>
        $(function () {
            $("#employees")
                .DataTable({
                    paging: true,
                    lengthChange: false,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    buttons: ["excel", "pdf"],
                })
                .buttons()
                .container()
                .appendTo("#employees_wrapper .col-md-6:eq(0)");
        });
    </script>
    <script>
        $(document).ready(function () {
            @if (session('message'))
                Swal.fire({
                    title: "Başarılı!",
                    text: "{{ session('message') }}",
                    icon: "success"
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    title: "Hata!",
                    text: "{{ session('error') }}",
                    icon: "error"
                });
            @endif
            });

    </script>
@endsection