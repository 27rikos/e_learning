@extends('Partials.admin')
@section('title', 'Data Guru')
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
                                <h4>Guru</h4>
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
                                <li class="breadcrumb-item"><a href="#!">Daftar Guru</a>
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
                                <a href="{{ route('teacher.create') }}" class="btn btn-primary btn-sm"><i
                                        class="ti-plus mr-2"></i>Tambah</a>
                                <!-- Button trigger modal -->
                                <a href="#" class="btn btn-success btn-sm"data-toggle="modal"
                                    data-target="#exampleModal">Imports</a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import Guru</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ url('imports-guru') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="file" name="file" class="form-control">
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
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Agama</th>
                                            <th>Pendidikan</th>
                                            <th>Jabatan</th>
                                            <th>Telepon</th>
                                            <th>E-Mail</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->jenkel }}</td>
                                                <td>{{ $item->tempat_lhr }}</td>
                                                <td>{{ $item->tanggal_lhr }}</td>
                                                <td>{{ $item->agama }}</td>
                                                <td>{{ $item->pendidikan }}</td>
                                                <td>{{ $item->jabatan }}</td>
                                                <td>{{ $item->hp }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    <img src="{{ asset('images/teachers/' . $item->file) }}" alt=""
                                                        width="80" height="80">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('teacher.edit', $item->id) }}"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        &nbsp;
                                                        <form action="{{ route('teacher.destroy', $item->id) }}"
                                                            method="post" class="ms-2" enctype="multipart/form-data">
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
