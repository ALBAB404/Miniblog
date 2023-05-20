<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.includes.head')
</head>

<body>
    @include('frontend.includes.nav')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    @yield('banner')
    <!-- Banner Ends Here -->
    <section class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('frontend.includes.rightsidebar')
            </div>
        </div>
    </section>


    @include('frontend.includes.footer')

</body>

</html>
