<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.header')
    <body class="">

     @include('includes.navbar')
    
        <!-- Page Content -->
        <main id="main">
     <!-- Content-->
       <section class="container-fluid">
             @yield('content')

             @include('includes.footer')
        </section>
    
        </main>
        <!-- /Page Content -->
    
        <!-- Page Aside-->

        @include('includes.sidebar')
       
    
        <!-- Theme JS -->
        <!-- Vendor JS -->
        <script src="{{asset('assets/js/vendor.bundle.js')}}"></script>
        
        <!-- Theme JS -->
        <script src="{{asset('assets/js/theme.bundle.js')}}"></script>
        <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/sweetalert.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/jquery.datatables.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/croppie/croppie.js')}}" type="text/javascript"></script>

        
    </body>
</html>
