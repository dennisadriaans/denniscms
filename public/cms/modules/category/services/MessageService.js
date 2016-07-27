app.factory('Messages', function($resource) {

    function animate() {
        $('.message').css('display', 'block');

        setTimeout(function(){
            $('.message').css('display', 'none');
        }, 2000);
    }

    return {
        save: function() {
            animate();
            return 'Opslaan...';
        }
    };
});
