<?php

use Illuminate\Http\Request;

Route::group(['prefix' => '0.1'], function () {
    Route::get('test', function () {
        return response()->json(\Domain\User\User::find(1)->load(['roles', 'authProviders', 'authTokens']));
    });
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('login/{provider?}', [
            'uses' => 'AuthController@login',
            'as' => 'public::auth.login',
        ]);
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
