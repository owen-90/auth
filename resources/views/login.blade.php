<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{config('app.name')}}">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/png">
    <title>Login :: {{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/bill-recon.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins/theme-bill-recon.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>

<body class="nk-body npc-crypto ui-clean pg-auth">
<div class="nk-app-root">
    <div class="nk-split nk-split-page nk-split-md">
        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container w-lg-45">
            <div class="nk-block  nk-auth-body mt-4">
                <div class="nk-block-head left">
                    <div class="nk-block-head-content mt-4 p-">
                        <a href="#" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{asset('img/eLipa.png')}}"
                                 srcset="{{asset('img/eLipa.png  2x')}}" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="{{asset('img/eLipa.png')}}"
                                 srcset="{{asset('img/eLipa.png  2x')}}" alt="logo-dark">
                        </a>

                        {{--<h5 style="margin-top: 50px; margin-bottom: 30px;" class="nk-block-title">
                            Cetri.io
                        </h5>--}}
                        @include('partials.alerts')
                        <h5 class="nk-block-title" style="margin-top: 50px; margin-bottom: 30px;">Sign-In</h5>
                        <div class="nk-block-des">
                            <p>
                                Access the platform using your email and passcode
                            </p>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label-group" for="text">Username</label>
                        <input type="text" name="email" class="form-control form-control-lg" id="email-address"
                               placeholder="Enter your email address" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label-group" for="password">Passcode</label>
                            <a class="link link-primary link-sm" tabindex="-1" href="{{ route('forgot-password') }}">
                                Forgot Code?
                            </a>
                        </div>
                        <div class="form-control-wrap">
                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch"
                               data-target="password" id="togglePassword" onclick="myFunction()">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input autocomplete="false"
                                   name="password" type="password" class="form-control form-control-lg" id="password"
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign In</button>
                    </div>
                </form>
                <div class="form-note-s2 pt-4">
                    New on the platform?
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
            </div>

            <div class="nk-blockx nk-auth-footer">
                <div class="mt-3">
                    <p>&copy; {{date('Y')}} {{config('app.company_name')}}. All Rights Reserved.</p>
                </div>
            </div>
        </div>
        <div
            class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right toggle-screen-lg"
            data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                <div class="slider-init slick-initialized slick-slider slick-dotted"
                     data-slick='{"dots":true, "arrows":false}'>
                    <div class="slick-list draggable">
                        <div class="slick-track"
                             style="opacity: 1; width: 3234px; transform: translate3d(-462px, 0px, 0px);">
                            <div class="slider-item slick-slide slick-cloned" data-slick-index="-1" id=""
                                 aria-hidden="true" style="width: 462px;" tabindex="-1">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="" srcset="/demo2/images/slides/promo-c2x.png 2x" alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5">
                                        <h4>Cetri.io</h4>
                                        <p>You can start to create your products easily with its user-friendly design
                                            &amp; most completed responsive layout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item slick-slide slick-current slick-active" data-slick-index="0"
                                 aria-hidden="false" style="width: 462px;" tabindex="0" role="tabpanel"
                                 id="slick-slide00" aria-describedby="slick-slide-control00">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="" srcset="/demo2/images/slides/promo-a2x.png 2x" alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5"><h4>Cetri.io</h4>
                                        <p>You can start to create your products easily with its user-friendly design
                                            &amp; most completed responsive layout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item slick-slide" data-slick-index="2" aria-hidden="true"
                                 style="width: 462px;" tabindex="-1" role="tabpanel" id="slick-slide02"
                                 aria-describedby="slick-slide-control02">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="" srcset="/demo2/images/slides/promo-c2x.png 2x" alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5">
                                        <h4>Daro</h4>
                                        <p>You can start to create your products easily with its user-friendly design
                                            &amp; most completed responsive layout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item slick-slide slick-cloned" data-slick-index="3" id=""
                                 aria-hidden="true" style="width: 462px;" tabindex="-1">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="/demo2/images/slides/promo-a.png"
                                                                     srcset="/demo2/images/slides/promo-a2x.png 2x"
                                                                     alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5">
                                        <h4>Cetri.io</h4>
                                        <p>You can start to create your products easily with its user-friendly design
                                            &amp; most completed responsive layout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item slick-slide slick-cloned" data-slick-index="4" id=""
                                 aria-hidden="true" style="width: 462px;" tabindex="-1">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="/demo2/images/slides/promo-b.png"
                                                                     srcset="/demo2/images/slides/promo-b2x.png 2x"
                                                                     alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5">
                                        <h4>Daro</h4>
                                        <p>You can start to create your products easily with its user-friendly design
                                            &amp; most completed responsive layout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item slick-slide slick-cloned" data-slick-index="5" id=""
                                 aria-hidden="true" style="width: 462px;" tabindex="-1">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img">
                                        <img class="round" src="/demo2/images/slides/promo-c.png"
                                                                     srcset="/demo2/images/slides/promo-c2x.png 2x"
                                                                     alt="">
                                    </div>
                                    <div class="nk-feature-content py-4 p-sm-5">
                                        <h4>Daro</h4>
                                        <p>You can start to create your products easily with its user-friendly design
                                            &amp; most completed responsive layout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-item slick-slide slick-current slick-active" data-slick-index="0"
                                 id="slick-slide00" aria-describedby="slick-slide-control00" aria-hidden="false"
                                 tabindex="0">
                                <div class="nk-feature nk-feature-center">
                                    <div class="nk-feature-img" align="center">
                                        <img class="round" src="{{ asset('img/loin.jpg') }}"
                                             srcset="{{ asset('img/loin.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="slick-dots" style="" role="tablist">
                        <li class="slick-active" role="presentation">
                            <button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00"
                                    aria-label="1 of 3" tabindex="0" aria-selected="true">1
                            </button>
                        </li>
                        <li role="presentation" class="">
                            <button type="button" role="tab" id="slick-slide-control01" aria-controls="slick-slide01"
                                    aria-label="2 of 3" tabindex="-1">2
                            </button>
                        </li>
                        <li role="presentation" class="">
                            <button type="button" role="tab" id="slick-slide-control02" aria-controls="slick-slide02"
                                    aria-label="3 of 3" tabindex="-1">3
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="slider-dots"></div>
                <div class="slider-arrows"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/bundle.js?ver=1.4.0') }}"></script>
<script src="{{ asset('js/scripts.js?ver=1.4.0') }}"></script>
<script>
    function myFunction() {
        var x = document.getElementById('password');

        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
    }
</script>
</body>

</html>
