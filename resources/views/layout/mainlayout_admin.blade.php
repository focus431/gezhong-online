<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">  <head>
    @include('layout.partials.head_admin')
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>
  @if(Route::is(['error-404','error-500']))
  <body class="error-page">
  @endif
  <body>
  @if(!Route::is(['login','register','forgot-password','lock-screen','error-404','error-500', 'admin-login']))
  @include('layout.partials.header_admin')
  @include('layout.partials.nav_admin')
@endif

 @yield('content')
 @include('layout.partials.footer_admin-scripts')
 <script src="{{ asset('js/shared-translations.js') }}"></script>

 @yield('scripts')
  </body>
</html>