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