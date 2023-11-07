<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">  <head>
    @include('layout.partials.head')
   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preload" href="/assets/plugins/fontawesome/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/plugins/fontawesome/webfonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin>

  </head>
  @if(Route::is(['map-grid']))
  <body class="map-page">
  @endif
  @if(Route::is(['mentor-register','login','register','mentee-register']))
  <body class="account-page">
  @endif
  @if(Route::is(['chat-mentee','chat']))
  <body class="chat-page">
  @endif
  @if(Route::is(['voice-call','video-call']))
  <body class="call-page">
  @endif
  @if(!Route::is(['login','register','forgot-password']))
@include('layout.partials.header')
@endif
@yield('content')



@if(!Route::is(['chat','chat-mentee','voice-call','video-call','login','register','forgot-password']))
@include('layout.partials.footer')
@endif
@include('layout.partials.footer-scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/shared-translations.js') }}"></script>

@yield('scripts')
  </body>
</html>
