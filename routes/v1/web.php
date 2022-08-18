<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
$router->get('/', function () use ($router) {
   return view('index');
});

$router->post('verify', 'LicenseController@verify');
$router->get('blogs', 'BlogController@index');
$router->get('news', 'NewsController@index');

Route::post('/mail-send', 'FrontController@mailSend');

$router->get('blogs/details/{slug}', 'BlogController@details');
$router->get('news/details/{slug}', 'NewsController@details');

$router->post('base', 'V1\Common\CommonController@base');
$router->get('cmspage/{type}', 'V1\Common\CommonController@cmspagetype');

$router->group(['prefix' => 'api/v1'], function ($app) {

	$app->post('user/appsettings', 'V1\Common\CommonController@base');

	$app->post('provider/appsettings', 'V1\Common\CommonController@base');

	$app->get('storetypelist', 'V1\Order\Admin\Resource\StoretypeController@storetypelistShop');
    $app->get('/cuisinelist/{id}', 'V1\Order\Admin\Resource\CuisinesController@cuisinelist');

    $app->get('/countrycities/{id}','V1\Common\Admin\Resource\CompanyCitiesController@countrycities');
    $app->get('/zonetype/{id}', 'V1\Common\Admin\Resource\ZoneController@cityzonestypeShop');

    $app->post('/shops', ['uses' => 'V1\Order\Admin\Resource\ShopsController@storeShop']);


	$app->get('countries', 'V1\Common\CommonController@countries_list');
	$app->get('states/{id}', 'V1\Common\CommonController@states_list');

	$app->get('cities/{id}', 'V1\Common\CommonController@cities_list');

	$app->post('/{provider}/social/login', 'V1\Common\SocialLoginController@handleSocialLogin');

	$app->post('/chat', 'V1\Common\CommonController@chat');

	$app->post('/provider/update/location', 'V1\Common\Provider\HomeController@update_location');

});

$router->get('/send/{type}/push', 'V1\Common\SocialLoginController@push');

$router->get('v1/docs', ['as' => 'swagger-v1-lume.docs', 'middleware' => config('swagger-lume.routes.middleware.docs', []), 'uses' => 'V1\Common\SwaggerController@docs']);

$router->get('/api/v1/documentation', ['as' => 'swagger-v1-lume.api', 'middleware' => config('swagger-lume.routes.middleware.api', []), 'uses' => 'V1\Common\SwaggerController@api']);
