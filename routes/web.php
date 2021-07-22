<?php

// use Illuminate\Support\Facades\Auth;
// use Symfony\Component\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test1', function () {
    return 'welcom';
});

//Required parameter
Route::get('/test2/{id}', function ($id) {
    return $id;
});
//optional parameter
Route::get('/test3/{id?}', function () {
    return 'welcom';
});

//Route::get('second', 'Admin\SecondController@showString');

Route::group(['namespace' => 'Admin'], function(){
     Route:: get('second','SecondController@showStringpp')->middleware('auth');
 });

/*Route::get('login',function (){
    return 'login El2wl ya 7abeby';
}) -> name('login');*/
Route::resource('news', 'NewsController');

Route::get('/landing', function () {
    return view('landing');
});
Route::get('/about', function () {
    return view('about');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', function(){
    return 'dashboard';
});

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

Route::get('fillable','CrudController@getOffers');

Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
     ],
     function(){

    Route::group(['prefix' => 'offers'], function(){



            Route::get('create', 'CrudController@create');
            Route::post('store','CrudController@store') -> name('offers.store');

            Route::get('edit/{offer_id}', 'CrudController@editOffer');
            Route::post('update/{offer_id}','CrudController@UpdateOffer') -> name('offers.update');

            Route::get('all', 'CrudController@getAlloffers');

        });


        Route::get('youtube','CrudController@getVideo');


});
