<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple landing page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('front/vendors/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendors/owl-carousel/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.min.css') }}">
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">
    <header id="header-section">
        <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar">
            <div class="container">
                <div class="navbar-brand-wrapper d-flex w-100">
                    <h5>E-learning SMA</h5>
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mdi mdi-menu navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-lg-center align-items-start ml-auto">
                        <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
                            <div class="navbar-collapse-logo">
                                <img src="{{ asset('front/images/Group2.svg') }}" alt="">
                            </div>
                            <button class="navbar-toggler close-button" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="mdi mdi-close navbar-toggler-icon pl-5"></span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#header-section">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features-section">About</a>
                        </li>
                        <li class="nav-item btn-contact-us pl-4 pl-lg-0">
                            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Contact
                                Us</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="banner">
        <div class="container">
            <h1 class="font-weight-semibold">LEARNING MANAJEMENT SYSTEM</h1>
            <h6 class="font-weight-normal text-muted pb-3">UNTUK BELAJAR DARING SISWA SMAN 1 PANCUR BATU</h6>
            <div>
                <a href="{{ route('login') }}" class="btn btn-opacity-light mr-1">Login</a>
                <a href="{{ route('register') }}" class="btn btn-opacity-success ml-1">Registrasi</a>
            </div>
            <img src="{{ asset('front/images/Group171.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="content-wrapper">
        <div class="container">
            <section class="features-overview" id="features-section">
                <div class="content-header">
                    <h2>Cara Kerja Kami</h2>
                    <h6 class="section-subtitle text-muted">Tema yang dirancang sebagai alat operasional mudah
                        digunakan<br>yang memenuhi kebutuhan pembelajaran online Anda.</h6>
                </div>
                <div class="d-md-flex justify-content-between">
                    <div class="grid-margin d-flex justify-content-start">
                        <div class="features-width">
                            <img src="{{ asset('front/images/Group12.svg') }}" alt="" class="img-icons">
                            <h5 class="py-3">Kursus<br>Interaktif</h5>
                            <p class="text-muted">Desain kursus yang interaktif dan menarik, memberikan pengalaman
                                belajar yang menyenangkan.</p>
                            <a href="#">
                                <p class="readmore-link">Selengkapnya</p>
                            </a>
                        </div>
                    </div>
                    <div class="grid-margin d-flex justify-content-center">
                        <div class="features-width">
                            <img src="{{ asset('front/images/Group7.svg') }}" alt="" class="img-icons">
                            <h5 class="py-3">Materi<br>Pembelajaran</h5>
                            <p class="text-muted">Akses mudah ke berbagai materi pembelajaran yang komprehensif dan
                                terstruktur.</p>
                            <a href="#">
                                <p class="readmore-link">Selengkapnya</p>
                            </a>
                        </div>
                    </div>
                    <div class="grid-margin d-flex justify-content-end">
                        <div class="features-width">
                            <img src="{{ asset('front/images/Group5.svg') }}" alt="" class="img-icons">
                            <h5 class="py-3">Pengalaman<br>Belajar</h5>
                            <p class="text-muted">Fitur-fitur yang mendukung pengalaman belajar yang menyenangkan dan
                                efektif.</p>
                            <a href="#">
                                <p class="readmore-link">Selengkapnya</p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>


            <footer class="border-top">
                <p class="text-center text-muted pt-4">Copyright © 2024<a href="https://www.bootstrapdash.com/"
                        class="px-1">E-learning</a>All rights reserved.</p>
            </footer>
            <!-- Modal for Contact - us Button -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Contact Us</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" id="Name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email-1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="Message">Message</label>
                                    <textarea class="form-control" id="Message" placeholder="Enter your Message"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('front/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/vendors/aos/js/aos.js') }}"></script>
    <script src="{{ asset('front/js/landingpage.js') }}"></script>
</body>

</html>
