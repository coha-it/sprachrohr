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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});



Route::group(['middleware' => 'api'], function () {
    Route::get('podcasts', function() {
        $arr = [
            [
              'id' => 1,
              'type' => 'audio',
              'title' => '1 Hour of Dark Piano Music III _ Dark Piano For Dark Thoughts (152kbit_Opus)',
              'image' => 'https://semantic-ui.com/images/wireframe/image.png',
              'sources' => [
                [
                  'src' => 'https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/stratosphere.mp3',
                  'type' => 'audio/mp3'
                ]
              ]
            ],
            [
              'id' => 2,
              'type' => 'audio',
              'title' => 'Duster - Experimental Dust (2000)',
              'image' => asset('/media/images/6898628.jpg'),
              'sources' => [
                [
                  'src' => 'https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/cooking.mp3',
                  'type' => 'audio/mp3'
                ]
              ]
            ],
            [
              'id' => 3,
              'type' => 'audio',
              'title' => 'ATMOSPHERIC GOTHIC HORROR READING MUSIC',
              'image' => 'https://semantic-ui.com/images/wireframe/image.png',
              'sources' => [
                [
                  'src' => 'https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/the-landing.mp3',
                  'type' => 'audio/mp3'
                ]
              ]
            ]
        ];
        return json_encode($arr);
    });
});
