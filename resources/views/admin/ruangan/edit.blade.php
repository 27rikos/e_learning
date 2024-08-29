@extends('Partials.admin')
@section('title', 'Guru Mapel Ruang')
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
                                <h4>Guru Mapel Ruang</h4>
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
                                <li class="breadcrumb-item"><a href="{{ route('room.index') }}">Daftar Guru Mapel Ruang</a>
                                <li class="breadcrumb-item"><a href="#">Edit Guru Mapel Ruang</a></li>
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
                                        <li><i class="icofont icofont-simple-left"></i></li>
                                        <li><i class="icofont icofont-maximize full-card"></i></li>
                                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                                        <li><i class="icofont icofont-error close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <form action="{{ route('room.update', $data->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                        <div class="col-sm-10">
                                            <select name="tahun" id="" class="form-control">
                                                <option value="">Pilih Tahun Ajaran</option>
                                                @foreach ($tahun as $thn)
                                                    <option value="{{ $thn->tahun }}"
                                                        {{ $data->tahun == $thn->tahun ? 'selected' : '' }}>
                                                        {{ $thn->tahun }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Guru</label>
                                        <div class="col-sm-10">
                                            <select name="guru" id="" class="form-control">
                                                <option value="">Pilih Guru</option>
                                                @foreach ($guru as $g)
                                                    <option value="{{ $g->name }}"
                                                        {{ $data->guru == $g->name ? 'selected' : '' }}>
                                                        {{ $g->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-10">
                                            <select name="mapel" id="" class="form-control">
                                                <option value="">Pilih Mata Pelajaran</option>
                                                @foreach ($mapel as $m)
                                                    <option value="{{ $m->mapel }}"
                                                        {{ $data->mapel == $m->mapel ? 'selected' : '' }}>
                                                        {{ $m->mapel }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kelas</label>
                                        <div class="col-sm-10">
                                            <!-- Looping through $kelas and displaying as checkboxes -->
                                            @foreach ($kelas as $item)
                                                <div class="form-check ml-4">
                                                    <input type="checkbox" class="form-check-input" name="kelas[]"
                                                        id="kelas_{{ $item->id }}" value="{{ $item->kelas }}"
                                                        {{ in_array($item->kelas, explode(', ', $data->kelas)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="kelas_{{ $item->id }}">
                                                        {{ $item->kelas }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
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
