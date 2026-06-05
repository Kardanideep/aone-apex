<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/packages', function () {
    return view('packages');
})->name('packages');

Route::get('/business-plan', function () {
    return view('business-plan');
})->name('business-plan');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication Routes (Frontend Only)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verification.notice');

// User Profile Routes (Frontend Only)
Route::get('/profile', function () {
    return view('user.profile');
})->name('profile');

Route::get('/change-password', function () {
    return view('user.change-password');
})->name('password.change');
