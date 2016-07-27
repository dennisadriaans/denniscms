app.factory('Modules', function($resource) {
    return $resource('api/admin/modules/:moduleid', null, {
        'update': {
            method: 'PUT'
        }
    });
});