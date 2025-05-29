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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        /* Custom CSS for 1080x1920 hero images */
        .hero-slider-container {
            width: 100%;
            height: 100vh;
            /* Full viewport height */
            max-height: 1920px;
            overflow: hidden;
            position: relative;
        }

        .swiper.mySwiper {
            height: 100%;
        }

        .swiper-slide {
            height: 100%;
        }

        .hero-slide-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .hero-slide-content {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 10;
            width: 100%;
        }

        .hero-slide-content .btn {
            font-size: 1.5rem;
            padding: 12px 30px;
            border-radius: 50px;
        }

        /* Adjust navbar for fullscreen hero */
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: rgba(248, 249, 250, 0.8) !important;
            backdrop-filter: blur(5px);
        }

        /* Other sections spacing */
        section {
            padding: 80px 0;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top bg-body-secondary navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/Aufadecorr-Logo.png') }}" alt="Logo" width="90" height="90"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
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
                            <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron / Hero Slider -->
    <div class="hero-slider-container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide position-relative">
                    <img src="{{ asset('img/1.png') }}" class="hero-slide-img" alt="Event 1">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2">Pesan Sekarang</a>
                    </div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="{{ asset('img/2.png') }}" class="hero-slide-img" alt="Event 2">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2">Pesan Sekarang</a>
                    </div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="{{ asset('img/3.png') }}" class="hero-slide-img" alt="Event 3">
                    <div class="hero-slide-overlay"></div>
                    <div class="hero-slide-content">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Rest of your content (About, Pembayaran, Contact sections) -->
    <div class="container">
        <!-- About -->
        <section class="about mt-5" id="about">
            <h2 data-aos="fade-down" data-aos-duration="1000">
                <span>Tentang</span> Kami
            </h2>
            <div class="row m-3">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                    <img src="{{ asset('assets/dekor-home.jpg') }}" alt="fix" class="img-fluid" />
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                    <h4 class="text-center mb-3">Kenapa Memilih kami?</h4>
                    <p>AUFARRIZKY DECORATION adalah penyedia jasa dekorasi profesional yang siap menghadirkan sentuhan
                        elegan dan kreatif untuk berbagai acara, mulai dari pernikahan, ulang tahun, tunangan, hingga
                        event
                        perusahaan. Dengan pengalaman bertahun-tahun, kami selalu mengutamakan desain yang unik,
                        material
                        berkualitas, dan pelayanan terbaik agar setiap momen spesial Anda menjadi lebih berkesan...</p>
                </div>
            </div>
        </section>

        <!-- Pembayaran -->
        <section class="pembayaran mt-5" id="bayar">
            <h2 data-aos="fade-down" data-aos-duration="1000">
                <span>Tata Cara</span> Pembayaran
            </h2>
            <p class="text-center">Berikut adalah tata cara pemesanan pada Aufarrizky Decoration:</p>
            <ul class="border list-group list-group-flush mt-5 mx-3">
                <li class="list-group-item">1. Pengguna harus membuat akun atau mendaftar pada website Aufarrizky
                    Decoration.</li>
                <li class="list-group-item">2. Pilih paket dekorasi, tanggal, dan waktu tertentu.</li>
                <li class="list-group-item">3. Lengkapi formulir pemesanan.</li>
                <li class="list-group-item">4. Klik tombol pesan jika sudah sesuai.</li>
                <li class="list-group-item">5. Pengguna akan diarahkan ke menu pembayaran.</li>
                <li class="list-group-item">6. Lakukan pembayaran dan upload bukti pembayaran.</li>
                <li class="list-group-item">7. Tunggu persetujuan dari admin.</li>
                <li class="list-group-item">8. Tim kami akan menghubungi Anda setelah pembayaran disetujui.</li>
            </ul>
        </section>

        <!-- Contact -->
        <section id="contact" class="contact mt-5" data-aos="fade-down" data-aos-duration="1000">
            <h2><span>Kontak</span> Kami</h2>
            <p class="text-center m-5">
                Hubungi kami jika ada saran yang ingin disampaikan
            </p>
            <div class="row m-3">
                <div class="col-md-6 mb-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63731.19313685472!2d114.51458573341371!3d-3.300723093983044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423a36e058181%3A0x66e7b2f6dd35f7f8!2sBanua%20Dekorasi!5e0!3m2!1sid!2sid!4v1740995040357!5m2!1sid!2sid"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i data-feather="mail"></i></span>
                            <input type="text" class="form-control" value="aufarrizkydecoration@gmail.com"
                                readonly>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i data-feather="phone"></i></span>
                            <input type="text" class="form-control" value="081300000000" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All Rights Reserved.</p>
    </footer>

    <!-- JS Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoMjybSnCNh3tp/gORdzdrpFjhLxeQ6nUygD2GQ26rdp3mo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        feather.replace();

        const swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</body>

</html>
