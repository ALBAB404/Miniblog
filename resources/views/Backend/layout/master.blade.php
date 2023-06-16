@include('Backend.includes.header')

<body class="sb-nav-fixed">
    @include('Backend.includes.nav')
    <div id="layoutSidenav">
        @include('Backend.includes.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">@yield('page_title')</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">@yield('page_sub_title')</li>
                    </ol>
                    @yield('contant')
                </div>
            </main>

            @include('Backend.includes.footer')
