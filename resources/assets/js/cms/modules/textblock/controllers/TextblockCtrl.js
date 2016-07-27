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