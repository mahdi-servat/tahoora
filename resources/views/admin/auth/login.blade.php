<!DOCTYPE html>

<html
    lang="fa"
    class="light-style customizer-hide"
    dir="rtl"
    data-theme="theme-default"
    data-assets-path="/theme/vuexy/assets/"
    data-template="vertical-menu-template">
<head>
    <meta name="robots" content="noindex, nofollow" />

    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        ورود
        -
        {{env('APP_NAME')}}
    </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/theme/vuexy/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/theme/vuexy/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/theme/vuexy/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="/theme/vuexy/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/theme/vuexy/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/theme/vuexy/assets/js/config.js"></script>
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4 mt-2">
                            <span class="app-brand-text demo text-body fw-bold ms-1">
                        <img src="/full-logo.webp">
                            </span>
                    </div>
                    <!-- /Logo -->
                    <form id="formAuthentication" class="mb-3" action="{{route('login.post')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">پست الکترونیک</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="پست الکترونیک خود را وارد کنید"
                                autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">رمزعبور</label>

                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
{{--                        <div class="mb-3">--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="checkbox" id="remember-me" />--}}
{{--                                <label class="form-check-label" for="remember-me"> مرا به خاطر بسپار </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="/theme/vuexy/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/theme/vuexy/assets/vendor/libs/popper/popper.js"></script>
<script src="/theme/vuexy/assets/vendor/js/bootstrap.js"></script>
<script src="/theme/vuexy/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="/theme/vuexy/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/theme/vuexy/assets/vendor/libs/hammer/hammer.js"></script>
<script src="/theme/vuexy/assets/vendor/libs/i18n/i18n.js"></script>
<script src="/theme/vuexy/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="/theme/vuexy/assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="/theme/vuexy/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
{{--<script src="/theme/vuexy/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>--}}
{{--<script src="/theme/vuexy/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>--}}

<!-- Main JS -->
<script src="/theme/vuexy/assets/js/main.js"></script>

<!-- Page JS -->
<script src="/theme/vuexy/assets/js/pages-auth.js"></script>
</body>
</html>
