@extends('Partials.guru')
@section('title', 'Materi')
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
                                <h4>Materi</h4>
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
                                <li class="breadcrumb-item"><a href="#!">{{ $room->mapel }}</a>
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
                                <a href="{{ url('materi/create/' . $room->id) }}" class="btn btn-primary btn-sm">
                                    <i class="ti-plus mr-2"></i>Tambah
                                </a>
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
                                <table id="example" class="table table-borderless" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Materi</th>
                                            <th>Pertanyaan</th>
                                            <th>Pilihan A</th>
                                            <th>Pilihan B</th>
                                            <th>Pilihan C</th>
                                            <th>Pilihan D</th>
                                            <th>Pilihan E</th>
                                            <th>Kunci Jawaban</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{!! $item->materi !!}</td>
                                                <td>{{ $item->pertanyaan }}</td>
                                                <td>{{ $item->pilihan_a }}</td>
                                                <td>{{ $item->pilihan_b }}</td>
                                                <td>{{ $item->pilihan_c }}</td>
                                                <td>{{ $item->pilihan_d }}</td>
                                                <td>{{ $item->pilihan_e }}</td>
                                                <td>{{ $item->kunci_jawaban }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ url("materi/{$item->id}/edit/{$room->id}") }}"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        &nbsp;
                                                        <form action="{{ url("materi/{$item->id}/destroy/{$room->id}") }}"
                                                            method="post" class="ms-2">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
