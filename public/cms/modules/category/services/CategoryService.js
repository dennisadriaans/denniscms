app.factory('Category', function($resource) {
    return $resource('admin/modules/category/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});