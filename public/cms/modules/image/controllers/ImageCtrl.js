
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