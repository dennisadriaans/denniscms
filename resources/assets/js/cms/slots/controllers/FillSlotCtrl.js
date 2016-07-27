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