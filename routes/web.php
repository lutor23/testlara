<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('/test', function () {
    return view('test');
});

Route::post('/home2', 'HomeController@save');

Route::get('datasources/{datasource_id}/sync' , 'DatasourcesController@sync');

Route::get('/json' , function() { 
	return '
		{
		    "serie": [
		        {
		            "id": "a",
		            "name": "a"
		  },
		        {
		            "id": "b",
		            "name": "b"
		  },
		        {
		            "id": "c",
		            "name": "c"
		  },
		        {
		            "id": "d",
		            "name": "d"
		  }
		]
		}';

});

Route::post('datasources/validate' , 'DatasourcesController@validateParam');
Route::resource('datasources'      , 'DatasourcesController');

Route::post('/cachedatasource/aggregate'             				 , ['uses'=>'CacheDatasourceStatsController@showagg']);
Route::get('/cachedatasource/{datasource_id}'                        , ['uses'=>'CacheDatasourceStatsController@show']);
Route::get('/cachedatasource/{datasource_id}/fieldnames'             , ['uses'=>'CacheDatasourceStatsController@getFieldNames']);
Route::get('/cachedatasource/{datasource_id}/sumfields'              , ['uses'=>'CacheDatasourceStatsController@showsumfield']);
Route::get('/cachedatasource/{datasource_id}/raw'                    , ['uses'=>'CacheDatasourceStatsController@showraw']);
Route::get('/cachedatasource/{datasource_id}/last'                   , ['uses'=>'CacheDatasourceStatsController@showlast']);
Route::get('/cachedatasource/{datasource_id}/jsonvalue/{jsonheader}' , ['uses'=>'CacheDatasourceStatsController@getJsonField']);


Route::get('/charts', 'TestController@index');


Route::get('/widgets/table/{widget_id}', 'WidgetsController@showtable');
Route::get('/widgets/{widget_id}/preview', 'WidgetsController@previewfull');
Route::get('/widgets/preview', 'WidgetsController@preview');
Route::get('/widgets/url/{widget_id}', 'WidgetsController@url');
Route::get('/widgets/{widget_id}/preview', 'WidgetsController@previewfull');
Route::get('/widgets/chartoptions', 'WidgetsController@getChartOptions');
Route::get('/widgets/chartpreview', 'WidgetsController@chartPreview');
Route::resource('widgets', 'WidgetsController');




Route::get('markboyles', function(){
	return view('markboyles');
});


Route::resource('director', 'DirectorController');
Route::resource('team', 'TeamController');
Route::resource('dashboard', 'DashboardController');
Route::resource('url', 'UrlController');


Route::get('/urlobject/{url_id}', 'UrlController@showframe');


Route::post('connections/validate' , 'ConnectionsController@validateConn');
Route::resource('connections', 'ConnectionsController');

Route::get('/rules/min/{id}', 'RulesController@indexmin');
Route::get('/rules/min/create/{id}', 'RulesController@createmin');
Route::post('/rules/min', 'RulesController@storemin');
Route::get('/rules/min/{rule}/edit', 'RulesController@editmin');
Route::resource('rules', 'RulesController');