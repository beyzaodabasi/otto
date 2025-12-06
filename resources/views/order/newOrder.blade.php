@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Yeni Sipariş</h3>
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
                    <h4 class="card-title">Sipariş Oluştur</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createOrder') }}">
                        @csrf
                        @method('POST')
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Hata! Lütfen aşağıdaki alanları kontrol edip tekrar deneyiniz.</strong>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="orderNumber">Sipariş Numarası</label>
                            <input type="text" class="form-control @error('orderNumber') is-invalid @enderror"
                                id="orderNumber" name="orderNumber" placeholder="Sipariş Numarası"
                                value="{{ $orderNumber }}" disabled />
                            @error('orderNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="orderNumber" value="{{ $orderNumber }}" />
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="customerCode">Müşteri Tanımı</label>
                                    <input type="text" class="form-control @error('customerCode') is-invalid @enderror"
                                        id="customerCode" name="customerCode" placeholder="Müşteri Tanımı" required />
                                    @error('customerCode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="productDescription">Aracı Firma</label>
                                    <input type="text"
                                        class="form-control @error('productDescription') is-invalid @enderror"
                                        id="productDescription" name="productDescription"
                                        placeholder="Aracı Firma" />
                                    @error('productDescription')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="orderDate">Sipariş Tarihi</label>
                                    <input type="datetime-local"
                                        class="form-control @error('orderDate') is-invalid @enderror" id="orderDate"
                                        name="orderDate" placeholder="Sipariş Tarihi" value="{{ old('orderDate') }}"
                                        required />
                                    @error('orderDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="dueDate">Termin Tarihi</label>
                                    <input type="datetime-local"
                                        class="form-control @error('dueDate') is-invalid @enderror" id="dueDate"
                                        name="dueDate" placeholder="Termin Tarihi" value="{{ old('dueDate') }}" />
                                    @error('dueDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="personnelCode">Personel Kodu</label>
                                    <input type="text" class="form-control @error('personnelCode') is-invalid @enderror"
                                        id="personnelCode" name="personnelCode" placeholder="Personel Kodu"
                                        value="{{ old('personnelCode') }}" required />
                                    @error('personnelCode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="personnelName">Personel Adı Soyadı</label>
                                    <input type="text" class="form-control @error('personnelName') is-invalid @enderror"
                                        id="personnelName" name="personnelName" placeholder="Personel Adı Soyadı"
                                        value="{{ old('personnelName') }}" required />
                                    @error('personnelName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="companyName">Sipariş Talep Eden Firma Adı</label>
                                    <input type="text" class="form-control @error('companyName') is-invalid @enderror"
                                        id="companyName" name="companyName" placeholder="Sipariş Talep Eden Firma Adı"
                                        value="{{ old('companyName') }}" required />
                                    @error('companyName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description">Açıklama</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" placeholder="Açıklama"
                                        value="{{ old('description') }}" required />
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="orderStatus">Sipariş Durumu</label>
                                    <select class="form-control @error('orderStatus') is-invalid @enderror"
                                        id="orderStatus" name="orderStatus">
                                        <option value="APPROVED" @if (old('orderStatus')=='APPROVED' ) selected @endif>
                                            Onaylandı
                                        </option>
                                        <option value="IN_PROGRESS" @if (old('orderStatus')=='IN_PROGRESS' ) selected
                                            @endif>Devam Ediyor</option>
                                        <option value="SHIPPED" @if (old('orderStatus')=='SHIPPED' ) selected @endif>Sevk
                                            Edildi</option>
                                        <option value="COMPLETED" @if (old('orderStatus')=='COMPLETED' ) selected @endif>
                                            Tamamlandı
                                        </option>
                                        <option value="CANCELLED" @if (old('orderStatus')=='CANCELLED' ) selected @endif>
                                            İptal Edildi
                                        </option>
                                    </select>
                                    @error('orderStatus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="shippingDate">Sipariş Sevk Tarihi</label>
                                    <input type="datetime-local"
                                        class="form-control @error('shippingDate') is-invalid @enderror"
                                        id="shippingDate" name="shippingDate" placeholder="Sipariş Sevk Tarihi"
                                        value="{{ old('shippingDate') }}" />
                                    @error('shippingDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="note">Not</label>
                                    <input type="text" class="form-control @error('note') is-invalid @enderror"
                                        id="note" name="note" placeholder="Not" value="{{ old('note') }}" />
                                    @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Durum</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="ACTIVE" @if (old('status')=='ACTIVE' ) selected @endif>Aktif
                                        </option>
                                        <option value="PASSIVE" @if (old('status')=='PASSIVE' ) selected @endif>Pasif
                                        </option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group table-div">
                            <div class="row align-items-center mb-2 ">
                                <div class="col-sm-6">
                                    <label for="product">Ürünler</label>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary float-right" id="openProductModal">
                                        Ürün Ekle
                                    </button>

                                </div>
                            </div>
                            <table class="table table-bordered table-striped" id="qr-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Özel Kod Açıklaması</th>
                                        <th class="text-center">Tür</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Açıklama</th>
                                        <th class="text-center">Grup Kodu</th>
                                        <th class="text-center">Ana Birim</th>
                                        <th class="text-center">Miktar</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody id="qr-table-body">
                                </tbody>
                            </table>
                            <div id="form-products"></div>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary" name="createOrder" value="submit">
                                Kaydet
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
<div class="modal" id="newProductModal" aria-labelledby="newProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tabloya Ürün Ekle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Özel Kod Açıklaması</th>
                                <th class="text-center">Tür</th>
                                <th class="text-center">Kod</th>
                                <th class="text-center">Açıklama</th>
                                <th class="text-center">Grup Kodu</th>
                                <th class="text-center">Ana Birim</th>
                                <th class="text-center">Ekle</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-center">Özel Kod Açıklaması</th>
                                <th class="text-center">Tür</th>
                                <th class="text-center">Kod</th>
                                <th class="text-center">Açıklama</th>
                                <th class="text-center">Grup Kodu</th>
                                <th class="text-center">Ana Birim</th>
                                <th class="text-center">Ekle</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
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
    let productTable;

    // "Ürün Ekle" butonuna tıklandığında modalı aç
    $('#openProductModal').click(function() {
        $('#newProductModal').modal('show');
    });

    // Modal açıldığında DataTable'ı yükle veya yenile
    $('#newProductModal').on('shown.bs.modal', function() {
        if (!$.fn.DataTable.isDataTable('#products')) {
            productTable = $('#products').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('getProductsData') }}",
                columns: [{
                        data: 'specialCodeDescription',
                        className: 'text-center'
                    },
                    {
                        data: 'type',
                        className: 'text-center'
                    },
                    {
                        data: 'code',
                        className: 'text-center'
                    },
                    {
                        data: 'description',
                        className: 'text-center'
                    },
                    {
                        data: 'groupCode',
                        className: 'text-center'
                    },
                    {
                        data: 'mainUnit',
                        className: 'text-center'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <button 
                                    class="btn btn-sm btn-success select-product" 
                                    data-id="${row.id}">
                                    Seç
                                </button>`;
                        },
                        className: 'text-center'
                    }
                ]
            });
        } else {
            productTable.columns.adjust().draw();
        }
    });

    // Ürün seçme işlemi
    $(document).on('click', '.select-product', function() {
        const productId = $(this).data('id');
        const product = productTable.rows().data().toArray().find(p => p.id === productId);

        if (!product) {
            console.error("Ürün verisi bulunamadı:", productId);
            return;
        }

        const quantity = prompt("Lütfen miktar giriniz:", "1");
        if (quantity !== null) {
            // Virgülü noktaya çevir
            const normalizedQuantity = quantity.replace(',', '.');
            const parsedQuantity = parseFloat(normalizedQuantity);
            
            if (parsedQuantity > 0) {
                let duplicateFound = false;

                $("#qr-table-body tr").each(function() {
                    const existingCode = $(this).find("td").eq(2).text().trim();
                    if (existingCode === product.code) {
                        duplicateFound = true;
                        const quantityCell = $(this).find("td").eq(6);
                        const currentQuantity = parseFloat(quantityCell.text().replace(',', '.'));
                        const newQuantity = currentQuantity + parsedQuantity;
                        quantityCell.text(newQuantity);

                        const inputIndex = $(this).attr('data-index');
                        $(`input[name='products[${inputIndex}][quantity]']`).val(newQuantity);
                    }
                });

                if (!duplicateFound) {
                    const productIndex = $("#qr-table-body tr").length;

                    const newRow = `
                        <tr data-index="${productIndex}">
                            <td>${product.specialCodeDescription ?? ""}</td>
                            <td>${product.type ?? ""}</td>
                            <td>${product.code ?? ""}</td>
                            <td>${product.description ?? ""}</td>
                            <td>${product.groupCode ?? ""}</td>
                            <td>${product.mainUnit ?? ""}</td>
                            <td>${parsedQuantity}</td>
                            <td><button class="btn btn-danger btn-sm remove-product">Sil</button></td>
                        </tr>
                    `;
                    $("#qr-table-body").append(newRow);

                    const hiddenInputs = `
                        <input type="hidden" name="products[${productIndex}][id]" value="${product.id}">
                        <input type="hidden" name="products[${productIndex}][quantity]" value="${parsedQuantity}">
                    `;
                    $("#form-products").append(hiddenInputs);
                }

                $('#newProductModal').modal('hide');
            }
        }
    });

    // Ürün silme
    $('#qr-table-body').on('click', '.remove-product', function() {
        const row = $(this).closest('tr');
        const inputIndex = row.attr('data-index');
        row.remove();
        $(`input[name='products[${inputIndex}][id]']`).remove();
        $(`input[name='products[${inputIndex}][quantity]']`).remove();
    });
</script>

<script>
    $(document).ready(function() {
        $("form").on("submit", function(e) {
            let productCount = $("#qr-table-body tr").length; // Tablo satır sayısını kontrol et
            if (productCount === 0) {
                e.preventDefault(); // Formun gönderilmesini engelle
                Swal.fire({
                    icon: "error",
                    title: "Sipariş Oluşturulmadı!",
                    text: "Lütfen en az bir ürün ekleyin.",
                    confirmButtonText: "Tamam",
                    confirmButtonColor: "#e8540c"
                });
            }
        });
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