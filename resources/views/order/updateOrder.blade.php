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
                        <h4 class="card-title">Sipariş Güncelle</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateOrder', ['id' => $order->id]) }}">
                            @csrf
                            @method('POST')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Hata! Lütfen aşağıdaki alanları kontrol edip tekrar deneyiniz.</strong>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="orderNumber">Sipariş Numarası</label>
                                <input type="text" class="form-control" id="orderNumber" name="orderNumber"
                                    placeholder="Sipariş Numarası" value="{{ $order->orderNumber }}" disabled />
                                @error('orderNumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="customerCode">Müşteri Tanımı</label>
                                        <input type="text" class="form-control @error('customerCode') is-invalid @enderror"
                                            id="customerCode" name="customerCode" placeholder="Müşteri Tanımı"
                                            value="{{ old('customerCode', $order->customerCode) }}"
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                            id="productDescription" name="productDescription" placeholder="Aracı Firma"
                                            value="{{ old('productDescription', $order->productDescription) }}"
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                            name="orderDate" placeholder="Sipariş Tarihi"
                                            value="{{ old('orderDate', $order->orderDate) }}"
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                            name="dueDate" placeholder="Termin Tarihi"
                                            value="{{ old('dueDate', $order->dueDate) }}"
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                            value="{{ old('personnelCode', $order->personnelCode) }}" 
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                            value="{{ old('personnelName', $order->personnelName) }}"
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
                                        @error('personnelName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="companyName">Sipariş Talep Eden Firma</label>
                                        <input type="text" class="form-control @error('companyName') is-invalid @enderror"
                                            id="companyName" name="companyName" placeholder="Sipariş Talep Eden Firma"
                                            value="{{ old('companyName', $order->companyName) }}" 
                                            {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
                                        @error('companyName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Açıklama</label>
                                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description" placeholder="Personel Adı Soyadı"
                                            value="{{ old('description', $order->description) }}" {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                        <select id="orderStatus"
                                            class="form-control @error('orderStatus') is-invalid @enderror"
                                            name="orderStatus" {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }}>
                                            <option value="SHIPPED" {{ old('orderStatus', $order->orderStatus) == 'SHIPPED' ? 'selected' : '' }}>Sevk Edildi</option>
                                            <option value="CANCELLED" {{ old('orderStatus', $order->orderStatus) == 'CANCELLED' ? 'selected' : '' }}>İptal Edildi</option>
                                            <option value="IN_PROGRESS" {{ old('orderStatus', $order->orderStatus) == 'IN_PROGRESS' ? 'selected' : '' }}>İşlemde</option>
                                            <option value="COMPLETED" {{ old('orderStatus', $order->orderStatus) == 'COMPLETED' ? 'selected' : '' }}>Tamamlandı</option>
                                            <option value="APPROVED" {{ old('orderStatus', $order->orderStatus) == 'APPROVED' ? 'selected' : '' }}>Onaylandı</option>
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
                                            value="{{ old('shippingDate', $order->shippingDate) }}" {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
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
                                            id="note" name="note" placeholder="Not"
                                            value="{{ old('note', $order->note) }}" {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }} />
                                        @error('note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Durum</label>
                                        <select id="status" class="form-control @error('status') is-invalid @enderror"
                                            name="status" {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }}>
                                            <option value="ACTIVE" {{ old('status', $order->status) == 'ACTIVE' ? 'selected' : '' }}>Aktif</option>
                                            <option value="PASSIVE" {{ old('status', $order->status) == 'PASSIVE' ? 'selected' : '' }}>Pasif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary" {{ Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES' ? 'disabled' : '' }}>
                                    Güncelle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card-secondary">
                    <div class="card-header">
                        <h4 class="card-title">Ürün Detayları</h4>
                    </div>
                    <div class="card-body">
                        <table id="products" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Kod</th>
                                    <th class="text-center">Özel Kod Açıklaması</th>
                                    <th class="text-center">Tür</th>
                                    <th class="text-center">Özel Kod</th>
                                    <th class="text-center">Açıklama</th>
                                    <th class="text-center">Grup Kodu</th>
                                    <th class="text-center">Ana Birim</th>
                                    <th class="text-center">Miktar</th>
                                    <th class="text-center">Durum</th>
                                    <th class="text-center">Durum Güncelle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td class="text-center">{{ $product->code }}</td>
                                        <td class="text-center">{{ $product->specialCodeDescription }}</td>
                                        <td class="text-center">{{ $product->type}}</td>
                                        <td class="text-center">{{ $product->specialCode }}</td>
                                        <td class="text-center">{{ $product->description }}</td>
                                        <td class="text-center">{{ $product->groupCode }}</td>
                                        <td class="text-center">{{ $product->mainUnit }}</td>
                                        <td class="text-center">{{ $product->pivot->quantity }}</td>
                                        <td class="text-center">
                                            <h5>
                                                @if ($product->pivot->status == 'ORDER')
                                                    <span class="badge bg-success">SİPARİŞ</span>
                                                @elseif ($product->pivot->status == 'MANUFACTURING')
                                                    <span class="badge bg-primary">İMALAT</span>
                                                @elseif ($product->pivot->status == 'ASSEMBLY')
                                                    <span class="badge bg-primary">MONTAJ</span>
                                                @elseif ($product->pivot->status == 'ACCOUNTING')
                                                    <span class="badge bg-warning">MUHASEBE</span>
                                                @elseif ($product->pivot->status == 'SHIPPING')
                                                    <span class="badge bg-info">SEVK/DEPO</span>
                                                @elseif ($product->pivot->status == 'CANCELLED')
                                                    <span class="badge bg-danger">İPTAL</span>
                                                @elseif ($product->pivot->status == 'COMPLETED')
                                                    <span class="badge bg-secondary">TAMAMLANDI</span>
                                                @endif
                                            </h5>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="update-status-btn" data-toggle="modal"
                                                data-target="#updateProductStatusModal" data-order-id="{{ $order->id }}"
                                                data-product-id="{{ $product->id }}" data-product-code="{{ $product->code }}"
                                                data-product-status="{{ $product->pivot->status }}"
                                                data-product-quantity="{{ $product->pivot->quantity }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="updateProductStatusModal" tabindex="-1" role="dialog"
                                        aria-labelledby="updateProductStatusLabel" aria-hidden="true">
                                        <form method="POST" id="updateProductForm">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="updateProductStatusLabel">Durum Güncelle
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Kod -->
                                                        <div class="form-group">
                                                            <label for="modalCode">Kod:</label>
                                                            <input type="text" class="form-control" id="modalCode" disabled />
                                                        </div>
                                                        <!-- hidden input -->
                                                        <input type="hidden" id="modalOrderId" name="orderId"
                                                            value="{{ $order->id }}" />
                                                        <input type="hidden" id="modalProductId" name="productId" />
                                                        <input type="hidden" id="modalCurrentStatus" name="currentStatus" />
                                                        <!-- Adet -->
                                                        <div class="form-group">
                                                            <label for="modalQuantity">Miktar</label>
                                                            <input type="number" id="modalQuantity" class="form-control"
                                                                name="quantity" step="0.01" min="0.01" required />
                                                            <small class="form-text text-muted">Maksimum: <span id="maxQuantity"></span></small>
                                                        </div>
                                                        <!-- Durum -->
                                                        <div class="form-group">
                                                            <label for="modalNewStatus">Durum</label>
                                                            <select id="modalNewStatus" class="form-control" name="newStatus">
                                                                <option value="ORDER">SİPARİŞ</option>
                                                                <option value="MANUFACTURING">İMALAT</option>
                                                                <option value="ASSEMBLY">MONTAJ</option>
                                                                <option value="SHIPPING">SEVK/DEPO</option>
                                                                <option value="ACCOUNTING">MUHASEBE</option>
                                                                <option value="COMPLETED">TAMAMLANDI</option>
                                                                <option value="CANCELLED">İPTAL</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Kapat</button>
                                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">Kod</th>
                                    <th class="text-center">Özel Kod Açıklaması</th>
                                    <th class="text-center">Tür</th>
                                    <th class="text-center">Özel Kod</th>
                                    <th class="text-center">Açıklama</th>
                                    <th class="text-center">Grup Kodu</th>
                                    <th class="text-center">Ana Birim</th>
                                    <th class="text-center">Miktar</th>
                                    <th class="text-center">Durum</th>
                                    <th class="text-center">Durum Güncelle</th>
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
                    buttons: ["excel", "pdf"],
                })
                .buttons()
                .container()
                .appendTo("#products_wrapper .col-md-6:eq(0)");
        });
    </script>
    <script>
        $(document).on('click', '.update-status-btn', function () {
            var orderId = $(this).data('order-id');
            var productId = $(this).data('product-id');
            var productCode = $(this).data('product-code');
            var productStatus = $(this).data('product-status');
            var productQuantity = $(this).data('product-quantity');

            var modal = $('#updateProductStatusModal');

            // Modal içindeki alanları güncelle
            modal.find('#modalProductId').val(productId);
            modal.find('#modalCode').val(productCode);
            modal.find('#modalCurrentStatus').val(productStatus);

            // Adet input'unu ayarla
            var quantityInput = modal.find('#modalQuantity');
            quantityInput.val(productQuantity);
            quantityInput.attr('max', productQuantity);
            modal.find('#maxQuantity').text(productQuantity);

            // Durum seçeneklerini güncelle
            modal.find('#modalNewStatus').val(productStatus);

            // Form action URL'sini güncelle
            var updateUrl = "/orders/updateProductStatus/" + productId;
            modal.find('#updateProductForm').attr('action', updateUrl);

            // Modalı aç
            modal.modal('show');
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