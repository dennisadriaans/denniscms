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