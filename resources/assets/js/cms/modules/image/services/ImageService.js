app.factory('Image', function($resource) {
    return $resource('admin/modules/image/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});