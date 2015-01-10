<?php

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
*/

Route::filter('auth', function() {
  if(Auth::guest()) {
    if(Request::ajax()) {
      return Response::make('Unauthorized', 401);
    }
    
    return Redirect::guest('login');
  }
});

Route::filter('guest', function() {
  if(Auth::check()) {
    return Redirect::route('home');
  }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
*/

Route::filter('csrf', function() {
  if(Session::token() !== Input::get('_token')) {
    throw new Illuminate\Session\TokenMismatchException;
  }
});
