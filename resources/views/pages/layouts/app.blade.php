<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('css/jqvmap.min.css') }}" media="none" onload="if(media!='all')media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('css/jqvmap.min.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}" media="none" onload="if(media!='all')media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" media="none" onload="if(media!='all')media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"></noscript>
    
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" media="none" onload="if(media!='all')media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}"></noscript>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css')}}">

    @yield('style' ?? '')

</head>
<body>
    <div id="app">
        <div class="main-wrapper">

          {{-- include navbar --}}
          @include('pages.partials.navbar')

          {{-- include sidebar --}}
          @include('pages.partials.sidebar')
    
          <!-- Main Content -->
          <div class="main-content">
            <section class="section">              

              {{-- insert content --}}
              @yield('content')

            </section>
          </div>
          
          {{-- include footer --}}
          @include('pages.partials.footer')
          
        </div>
      </div>

    <script async src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    {{-- JS Libraries --}}
    <script async src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script async src="{{ asset('js/Chart.min.js') }}"></script>
    <script async src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script async src="{{ asset('js/summernote-bs4.js') }}"></script>
    <script async src="{{ asset('js/jquery.chocolat.min.js') }}"></script>

    <script async src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script async src="{{ asset('js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script async src="{{ asset('js/scripts.js') }}"></script>
    <script async src="{{ asset('js/custom.js') }}"></script>

    {{-- Include scripts --}}
    @yield('script' ?? '')
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    var lazyloadImages = document.querySelectorAll("img.lazy");    
    var lazyloadThrottleTimeout;

    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }    

      lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
          if(img.offsetTop < (window.innerHeight + scrollTop)) {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
          }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
      }, 20);
    }

    document.addEventListener("scroll", lazyload);
    window.addEventListener("resize", lazyload);
    window.addEventListener("orientationChange", lazyload);
  });
</script>
</body>
</html>
