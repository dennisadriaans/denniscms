<?php

Route::group(array('module'=>'Textblock','namespace' => 'App\Modules\textblock\Controllers'), function() {
    Route::group(['prefix' => 'admin/modules'], function() {
        Route::resource('textblock', 'TextblockController');
        Route::post('textblock/{templateid}', 'TextblockController@getTemplate');
    });
});