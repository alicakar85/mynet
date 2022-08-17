<!DOCTYPE html>
<html class="h-100" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Panel - Üye Girişi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/web/images/favicon.png') }}">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{ asset('assets/web/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="#login"><h4>Üye Girişi</h4></a>

                            @include ('web.partials.message')

                            <form method="post" action="{{ route('web.member.login') }}" class="mt-5 mb-5 login-input">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control"
                                           placeholder="E-posta adresiniz">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Şifreniz">
                                </div>

                                <button class="btn login-form__btn submit w-100">Giriş Yap</button>

                                <div class="form-group">
                                    <a class="form-control text-right" href="#">Şifremi Unuttum</a>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="{{ asset('assets/web/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('assets/web/js/custom.min.js') }}"></script>
</body>
</html>
