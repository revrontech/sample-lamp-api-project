<?php

$router->post('/login', 'V1\Order\Shop\Auth\AuthController@login');

$router->post('/refresh', 'V1\Order\Shop\Auth\AuthController@refresh');
$router->post('/forgotOtp', 'V1\Order\Shop\Auth\AuthController@forgotPasswordOTP');
$router->post('/verify-number', 'V1\Order\Shop\Auth\AuthController@verifyNumber');

$router->post('/resetOtp', 'V1\Order\Shop\Auth\AuthController@resetPasswordOTP');
$router->post('/reset-password', 'V1\Order\Shop\Auth\AuthController@resetPasswordShop');

$router->get('/dispatcher/autosign', 'V1\Order\Shop\Auth\AdminController@StoreAutoAssign');

$router->group(['middleware' => 'auth:shop'], function ($app) {


//test notification
$app->get('/notify', 'V1\Order\Admin\Resource\ShopsController@notify');

//Shops Add on
$app->get('/addon/{id}', 'V1\Order\Admin\Resource\ShopsaddonController@index');
$app->post('/addons', 'V1\Order\Admin\Resource\ShopsaddonController@store');
$app->get('/addons/{id}', 'V1\Order\Admin\Resource\ShopsaddonController@show');
$app->patch('/addons/{id}', 'V1\Order\Admin\Resource\ShopsaddonController@update');
$app->delete('/addons/{id}', 'V1\Order\Admin\Resource\ShopsaddonController@destroy'); 
$app->get('/addonslist/{id}', 'V1\Order\Admin\Resource\ShopsaddonController@addonlist');
$app->get('/addonslists', 'V1\Order\Admin\Resource\ShopsaddonController@addonlistShop');

$app->get('/addon/{id}/updateStatus', 'V1\Order\Admin\Resource\ShopsaddonController@updateStatus'); 

//Shops Category
$app->get('/categoryindex/{id}', 'V1\Order\Admin\Resource\ShopscategoryController@index');
$app->post('/category', 'V1\Order\Admin\Resource\ShopscategoryController@store');
$app->post('/add-category', 'V1\Order\Admin\Resource\ShopscategoryController@storeCategory');

$app->get('/category/{id}', 'V1\Order\Admin\Resource\ShopscategoryController@show');
$app->patch('/category/{id}', 'V1\Order\Admin\Resource\ShopscategoryController@update');
$app->delete('/category/{id}', 'V1\Order\Admin\Resource\ShopscategoryController@destroy');
$app->get('/categorylist/{id}', 'V1\Order\Admin\Resource\ShopscategoryController@categorylist');
$app->get('/categorylists', 'V1\Order\Admin\Resource\ShopscategoryController@categorylistShop');

$app->get('/category/{id}/updateStatus', 'V1\Order\Admin\Resource\ShopscategoryController@updateStatus');

//Shpos Items

$app->get('/itemsindex/{id}', 'V1\Order\Admin\Resource\ShopsitemsController@index');
$app->get('/itemslists', 'V1\Order\Admin\Resource\ShopsitemsController@listindex');
$app->post('/items', 'V1\Order\Admin\Resource\ShopsitemsController@store');
$app->post('/add-items', 'V1\Order\Admin\Resource\ShopsitemsController@storeShop');

$app->get('/items/{id}', 'V1\Order\Admin\Resource\ShopsitemsController@show');
$app->patch('/items/{id}', 'V1\Order\Admin\Resource\ShopsitemsController@update');


$app->get('/showitem/{id}', 'V1\Order\Admin\Resource\ShopsitemsController@showItem');
$app->patch('/updateitem/{id}', 'V1\Order\Admin\Resource\ShopsitemsController@updateItem');


$app->delete('/items/{id}', 'V1\Order\Admin\Resource\ShopsitemsController@destroy');
$app->get('/items/{id}/updateStatus', 'V1\Order\Admin\Resource\ShopsitemsController@updateStatus');


// Store Types	
$app->get('/storetypelist', 'V1\Order\Admin\Resource\StoretypeController@storetypelist'); 	

//zone
$app->get('/zonetype/{id}', 'V1\Common\Admin\Resource\ZoneController@cityzonestype');

//cuisine
$app->get('/cuisinelist/{id}', 'V1\Order\Admin\Resource\CuisinesController@cuisinelist');
//shop
$app->get('/shops/{id}', 'V1\Order\Admin\Resource\ShopsController@show');
$app->get('/shop/profile', 'V1\Order\Admin\Resource\ShopsController@showShop');

$app->patch('/shops/{id}', 'V1\Order\Admin\Resource\ShopsController@update'); 
$app->patch('/shop/update-profile', 'V1\Order\Admin\Resource\ShopsController@updateShop');  


//Account setting details
Route::get('password', 'V1\Order\Shop\Auth\AdminController@password');
Route::post('password', 'V1\Order\Shop\Auth\AdminController@password_update');
Route::get('bankdetails/template', 'V1\Common\Provider\HomeController@template');
$app->post('/addbankdetails', 'V1\Common\Provider\HomeController@addbankdetails'); 
$app->post('/editbankdetails', 'V1\Common\Provider\HomeController@editbankdetails');

//Dispatcher Panel
$app->get('/dispatcher/orders', 'V1\Order\Shop\Auth\AdminController@orders');
$app->post('/dispatcher/cancel', 'V1\Order\Shop\Auth\AdminController@cancel_orders');
$app->post('/dispatcher/accept', 'V1\Order\Shop\Auth\AdminController@accept_orders');
$app->post('/dispatcher/pickedup', 'V1\Order\Shop\Auth\AdminController@picked_up');

//Wallet
$app->get('/wallet', 'V1\Order\Shop\Auth\AdminController@wallet');

//logout
$app->post('/logout', 'V1\Order\Shop\Auth\AuthController@logout'); 

//Dashboard
$app->get('total/storeorder', 'V1\Order\Shop\Auth\AdminController@total_orders');

$app->get('total-revenue', 'V1\Order\Shop\Auth\AdminController@total_ordersShop');



$app->get('/transactions', 'V1\Order\Shop\ShopStatementController@statement_shop');

$app->get('/shoprequesthistory', 'V1\Order\User\HomeController@shoprequestHistory');
$app->get('/shoprequesthistorylist', 'V1\Order\User\HomeController@shoprequestHistoryShop');

$app->get('/requesthistory/{id}', 'V1\Order\User\HomeController@requestHistoryDetails');



});

