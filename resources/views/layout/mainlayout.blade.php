<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
  <head>
    @include('layout.partials.head')
  </head>

  <body>
  <?php $segment=Request::segment(2); ?>
  @if(($segment != "login") && ($segment != "form_email"))
                                          
        @include('layout.partials.nav')

        @include('layout.partials.header')
   

  @endif
 @yield('content')

 @include('layout.partials.footer-scripts')
 @stack('footer')
@yield('script')
  </body>
</html>   