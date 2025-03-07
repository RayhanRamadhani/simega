<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chatbot', function () {
    return view('chatbot');
});

Route::post('/chatbot', 'App\Http\Controllers\ChatbotController');