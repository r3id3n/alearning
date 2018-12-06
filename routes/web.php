<?php


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
/** 
 *una ruta la cual get va a login y le entregaremos la variable {driver} 
 *luego se dirige al controlador y llamar al metodo redirectToProvider
 *le añadiremos un nombre social_auth para utilizarlos 
 */
Route::get('/set_language/{lang}', 'Controller@setLanguage')->name( 'set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
/* 
devolucion de la plataforma que se utilizara como Facebook y GitHub
 */
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'courses'], function(){
    Route::get('/{course}', 'CourseController@show')->name('courses.detail');
});

Route::group(["prefix" => "subscriptions"], function() {
    //URL
    Route::get('/plans', 'SubscriptionController@plans')
		     ->name('subscriptions.plans');
		Route::get('/admin', 'SubscriptionController@admin')
		     ->name('subscriptions.admin');
		Route::post('/process_subscription', 'SubscriptionController@processSubscription')
		     ->name('subscriptions.process_subscription');
});

Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    if(File::exists($file)){
        return \Intervention\Image\Facades\Image::make($file)->response();
    }
});