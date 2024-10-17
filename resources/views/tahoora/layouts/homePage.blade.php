<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>کلینک ناباروری طهورا</title>
    <meta name="author" content="Vecuro">
    <meta name="description" content="کلینک ناباروری طهورا">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('tahoora.includes.style')
</head>
<body class="">
<div class="preloader  ">
    <button class="vs-btn preloaderCls">غیرفعال کردن پیش بارگذاری</button>
    <div class="preloader-inner">
        <img src="/theme/tahoora/assets/img/used/full-logo.webp" style="max-width: 50%;" alt="tahoora">
        <svg width="88px" height="108px" viewBox="0 0 54 64">
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path class="beat-loader"
                      d="M0.5,38.5 L16,38.5 L19,25.5 L24.5,57.5 L31.5,7.5 L37.5,46.5 L43,38.5 L53.5,38.5" id="Path-2"
                      stroke-width="2"></path>
            </g>
        </svg>
    </div>
</div>

@include('tahoora.sections.mobileMenu')

<div class="popup-search-box d-none d-lg-block  ">
    <button class="searchClose border-theme text-theme"><i class="fal fa-times"></i></button>
    <form action="#">
        <input type="text" class="border-theme" placeholder="جستجو کنید ...">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div>

@include('tahoora.includes.header')
@include('tahoora.sections.slider')
@include('tahoora.sections.about')
@include('tahoora.sections.service')
@include('tahoora.sections.team')
@include('tahoora.sections.testimonials')
@include('tahoora.sections.blogs')
@include('tahoora.includes.footer')

<!-- Scroll To Top -->
<a href="#" class="scrollToTop scroll-bottom  style2"><i class="fas fa-arrow-alt-up"></i></a>


<!--==============================
    All Js File
============================== -->
@include('tahoora.includes.script')

</body>

</html>
