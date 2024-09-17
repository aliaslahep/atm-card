<?php

use App\Modules\AtmCard\Middleware\AtmCardAuth;

Route::group(['middleware' => [AtmCardAuth::class],'namespace' => 'App\Modules\AtmCard\Controllers'], function() {
	
	Route::post('atm-card/create', ['as' => 'atm.create', 'uses' => 'AtmCardController@store'] );
	
    Route::post('atm-card/balance-fetch', ['as' => 'atm.balance.fetch', 'uses' => 'AtmCardController@fetch_balance'] );
	
	Route::post('atm-card/fund-transfer', ['as' => 'atm.fund.transfer', 'uses' => 'AtmCardController@fund_transfer'] );

});
