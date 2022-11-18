<?php

use Illuminate\Support\Facades\Route;

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

/*
INDEX CONTROLLER
*/
Route::get('/', [\App\Http\Controllers\IndexController::class,'inicio']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [\App\Http\Controllers\IndexController::class,'dashboard'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/devolverProduFiltrados', [\App\Http\Controllers\IndexController::class,'devolverProduFiltrados']);
Route::middleware(['auth:sanctum', 'verified'])->get('/guardadas', [\App\Http\Controllers\IndexController::class,'guardadas']);
Route::middleware(['auth:sanctum', 'verified'])->get('/publicadas', [\App\Http\Controllers\IndexController::class,'publicadas']);



/*
PUBLICACIONES CONTROLLER
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/crearPublicacion', [\App\Http\Controllers\PublicacionController::class,'crearPublicacion']);

Route::middleware(['auth:sanctum', 'verified'])->post('/productos', [\App\Http\Controllers\PublicacionController::class,'productos']);
Route::middleware(['auth:sanctum', 'verified'])->post('/crearInmueble', [\App\Http\Controllers\PublicacionController::class,'crearInmueble']);
Route::middleware(['auth:sanctum', 'verified'])->post('/crearServicio', [\App\Http\Controllers\PublicacionController::class,'crearServicio']);
Route::middleware(['auth:sanctum', 'verified'])->get('/buscarCategoria/{titulo}', [\App\Http\Controllers\PublicacionController::class,'buscarCategoria']);
Route::middleware(['auth:sanctum', 'verified'])->get('/buscarProductos/{buscador}', [\App\Http\Controllers\PublicacionController::class,'buscarProductos']);
Route::get('/traerProductosFiltrados' , [\App\Http\Controllers\PublicacionController::class, 'traerProductosFiltrados']);
Route::middleware(['auth:sanctum', 'verified'])->get('/cargarCategoria/{categoria}', [\App\Http\Controllers\PublicacionController::class,'cargarCategoria']);
Route::middleware(['auth:sanctum', 'verified'])->post('/guardarPublicacion', [\App\Http\Controllers\PublicacionController::class,'guardarPublicacion']);
Route::middleware(['auth:sanctum', 'verified'])->post('/quitarPublicacion', [\App\Http\Controllers\PublicacionController::class,'quitarPublicacion']);
Route::middleware(['auth:sanctum', 'verified'])->post('/eliminarPublicacion', [\App\Http\Controllers\PublicacionController::class,'eliminarPublicacion']);
Route::middleware(['auth:sanctum', 'verified'])->post('/filtrarProductos', [\App\Http\Controllers\PublicacionController::class,'filtrarProductos']);
Route::middleware(['auth:sanctum', 'verified'])->get('/filtrarProductos', [\App\Http\Controllers\PublicacionController::class,'filtrarProductos']);
Route::middleware(['auth:sanctum', 'verified'])->post('/editarPublicacion', [\App\Http\Controllers\PublicacionController::class,'editarPublicacion']);
Route::middleware(['auth:sanctum', 'verified'])->post('/editarInmueble', [\App\Http\Controllers\PublicacionController::class,'editarInmueble']);
Route::middleware(['auth:sanctum', 'verified'])->get('/buscar', [\App\Http\Controllers\PublicacionController::class,'buscarProductos']);

/*
CREAR CONTROLLER
*/
Route::middleware(['auth:sanctum', 'verified'])->post('/eliminarUsuario/{id}', [\App\Http\Controllers\CrearController::class,'eliminarUsuario']);
Route::middleware(['auth:sanctum', 'verified'])->get('/admin', [\App\Http\Controllers\CrearController::class,'admin']);
Route::middleware(['auth:sanctum', 'verified'])->get('/verPublicaciones', [\App\Http\Controllers\CrearController::class,'verPublicaciones']);
Route::middleware(['auth:sanctum', 'verified'])->get('/verUsuarios', [\App\Http\Controllers\CrearController::class,'verUsuarios']);
Route::middleware(['auth:sanctum', 'verified'])->get('/crearSector', [\App\Http\Controllers\CrearController::class,'crearSector']);
Route::middleware(['auth:sanctum', 'verified'])->get('/crearCategoria', [\App\Http\Controllers\CrearController::class,'crearCategoria']);
Route::middleware(['auth:sanctum', 'verified'])->post('/guardarSector/{titulo}', [\App\Http\Controllers\CrearController::class,'guardarSector']);
Route::middleware(['auth:sanctum', 'verified'])->post('/guardarCategoria/{titulo}', [\App\Http\Controllers\CrearController::class,'guardarCategoria']);
Route::middleware(['auth:sanctum', 'verified'])->post('/borrarSector/{id}', [\App\Http\Controllers\CrearController::class,'borrarSector']);
Route::middleware(['auth:sanctum', 'verified'])->post('/borrarCategoria/{id}', [\App\Http\Controllers\CrearController::class,'borrarCategoria']);


/*
CATEGORIA CONTROLLER
*/
