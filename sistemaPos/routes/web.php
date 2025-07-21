<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\compraController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\proveedoreController;
use App\Http\Controllers\userController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\ventaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[homeController::class,'index'])->name('panel');

Route::resources([
    'categorias' => categoriaController::class,
    'marcas' => marcaController::class,
    'presentaciones' => presentacioneController::class,
    'productos' => ProductoController::class,
    'compras' => compraController::class,
    'users'=> UserController::class,
    'clientes'=> clienteController::class,
    'proveedores'=> proveedoreController::class,
    'roles'=> roleController::class,
    'ventas'=> ventaController::class,
    'profile'=> profileController::class
]);

Route::apiResource('books', BookController::class);


Route::get('/401',function(){
    return view('pages.401');
});

Route::get('/404',function(){
    return view('pages.404');
});
Route::get('/500',function(){
    return view('pages.500');
});
Route::get('/login',[loginController::class,'index'])->name('login');
Route::post('/login',[loginController::class,'login']);
Route::get('/logout',[logoutController::class,'logout'])->name('logout');
Route::get('/ventas/{venta}/factura', [App\Http\Controllers\VentaController::class, 'generarFactura'])->name('ventas.factura');
Route::get('/compras/{compra}/factura', [App\Http\Controllers\CompraController::class, 'generarFactura'])->name('compras.factura');

Route::get('/crear-admin', function () {
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('123456'),
    ]);
    return "Usuario admin creado!";
});

Route::get('/crear-admin', function () {
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('123456'),
    ]);
    return "Usuario admin creado!";
});

