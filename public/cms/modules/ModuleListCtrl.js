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