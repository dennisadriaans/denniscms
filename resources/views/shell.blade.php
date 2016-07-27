<!DOCTYPE html>
<html class="{{$pageInfo->title}}">
    <head itemscope itemtype="http://schema.org/WebSite">
        <title itemprop='name'>De Stadsboerderij Harderwijk | Bed en Breakfast {{$pageInfo->title}}</title>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script src="{{ asset('vendor/foundation/js/foundation.js') }}"></script>
        <script src="{{ asset('vendor/foundation/js/foundation/foundation.topbar.js') }}"></script>

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

        <link href="{{ asset('css/foundation.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

        <meta name="theme-color" content="#999999">

        <meta charset="UTF-8">
        <meta name="description" content="Het bed and breakfast adres in Harderwijk. Welkom bij de Stadsboerderij Harderwijk.">
        <meta name="keywords" content="Bed and Breakfast. Benb, B&b, B&B Harderwijk, Bed Breakfast, Harderwijk, De stadsboerderij, De Stadsboerderij Harderwijk">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <link rel="canonical" href="http://bedandbreakfastharderwijk.com/" itemprop="url">

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-43076888-6', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body>

        <div class="sub-top">
            <div class="row">
                <div class="left flags">
                    <a href="/set-language/nl"><img class="nl" src="/img/nl.png" title="Bed And Breakfast Harderwijk Nederlands" alt="Bed and breakfast Harderwijk" width="25"/></a>
                    <a href="/set-language/en"><img class="en" src="/img/en.png" title="Bed And Breakfast Harderwijk English" alt="Bed and breakfast Harderwijk" width="25"/></a>
                    <a href="/set-language/de"><img class="de" src="/img/de.png" title="Bed And Breakfast Harderwijk German" alt="Bed and breakfast Harderwijk" width="25"/></a>
                </div>
                <ul class="right inline-list address" itemscope itemtype="http://schema.org/LocalBusiness">
                    <li itemprop="streetAddress">Weiburglaan 9</li>
                    <li itemprop="postalCode">3844 KZ <span itemprop="addressLocality">Harderwijk</span></li>
                </ul>
            </div>
        </div>

        <div class="contain-to-grid sticky">
            <nav class="top-bar" data-topbar role="navigation">
              <ul class="title-area">
                <li class="name">
                  <h1><a href="/"><img src="/img/logo.png" width="200px" alt="Logo bedandbreakfastharderwijk.com"/></a></h1>
                </li>
                <li class="toggle-topbar menu-icon"><a href="#"><span>{{ trans('variables.menu') }}</span></a></li>
              </ul>


              <section class="top-bar-section">
                <ul class="right menu">
                    @foreach ($menu as $page)
                        <li class="menu-item @if($page->title == 'Nieuws') hide @endif"  @if($pageInfo->title == $page->title) class="active" @endif>
                            <a href="/{{$page->title}}">{{$page->title}}</a>
                        </li>
                    @endforeach
                </ul>
              </section>
            </nav>
        </div>

        <div class="row show-for-small-only">
            <div class="page-title small-12 column">
            <h2 class="page-title">{{$pageInfo->title}}</h2>
            </div>
        </div>

        <div class="row hide-for-small-only">
            <ul class="breadcrumbs">
                <li><a href=""><img src="/img/direcion.png" width="18px" class="icon" alt="location bedandbreakfastharderwijk.com"/></a></li>
                <li><a href="#">home</a></li>
                @if($pageInfo->title != 'home')
                    <li><a href="#"> {{ $pageInfo->title }}</a></li>
                 @endif
            </ul>
            <div class="rating right">
                <a target="_blank" href="https://www.bedandbreakfast.nl/bed-and-breakfast-nl/harderwijk/de-stadsboerderij-harderwijk/64536/">{{ trans('variables.Bekijk op bedandbreakfast.nl') }} »</a>
            </div>
        </div>

        <div class="container small-12 column">
            <div class="content">

                @yield('content')

            </div>
        </div>

        @include('templates.shell.footer')

        <script>
            $(document).foundation();
        </script>
    </body>
</html>
