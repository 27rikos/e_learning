@extends('Partials.siswa')
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
                                <li class="breadcrumb-item"><a href="{{ route('tugas.index') }}">Daftar Tugas</a>
                                </li>
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
                                <table id="example" class="table table-borderless" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mapel</th>
                                            <th>Judul</th>
                                            <th>File</th>
                                            <th>KKM</th>
                                            <th>Deadline</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tugas->mapel }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td> <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#exampleModal{{ $item->id }}">
                                                        View
                                                    </button>
                                                </td>
                                                <td>{{ $item->kkm }}</td>
                                                <td>{{ $item->deadline }}</td>
                                                <td>
                                                    <div>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#staticBackdrop{{ $item->id }}">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($data as $item)
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Materi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe src="{{ asset('files/tugas/' . $item->file) }}" frameborder="0"
                                                        style="width: 100%" height="600px"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Modal -->
                        @foreach ($data as $item)
                            <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Upload File Tugas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('tugas-submit') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group" hidden>
                                                    <label for="id_siswa">Nama</label>
                                                    <input type="text" class="form-control" id="id_siswa"
                                                        name="id_siswa" value="{{ $examps->id }}">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="nama">ID Tugas</label>
                                                    <input type="text" class="form-control" id="id_tugas"
                                                        name="id_tugas" value="{{ $item->id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama"
                                                        class="text-danger text-decoration-underline">Kumpulkan File dalam
                                                        bentuk
                                                        PDF</label>
                                                    <input type="file" class="form-control" id="file"
                                                        name="file" accept=".pdf">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
