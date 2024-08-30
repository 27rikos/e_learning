@extends('Partials.guru')
@section('title', 'Quiz')
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
                                <h4>Quiz</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('quiz.index') }}">Daftar Quiz</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ url("materi/show/{$room->id}") }}">{{ $room->mapel }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Tambah Quiz</a>
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
                                <form action="{{ url('quiz/store/' . $room->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Peratanyaan</label>
                                        <div class="col-sm-10">
                                            <input id="x" type="hidden" name="pertanyaan">
                                            <trix-editor input="x"></trix-editor>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OPSI A</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_a">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OPSI B</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_b">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OPSI C</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_c">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OPSI D</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_d">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">OPSI E</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="pilihan_e">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kunci Jawaban</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="kunci">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10"><button class="btn btn-primary btn-sm"
                                                type="submit">Simpan</button></div>
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
