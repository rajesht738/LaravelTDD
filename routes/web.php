<?php

use Illuminate\Support\Facades\Route;
use Google\Service\AdExchangeBuyerII\Client;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/drive', function(){
    $client = new Client();
    $client->setClientId('548404326548-d5ikpaqtlcooarlbvcsuqacr57kn020c.apps.googleusercontent.com');
    $client->setClientSecret('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');
    $client->setRedirectUri('http://localhost:8000/google-drive/callback');
    $client->setScopes([
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',

    ]);
    $url = $client->createAuthUrl();

    return $url;

});
