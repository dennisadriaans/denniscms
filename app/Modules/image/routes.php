<?php
Route::group(array('module'=>'Image','namespace' => 'App\Modules\image\Controllers'), function() {
    Route::group(['prefix' => 'admin/modules'], function() {
        Route::resource('image', 'ImageController');
        Route::post('image/change', 'ImageController@changeImage');
    });
});