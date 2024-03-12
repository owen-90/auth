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

<body class="nk-body bg-white npc-default pg-auth no-touch nk-nio-theme">
<div class="nk-app-root">
    <div class="nk-main ">
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
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Register</h5>
                                <div class="nk-block-des">
                                    <p>Create New Daro Account</p>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="#" autocomplete="off">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg" name="full_name" id="name"
                                           placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg" name="email" id="email"
                                           placeholder="Enter your email address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Passcode</label>
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                                       data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" class="form-control form-control-lg" name="password" id="password"
                                           placeholder="Enter your passcode">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-control-xs custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox">
                                    <label class="custom-control-label" for="checkbox">I agree to Daro
                                        <a tabindex="-1" href="#">Privacy Policy</a> &amp;
                                        <a tabindex="-1" href="#"> Terms.</a></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block">Register</button>
                            </div>
                        </form>
                        <div class="form-note-s2 pt-4"> Already have an account ?
                            <a href="{{ route('login') }}"><strong>Sign in instead</strong></a>
                        </div>
                    </div>
                </div>
                <div
                    class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right toggle-screen-lg"
                    data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg"
                    data-toggle-overlay="true">
                    <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                        <div class="slider-init slick-initialized slick-slider slick-dotted"
                             data-slick="{&quot;dots&quot;:true, &quot;arrows&quot;:false}">
                            <div class="slick-list draggable">
                                <div class="slick-track"
                                     style="opacity: 1; width: 3234px; transform: translate3d(-462px, 0px, 0px);">
                                    <div class="slider-item slick-slide slick-cloned" data-slick-index="-1" id=""
                                         aria-hidden="true" style="width: 462px;" tabindex="-1">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-c.png"
                                                     srcset="/demo4/images/slides/promo-c2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5"><h4>Cetri.io</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item slick-slide slick-current slick-active"
                                         data-slick-index="0" aria-hidden="false" style="width: 462px;" tabindex="0"
                                         role="tabpanel" id="slick-slide00"
                                         aria-describedby="slick-slide-control00">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-a.png"
                                                     srcset="/demo4/images/slides/promo-a2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Cetri.io</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item slick-slide" data-slick-index="1" aria-hidden="true"
                                         style="width: 462px;" tabindex="-1" role="tabpanel" id="slick-slide01"
                                         aria-describedby="slick-slide-control01">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-b.png"
                                                     srcset="/demo4/images/slides/promo-b2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Cetri.io</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item slick-slide" data-slick-index="2" aria-hidden="true"
                                         style="width: 462px;" tabindex="-1" role="tabpanel" id="slick-slide02"
                                         aria-describedby="slick-slide-control02">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-c.png"
                                                     srcset="/demo4/images/slides/promo-c2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Cetri.io</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item slick-slide slick-cloned" data-slick-index="3" id=""
                                         aria-hidden="true" style="width: 462px;" tabindex="-1">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-a.png"
                                                     srcset="/demo4/images/slides/promo-a2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Cetri</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item slick-slide slick-cloned" data-slick-index="4" id=""
                                         aria-hidden="true" style="width: 462px;" tabindex="-1">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-b.png"
                                                     srcset="/demo4/images/slides/promo-b2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Cetri.io</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-item slick-slide slick-cloned" data-slick-index="5" id=""
                                         aria-hidden="true" style="width: 462px;" tabindex="-1">
                                        <div class="nk-feature nk-feature-center">
                                            <div class="nk-feature-img">
                                                <img class="round" src="/demo4/images/slides/promo-c.png"
                                                     srcset="/demo4/images/slides/promo-c2x.png 2x" alt="">
                                            </div>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                                <h4>Cetri.io</h4>
                                                <p>You can start to create your products easily with its
                                                    user-friendly design &amp; most completed responsive layout.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="slick-dots" style="" role="tablist">
                                <li class="slick-active" role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control00"
                                            aria-controls="slick-slide00" aria-label="1 of 3" tabindex="0"
                                            aria-selected="true">1
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control01"
                                            aria-controls="slick-slide01" aria-label="2 of 3" tabindex="-1">2
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control02"
                                            aria-controls="slick-slide02" aria-label="3 of 3" tabindex="-1">3
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
