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