<?php

Route::group(array('module'=>'Category','namespace' => 'App\Modules\category\Controllers'), function() {
    Route::group(['prefix' => 'admin/modules'], function() {
        Route::post('category/updateProp', 'CategoryController@updateProperty');
        Route::resource('category', 'CategoryController');
        Route::resource('property', 'PropertyController');
        Route::resource('comments', 'CommentController');
        Route::resource('items', 'ItemController');
        Route::post('category/addProperty', 'CategoryController@addProperty');
        Route::get('category/{id}/{itemId}/properties', 'CategoryController@getProperties');
    });
});
