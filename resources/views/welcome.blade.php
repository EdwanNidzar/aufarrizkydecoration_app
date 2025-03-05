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
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#bayar">Tata Cara</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#contact">Kontak</a>
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

    <!-- Jumbotron -->
    <section class="jumbotron" id="home">
        <main class="contain" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="home-text-head" style="color: black">Wujudkan Dekorasi Impian bersama</h1>
            <p style="color: black;">Aufarrizky Decoration</p>
            <a href="{{ route('user-catalog') }}" class="btn btn-inti">Pesan Sekarang</a>
        </main>
    </section>
    <!-- End Jumbotron -->

    <!-- About -->
    <section class="about" id="about">
        <h2 data-aos="fade-down" data-aos-duration="1000">
            <span>Tentang</span> Kami
        </h2>
        <div class="row">
            <div class="about-img" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ asset('assets/dekor-home.jpg') }}" alt="fix" />
            </div>
            <div class="contain" data-aos="fade-left" data-aos-duration="1000">
                <h4 class="text-center mb-3">Kenapa Memilih kami?</h4>
                <p>AUFARRIZKY DECORATION adalah penyedia jasa dekorasi profesional yang siap menghadirkan sentuhan
                    elegan dan kreatif untuk berbagai acara, mulai dari pernikahan, ulang tahun, tunangan, hingga event
                    perusahaan. Dengan pengalaman bertahun-tahun, kami selalu mengutamakan desain yang unik, material
                    berkualitas, dan pelayanan terbaik agar setiap momen spesial Anda menjadi lebih berkesan. Kami
                    berkomitmen untuk menghadirkan dekorasi yang tidak hanya indah tetapi juga sesuai dengan konsep dan
                    impian pelanggan. Untuk konsultasi dan pemesanan, hubungi kami dan wujudkan dekorasi impian Anda
                    bersama AUFARRIZKY DECORATION.</p>
            </div>
        </div>
    </section>
    <!-- End About -->

    <!-- Pembayaran -->
    <section class="pembayaran" id="bayar">
        <h2 data-aos="fade-down" data-aos-duration="1000">
            <span>Tata Cara</span> Pembayaran
        </h2>
        <p class="text-center">Berikut adalah tata cara pemesanan pada Aufarrizky Decoration:</p>
        <ul class="border list-group list-group-flush mt-5">
            <li class="list-group-item">1. Pengguna harus membuat akun atau mendaftar pada website Aufarrizky
                Decoration.</li>
            <li class="list-group-item">2. Pengguna dapat memilih paket dekorasi yang tersedia, memilih tanggal dan
                waktu tertentu.</li>
            <li class="list-group-item">3. Pengguna harus memilih tanggal dan waktu, melihat harga jasa, melengkapi
                formulir pemesanan.</li>
            <li class="list-group-item">4. Bila Dirasa sudah sesuai, pengguna dapat meng klik tombol pesan.</li>
            <li class="list-group-item">5. Lalu pengguna akan diarahkan ke menu pembayaran</li>
            <li class="list-group-item">6. Lakukan pembayaran ke rekening yang sudah tertera dan upload bukti pembayaran
            </li>
            <li class="list-group-item">7. Setelah upload, tunggu admin menyetujui pembayaran anda</li>
            <li class="list-group-item">8. Setelah status sudah di setujui, tim Aufarrizky Decoration akan menghubungi
                anda</li>
        </ul>
    </section>
    <!-- End Pembayaran -->

    <!-- Contact -->
    <section id="contact" class="contact" data-aos="fade-down" data-aos-duration="1000">
        <h2><span>Kontak</span> Kami</h2>
        <p class="text-center m-5">
            Hubungi kami jika ada saran yang ingin di sampaikan
        </p>
        <div class="row">
            <div class="col">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63731.19313685472!2d114.51458573341371!3d-3.300723093983044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423a36e058181%3A0x66e7b2f6dd35f7f8!2sBanua%20Dekorasi!5e0!3m2!1sid!2sid!4v1740995040357!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col">
                <form action="">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="mail"></i></span>
                        </div>
                        <input type="text" name="" id="" value="aufarrizkydecoration@gmail.com"
                            class="form-control" readonly />
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="phone"></i></span>
                        </div>
                        <input type="text" name="" id="" value="081300000000"
                            class="form-control" readonly />
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Contact -->

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
