<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="welcome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Poppins:wght@100;300;400;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        html,
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="container">
        <nav class="navbar fixed-top bg-body-secondary navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="70" height="70"
                        class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('user-catalog') }}">Catalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('order.payment') }}">Bayar</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item dropdown ms-lg-auto">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- End Navbar -->

    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Order untuk Pembayaran</h2>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->catalog->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->waktu_mulai)->format('d-m-Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->waktu_selesai)->format('d-m-Y H:i') }}</td>
                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($order->payment && $order->payment->status === 'paid')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Dibayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$order->payment || $order->payment->status !== 'paid')
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#paymentModal" data-order-id="{{ $order->id }}"
                                            data-product-name="{{ $order->catalog->nama }}"
                                            data-total-harga="{{ number_format($order->total_harga, 0, ',', '.') }}">
                                            Bayar Sekarang
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Lunas</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($orders->isEmpty())
                    <div class="alert alert-info text-center">Tidak ada order yang perlu dibayar.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pembayaran Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payment.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" id="modal-order-id">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="modal-product-name" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="modal-total-harga" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select class="form-control" name="payment_method" required>
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="ewallet">E-Wallet</option>
                                <option value="credit_card">Kartu Kredit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="bukti_pembayaran" required
                                accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();

        document.addEventListener("DOMContentLoaded", function() {
            let paymentModal = document.getElementById('paymentModal');
            paymentModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let orderId = button.getAttribute('data-order-id');
                let productName = button.getAttribute('data-product-name');
                let totalHarga = button.getAttribute('data-total-harga');

                document.getElementById('modal-order-id').value = orderId;
                document.getElementById('modal-product-name').value = productName;
                document.getElementById('modal-total-harga').value = "Rp " + totalHarga;
            });
        });
    </script>

</body>

</html>
