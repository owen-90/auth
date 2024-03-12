<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/png">
    <title>Forgot Password | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bill-recon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/theme-bill-recon.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="nk-body bg-white npc-default pg-auth">
<div class="nk-app-root">
    <div class="nk-main">
        <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-split nk-split-page nk-split-lg">
                <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                    <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                        <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo">
                            <em class="icon ni ni-info"></em>
                        </a>
                    </div>
                    <div class="nk-block nk-block-middle nk-auth-body">
                        <div class="brand-logo pb-5">
                            <a href="#" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="{{asset('img/eLipa.png')}}"
                                     srcset="{{asset('img/eLipa.png  2x')}}" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="{{asset('img/eLipa.png')}}"
                                     srcset="{{asset('img/eLipa.png  2x')}}" alt="logo-dark">
                            </a>
                        </div>
                        @include('partials.alerts')
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Reset password</h5>
                                <div class="nk-block-des">
                                    <p>
                                        If you forgot your password, we’ll email you
                                        instructions to reset your password.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('reset-password') }}" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="default-01">Email</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input type="text" name="email" class="form-control form-control-lg" id="default-01"
                                           placeholder="Enter your email address">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                            </div>
                        </form>
                        <div class="form-note-s2 pt-5">
                            <a href="{{ route('login') }}">
                                <strong>Return to login</strong>
                            </a>
                        </div>
                    </div>
                    <div class="nk-block nk-auth-footer">
                        <div class="mt-3">
                            <p>&copy; {{ date('Y') . config('app.company_name')}} . All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
                <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide
                    toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                    <div class="w-100 w-max-550px p-3 p-sm-5 m-auto">
                        <div class="nk-feature nk-feature-center">
                            <div class="nk-feature-img">
                                <img class="round" src="#" srcset="#" alt="">
                            </div>
                            <div class="nk-feature-content py-4 p-sm-5">
                                <h4>Cetri.io</h4>
                                <p>
                                    You can start to create your products easily with its user-friendly design & most
                                    completed responsive layout.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/demo2/assets/js/bundle.js?ver=3.2.3"></script>
<script src="/demo2/assets/js/scripts.js?ver=3.2.3"></script>
<script src="/demo2/assets/js/demo-settings.js?ver=3.2.3"></script>

</body>
</html>
