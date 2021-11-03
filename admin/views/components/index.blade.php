<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}" />

   <link rel="icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon" />
   <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon" />

   <title>{{ $title ?? config('app.name') }}</title>

   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/fontawesome.css') }}">
   <!-- ico-font-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/icofont.css') }}">
   <!-- Themify icon-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/themify.css') }}">
   <!-- Flag icon-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/flag-icon.css') }}">
   <!-- Feather icon-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/feather-icon.css') }}">
   <!-- Plugins css start-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/prism.css') }}">
   <!-- Plugins css Ends-->
   <!-- Bootstrap css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap.css') }}">
   <link id="bootstrap-file" rel="stylesheet" type="text/css" href="#">
   <!-- App css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">
   <link id="color" rel="stylesheet" href="{{ asset('assets/admin/css/color-1.css') }}" media="screen">
   <!-- Responsive css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/responsive.css') }}">
   {{ $head ?? '' }}
   <script>
      const admin = @json($layoutData);
      const menus = @json($primaryMenu);
   </script>
</head>
<body>
<!-- Loader starts-->
<div class="loader-wrapper">
   <div class="loader bg-white">
      <div class="whirly-loader"> </div>
   </div>
</div>
<!-- Loader ends-->
<div id="root" class="page-wrapper">
   {{ $header ?? '' }}
   <div class="page-body-wrapper">
      <x-admin-sidebar></x-admin-sidebar>
      <div class="page-body">
         <div class="container-fluid">
            {{ $slot }}
         </div>
      </div>
   </div>
</div>
{{ $scripts ?? '' }}
@stack('js')
<script src="@asset('admin/libs/alpinejs/alpinejs.min.js')"></script>
<!-- latest jquery-->
<script src="@asset('admin/js/jquery-3.2.1.min.js')"></script>
<!-- Bootstrap js-->
<script src="@asset('admin/js/bootstrap/bootstrap.bundle.min.js')"></script>
<!-- feather icon js-->
<script src="@asset('admin/js/icons/feather-icon/feather.min.js')"></script>
<script src="@asset('admin/js/icons/feather-icon/feather-icon.js')"></script>
<!-- Sidebar jquery-->
<script src="@asset('admin/js/sidebar-menu.js')"></script>
<script src="@asset('admin/js/config.js')"></script>
<!-- Plugins JS start-->
<script src="@asset('admin/js/prism/prism.min.js')"></script>
<script src="@asset('admin/js/clipboard/clipboard.min.js')"></script>
<script src="@asset('admin/js/custom-card/custom-card.js')"></script>
<script src="@asset('admin/js/typeahead/handlebars.js')"></script>
<script src="@asset('admin/js/typeahead/typeahead.bundle.js')"></script>
<script src="@asset('admin/js/typeahead/typeahead.custom.js')"></script>
<script src="@asset('admin/js/chat-menu.js')"></script>
<script src="@asset('admin/js/tooltip-init.js')"></script>
<script src="@asset('admin/js/typeahead-search/handlebars.js')"></script>
<script src="@asset('admin/js/typeahead-search/typeahead-custom.js')"></script>
<!-- Theme js-->
<script src="@asset('admin/js/script.js')"></script>
</body>
</html>

