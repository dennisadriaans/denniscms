app.factory('Textblock', function($resource) {
    return $resource('admin/modules/textblock/:id', null, {
        'update': {
            method: 'PUT'
        }
    });
});