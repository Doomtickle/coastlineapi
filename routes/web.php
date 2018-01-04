<?php
Route::get('/api/v1/properties', 'PropertiesController@index');
Route::get('/api/v1/properties/{id}', 'PropertiesController@show');