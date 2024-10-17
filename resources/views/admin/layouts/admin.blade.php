<!DOCTYPE html>

<html
    lang="fa"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="rtl"
    data-theme="theme-default"
    data-assets-path="/theme/vuexy/assets/"
    data-template="vertical-menu-template">

    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>
            {{env('APP_NAME')}}
        </title>
        <meta name="robots" content="noindex, nofollow" />
        @include('admin.includes.style')


    </head>



    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                @include('admin.includes.sidebar')

                <div class="layout-page">

                    @include('admin.includes.header')

                    <div class="content-wrapper">

                        <div class="container-xxl flex-grow-1 container-p-y">
                            @yield('content')
                        </div>

                        @include('admin.includes.footer')

                        <div class="content-backdrop fade"></div>
                    </div>

                </div>

            </div>



            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>


        </div>

        @include('admin.includes.script')
{{--        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>--}}
{{--        <script src="/theme/vuexy/assets/js/extended-ui-drag-and-drop.js"></script>--}}
        @yield('script')
        @foreach (['error', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <script> message('{{ Session::get($msg) }}', '{{$msg}}');</script>
            @endif
        @endforeach
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script> message('{{ $error }}', 'error', '');</script>
            @endforeach
        @endif
    </body>




</html>
