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