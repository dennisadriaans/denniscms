app.controller("EditSlotCtrl", function($rootScope, $scope, $http, $state, Slots) {

    var slotId = $state.params.slotId;

    $scope.$on('refresh-current', function() {
        $scope.editSlot();
    });

    $scope.editSlot = function () {
        $http.post('admin/edit/slot', {id: slotId}).success(function(result) {
            $scope.slot = result;
        });
    }

    function returSTuf () {
        return 'belangrijke functie.'
    }

    $scope.editSlot();

    //get slot info

    // pageslots whre id = id   with moduleslot

});