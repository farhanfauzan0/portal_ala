<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/logo-ala.png') }}">
    <title>ALA GROUP PORTAL</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <!-- Date Range Picker CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    <style>
        .datepicker {
            z-index: 99999 !important;
        }

        hr {
            border: 0;
            clear: both;
            display: block;
            width: 96%;
            background-color: #ffffff;
            height: 1px;
        }

    </style>
    @yield('css')
</head>
<body class="vertical light">
    <div class="wrapper">
        @include('layout.navbar')
        @include('layout.sidebar')
        @yield('main')
    </div> <!-- .wrapper -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    {{-- <script src='{{ asset('js/daterangepicker.js') }}'></script> --}}
    <script src='{{ asset('js/bootstrap-datepicker.js') }}'></script>
    <script src='{{ asset('js/jquery.mask.min.js') }}'></script>
    <script src='{{ asset('js/jquery-dateformat.min.js') }}'></script>
    <script src='{{ asset('js/jquery.dataTables.min.js') }}'></script>
    <script src="{{ asset('sweetalert/sweetalert2.min.js') }}"></script>
    <script src='{{ asset('js/button.js') }}'></script>
    <script src='{{ asset('js/buttonhtml5.js') }}'></script>
    <script src='{{ asset('js/zip.js') }}'></script>
    {{-- <script src="js/d3.min.js"></script>
    <script src="js/topojson.min.js"></script>
    <script src="js/Chart.min.js"></script> --}}
    <script>
        /* defind global options */
        // Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        // Chart.defaults.global.defaultFontColor = colors.mutedColor;

    </script>
    {{-- <script src='{{asset('js/jquery.timepicker.js')}}'></script> --}}
    {{-- <script src="js/gauge.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src='js/jquery.mask.min.js'></script>
    <script src='js/select2.min.js'></script>
    <script src='js/jquery.steps.min.js'></script>
    <script src='js/jquery.validate.min.js'></script>
    <script src='js/dropzone.min.js'></script>
    <script src='js/uppy.min.js'></script>
    <script src='js/quill.min.js'></script> --}}

    <script src="{{ asset('js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        $(function() {
            $("body").delegate(".datepickers", "focusin", function() {
                $(this).datepicker({
                    autoclose: true
                    , format: 'yyyy-mm-dd'
                });
            });
        });

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.number-only').mask('0#');
        $('.number-money').mask('000.000.000.000.000', {
            reverse: true
        });

    </script>
    @yield('js')
</body>
</html>
