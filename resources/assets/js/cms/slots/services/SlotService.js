app.factory('Slots', function($resource) {
    return $resource('api/admin/slots/:pageid', null, {
        'update': {
            method: 'PUT'
        }
    });
});