<?php

Route::group([
	'middleware' => ['web', 'auth'], 
	'prefix' => 'referraltree', 
	'namespace' => 'Modules\ReferralTree\Http\Controllers'], function() {
		//
    	Route::get('/', 'ReferralTreeController@index');
    	Route::get('/getReferreds', 'ReferralTreeController@getReferreds');
		
});
