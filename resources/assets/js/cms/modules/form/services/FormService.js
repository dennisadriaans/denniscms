app.factory('Form', function($resource) {
    return $resource('admin/modules/form/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});