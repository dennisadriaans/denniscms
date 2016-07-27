<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="{{ asset('css/all.css') }}" rel="stylesheet">

        <script src="{{ asset('vendor/angular/angular.js') }}"></script>
        <script src="{{ asset('vendor/angular-resource/angular-resource.js') }}"></script>
        <script src="{{ asset('vendor/angular-ui-router/release/angular-ui-router.js') }}"></script>
        <script src="{{ asset('vendor/angular-filter/dist/angular-filter.js') }}"></script>

        <script src="{{ asset('cms/app.js') }}"></script>
        <script src="{{ asset('cms/dashboard/services/PageService.js') }}"></script>
        <script src="{{ asset('cms/dashboard/services/SlotService.js') }}"></script>
        <script src="{{ asset('cms/dashboard/controllers/NavController.js') }}"></script>
        <script src="{{ asset('cms/dashboard/controllers/SlotController.js') }}"></script>

        <script src="{{ asset('cms/fillslot/controllers/ModuleListCtrl.js') }}"></script>
        <script src="{{ asset('cms/fillslot/controllers/FillSlotCtrl.js') }}"></script>

        <base href="http://localhost/dacms/public/"/>

    </head>
    <body ng-app="Cms">
    <div class="contain-to-grid sticky">
      <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
        ...
      </nav>
    </div>

    <style>
        .test {
            background: #f00;
            border: 1px solid #000;
        }
    </style>

    <div class="row">
        {!! $template[0] !!}
        {!! $template[1] !!}
        {!! $template[2] !!}
        {!! $template[3] !!}
        {!! $template[4] !!}
        {!! $template[5] !!}
        {!! $template[6] !!}
    </div>


    </body>
</html>
