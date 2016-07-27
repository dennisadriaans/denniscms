<!DOCTYPE html>
<html>
    <head>
        <title>Admin | De Stadsboerderij Harderwijk</title>

        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/foundation.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>
        <script src="{{ asset('vendor/angular/angular.js') }}"></script>
        <script src="{{ asset('vendor/angular-resource/angular-resource.js') }}"></script>
        <script src="{{ asset('vendor/angular-ui-router/release/angular-ui-router.js') }}"></script>
        <script src="{{ asset('vendor/angular-messages/angular-messages.js') }}"></script>
        <script src="{{ asset('vendor/angular-filter/dist/angular-filter.js') }}"></script>
        <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('vendor/angular-ckeditor/angular-ckeditor.js') }}"></script>
        <script src="{{ asset('vendor/angular-xeditable/dist/js/xeditable.js') }}"></script>
        <script src="{{ asset('vendor/ng-file-upload-shim/ng-file-upload.js') }}"></script>
        <script src="{{ asset('vendor/ng-file-upload/ng-file-upload.js') }}"></script>
        <script src="{{ asset('vendor/angular-aria/angular-aria.js') }}"></script>
        <script src="{{ asset('vendor/angular-animate/angular-animate.js') }}"></script>
        <script src="{{ asset('vendor/angular-material/angular-material.js') }}"></script>
        <!-- <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script> -->

        <script src="{{ asset('js/all.js') }}"></script>


        <!-- <script src="{{ asset('cms/modules/textblock/services/ckEditor.js') }}"></script> -->

        <!--  <base href="http://localhost/dacms/public/"/> -->
        <base href="http://local.denniscms.nl/"/>
        <!-- <base href="http://destadsboerderijharderwijk.nl/"/> -->

    </head>
    <body ng-app="Cms">

        <div class="cms">
            @yield('content')
        </div>
    </body>
</html>
