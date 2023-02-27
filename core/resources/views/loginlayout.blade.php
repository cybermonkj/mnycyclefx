<!doctype html>
<html class="no-js" lang="en">
    <head>
        <base href="{{url('/')}}"/>
        <title>{{ $title }} | {{$set->site_name}}</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="{{$set->site_name}}"/>
        <meta name="application-name" content="{{$set->site_name}}"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="{{$set->site_desc}}" />
        <link rel="shortcut icon" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/asset/vendor/slick-carousel/slick/slick.css">
        <link rel="stylesheet" href="{{asset('asset/css/theme.css')}}" type="text/css">
        <link href="{{url('/')}}/asset/fonts/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
        <link href="{{url('/')}}/asset/fonts/fontawesome/css/all.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{url('/')}}/asset/css/toast.css" type="text/css">
         @yield('css')
         @include('partials.font')
    </head>
    <body>
<!-- header begin-->
    <header id="header" class="header header-bg-transparent header-abs-top">
      <div class="header-section">
        <div id="logoAndNav" class="container-fluid">
          <!-- Nav -->
          <nav class="navbar navbar-expand header-navbar">
            <!-- White Logo -->
            <a class=" navbar-brand" href="{{url('/')}}" aria-label="Front">
              <img src="{{asset('asset/'.$logo->image_link)}}" alt="Logo">
            </a>
            <!-- End White Logo -->

            <!-- Default Logo -->
            <!-- End Default Logo -->

            <!-- Button -->
            <div class="ml-auto">
              <a class="btn btn-sm btn-link text-body" href="{{url()->previous()}}">
                <i class="fas fa-angle-left fa-sm mr-1"></i> Go back
              </a>
            </div>
            <!-- End Button -->
          </nav>
          <!-- End Nav -->
        </div>
      </div>
    </header>
<!-- header end -->
    <main id="content" role="main">
      <div class="d-flex align-items-center position-relative vh-lg-100">
      @yield('content')
      </div>
    </main>
<!-- footer begin -->
        {!!$set->livechat!!}
        <script src="{{url('/')}}/asset/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{url('/')}}/asset/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
        <script src="{{url('/')}}/asset/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- JS Implementing Plugins -->
        <script src="{{url('/')}}/asset/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="{{url('/')}}/asset/vendor/slick-carousel/slick/slick.js"></script>
        <!-- JS Front -->
        <script src="{{url('/')}}/asset/js/hs.core.js"></script>
        <script src="{{url('/')}}/asset/js/hs.validation.js"></script>
        <script src="{{url('/')}}/asset/js/hs.slick-carousel.js"></script>
        <script src="{{url('/')}}/asset/js/toast.js"></script>

        <!-- JS Plugins Init. -->
        <script>
        !function ($) {
        //eyeOpenClass: 'fa-eye',
        //eyeCloseClass: 'fa-eye-slash',
            'use strict';

            $(function () {
                $('[data-toggle="password"]').each(function () {
                    var input = $(this);
                    var eye_btn = $(this).parent().find('.input-group-text');
                    eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
                    eye_btn.on('click', function () {
                        if (eye_btn.hasClass('input-password-hide')) {
                            eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                            eye_btn.find('.fa').removeClass('fa-eye').addClass('fa-eye-slash')
                            input.attr('type', 'text');
                        } else {
                            eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                            eye_btn.find('.fa').removeClass('fa-eye-slash').addClass('fa-eye')
                            input.attr('type', 'password');
                        }
                    });
                });
            });

        }(window.jQuery);
          "use strict";
          $(document).on('ready', function () {
            // initialization of slick carousel
            $('.js-slick-carousel').each(function() {
              var slickCarousel = $.HSCore.components.HSSlickCarousel.init($(this));
            });

            // initialization of form validation
            $('.js-validate').each(function () {
              var validation = $.HSCore.components.HSValidation.init($(this));
            });
          });
        </script>
        <!-- IE Support -->
        <script>
            "use strict";
            if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{url('/')}}/asset/vendor/polifills.js"><\/script>');
        </script>
        @yield('script')
        @if (session('success'))
            <script>
              "use strict";
              toastr.success("{{ session('success') }}");
            </script>    
        @endif
        @if (session('alert'))
            <script>
              "use strict";
              toastr.warning("{{ session('alert') }}");
            </script>
        @endif

        @if($set->recaptcha==1)
          {!! NoCaptcha::renderJs() !!}
        @endif
    </body>
</html>