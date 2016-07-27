app.controller("UploadCtrl", function($scope, $http, Image, $state, Upload, Image) {

    $scope.getImages = function () {
        Image.query({}, function(result) {
            $scope.images = result;
        });
    }
    $scope.getImages();

    $scope.upload = function (files) {
        console.log($scope.newItemTitle);
        console.log($scope.newItemTitle);
        if (files && files.length) {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                Upload.upload({
                    url: 'admin/modules/image',
                    file: file,
                    title: $scope.newItemTitle
                }).progress(function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                }).success(function (data, status, headers, config) {
                    $scope.getImages();
                });
            }
        }
    };

    $scope.removeImage = function (id) {
        Image.delete({ id: id }, function() {
            location.reload();
        });
    }
});
