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

/*
	home panel home controller
*/

Route::get('/home', 'Panel\HomeController@index');
Route::get('/', 'Panel\HomeController@index');
Route::get('/Role',function(){
	// $admin = new \App\Role();
	// $admin->name         = 'admin';
	// $admin->display_name = 'User Administrator'; // optional
	// $admin->description  = 'User is allowed to manage and edit other users'; // optional

	// $owner = new \App\Role();
	// $owner->name         = 'owner';
	// $owner->display_name = 'Project Owner'; // optional
	// $owner->description  = 'User is the owner of a given project'; // optional

	// $createPost = new \App\Permission();
	// $createPost->name         = 'create-post';
	// $createPost->display_name = 'Create Posts'; // optional
	// // Allow a user to...
	// $createPost->description  = 'create new blog posts'; // optional
	// $createPost->save();

	// $editUser = new \App\Permission();
	// $editUser->name         = 'edit-user';
	// $editUser->display_name = 'Edit Users'; // optional
	// // Allow a user to...
	// $editUser->description  = 'edit existing users'; // optional
	// $editUser->save();

	// $admin->attachPermission($createPost);
	// // equivalent to $admin->perms()->sync(array($createPost->id));

	// $owner->attachPermissions(array($createPost, $editUser));
	// // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
	$user = \App\User::where('email', '=', 'admin@admin.com')->first();
	die($user->hasRole('admin'));
});


Route::get('/panel', function () {
    return view('admin_panel.layout');
});

/*
	auth an register_shutdown_function(function)
*/
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
// Route::auth();

Route::group(array('prefix' => 'manager'), function(){

	// customer routs (testa controller)
	Route::group(array('prefix' => 'customer'), function(){
		Route::get('/', 'Panel\CustomerController@index');
		Route::get('/create', 'Panel\CustomerController@create');
		Route::get('/edit/{id}', 'Panel\CustomerController@edit');
		Route::get('/destroy/{id}', 'Panel\CustomerController@destroy');
		Route::post('/store/{id}', 'Panel\CustomerController@store');
	});

	// category routs (testa controller)
	Route::group(array('prefix' => 'layer'), function(){
		Route::get('/', 'Panel\LayerController@index');
		Route::get('/create', 'Panel\LayerController@create');
		Route::get('/edit/{id}', 'Panel\LayerController@edit');
		Route::get('/destroy/{id}', 'Panel\LayerController@destroy');
		Route::post('/store/{id}', 'Panel\LayerController@store');
	});

	// site routs (testa controller)
	Route::group(array('prefix' => 'site'), function(){
		Route::get('/', 'Panel\SiteController@index');
		Route::get('/index/{id}', 'Panel\SiteController@index');
		Route::get('/index', 'Panel\SiteController@index');
		Route::get('/chart', 'Panel\SiteController@chart');
		Route::get('/word', 'Panel\SiteController@word');
		Route::get('/create', 'Panel\SiteController@create');
		Route::get('/edit/{id}', 'Panel\SiteController@edit');
		Route::get('/destroy/{id}', 'Panel\SiteController@destroy');
		Route::post('/store/{id}', 'Panel\SiteController@store');
		Route::get('/tree', 'Panel\SiteController@tree');
		Route::get('/export/', 'Panel\SiteController@export');
	});	

	// site routs (testa controller)
	Route::group(array('prefix' => 'pingweb'), function(){
		Route::get('/', 'Panel\PingWebsiteController@index');
		Route::post('/import', 'Panel\PingWebsiteController@import');
		Route::get('/export', 'Panel\PingWebsiteController@export');
	});

	// site routs (testa controller)
	Route::group(array('prefix' => 'rankalexa'), function(){
		Route::get('/', 'Panel\RankAlexaController@index');
		Route::post('/import', 'Panel\RankAlexaController@import');
		Route::get('/export', 'Panel\RankAlexaController@export');
	});

	// site routs (testa controller)
	Route::group(array('prefix' => 'account'), function(){
		Route::get('/users', 'Panel\UsersController@index');
		Route::get('/permission', 'Panel\PermissionController@index');
		Route::get('/role', 'Panel\RoleController@index');
	});

	// site routs (testa controller)
	Route::group(array('prefix' => 'report'), function(){
		Route::get('/', 'Panel\ReportController@index');
		Route::get('/service', 'Panel\ReportController@service');
		Route::get('/connection', 'Panel\ReportController@connection');
		Route::get('/content', 'Panel\ReportController@content');
		Route::get('/all_category', 'Panel\ReportController@all_category');
	});	

	Route::group(array('prefix' => 'api'), function(){
		Route::get('/', 'Panel\ApiClientController@api');
	});
});



