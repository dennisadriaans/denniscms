app.factory('Item', function($resource) {
    return $resource('admin/modules/items/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});