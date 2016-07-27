app.factory('Property', function($resource) {
    return $resource('admin/modules/property/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});