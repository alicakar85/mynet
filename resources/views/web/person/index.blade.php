@extends('web.layout')

@section('title', 'Üye Listesi')

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
                            <div class="card-title">
                                <h4>Üye Listesi</h4>
                            </div>

                            @include ('web.partials.message')

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad Soyad</th>
                                        <th>Doğum Tarihi</th>
                                        <th>Cinsiyet</th>
                                        <th>Oluşturma <br> Tarihi</th>
                                        <th>Düzenlenme <br> Tarihi</th>
                                        <th>İşlem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($list as $key => $item)
                                        <tr>
                                            <th>
                                                {{ ($key+1) }}
                                            </th>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->birthday ? $item->birthday->format('d.m.Y') : null }}
                                            </td>
                                            <td>
                                                {{ $item->genders($item->gender) }}
                                            </td>
                                            <td>
                                                {{ $item->created_at ? $item->created_at->format('d.m.Y H:i') : null }}
                                            </td>
                                            <td>
                                                {{ $item->updated_at ? $item->updated_at->format('d.m.Y H:i') : null }}
                                            </td>
                                            <td class="color-primary">
                                                <span>
                                                    <a href="{{ route('web.person.edit', ['id' => $item->id]) }}"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="Düzenle">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>

                                                    <a class="sweet-confirm"
                                                       href="{{ route('web.person.destroy', ['id' => $item->id]) }}"
                                                       data-toggle="tooltip" data-placement="top" title="Sil"
                                                       data-original-text="Silmek istediğinize emin misiniz?"
                                                       data-original-title="Kayıt Sil">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($list->count())
                                <div class="row">
                                    <div class="col-12">
                                        {{ $list->links() }}
                                    </div>
                                </div>
                            @endif
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

    <form id="formDelete" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('.sweet-confirm').click(function (e) {
                e.preventDefault();
                var _this = $(this);

                swal({
                    title: $(this).data('original-title'),
                    text: $(this).data('original-text'),
                    type: "warning",
                    showCancelButton: !0,
                    cancelButtonText: "İptal",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sil",
                    closeOnConfirm: !1
                }, function () {
                    $('#formDelete').attr('action', _this.attr('href')).submit();
                });
            });
        });
    </script>
@endpush
