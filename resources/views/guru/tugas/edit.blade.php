@extends('Partials.guru')
@section('title', 'Tugas')
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
                                <h4>Tugas</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('tugas.index') }}">Daftar Materi</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ url("tugas/show/{$room->id}") }}">{{ $room->mapel }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Edit Tugas</a>
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
                                <form action="{{ url("tugas/{$data->id}/update/{$room->id}") }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Judul Tugas</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="judul"
                                                value="{{ $data->judul }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">File Tugas</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="file" accept=".pdf">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Deadline</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="deadline"
                                                value="{{ $data->deadline }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">KKM</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="kkm"
                                                value="{{ $data->kkm }}">
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
