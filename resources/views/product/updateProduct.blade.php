@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Ürün Detayı</h3>
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
                        <h4 class="card-title">Ürün Güncelle</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateProduct', ['id' => $product->id]) }}">
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
                                        <label for="specialCodeDescription">Özel Kod Açıklaması</label>
                                        <select id="specialCodeDescription"
                                            class="form-control @error('specialCodeDescription') is-invalid @enderror"
                                            name="specialCodeDescription">
                                            @foreach (['P.SİLİNDİR', 'D.PNÖMATİK', 'VAKUM', 'D.HİDROLİK', 'H.ÜNİTE', 'H.POMPA', 'H.HORTUM', 'KATALOG', 'NONE'] as $option)
                                                <option value="{{ $option }}" {{ old('specialCodeDescription', $product->specialCodeDescription) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('specialCodeDescription')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Tür</label>
                                        <select id="type" class="form-control @error('type') is-invalid @enderror"
                                            name="type">
                                            @foreach (['YM', 'TM', 'SK', 'HM', 'MM', 'OTHER'] as $option)
                                                <option value="{{ $option }}" {{ old('type', $product->type) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="specialCode">Özel Kod</label>
                                        <input type="text" class="form-control @error('specialCode') is-invalid @enderror"
                                            id="specialCode" name="specialCode" placeholder="Özel Kod"
                                            value="{{ old('specialCode', $product->specialCode) }}" />
                                        @error('specialCode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="code">Kod</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Kod"
                                            value="{{ $product->code }}" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Açıklama</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="Açıklama" value="{{ $product->description }}" disabled />
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="groupCode">Grup Kodu</label>
                                        <input type="text" class="form-control @error('groupCode') is-invalid @enderror"
                                            id="groupCode" name="groupCode" placeholder="Grup Kodu"
                                            value="{{ old('groupCode', $product->groupCode) }}" />
                                        @error('groupCode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="mainUnit">Ana Birim</label>
                                        <select id="mainUnit" class="form-control @error('mainUnit') is-invalid @enderror"
                                            name="mainUnit">
                                            @foreach (['AD' => 'Adet', 'MT' => 'Metre', 'KG' => 'Kilogram'] as $key => $label)
                                                <option value="{{ $key }}" {{ old('mainUnit', $product->mainUnit) == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mainUnit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Durum</label>
                                        <select id="status" class="form-control @error('status') is-invalid @enderror"
                                            name="status">
                                            <option value="ACTIVE" {{ old('status', $product->status) == 'ACTIVE' ? 'selected' : '' }}>Aktif</option>
                                            <option value="PASSIVE" {{ old('status', $product->status) == 'PASSIVE' ? 'selected' : '' }}>Pasif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary">
                                    Güncelle
                                </button>
                            </div>
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
            $("#products")
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
                .appendTo("#products_wrapper .col-md-6:eq(0)");
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