<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('/','home\HomeController');
// 后台模块
Route::group(['prefix' => 'admin'],function(){
	Route::get('/',function(){
		return view('admin.layout.index');
	});
	// 后台用户模块
	Route::resource('user','admin\UserController');
	Route::get('user/{id}/info','admin\UserController@info');
	// 后台管理员模块
	Route::resource('administrator','admin\AdministratorController');

	Route::get('administrator/{id}/info','admin\AdministratorController@info');
	// 后台店铺分类模块
	Route::resource('shopcate','admin\ShopcateController');
	// 后台商铺模块
	Route::resource('shop','admin\ShopController');
	// 后台订单模块
	Route::resource('order','admin\OrderController');
	Route::get('order/{id}/info','admin\OrderController@info');
	// 后台活动模块
	Route::resource('activity','admin\ActivityController');
	// 后台投诉模块
	Route::resource('complain','admin\ComplainController');
	// 后台审核模块
	Route::resource('audit','admin\AuditController');
	// 后台广告管理
	Route::resource('advert','admin\AdvertController');
});

// 商家模块
Route::group(['prefix'=>'shop'],function(){
	Route::get('/',function(){
		return view('shop.layout.index');
	});
	// 商家注册模块
	Route::resource('reg','shop\regController');
	// 商家登录模块
	Route::resource('login','shop\LoginController');
	// 商家订单模块
	Route::resource('order','shop\OrderController');
	// 商家店铺模块
	Route::resource('store','shop\StoreController');
	// 商家菜品模块
	Route::resource('food','shop\FoodController');
	// 商家菜品分类模块
	Route::resource('foodcate','shop\FoodCateController');
	// 商铺评论模块
	Route::resource('scomment','shop\SCommentController');
	// 菜品评论模块
	Route::resource('fcomment','shop\FCommentController');
	// 商户中心模块
	Route::resource('userinfo','shop\UserInfoController');
});

//用户模块
Route::group(['prefix'=>'/'],function(){
	route::get('/',function(){
		return view('home.layout.index');
	});
	//前台用户登录模块
	Route::resource('login','home\LoginController');
	//前台用户个人中心
	Route::resource('user','home\UserController');
});
