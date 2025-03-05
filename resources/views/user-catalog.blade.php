<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="welcome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary: #c28866;
            --hover: #c46800;
            --bg: #eeeeee;
        }

        .nav-item a:hover {
            background-color: var(--primary);
            border-radius: 12px;
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
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('user-catalog') }}">Catalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('order.payment') }}">Bayar</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- End Navbar -->

    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Catalog</h1>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($catalogs as $catalog)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $catalog->image) }}" class="card-img-top"
                            alt="{{ $catalog->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $catalog->nama }}</h5>
                            <p class="card-text">{{ $catalog->deskripsi }}</p>
                            <p class="card-text">Rp {{ number_format($catalog->harga, 0, ',', '.') }}</p>
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#orderModal{{ $catalog->id }}">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Order -->
                <div class="modal fade" id="orderModal{{ $catalog->id }}" tabindex="-1"
                    aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderModalLabel">Pesan {{ $catalog->nama }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('order.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="catalog_id" value="{{ $catalog->id }}">

                                    <div class="mb-3">
                                        <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                        <input type="datetime-local" name="waktu_mulai" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                        <input type="datetime-local" name="waktu_selesai" class="form-control"
                                            required>
                                    </div>

                                    <input type="hidden" name="harga" value="{{ $catalog->harga }}">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
        feather.replace();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let navLinks = document.querySelectorAll(".nav-link");
            let navbarCollapse = document.querySelector(".navbar-collapse");

            navLinks.forEach(link => {
                link.addEventListener("click", function() {
                    navbarCollapse.classList.remove("show");
                });
            });
        });
    </script>
</body>

</html>
