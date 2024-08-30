@extends('Partials.siswa')
@section('title', 'Kuis')
@section('content')

    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="fa-solid fa-chalkboard-user bg-c-blue"></i>
                            <div class="d-inline">
                                <h4>Kuis</h4>
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
                                <li class="breadcrumb-item"><a href="{{ url('kuis/mapel') }}">Daftar Mata Pelajaran</a>
                                <li class="breadcrumb-item"><a href="#!">{{ $room->mapel }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->
            <div class="page-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        <p>Jumlah jawaban benar: {{ session('success')['Jumlah jawaban benar'] }}</p>
                        <p>Total nilai: {{ session('success')['Total nilai'] }}</p>
                        <p>Waktu pengerjaan kuis: {{ session('success')['Waktu pengerjaan kuis (menit)'] }} menit</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option" style="width: 35px;">
                                        <li class=""><i class="icofont icofont-simple-left"></i></li>
                                        <li><i class="icofont icofont-maximize full-card"></i></li>
                                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                                        <li><i class="icofont icofont-error close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <form method="POST" action="{{ url('kuis/store/' . $room->id) }}" id="quizForm">
                                    @csrf <!-- Token CSRF untuk keamanan -->

                                    @foreach ($data as $index => $item)
                                        <div class="soal mb-3 d-flex align-items-start">
                                            <!-- Nomor dan Pertanyaan Soal -->
                                            <p class="nomor-soal me-2 mb-0">{{ $index + 1 }}.</p>
                                            <p class="pertanyaan mb-0">{!! $item->pertanyaan !!}</p>
                                            <input type="text" readonly hidden name="id_soal"
                                                value="{{ $item->id }}">
                                        </div>

                                        <!-- Pilihan Jawaban -->
                                        @foreach (['A', 'B', 'C', 'D', 'E'] as $opsi)
                                            <div>
                                                <input type="radio" name="jawaban[{{ $item->id }}]"
                                                    value="{{ $opsi }}"
                                                    id="soal{{ $item->id }}_{{ $opsi }}">
                                                <label for="soal{{ $item->id }}_{{ $opsi }}">
                                                    {{ $opsi }}. {{ $item->{'pilihan_' . strtolower($opsi)} }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endforeach

                                    <!-- Hidden input field for time elapsed -->
                                    <input type="hidden" id="elapsed_time" name="elapsed_time">

                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </form>

                                <script>
                                    document.addEventListener('DOMContentLoaded', (event) => {
                                        let startTime = Date.now();

                                        // Function to format time in seconds
                                        function formatTime(ms) {
                                            let seconds = Math.floor(ms / 1000);
                                            return seconds;
                                        }

                                        // Update hidden input with elapsed time when form is submitted
                                        document.getElementById('quizForm').addEventListener('submit', function() {
                                            let elapsedTime = Date.now() - startTime;
                                            document.getElementById('elapsed_time').value = formatTime(elapsedTime);
                                        });
                                    });
                                </script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
