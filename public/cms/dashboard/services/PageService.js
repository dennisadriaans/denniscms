app.factory('Page', function($resource) {
    return $resource('api/admin/page/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});