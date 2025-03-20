@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Sipariş Detayı</h3>
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
                        <h4 class="card-title">Ürün Detayları</h4>
                    </div>
                    <div class="card-body">
                        <table id="products" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Özel Kod Açıklaması</th>
                                    <th class="text-center">Tür</th>
                                    <th class="text-center">Özel Kod</th>
                                    <th class="text-center">Kod</th>
                                    <th class="text-center">Açıklama</th>
                                    <th class="text-center">Grup Kodu</th>
                                    <th class="text-center">Ana Birim</th>
                                    <th class="text-center">Adet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $product['specialCodeDescription'] }}</td>
                                        <td class="text-center">{{ $product['type'] }}</td>
                                        <td class="text-center">{{ $product['specialCode'] }}</td>
                                        <td class="text-center">{{ $product['code'] }}</td>
                                        <td class="text-center">{{ $product['description'] }}</td>
                                        <td class="text-center">{{ $product['groupCode'] }}</td>
                                        <td class="text-center">{{ $product['mainUnit'] }}</td>
                                        <td class="text-center">{{ $product['quantity'] }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Özel Kod Açıklaması</th>
                                    <th class="text-center">Tür</th>
                                    <th class="text-center">Özel Kod</th>
                                    <th class="text-center">Kod</th>
                                    <th class="text-center">Açıklama</th>
                                    <th class="text-center">Grup Kodu</th>
                                    <th class="text-center">Ana Birim</th>
                                    <th class="text-center">Adet</th>
                                </tr>
                            </tfoot>
                        </table>

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