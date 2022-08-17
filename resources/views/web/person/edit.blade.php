@extends('web.layout')

@section('title', 'Kişi Düzenle')

@section('content')

    <!--**********************************
    Content body start
***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Kişi Düzenle</h4>
                            <div class="basic-form">
                                @include ('web.partials.message')

                                <form method="post" action="{{ route('web.person.update', ['id' => $person->id]) }}">
                                    {{ method_field('PUT') }}
                                    @include('web.person.form')

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-dark">Kaydet</button>
                                            <a href="{{ route('web.person.index') }}" class="btn btn-dark">Geri</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    <script src="{{ asset('assets/web/js/imask.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('.phone-mask').each(function (key, item) {
                IMask(item, {
                    mask: '(500) 000 00 00'
                });
            });

            $('#room_status').change(function () {
                $('[class*=room_status]').hide();
                $('.room_status' + $(this).val()).show();
            });

            $('#room_status').change();
        });
    </script>
@endpush
