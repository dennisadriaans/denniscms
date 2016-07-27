var app = angular.module('Cms', [
    'ui.router',
    'ngResource',
    'angular.filter',
    'ngMessages',
    'xeditable',
    'ckeditor',
    'ngFileUpload',
    'ngMaterial'
]);

app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.config(['$locationProvider', function($locationProvider){
    $locationProvider.html5Mode(true);
}]);

app.config(function($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise('/admin');
    $stateProvider

        .state('mediamanager', {
            url: '/admin/mediamanager',
            views: {
                '': {
                    templateUrl: '/cms/mediamanager/views/mediamanager.html',
                    controller: 'UploadCtrl'
                }
            }
        })

        .state('dashboard', {
            url: '/admin',
            views: {
                '': {
                    templateUrl: '/cms/dashboard/views/dashboard.html'
                },

                'nav@dashboard': {
                    templateUrl: '/cms/dashboard/views/navigation.html',
                    controller: 'NavController'
                },

                'slots@dashboard': {
                    templateUrl: '/cms/slots/views/slot-list.html',
                    controller: 'SlotController'
                }
            }
        })

        .state('editSlot', {

            url: '/admin/editslot/:pageId/:slotId',
            views: {
                '': {
                    templateUrl: '/cms/slots/views/editslot-wrapper.html'
                },

                'nav@editSlot': {
                    templateUrl: '/cms/dashboard/views/navigation.html',
                    controller: 'NavController'
                },

                'edit@editSlot': {
                    templateUrl: '/cms/slots/views/editslot.html',
                    controller: 'EditSlotCtrl'
                }
            }
        })

        .state('fillslot', {
            url: '/admin/fillslot/:pageId/:slotId',
            views: {
                '': {
                    templateUrl: '/cms/slots/views/fillslot.html',
                    controller: 'ModuleListCtrl'
                }
            }
        })

        .state('dashboard.slots', {
            url: '/:page'
        })

        .state('editCategory', {
            url: '/admin/edit/category/:id/:itemId',
            views: {
                '': {
                    templateUrl: '/cms/modules/category/views/edit-properties.html',
                    controller: 'PropertyCtrl'
                }
            }
        })
});
