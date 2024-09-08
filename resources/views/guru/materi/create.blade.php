@extends('Partials.guru')
@section('title', 'Materi')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
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
                                <li class="breadcrumb-item"><a href="{{ route('materi.index') }}">Daftar Materi</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ url("materi/show/{$room->id}") }}">{{ $room->mapel }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Tambah Materi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

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
                                <form action="{{ url('materi/store/' . $room->id) }}" method="POST">
                                    @csrf

                                    <div id="form-container">
                                        <div class="form-section">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Materi 1</label>
                                                <div class="col-sm-10">
                                                    <input id="materi_1" type="hidden" name="materi[]">
                                                    <trix-editor input="materi_1"></trix-editor>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pertanyaan Kuis 1</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="pertanyaan[]"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pilihan A</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pilihan_a[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pilihan B</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pilihan_b[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pilihan C</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pilihan_c[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pilihan D</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pilihan_d[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Pilihan E</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="pilihan_e[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Kunci Jawaban</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="kunci_jawaban[]">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr> <!-- Pembatas antara materi -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="button" id="add-section" class="btn btn-primary">+ Tambah Materi
                                                dan Kuis</button>
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

    <script>
        let sectionCount = 1;

        function addFormSection() {
            sectionCount++;
            const formContainer = document.getElementById('form-container');
            const newId = 'materi_' + sectionCount;
            formContainer.innerHTML += `
                <div class="form-section">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Materi ${sectionCount}</label>
                        <div class="col-sm-10">
                            <input id="${newId}" type="hidden" name="materi[]">
                            <trix-editor input="${newId}"></trix-editor>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pertanyaan Kuis ${sectionCount}</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="pertanyaan[]"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilihan A</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pilihan_a[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilihan B</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pilihan_b[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilihan C</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pilihan_c[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilihan D</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pilihan_d[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilihan E</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pilihan_e[]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kunci Jawaban</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kunci_jawaban[]">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>
                    <hr> <!-- Pembatas antar materi -->
                </div>
            `;
        }

        document.getElementById('add-section').addEventListener('click', addFormSection);
    </script>
@endsection
