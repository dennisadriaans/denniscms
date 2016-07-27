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
                    templateUrl: 'cms/dashboard/views/dashboard.html'
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

app.factory('Page', function($resource) {
    return $resource('api/admin/page/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.controller("UploadCtrl", function($scope, $http, Image, $state, Upload, Image) {

    $scope.getImages = function () {
        Image.query({}, function(result) {
            $scope.images = result;
        });
    }
    $scope.getImages();

    $scope.upload = function (files) {
        console.log($scope.newItemTitle);
        console.log($scope.newItemTitle);
        if (files && files.length) {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                Upload.upload({
                    url: 'admin/modules/image',
                    file: file,
                    title: $scope.newItemTitle
                }).progress(function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                }).success(function (data, status, headers, config) {
                    $scope.getImages();
                });
            }
        }
    };

    $scope.removeImage = function (id) {
        Image.delete({ id: id }, function() {
            location.reload();
        });
    }
});

app.controller('NavController', function($scope, Page, $state, $stateParams, $http) {


    $scope.selectedLanguage = window.localStorage['lang'];

    $http.get('api/admin/shell').success(function(shell) {
        $scope.menus = shell;
    });

    $scope.showAddPage = function() {
        $scope.addpage = true;

        Page.query().$promise.then(function (menus) {
            $scope.languages = menus;
        });
    }

    $scope.createPage = function() {
        Page.save($scope.page, function(result) {
            console.log(result);
        });
    }

    $scope.changeLang = function () {
        window.localStorage['lang'] = $scope.selectedLanguage;
    }


});
app.controller('SlotController', function($scope, $state, Slots, $http, $timeout, Messages, Page, $location) {

    $scope.page = $state.params.page;
    $scope.pageId = $state.params.page;

    $scope.$on('$locationChangeStart', function(event) {
        $scope.page = $state.params.page;
        $scope.getPage();
    });

    $scope.$on('get-slots', function() {
        $scope.getSlots($scope.page);
    });

    $scope.getPage = function () {
        Page.get({id: $scope.page})
            .$promise.then(function (result) {
                $scope.getSlots(result.template.name)
        });
    }

    $scope.getSlots = function (template) {
        $http.get('templates/conf/' + template).success(function(config) {
            $scope.rows = config.backend;
        });
        if($scope.page) {
            $http.post('api/admin/slots', {'pageId': $scope.page}).success(function(result) {
                $scope.slots = result;
            })
        }
    }

    $scope.getSlots('homepage');

    $http.post('api/admin/templates', $scope.page)
        .success(function(result) {
            $scope.pageTemplates = result;
        });

    $scope.selectTemplateOpen = false;

    $scope.openSelectTemplate = function() {
        $scope.selectTemplateOpen = true;
    }

    $scope.selectTemplate = function(pageId, template) {
        $http.post('admin/edit/changetemplate', {
            pageId: pageId,
            templateId: template.id
        }).success(function(data) {
            console.log('template changed');
        });
    };

    $scope.getSlot = function (row, col, pageId) {

        var self = this;
        var page = $state.params.page;

        data = {
            pageId: pageId,
            row: row,
            col: col
        };

        $http.post('api/admin/getSpecSlot', data).success(function(result) {
            self.slot = result;
            return self.slot;
        });
    }

    $scope.disconnect = function (id) {
        $http.post('admin/edit/disconnect', {id: id}).success(function(result) {
            $state.reload();
        });
    }


});
app.controller("FillSlotCtrl", function($rootScope, $scope, $http, $state, $stateParams, Slots, Modules) {

    $http.post('api/admin/items', {module: $scope.selectedModule}).success(function(data) {
        $scope.items = data;
    });

    $scope.selectItem = function () {
        this.selectExisting();
    };

    $scope.selectExisting = function () {
        $http.post('admin/edit/fillslot', {
            pageId: $state.params.pageId,
            slotId: $state.params.slotId,
            selectedId: $scope.item.id,
            module: $scope.selectedModuleId
        }).success(function(data) {
            $state.go('dashboard.slots', {page: $state.params.pageId});
        })
    }

    $scope.save = function () {

        $http.post('admin/edit/fillslot', {
            slotId: $state.params.slotId,
            module: $scope.selectedModule,
            moduleId: $scope.selectedModuleId,
            title: $scope.nItem.title
        }).success(function(data) {
            $state.go('dashboard.slots', {page: $state.params.pageId});
        });

    }
});
app.controller("EditSlotCtrl", function($rootScope, $scope, $http, $state, Slots) {

    var slotId = $state.params.slotId;

    $scope.$on('refresh-current', function() {
        $scope.editSlot();
    });

    $scope.editSlot = function () {
        $http.post('admin/edit/slot', {id: slotId}).success(function(result) {
            $scope.slot = result;
        });
    }

    function returSTuf () {
        return 'belangrijke functie.'
    }

    $scope.editSlot();

    //get slot info

    // pageslots whre id = id   with moduleslot

});
app.factory('Slots', function($resource) {
    return $resource('api/admin/slots/:pageid', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.controller("ModuleListCtrl", function($rootScope, $scope, $http, Modules) {

    $scope.selectModule = function (module) {
        $rootScope.selectedModule = module.name;
        $rootScope.selectedModuleId = module.id;
    }

    Modules.query({}, function(data) {
        $scope.modules = data;
        console.log($scope.modules);
    });

});
app.factory('Modules', function($resource) {
    return $resource('api/admin/modules/:moduleid', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.controller("TextblockCtrl", function($rootScope, $scope, $http, $state, Textblock, $location) {

    var editor = CKEDITOR.replace( 'editor1', {
        removePlugins: 'forms, flash, smiley, find, wsc, about, specialchar, colordialog',
        //resize_dir : 'both'
    });
    editor.on( 'instanceReady', function( evt ) {
        evt.editor.insertText();//you can use variable here or server-side tag that will evaluate to string on page load.
    });

    $scope.textblock = $scope.slot.item;

    $scope.updateTextblock = function (id, module) {
        Textblock.update({id: id}, {
            data : {
                title: $scope.textblock.title,
                content: CKEDITOR.instances.editor1.getData(),
            },
            module: $scope.slot.module.name
        }).$promise.then(function (result) {
                $state.go('dashboard.slots', {page: $state.params.pageId});
            });
    }

    $scope.selectTemplate = function (moduleSlotId, template) {
        $http.post('admin/modules/textblock/template', {
            moduleSlotId: moduleSlotId,
            template: template.title
        }).success(function(result) {
            $state.go('dashboard.slots', {page: $state.params.pageId});
        });
    }

    $scope.goback = function () {
        console.log($state.params);
        window.location = "/admin/" + $state.params.pageId;
    }

});
app.factory('Textblock', function($resource) {
    return $resource('admin/modules/textblock/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});

app.controller("ImageCtrl", function($rootScope, $scope, $http, $state, Image) {

    $scope.image = $scope.slot.item;

    $scope.getImages = function () {
        Image.query({}, function(result) {
            $scope.images = result;
        });
    }

    $scope.getImages();

    $scope.$on('get-images', function() {
        $scope.getImages();
    });

    $scope.updateImage = function (item, moduleSlotId) {

        $http.post('admin/modules/image/change', {
            item: item,
            moduleSlotId: moduleSlotId
        }).success(function() {
            $state.go('dashboard.slots', {page: $state.params.pageId});
        })

    }

    $scope.selectTemplate = function (moduleSlotId, template) {
        $http.post('admin/modules/textblock/template', {
            moduleSlotId: moduleSlotId,
            template: template.title
        }).success(function(result) {
            $state.go('dashboard.slots', {page: $state.params.pageId});
        });
    }

    $scope.goback = function () {
        window.location = "/admin/" + $state.params.pageId;
    }
});
app.factory('Image', function($resource) {
    return $resource('admin/modules/image/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.controller("CategoryCtrl", function($rootScope, $scope, $http, $state, $location, Category, Item, Messages) {

    $scope.addItem = function (categoryId, itemTemplate) {
        Item.save({}, {
            title: $scope.newItem.title,
            category_id: categoryId,
            module: 'Item',
            itemTemplate: itemTemplate
        }).$promise.then(function (result) {
                $scope.$emit('refresh-current');
            }
        );
    }

    $scope.selectItem = function (item) {
        $scope.currentItem = item;
    }

    $scope.showPropertyCreator = function (item) {
        $state.go('editCategory', {id: item.category_id, itemId: item.id});
    }

    $scope.updateProperty = function (currentItem) {
        console.log(currentItem);
        $http.post('admin/modules/category/updateProp', $scope.currentItem)
            .success(function(result) {
                $scope.message = Messages.save();
                setTimeout(function () {
                    console.log(result);
                    console.log(result);
                }, 300);
            });
    }

    /* Ckeditor options */
    $scope.options = {
        language: 'en',
        allowedContent: true,
        entities: false,
        toolbar: 'full',
        toolbar_full: [
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
            { name: 'tools', items: [ 'Maximize' ] },
            { name: 'document', items: [ 'Source' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ] },
        ]
    };

    $scope.selectTemplate = function (template) {

        $http.post('admin/modules/category/template', {
            pageId: $state.params.pageId,
            template: template.title
        }).success(function(result) {
            console.log(result);
            console.log(result);
            console.log(result);
            console.log(result);
            $state.go('dashboard.slots', {page: $state.params.pageId});
        });
    }

});
app.factory('Category', function($resource) {
    return $resource('admin/modules/category/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.controller("PropertyCtrl", function($rootScope, $scope, $http, $state, Property) {

    $scope.types = [
        {label: "checkbox"},
        {label: "text"},
        {label: "textarea"},
        {label: "radio"},
        {label: "image"},
    ];

    $scope.getProps = function () {
        var categoryId = $state.params.id;
        var itemId = $state.params.itemId;

        $http.get('admin/modules/category/'+ categoryId +'/'+ itemId +'/properties')
            .success(function(result) {
                $scope.props = result;
            })
    }

    $scope.getProps();

    $scope.addProperty = function (property) {

        if(!$scope.props) {
            $scope.props = [];
        }

        $http.post('admin/modules/category/addProperty', {
            label: property.label.replace(/\s+/g, ''),
            type: property.type.label,
            category_id: $state.params.id
        }).success(function(result) {
            $scope.propertyCreator = false;
        });

        $scope.props.label = $scope.props.push({
            label: property.label,
            type: property.type.label
        });

    }

    $scope.deleteProp = function (prop, idx) {
        Property.delete({ id: prop.id }, function() {
            $scope.props.splice(idx, 1);
        });
    }


});
app.factory('Property', function($resource) {
    return $resource('admin/modules/property/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.factory('Messages', function($resource) {

    function animate() {
        $('.message').css('display', 'block');

        setTimeout(function(){
            $('.message').css('display', 'none');
        }, 2000);
    }

    return {
        save: function() {
            animate();
            return 'Opslaan...';
        }
    };
});

app.controller("ItemCtrl", function($rootScope, $scope, $http, Item, Image, Messages) {

    $scope.editItem = function () {
        Item.save($newItem);
    }

    Image.query({}, function(result) {
        $scope.images = result;
    });

    $scope.deleteItem = function (currentItem, index) {
        var shure = confirm("Are u sure u want to delete this item?");

        if (shure) {
            Item.delete({ id: currentItem.id }, function() {
                location.reload();
            });
        }
    }
});
app.factory('Item', function($resource) {
    return $resource('admin/modules/items/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});
app.controller("FormCtrl", function($rootScope, $scope, $http, $state, $location, Form) {

    //get form + form items


    //add form   label  type   slot itemId
    //delete form

    Form.get({id: $scope.slot.item.id}, {})
        .$promise.then(function(result) {
            $scope.form = result;
    });


    $scope.updateForm = function (id) {

        Form.update({id: id}, {
            fields: $scope.fields,
            module: $scope.slot.module.name
        }).$promise.then(function (result) {
                angular.forEach(result, function(value, key) {
                    $scope.form.fields.push(value);
                });
        });
    }

    $scope.submitContactForm = function () {

        if(!$scope.cntct.empty) {
            $scope.loading = true;
            $http.post('admin/modules/form/sendContactForm', $scope.cntct)
                .success(function(data) {
                    console.log(data);
                    console.log(data);
                    $scope.loading = false;
                })
        } else {
            alert('Er is iets mis gegaan.');
        }
    }

});
app.factory('Form', function($resource) {
    return $resource('admin/modules/form/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});
//# sourceMappingURL=all.js.map
