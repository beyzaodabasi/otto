@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h3 class="m-0">Satış Raporları</h3>
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
            <!-- Filtreleme -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tarih Filtreleme</h3>
                </div>
                <div class="card-body">
                    <div class="row">
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
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-group w-100">
                                <button id="applyFilters" class="btn btn-success mr-2">
                                    <i class="fas fa-filter"></i> Filtrele
                                </button>
                                <button id="resetFilters" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i> Sıfırla
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Rapor Tablosu -->
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Ürün Satış Raporu</h3>
                </div>
                <div class="card-body">
                    <table id="reportingTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Ürün Kodu</th>
                                <th class="text-center">Ürün Açıklaması</th>
                                <th class="text-center">Özel Kod</th>
                                <th class="text-center">Tür</th>
                                <th class="text-center">Ana Birim</th>
                                <th class="text-center">Toplam Satış Miktarı</th>
                                <th class="text-center">Sipariş Sayısı</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">Ürün Kodu</th>
                                <th class="text-center">Ürün Açıklaması</th>
                                <th class="text-center">Özel Kod</th>
                                <th class="text-center">Tür</th>
                                <th class="text-center">Ana Birim</th>
                                <th class="text-center">Toplam Satış Miktarı</th>
                                <th class="text-center">Sipariş Sayısı</th>
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
    #reportingTable td,
    #reportingTable th {
        text-align: center;
        vertical-align: middle;
    }
</style>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css" />
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
    $(document).ready(function() {
        // DataTable başlat
        var table = $('#reportingTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: ["excel", "pdf"],
            ajax: {
                url: "{{ route('reporting.data') }}",
                data: function(d) {
                    d.filterDateFrom = $('#filterDateFrom').val() || '';
                    d.filterDateTo = $('#filterDateTo').val() || '';
                }
            },
            columns: [
                {
                    data: 'product_code',
                    name: 'product_code',
                    searchable: true
                },
                {
                    data: 'product_description',
                    name: 'product_description',
                    searchable: true
                },
                {
                    data: 'special_code',
                    name: 'special_code',
                    searchable: true
                },
                {
                    data: 'product_type',
                    name: 'product_type',
                    searchable: true
                },
                {
                    data: 'main_unit',
                    name: 'main_unit',
                    searchable: true
                },
                {
                    data: 'total_quantity',
                    name: 'total_quantity',
                    className: 'text-center',
                    searchable: false
                },
                {
                    data: 'order_count',
                    name: 'order_count',
                    className: 'text-center',
                    searchable: false
                }
            ],
            order: [[5, 'desc']], // Toplam satış adetine göre azalan sırada
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/tr.json'
            }
        });

        // Filtreleri uygula
        $('#applyFilters').on('click', function() {
            table.ajax.reload();
        });

        // Filtreleri sıfırla
        $('#resetFilters').on('click', function() {
            $('#filterDateFrom, #filterDateTo').val('');
            table.ajax.reload();
        });

        // Export butonlarını taşı
        table.buttons().container().appendTo('#reportingTable_wrapper .col-md-6:eq(0)');
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
