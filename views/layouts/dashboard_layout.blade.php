@extends('biopartnering::layouts.app')

@section('main_content')

    <div class="page-wrapper">
        
        @include('biopartnering::layouts.common.header-mobile')

        @include('biopartnering::layouts.common.sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
           
            @include('biopartnering::layouts.common.header-desktop')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        @yield('content')

                        <!-- @include('biopartnering::layouts.common.footer') -->
                        
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

@stop

@push('style')
    <!-- {!! Html::style(url('vendor/biopartnering/css/db_custom.css')) !!}
    {!! Html::style(url('vendor/biopartnering/css/intro.css')) !!} -->
@endpush

@push('scripts')
    <!-- {!! Html::script(url('vendor/biopartnering/js/metismenu.2.0.3.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/db_custom.js')) !!}
    {!! Html::script(url('vendor/biopartnering/js/intro.js')) !!} -->
@endpush