<?php

Route::group(array('module'=>'Form','namespace' => 'App\Modules\form\Controllers'), function() {
    Route::group(['prefix' => 'admin/modules'], function() {
        Route::post('form/sendform', 'SendMailController@sendMail');
    });
});