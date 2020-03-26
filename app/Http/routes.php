<?php

if( env('APP_ENV') == 'local' ) {
    Route::get          ('/__api__', 'ApiManagerController@index');  /* TEMP */
    Route::get          ('/__api__/{id}', 'ApiManagerController@show');
        Route::get      ('/__api__/{id}/fetch', 'ApiManagerController@fetch');
}
else
    Route::group(['domain' => 'api.agileapis.ideoplayground.com'], function () {
        Route::get      ('/', 'ApiManagerController@index');  /* TEMP */
        Route::get      ('/{id}', 'ApiManagerController@show');
        Route::get      ('/{id}/fetch', 'ApiManagerController@fetch');
    });

// if( env('APP_ENV') == 'local' ) {
//     Route::group(['middleware' => 'web'], function () {
//         Route::get	('/forum', 'ForumController@index')->name('static_forum.index');
//         Route::get      ('/forum/feature', 'ForumController@feature')->name('static_forum.feature');
//         Route::get      ('/forum/support', 'ForumController@support')->name('static_forum.support');
//         Route::get      ('/forum/request', 'ForumController@request')->name('static_forum.request');
//     });
//
//     Route::group(['middleware' => ['web', 'auth']], function () {
//         Route::get      ('/forum/create', 'ForumController@create')->name('forum.create');
//         Route::post     ('/forum/store', 'ForumController@store')->name('forum.store');
//         Route::get      ('/forum/{section}/{id}', 'ForumController@show')->name('forum.show');
//         Route::get      ('/forum/comment/{section}/{id}', 'ForumController@comment')->name('forum.comment');
//         Route::post     ('/forum/comment/store', 'ForumController@commentStore')->name('forum.commentStore');
//     });
// }
// else {
//     Route::group(['domain' => 'forum.agileapis.ideoplayground.com', 'middleware' => 'web'], function () {
//         Route::get	('/', 'ForumController@index')->name('static_forum.index');
//         Route::get      ('/features', 'ForumController@feature')->name('static_forum.feature');
//         Route::get      ('/support', 'ForumController@support')->name('static_forum.support');
//         Route::get      ('/request', 'ForumController@request')->name('static_forum.request');
//     });
//
//     Route::group(['domain' => 'forum.agileapis.ideoplayground.com', 'middleware' => ['web', 'auth']], function () {
//         Route::get      ('/create', 'ForumController@create')->name('forum.create');
//         Route::post     ('/store', 'ForumController@store')->name('forum.store');
//         Route::get      ('/{section}/{id}', 'ForumController@show')->name('forum.show');
//         Route::get      ('/comment/{section}/{id}', 'ForumController@comment')->name('forum.comment');
//         Route::post     ('/comment/store', 'ForumController@commentStore')->name('forum.commentStore');
//     });
// }

/**
 * Static pages
 **/
Route::group([/*'domain' => 'agileapis.ideoplayground.com',*/ 'middleware' => 'web'], function() {
    Route::get          ('/', 'StaticPagesController@index')->name('static_welcome');
//    Route::get          ('/post', 'StaticPagesController@indexPost' );
    Route::get          ('/service', function () { return view('service'); })->name('static_service');
    Route::get          ('/patners', function () { return view('patners'); })->name('static_patners');
    Route::get          ('/docs', function () { return view('docs'); })->name('static_docs');
    Route::get          ('/news', 'StaticPagesController@indexNews')->name('static_newsIndex');
    Route::get          ('/news/create', 'StaticPagesController@createNews')->name('static_newsCreate');
    Route::post         ('/news/store', 'StaticPagesController@storeNews')->name('static_newsStore');
    Route::get          ('/pricing', 'StaticPagesController@indexPricing')->name('static_pricing');
    Route::get          ('/aboutUs', function () { return view('aboutUs'); })->name('static_aboutUs');
    Route::get          ('/documentation', function () { return view('documentation'); })->name('static_documentation');
    Route::post         ('/contactUs', 'StaticPagesController@contactUs')->name('contactUs');
});

Route::group([/*'domain' => 'agileapis.ideoplayground.com',*/ 'middleware' => [ 'web', 'auth' ]], function() {
    /**
     * User section
     **/
    Route::get          ('dashboard', 'UserController@index')->name('dashboard');
    Route::get          ('account', 'UserController@account')->name('account');

    /**
     * APIs
     **/
    Route::get          ('api/v1/notifications', 'UserController@notifications')->name('notifications');
    Route::get          ('api/v1/statistics/{id}', 'ApiController@statisticsAPI')->name('statistics');

    /**
     * service APIs
     */
    Route::group( ['middleware' => 'checkout'], function() {
        Route::get          ('api/create/init', 'ApiController@createInit')->name('api.createInit');                    //  step 1
        Route::post         ('api/create/filter', 'ApiController@createHubFilter')->name('api.createHubFilter');        //  step 2
        Route::post         ('api/create/content', 'ApiController@createEdgeContent')->name('api.createEdgeContent');   //  step 2.1
        Route::post         ('api/create/partial', 'ApiController@createPartial')->name('api.createPartial');           //  step 2.1.1
        Route::get          ('api/create/settings', 'ApiController@createSettings')->name('api.createSettingsGET');     //  step 3
        Route::post         ('api/create/settings', 'ApiController@createSettings')->name('api.createSettingsPOST');    //  step 3 (redirect)
        Route::post         ('api/create/review', 'ApiController@createReview')->name('api.review');                    //  step 4
        Route::post         ('api/checkout', 'PayPalController@index')->name('api.checkout.index');
    });
    Route::get          ('api/checkout/done', 'PayPalController@done')->name('api.checkout.done');
    Route::get          ('api/checkout/cancel', 'PayPalController@cancel')->name('api.checkout.cancel');
    Route::get          ('api/checkout/error', 'PayPalController@error')->name('api.checkout.error');
    Route::post         ('api/store', 'PayPalController@storeByAdmin')->name('api.storeByAdmin');

//    Route::get          ('api/show', 'ApiController@show')->name('api.show');
    Route::get          ('api/show/{id}', 'ApiController@showElement')->name('api.showApi');
    Route::get          ('api/refresh/{id}', 'ApiController@refresh')->name('api.refresh');
    Route::get          ('api/edit/{id}', 'ApiController@edit')->name('api.edit');
    Route::post         ('api/update', 'ApiController@update')->name('api.update');
    Route::get          ('api/delete/{id}', 'ApiController@destroy')->name('api.delete');
    Route::get          ('api/statistics/{id}', 'ApiController@statistics')->name('api.statistics');
    /* service APIs
     */

    Route::auth();
    Auth::routes();
    Route::get('/logout', 'Auth\LoginController@logout');
    /* User section
     **/
});
