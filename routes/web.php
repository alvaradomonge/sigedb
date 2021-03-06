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
Route::get('/admin.gruposEstudiantes/{grupo_guia}','App\Http\Controllers\AdminController@gruposEstudiantes')->name('admin.gruposEstudiantes');

Route::resource('anio_lectivo','App\Http\Controllers\AnioLectivoController');
Route::resource('periodo','App\Http\Controllers\PeriodoController');
Route::resource('grupo_guia','App\Http\Controllers\grupoGuiaController')->parameters(['grupo_guia' => 'grupo_guia']);
Route::resource('materia','App\Http\Controllers\MateriaController')->parameters(['materia' => 'materia']);
Route::get('grupo_guia/{grupo_guia}/materia/create','App\Http\Controllers\MateriaController@create_materia_grupo_guia')->name('materia.create_grupo_guia');

//RUTAS DE MANEJO DE GESTION DE PERIODOS GRUPOS GUIAS Y ESTUDIANTES
Route::get('search/estudiantes','App\Http\Controllers\searchController@estudiantes')->name('search.estudiantes');
Route::get('search/estudiantesData/{grupo_guia}','App\Http\Controllers\searchController@estudiantesData')->name('search.estudiantesData');
Route::get('admin/storeGrupoGuiaEstudiante/{grupo_guia}','App\Http\Controllers\adminController@storeGrupoGuiaEstudiante')->name('admin.storeGrupoGuiaEstudiante');
Route::post('admin/storeNuevoEstudianteGrupoGuia/{grupo_guia}','App\Http\Controllers\adminController@storeNuevoEstudianteGrupoGuia')->name('admin.storeNuevoEstudianteGrupoGuia');
Route::get('admin/sacarEstudianteGrupo_guia/{grupo_guia}/{estudiante}','App\Http\Controllers\adminController@sacarEstudianteGrupo_guia')->name('admin.sacarEstudianteGrupo_guia');
Route::get('admin/crearEstudianteGrupoGuia/{grupo_guia}','App\Http\Controllers\adminController@crearEstudianteGrupoGuia')->name('admin.crearEstudianteGrupoGuia');
Route::post('admin/storeNuevoEstudianteGrupoGuia/{grupo_guia}','App\Http\Controllers\adminController@storeNuevoEstudianteGrupoGuia')->name('admin.storeNuevoEstudianteGrupoGuia');
Route::post('register/estudiante/{grupo_guia}','App\Http\Controllers\Auth\RegisterController@registerEstudiante')->name('register.estudiante');

Route::get('{grupo_guia}/materias','App\Http\Controllers\adminController@showGrupoGuiaMaterias')->name('grupo_guia.materias');

//RUTAS PARA LIBROS DE NOTAS

Route::get('{materia}/notas','App\Http\Controllers\adminController@showLibroNotas')->name('materia.notas');
Route::get('{materia}/rubros','App\Http\Controllers\adminController@showRubros')->name('materia.rubros');
Route::post('{materia}/rubro','App\Http\Controllers\adminController@nuevoRubro')->name('nuevo.rubro');
Route::post('{materia}/asignacion','App\Http\Controllers\adminController@nuevaAsignacion')->name('nueva.asignacion');
Route::delete('/{rubro}/rubro/destroy','App\Http\Controllers\AdminController@destroyRubro')->name('rubro.destroy');
Route::delete('/{asignacion}/asignacion/destroy','App\Http\Controllers\AdminController@destroyAsignacion')->name('asignacion.destroy');
Route::get('materia/{asignacion}/asignacion/{materia}/edit','App\Http\Controllers\AdminController@editAsignacion')->name('asignacion.edit');
Route::patch('asignacion/update/{asignacion}/{materia}','App\Http\Controllers\AdminController@updateAsignacion')->name('asignacion.update');
Route::get('materia/{materia}/asignacion/{asignacion}/ajaxcalificar','App\Http\Controllers\AdminController@editCalificacionAjax')->name('ajax.asignacion.calificar');
Route::get('materia/{materia}/asignacion/{asignacion}/calificar','App\Http\Controllers\AdminController@editCalificacion')->name('asignacion.calificar');
Route::patch('materia/asignacion/calificar','App\Http\Controllers\AdminController@updateCalificacion')->name('calificacion.update');
Route::get('/livetable/fetch_data/{materia}/{asignacion}','App\Http\Controllers\AdminController@fetch_data')->name('livetable/fetch_data');
Route::post('/livetable/update', 'App\Http\Controllers\AdminController@update_data')->name('livetable.update_data');

//RUTAS PARA ASISTENCIA
Route::get('materia/{materia}/asistencia','App\Http\Controllers\AdminController@showAsistencia')->name('materia.asistencia');
Route::get('grupo/{grupo_guia}/asistencia','App\Http\Controllers\AdminController@showAsistenciaAdmin')->name('grupo_guia.asistencia');
Route::get('materia/{materia}/asistencia/{user}/incidencia/{incidencia}','App\Http\Controllers\AdminController@nuevaIncidencia')->name('incidencia.create');
Route::post('materia/{materia}/asistencia/incidencia/store','App\Http\Controllers\AdminController@storeIncidencia')->name('incidencia.store');
//RUTAS PARA CONDUCTA

//RUTAS PARA INFORMES DE NOTAS
//PRUEBAS 
Route::get('Vista_prueba','App\Http\Controllers\rel_periodo_materia_Controller@index');

//Route::resource('admin','App\Http\Controllers\AdminController');
//Route::get('/admin/{anio_lectivo}','App\Http\Controllers\AdminController@show')->name('admin.show');
//Route::get('admin/create_anio_lectivo','App\Http\Controllers\AdminController@create')->name('admin.create');
//Route::get('admin/gestionAniosPeriodos','App\Http\Controllers\AdminController@index')->name('admin.index');
//Route::get('admin.create_anio_lectivo','App\Http\Controllers\AdminController@create')->name('create_anio_lectivo');
//Route::post('admin.create_anio_lectivo','App\Http\Controllers\AdminController@store');
//Route::patch('/admin.edit_anio/{anio_lectivo}','App\Http\Controllers\AdminController@update')->name('admin.update');
//Route::get('admin.edit_anio','App\Http\Controllers\AdminController@edit')->name('admin.edit_anio');

//Route::delete('/admin/{anio_lectivo}','App\Http\Controllers\AdminController@destroy')->name('admin.destroy');