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