<?php

/*
|--------------------------------------------------------------------------
| All Routes for Front End
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your NetCoden'S Back End. Just tell NetCoden the URIs it should respond
| to using a Closure or controller method. Build something great!
|
|
|  Designer : NetCoden
|  Developer: NetCoden
|  Maintenance: NetCoden
|  Website: http://netcoden.com
|
*/
/*=================================
=          Index Page              =
=================================*/

//Route::get('/en', 'IndexController@getIndex');

/*=================================
=          Home Page           /
=================================*/

Route::get('/', 'DashboardController@getIndex');


?>
