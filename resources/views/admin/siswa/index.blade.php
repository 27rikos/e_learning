@extends('Partials.admin')
@section('title', 'Data Siswa')
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
                                <h4>Siswa</h4>
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
                                <li class="breadcrumb-item"><a href="#!">Daftar Siswa</a>
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
                                <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm"><i
                                        class="ti-plus mr-2"></i>Tambah</a>
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
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Agama</th>
                                            <th>Kelas</th>
                                            <th>Telepon</th>
                                            <th>E-Mail</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nis }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->jenkel }}</td>
                                                <td>{{ $item->tempat_lhr }}</td>
                                                <td>{{ $item->tanggal_lhr }}</td>
                                                <td>{{ $item->agama }}</td>
                                                <td>{{ $item->kelas }}</td>
                                                <td>{{ $item->hp }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    <img src="{{ asset('images/students/' . $item->file) }}" alt=""
                                                        width="80" height="80">
                                                </td>
                                                <td><span class="bg-success px-3 py-1 rounded">{{ $item->status }}</span>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('student.edit', $item->id) }}"
                                                            class="btn btn-info btn-sm">Edit</a>
                                                        &nbsp;
                                                        <form action="{{ route('student.destroy', $item->id) }}"
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
