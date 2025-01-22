

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"{{ !empty($htmlAttribute) ? $htmlAttribute : '' }}>
	{{-- {{var_dump(user_permission('add_user'))}} --}}
<head>
    @include('admin.partial.head')


</head>

<body class="{{ !empty($bodyClass) ? $bodyClass : '' }}">
    <!-- BEGIN #app -->
    <div id="app" class="app {{ !empty($appClass) ? $appClass : '' }}">
        @includeWhen(empty($appHeaderHide), 'admin.partial.header')
        @includeWhen(empty($appSidebarHide), 'admin.partial.sidebar')
        @includeWhen(!empty($appTopNav), 'partial.top-nav')

        @if (empty($appContentHide))
            <!-- BEGIN #content -->
            <div id="content" class="app-content  {{ !empty($appContentClass) ? $appContentClass : '' }}">
                @yield('content')
            </div>
            <!-- END #content -->
        @else
            @yield('content')
        @endif

        @includeWhen(!empty($appFooter), 'partial.footer')
    </div>
    <!-- END #app -->

    @yield('outter_content')
    @include('admin.partial.scroll-top-btn')
    @include('admin.partial.theme-panel')
    @include('admin.partial.scripts')
</body>

</html>
