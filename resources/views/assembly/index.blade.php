@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h3 class="m-0">Montaj Hattı</h3>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
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
            <div class="">
                <div class="card card-secondary">
                    <div class="card-body">
                        <table id="assembly" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Sipariş Numarası</th>
                                    <th class="text-center">Müşteri Tanımı</th>
                                    <th class="text-center">Aracı Firma</th>
                                    <th class="text-center">Sipariş Adedi</th>
                                    <th class="text-center">Sipariş Tarihi</th>
                                    <th class="text-center">Termin Tarihi</th>
                                    <th class="text-center">Personel Adı Soyadı</th>
                                    <th class="text-center">Talep Eden Firma</th>
                                    <th class="text-center">Açıklama</th>
                                    <th class="text-center">Sipariş Durumu</th>
                                    <th class="text-center">Durum</th>
                                    <th class="text-center">Sipariş Detayı</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Sipariş Numarası</th>
                                    <th class="text-center">Müşteri Tanımı</th>
                                    <th class="text-center">Aracı Firma</th>
                                    <th class="text-center">Sipariş Adedi</th>
                                    <th class="text-center">Sipariş Tarihi</th>
                                    <th class="text-center">Termin Tarihi</th>
                                    <th class="text-center">Personel Adı Soyadı</th>
                                    <th class="text-center">Talep Eden Firma</th>
                                    <th class="text-center">Açıklama</th>
                                    <th class="text-center">Sipariş Durumu</th>
                                    <th class="text-center">Durum</th>
                                    <th class="text-center">Sipariş Detayı</th>
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
    <style>
        #assembly td,
        #assembly th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
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
        $(document).ready(function () {
            var table = $('#assembly').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('assembly.data') }}",
                dom: 'Bfrtip',
                buttons: ["excel", "pdf"],
                columns: [
                    { data: 'orderNumber', name: 'orderNumber' },
                    { data: 'customerCode', name: 'customerCode' },
                    { data: 'productDescription', name: 'productDescription' },
                    { data: 'productDetails', name: 'productDetails' },
                    { data: 'orderDate', name: 'orderDate' },
                    { data: 'dueDate', name: 'dueDate' },
                    { data: 'personnelName', name: 'personnelName' },
                    { data: 'companyName', name: 'companyName' },
                    { data: 'description', name: 'description' },
                    {
                        data: 'orderStatus',
                        name: 'orderStatus',
                        render: function (data, type, row) {
                            let badgeClass = '';

                            switch (data) {
                                case 'SEVK EDİLDİ':
                                    badgeClass = 'bg-success'; // Yeşil
                                    break;
                                case 'İPTAL EDİLDİ':
                                    badgeClass = 'bg-danger'; // Kırmızı
                                    break;
                                case 'İŞLEMDE':
                                    badgeClass = 'bg-warning text-dark'; // Sarı
                                    break;
                                case 'TAMAMLANDI':
                                    badgeClass = 'bg-primary'; // Mavi
                                    break;
                                case 'ONAYLANDI':
                                    badgeClass = 'bg-info'; // Turkuaz
                                    break;
                                default:
                                    badgeClass = 'bg-secondary'; // Gri
                            }

                            return `<h5><span class="badge ${badgeClass}">${data}</span></h5>`;
                        }
                    },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                createdRow: function (row, data, dataIndex) {
                    $('td:eq(9)', row).addClass('text-center'); // OrderStatus hücresini ortala
                }
            });

            table.buttons().container().appendTo('#assembly_wrapper .col-md-6:eq(0)');
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