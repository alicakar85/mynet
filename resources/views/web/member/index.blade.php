@extends('web.layout')

@section('title', 'Anasayfa')

@section('content')
    <!--**********************************
    Content body start
***********************************-->
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h3 class="card-title text-white">Kayıtlı Üye Sayısı</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">
                                    {{ $personCount }}
                                </h2>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">Kayıtlı Adres Sayısı</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">
                                    {{ $personAddressCount }}
                                </h2>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-hourglass"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection


@push('scripts')

@endpush
