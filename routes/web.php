<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::view('/','home')->name('inicio');
Route::post('informenotas', 'App\Http\Controllers\mensajeControlador@store');
Route::view('/notas','notas')->name('notas');
Route::view('/informenotas','informenotas')->name('informenotas');

Route::resource('estudiante','App\Http\Controllers\EstudianteControlador');

Auth::routes();
Auth::routes(['register'=>false]);


Route::view('/admin.gestionClases','admin.gestionClases')->name('admin.gestionClases');
Route::get('/admin.gestionAniosPeriodos','App\Http\Controllers\AdminController@index')->name('admin.gestionAniosPeriodos');

Route::resource('anio_lectivo','App\Http\Controllers\AnioLectivoController');

//Route::resource('admin','App\Http\Controllers\AdminController');
//Route::get('/admin/{anio_lectivo}','App\Http\Controllers\AdminController@show')->name('admin.show');
//Route::get('admin/create_anio_lectivo','App\Http\Controllers\AdminController@create')->name('admin.create');
//Route::get('admin/gestionAniosPeriodos','App\Http\Controllers\AdminController@index')->name('admin.index');
//Route::get('admin.create_anio_lectivo','App\Http\Controllers\AdminController@create')->name('create_anio_lectivo');
//Route::post('admin.create_anio_lectivo','App\Http\Controllers\AdminController@store');
//Route::patch('/admin.edit_anio/{anio_lectivo}','App\Http\Controllers\AdminController@update')->name('admin.update');
//Route::get('admin.edit_anio','App\Http\Controllers\AdminController@edit')->name('admin.edit_anio');

//Route::delete('/admin/{anio_lectivo}','App\Http\Controllers\AdminController@destroy')->name('admin.destroy');