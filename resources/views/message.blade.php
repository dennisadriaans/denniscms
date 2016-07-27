<!DOCTYPE html>
<html class=" ">
    <head>
        <title>B&B | Stadsboerderij Harderwijk</title>
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

    </head>
    <body>

        <div class="sub-top">
            <div class="row">
                <div class="left flags">
                    <a href="http://destadsboerderijharderwijk.nl/" target="blank"><img src="/img/nl.png" alt="" width="25"/></a>
                    <a href="http://de.bnbveluwe.eu" target="blank"><img class="de" src="/img/de.png" alt="" width="25"/></a>
                </div>
                <ul class="right inline-list">
                    <li>Weiburglaan 9</li>
                    <li>3844 KZ Harderwijk</li>
                </ul>
            </div>
        </div>

        <div class="contain-to-grid sticky">
            <nav class="top-bar" data-topbar role="navigation">
              <ul class="title-area">
                <li class="name">
                  <h1><a href="#"><img src="/img/logo.png" width="200px" alt=""/></a></h1>
                </li>
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
              </ul>

              <section class="top-bar-section">
                <ul class="right">

                </ul>
              </section>
            </nav>
        </div>

        <div class="row show-for-small-only">
            <div class="page-title small-12 column">
            </div>
        </div>

        <div class="row hide-for-small-only">
            <ul class="breadcrumbs">
                <li><a href=""><img src="/img/direcion.png" width="18px" class="icon" alt=""/></a></li>
                <li><a href="#">home</a></li>
            </ul>
            <div class="rating right">
                <a target="_blank" href="https://www.bedandbreakfast.nl/bed-and-breakfast-nl/harderwijk/de-stadsboerderij-harderwijk/64536/">Bekijk op bedandbreakfast.nl »</a>
            </div>
        </div>

        <div class="container small-12 column">
            <div class="content">

                <div class="row">
                    <h3>@if(isset($message)) {{ $message }} @endif</h3>
                    <label><a href="/reacties">Klik hier om terug te gaan</a></label>
                </div>

            </div>
        </div>


        <script>
            $(document).foundation();
        </script>
    </body>
</html>
