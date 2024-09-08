@extends('Partials.siswa')
@section('title', 'Materi dan Kuis')
@section('content')
    <style>
        .slide {
            display: none;
        }

        .active {
            display: block;
        }

        .card-body-custom {
            padding: 2rem;
            /* Adjust padding as needed */
        }

        .button-group {
            margin-top: 1rem;
            /* Space above the buttons */
        }
    </style>
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="fa-solid fa-chalkboard-user bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Materi dan Kuis</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="icofont icofont-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('materi/index') }}">Daftar Mata Pelajaran</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">{{ $room->mapel }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->

            <div class="page-body">
                <div class="container mt-5">
                    @php
                        // Create an array of slides for display
                        $slides = [];
                        foreach ($data as $item) {
                            // Add materi slide
                            $slides[] = [
                                'type' => 'materi',
                                'id' => $item->id,
                                'content' => $item->materi,
                            ];
                            // Add quiz slide if it has questions
                            if (!is_null($item->pertanyaan)) {
                                $slides[] = [
                                    'type' => 'quiz',
                                    'id' => $item->id,
                                    'pertanyaan' => $item->pertanyaan,
                                    'pilihan_a' => $item->pilihan_a,
                                    'pilihan_b' => $item->pilihan_b,
                                    'pilihan_c' => $item->pilihan_c,
                                    'pilihan_d' => $item->pilihan_d,
                                    'pilihan_e' => $item->pilihan_e,
                                    'kunci_jawaban' => $item->kunci_jawaban,
                                ];
                            }
                        }
                    @endphp

                    @foreach ($slides as $key => $slide)
                        <div class="slide {{ $key === 0 ? 'active' : '' }}" id="slide{{ $key + 1 }}">
                            <div class="card mb-3">
                                <div class="card-body card-body-custom">
                                    @if ($slide['type'] === 'materi')
                                        <h5 class="card-title">Materi {{ $key + 1 }}</h5>
                                        <p class="card-text">{!! $slide['content'] !!}</p>
                                        <div class="button-group">
                                            <button class="btn btn-primary" onclick="nextSlide()">Next</button>
                                        </div>
                                    @elseif ($slide['type'] === 'quiz')
                                        <h5 class="card-title">Kuis {{ $key }}</h5>
                                        <p class="card-text">Pertanyaan: {{ $slide['pertanyaan'] }}</p>
                                        <div>
                                            @if ($slide['pilihan_a'])
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="quiz{{ $key }}" value="A">
                                                    <label class="form-check-label">{{ $slide['pilihan_a'] }}</label>
                                                </div>
                                            @endif
                                            @if ($slide['pilihan_b'])
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="quiz{{ $key }}" value="B">
                                                    <label class="form-check-label">{{ $slide['pilihan_b'] }}</label>
                                                </div>
                                            @endif
                                            @if ($slide['pilihan_c'])
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="quiz{{ $key }}" value="C">
                                                    <label class="form-check-label">{{ $slide['pilihan_c'] }}</label>
                                                </div>
                                            @endif
                                            @if ($slide['pilihan_d'])
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="quiz{{ $key }}" value="D">
                                                    <label class="form-check-label">{{ $slide['pilihan_d'] }}</label>
                                                </div>
                                            @endif
                                            @if ($slide['pilihan_e'])
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="quiz{{ $key }}" value="E">
                                                    <label class="form-check-label">{{ $slide['pilihan_e'] }}</label>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <span id="result{{ $key }}"></span>
                                            <button class="btn btn-primary" onclick="prevSlide()">Previous</button>
                                            <button class="btn btn-primary"
                                                onclick="checkMultipleChoice({{ $key }}, '{{ $slide['kunci_jawaban'] }}')">Next</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 1;
        const totalSlides = {{ count($slides) }};

        function nextSlide() {
            if (currentSlide < totalSlides) {
                document.getElementById(`slide${currentSlide}`).classList.remove('active');
                currentSlide++;
                document.getElementById(`slide${currentSlide}`).classList.add('active');
            }
        }

        function prevSlide() {
            if (currentSlide > 1) {
                document.getElementById(`slide${currentSlide}`).classList.remove('active');
                currentSlide--;
                document.getElementById(`slide${currentSlide}`).classList.add('active');
            }
        }

        function checkMultipleChoice(quizNumber, correctAnswer) {
            const selectedAnswer = document.querySelector(`input[name="quiz${quizNumber}"]:checked`);
            const resultElement = document.getElementById(`result${quizNumber}`);
            if (selectedAnswer) {
                if (selectedAnswer.value === correctAnswer) {
                    resultElement.innerHTML = '<span class="text-success">Jawaban benar!</span>';
                    nextSlide();
                } else {
                    resultElement.innerHTML = '<span class="text-danger">Jawaban salah, coba lagi!</span>';
                }
            } else {
                resultElement.innerHTML = '<span class="text-warning">Pilih jawaban terlebih dahulu!</span>';
            }
        }
    </script>
@endsection
