<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! config('app.name', 'Bio Partner') !!}</title>

    <!-- Styles -->
    {!! Html::style(url('vendor/biopartnering/css/font-face.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/fontawesome-all.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/font-awesome.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/material-design-iconic-font.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/bootstrap.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/animsition.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/animate.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/hamburgers.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/slick.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/select2.min.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/perfect-scrollbar.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/toastr.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/theme.css'), ['media' => 'all']) !!}
    {!! Html::style(url('vendor/biopartnering/css/custom.css'), ['media' => 'all']) !!}
    
    @stack('style')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js dont work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!-- {!! Html::script(url('vendor/biopartnering/js/jquery-3.2.1.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/popper.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/bootstrap.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/slick.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/wow.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/animsition.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/jquery.waypoints.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/jquery.counterup.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/circle-progress.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/perfect-scrollbar.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/Chart.bundle.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/select2.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/main.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/toastr.min.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/custom.js')) !!} -->

    <!-- Scripts -->
    <script type="text/javascript">
        var base_url = "{!! url('') !!}";
        var _token = "{{ csrf_token() }}";
    </script>
</head>
<body class="animition">

@yield('main_content')

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="gndlovu_global_mdl">
    {{--global modal--}}
</div>

{!! Html::script(url('vendor/biopartnering/js/jquery-3.2.1.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/jquery.validate.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/popper.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/jquery-validate.bootstrap-tooltip.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/bootstrap.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/slick.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/wow.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/animsition.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/jquery.waypoints.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/jquery.counterup.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/circle-progress.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/perfect-scrollbar.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/Chart.bundle.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/select2.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/main.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/toastr.min.js')) !!}
{!! Html::script(url('vendor/biopartnering/js/custom.js')) !!}

@stack('scripts')

@include('biopartnering::layouts.common.loader')

@if(Session::has('flash_error'))

    <script type="text/javascript">
        notify('error', '{!! Session::get('flash_error') !!}', '', 0);
    </script>

@endif

@if(Session::has('flash_warning'))

    <script type="text/javascript">
        notify('warning', '{!! Session::get('flash_warning') !!}', '', 0);
    </script>

@endif

@if(Session::has('flash_success'))

    <script type="text/javascript">
        notify('success', '{!! Session::get('flash_success') !!}');
    </script>

@endif

@if(Session::has('flash_info'))

    <script type="text/javascript">
        notify('info', '{!! Session::get('flash_info') !!}', '', 0);
    </script>

@endif

</body>
</html>
