@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')


@yield('content')


@include('layouts.script')
@yield('custom-script')

@include('layouts.footer')