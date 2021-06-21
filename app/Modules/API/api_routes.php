<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$app 	= function(){
	Route::get('/',function(){
		return redirect(env('APP_URL'));
	});
};
if(env('APP_ENV') == 'local'){
	$app();
}else{
	Route::domain(env('APP_API_URL'))->group(function() use($app){
		$app();
	});
}

