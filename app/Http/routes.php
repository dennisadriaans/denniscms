<?php

Route::get('language/{lang}',
    array(
        'as' => 'language.select',
        'uses' => 'LanguageController@select'
    )
);

Route::get('templates/conf/{template}', 'Cms\AdminController@getTemplConf');

/* Languages */
Route::get('set-language/{lang}', 'Cms\AdminController@setlang');

/* Backend */
Route::group(['prefix' => 'api/admin', 'middleware' => 'auth'], function()
{
    Route::post('getSpecSlot', 'Cms\AdminController@getSpec');
    Route::resource('page', 'Cms\PageController');
    //Route::post('page/{id}', 'Cms\AdminController@page');
    Route::get('shell', 'Cms\AdminController@shell');
    Route::post('slots', 'Cms\AdminController@renderSlots');
    Route::get('modules', 'Cms\AdminController@getModules');
    Route::post('items', 'Cms\AdminController@getItems');
    Route::post('templates', 'Cms\AdminController@templates');
});
Route::group(['prefix' => 'admin/edit', 'middleware' => 'auth'], function()
{
    Route::post('changetemplate', 'Cms\PageHandler@changeTemplate');
    Route::post('fillslot', 'Cms\SlotController@fillslot');
    Route::post('slot', 'Cms\AdminController@getEditSlot');
    Route::post('disconnect', 'Cms\SlotController@disconnect');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
    Route::get('/', 'Cms\AdminController@dashboard');
    Route::get('/makemenu', 'Cms\AdminController@makeMenu');
    Route::get('/{page}', 'Cms\AdminController@dashboard');

    // not shure about this one
    Route::get('/{page}/{slot}', 'Cms\AdminController@dashboard');
    Route::get('/editslot/{pid}/{sid}', 'Cms\AdminController@dashboard');
    Route::get('/edit/category/{id}/{itemId}', 'Cms\AdminController@dashboard');
});

/* Frontend */
Route::get('/', [
    'as' => 'home',
    'uses' => 'Cms\PageHandler@setHome'
]);

Route::get('/signup', [
    'uses' => 'Auth\AuthController@getSignup',
    'as' => 'auth.signup'
]);
Route::post('/signup', [
    'uses' => 'Auth\AuthController@postSignup'
]);
Route::get('/signin', [
    'uses' => 'Auth\AuthController@getSignin',
    'as' => 'auth.signin'
]);
Route::post('/signin', [
    'uses' => 'Auth\AuthController@postSignin'
]);
Route::get('/{page}', 'Cms\PageHandler@index');
Route::get('/{page}/{sub}', 'Cms\PageHandler@index');
Route::get('/{page}/{sub}/{subchild}', 'Cms\PageHandler@index');
