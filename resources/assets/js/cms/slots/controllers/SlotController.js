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