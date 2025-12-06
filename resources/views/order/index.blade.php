@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h3 class="m-0">Siparişler</h3>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary float-right" style="margin-top: 10px"
                    onclick="window.location.href='{{ route('newOrder') }}';">
                    Yeni Sipariş
                </button>
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
            <!-- Filtreleme -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sipariş Filtreleme</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filterOrderStatus">Sipariş Durumu</label>
                                <div class="select2-primary">
                                    <select id="filterOrderStatus" class="select2" multiple="multiple" data-placeholder="Sipariş Durumu Seçin" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                        <option value="SHIPPED">SEVK EDİLDİ</option>
                                        <option value="CANCELLED">İPTAL EDİLDİ</option>
                                        <option value="IN_PROGRESS">İŞLEMDE</option>
                                        <option value="COMPLETED">TAMAMLANDI</option>
                                        <option value="APPROVED">ONAYLANDI</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filterDateFrom">Sipariş Tarihi (Başlangıç)</label>
                                <input type="date" id="filterDateFrom" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="filterDateTo">Sipariş Tarihi (Bitiş)</label>
                                <input type="date" id="filterDateTo" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="applyFilters" class="btn btn-success">Filtreleri Uygula</button>
                            <button id="resetFilters" class="btn btn-secondary">Filtreleri Sıfırla</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-body">
                    <table id="orders" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Sipariş Numarası</th>
                                <th class="text-center">Müşteri Tanımı</th>
                                <th class="text-center">Aracı Firma</th>
                                <th class="text-center">Sipariş Miktarı</th>
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
                                <th class="text-center">Sipariş Miktarı</th>
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
    #orders td,
    #orders th {
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
<!-- Select2 -->
<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
@endsection

@section('customjs')
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/plugins/select2/js/select2.full.min.js"></script>
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
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>

<script>
    $(document).ready(function() {
        // Select2 başlat
        $('#filterOrderStatus').select2();

        // Varsayılan olarak sayfa açıldığında seçilecek İngilizce değerler
        const defaultStatuses = ['SHIPPED', 'IN_PROGRESS', 'APPROVED'];
        $('#filterOrderStatus').val(defaultStatuses).trigger('change');

        // DataTable başlat (önce table değişkenini kullanmadan önce başlatıyoruz)
        var table = $('#orders').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: ["excel", "pdf"],
            ajax: {
                url: "{{ route('orders.filteredData') }}",
                data: function(d) {
                    // filterOrderStatus bir array olarak gönderiyoruz; backend explode/parse edebilir
                    d.filterOrderStatus = $('#filterOrderStatus').val() || [];
                    d.filterDateFrom = $('#filterDateFrom').val() || '';
                    d.filterDateTo = $('#filterDateTo').val() || '';
                }
            },
            columns: [{
                    data: 'orderNumber',
                    name: 'orderNumber'
                },
                {
                    data: 'customerCode',
                    name: 'customerCode'
                },
                {
                    data: 'productDescription',
                    name: 'productDescription'
                },
                {
                    data: 'productDetails',
                    name: 'productDetails'
                },
                {
                    data: 'orderDate',
                    name: 'orderDate'
                },
                {
                    data: 'dueDate',
                    name: 'dueDate'
                },
                {
                    data: 'personnelName',
                    name: 'personnelName'
                },
                {
                    data: 'companyName',
                    name: 'companyName'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'orderStatus',
                    name: 'orderStatus',
                    render: function(data) {
                        let labelMap = {
                            'SHIPPED': 'SEVK EDİLDİ',
                            'CANCELLED': 'İPTAL EDİLDİ',
                            'IN_PROGRESS': 'İŞLEMDE',
                            'COMPLETED': 'TAMAMLANDI',
                            'APPROVED': 'ONAYLANDI'
                        };

                        let badgeClass = {
                            'SHIPPED': 'bg-success',
                            'CANCELLED': 'bg-danger',
                            'IN_PROGRESS': 'bg-warning text-dark',
                            'COMPLETED': 'bg-primary',
                            'APPROVED': 'bg-info'
                        } [data] || 'bg-secondary';

                        let label = labelMap[data] || data;
                        return `<h5><span class="badge ${badgeClass}">${label}</span></h5>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            createdRow: function(row) {
                $('td:eq(9)', row).addClass('text-center');
            }
        });

        // Butona basınca DataTable'ı yenile (ajax.data fonksiyonu güncel değerlere bakar)
        $('#applyFilters').on('click', function() {
            table.ajax.reload();
        });

        // Filtreleri sıfırla: defaultları geri koy veya tamamen temizle istersen
        $('#resetFilters').on('click', function() {
            // Eğer reset'te yine default listesi gelsin istiyorsan:
            $('#filterOrderStatus').val(defaultStatuses).trigger('change');
            $('#filterDateFrom, #filterDateTo').val('');
            table.ajax.reload();
        });

        // Export butonlarını taşı
        table.buttons().container().appendTo('#orders_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    $(document).ready(function() {
        @if(session('message'))
        Swal.fire({
            title: "Başarılı!",
            text: "{{ session('message') }}",
            icon: "success"
        });
        @endif
        @if(session('error'))
        Swal.fire({
            title: "Hata!",
            text: "{{ session('error') }}",
            icon: "error"
        });
        @endif
    });
</script>
@endsection