<meta charset="utf-8" />
<title>Studio | @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="@yield('metaDescription')" />
<meta name="author" content="@yield('metaAuthor')" />
<meta name="keywords" content="@yield('metaKeywords')" />
<meta name="csrf-token" content="{{ csrf_token() }}">


@stack('metaTag')
<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }


</style>

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="/admin/assets/css/vendor.min.css" rel="stylesheet" />
<link href="/admin/assets/css/app.min.css" rel="stylesheet" />
<!-- ================== END BASE CSS STYLE ================== -->

@stack('css')
