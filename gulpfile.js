var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.copy('vendor/foundation/scss', 'resources/assets/sass/foundation');
});

elixir(function(mix) {
    mix.sass([
        'app.scss',
    ], 'public/css/foundation.css', { indentedSyntax: true })
});

elixir(function(mix) {
    mix.scripts([
        '/cms/app.js',
        '/cms/dashboard/services/PageService.js',
        '/cms/mediamanager/controllers/UploadCtrl.js',
        '/cms/dashboard/controllers/NavController.js',
        '/cms/slots/controllers/SlotController.js',
        '/cms/slots/controllers/FillSlotCtrl.js',
        '/cms/slots/controllers/EditSlotCtrl.js',
        '/cms/slots/services/SlotService.js',
        '/cms/modules/ModuleListCtrl.js',
        '/cms/modules/ModuleService.js',
        '/cms/modules/textblock/controllers/TextblockCtrl.js',
        '/cms/modules/textblock/services/TextblockService.js',
        '/cms/modules/image/controllers/ImageCtrl.js',
        '/cms/modules/image/services/ImageService.js',
        '/cms/modules/category/controllers/CategoryCtrl.js',
        '/cms/modules/category/services/CategoryService.js',
        '/cms/modules/category/controllers/PropertyCtrl.js',
        '/cms/modules/category/services/PropertyService.js',
        '/cms/modules/category/services/MessageService.js',
        '/cms/modules/category/controllers/ItemCtrl.js',
        '/cms/modules/category/services/ItemService.js',
        '/cms/modules/form/controllers/FormCtrl.js',
        '/cms/modules/form/services/FormService.js',
    ], 'public/js/all.js');
});


elixir(function(mix) {
    mix.sass([
        'all.sass',
    ], 'public/css/all.css', { indentedSyntax: true })
});

