<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentController;

Route::get('/', function () {
    phpinfo();
    return view('welcome');
});

Route::get('/components/view',[ComponentController::class,'getAllComponent'])->name('component.view');

Route::get('/components/add', function () {
    return view('components.create');
})->name('component.create');

Route::post('/components/store',[ComponentController::class,'store'])->name('component.store');