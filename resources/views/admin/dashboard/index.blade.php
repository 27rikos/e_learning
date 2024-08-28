@extends('Partials.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="fa-solid fa-chalkboard-user bg-c-blue card1-icon"></i>
                                    <span class="text-c-blue f-w-600">Jumlah Guru</span>
                                    <h4>49/50GB</h4>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="fa-solid fa-users bg-c-pink card1-icon"></i>
                                    <span class="text-c-pink f-w-600">Jumlah Siswa</span>
                                    <h4>$23,589</h4>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="fa-solid fa-layer-group bg-c-green card1-icon"></i>
                                    <span class="text-c-green f-w-600">Total Tingkatan</span>
                                    <h4>45</h4>
                                </div>
                            </div>
                        </div>
                        <!-- card1 end -->
                        <!-- card1 start -->
                        <div class="col-md-6 col-xl-3">
                            <div class="card widget-card-1">
                                <div class="card-block-small">
                                    <i class="fa-solid fa-house-flag bg-c-yellow card1-icon"></i>
                                    <span class="text-c-yellow f-w-600">Total Kelas</span>
                                    <h4>+562</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
@endsection
