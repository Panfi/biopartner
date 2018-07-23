@extends('biopartnering::layouts.app')

@section('main_content')
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script type="text/javascript">
    $(document).ready(function ()
    {
        // $('#theme-style').attr('href', base_url + '/vendor/biopartnering/css/db_themes/app.css');
    });
</script>
@endpush