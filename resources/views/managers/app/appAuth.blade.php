<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>SCHOOL | @yield('title')</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/logo/logo1.jpg')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/logo/logo1.jpg')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/logo/logo1.jpg')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/logo/logo1.jpg')}}">
    <link rel="manifest" href="{{asset('/logo/logo1.jpg')}}">
    <meta name="msapplication-TileImage" content="{{asset('/logo/logo1.jpg')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="/managers/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/managers/vendors/simplebar/simplebar.min.js"></script>
    <script src="/managers/assets/js/config.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="/managers/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/managers/unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="/managers/assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="/managers/assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="/managers/assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="/managers/assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    @yield('content')
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="/managers/vendors/popper/popper.min.js"></script>
    <script src="/managers/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/managers/vendors/anchorjs/anchor.min.js"></script>
    <script src="/managers/vendors/is/is.min.js"></script>
    <script src="/managers/vendors/fontawesome/all.min.js"></script>
    <script src="/managers/vendors/lodash/lodash.min.js"></script>
    <script src="/managers/polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
    <script src="/managers/vendors/list.js/list.min.js"></script>
    <script src="/managers/vendors/feather-icons/feather.min.js"></script>
    <script src="/managers/vendors/dayjs/dayjs.min.js"></script>
    <script src="/managers/assets/js/phoenix.js"></script>
  </body>


</html>
