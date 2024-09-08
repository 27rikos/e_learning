@extends('Partials.guru')
@section('title', 'Edit Materi')
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
                                <h4>Edit Materi</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('materi.index') }}">Daftar Mata Pelajaran</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ url("materi/show/{$room->id}") }}">{{ $room->mapel }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Edit Materi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->

            <div class="page-body">
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
                                <form action="{{ url("materi/{$data->id}/update/{$room->id}") }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Materi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="materi"
                                                value="{{ old('materi', $data->materi) }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pertanyaan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="pertanyaan">{{ old('pertanyaan', $data->pertanyaan) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pilihan A</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_a"
                                                value="{{ old('pilihan_a', $data->pilihan_a) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pilihan B</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_b"
                                                value="{{ old('pilihan_b', $data->pilihan_b) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pilihan C</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_c"
                                                value="{{ old('pilihan_c', $data->pilihan_c) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pilihan D</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_d"
                                                value="{{ old('pilihan_d', $data->pilihan_d) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pilihan E</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_e"
                                                value="{{ old('pilihan_e', $data->pilihan_e) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kunci Jawaban</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="kunci_jawaban"
                                                value="{{ old('kunci_jawaban', $data->kunci_jawaban) }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                            <a href="{{ url("materi/show/{$room->id}") }}"
                                                class="btn btn-secondary btn-sm">Batal</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
