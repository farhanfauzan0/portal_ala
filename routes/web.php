<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Jurnalcontroller;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\VisimisiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
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



Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login/p', [AuthController::class, 'login_post'])->name('login.post');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('index');
    Route::get('profil/{type?}', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('profil/update/foto', [ProfilController::class, 'update_foto'])->name('profil.update.foto');

    Route::get('produk/{type?}', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('produk/insert', [ProdukController::class, 'insert'])->name('produk.insert');
    Route::post('produk/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('produk/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('produk/delete', [ProdukController::class, 'delete'])->name('produk.delete');

    Route::get('visi_misi/{type?}', [VisimisiController::class, 'index'])->name('visimisi.index');
    Route::post('visi_misi/post', [VisimisiController::class, 'post'])->name('visimisi.post');

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::post('order/insert', [OrderController::class, 'insert'])->name('order.insert');
    Route::post('order/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('order/update', [OrderController::class, 'update'])->name('order.update');
    Route::post('order/delete', [OrderController::class, 'delete'])->name('order.delete');

    Route::get('master/param', [MasterController::class, 'index'])->name('master.index');

    Route::post('master/p/pesanan', [MasterController::class, 'add_pesanan'])->name('master.add.pesanan');
    Route::post('master/edit/pesanan', [MasterController::class, 'edit_pesanan'])->name('master.edit.pesanan');
    Route::post('master/update/pesanan', [MasterController::class, 'update_pesanan'])->name('master.update.pesanan');
    Route::post('master/delete/pesanan', [MasterController::class, 'delete_pesanan'])->name('master.delete.pesanan');

    Route::post('master/p/status', [MasterController::class, 'add_status'])->name('master.add.status');
    Route::post('master/edit/status', [MasterController::class, 'edit_status'])->name('master.edit.status');
    Route::post('master/update/status', [MasterController::class, 'update_status'])->name('master.update.status');
    Route::post('master/delete/status', [MasterController::class, 'delete_status'])->name('master.delete.status');

    Route::post('master/p/deadline', [MasterController::class, 'add_deadline'])->name('master.add.deadline');
    Route::post('master/edit/deadline', [MasterController::class, 'edit_deadline'])->name('master.edit.deadline');
    Route::post('master/update/deadline', [MasterController::class, 'update_deadline'])->name('master.update.deadline');
    Route::post('master/delete/deadline', [MasterController::class, 'delete_deadline'])->name('master.delete.deadline');

    Route::post('master/p/journal', [MasterController::class, 'add_journal'])->name('master.add.journal');
    Route::post('master/edit/journal', [MasterController::class, 'edit_journal'])->name('master.edit.journal');
    Route::post('master/update/journal', [MasterController::class, 'update_journal'])->name('master.update.journal');
    Route::post('master/delete/journal', [MasterController::class, 'delete_journal'])->name('master.delete.journal');

    Route::get('invoice/n', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('invoice/setting', [InvoiceController::class, 'index_setting'])->name('invoice.setting.index');
    Route::post('invoice/setting/p', [InvoiceController::class, 'setting_post'])->name('invoice.setting.post');
    Route::post('invoice/submit/p', [InvoiceController::class, 'submit_invoice'])->name('invoice.submit.post');

    Route::get('journal', [Jurnalcontroller::class, 'index'])->name('journal.index');
    Route::post('journal/insert', [Jurnalcontroller::class, 'insert'])->name('journal.insert');
    Route::post('journal/edit', [Jurnalcontroller::class, 'edit'])->name('journal.edit');
    Route::post('journal/update', [Jurnalcontroller::class, 'update'])->name('journal.update');
    Route::post('journal/delete', [Jurnalcontroller::class, 'delete'])->name('journal.delete');

    Route::get('/logout', function () {
        Auth::guard('web')->logout();
        return redirect()->route('index');
    })->name('logout');
});


Route::get('/test', function () {
    DB::table('users')->insert([
        'name' => 'admin',
        'password' => Hash::make('P@ssw0rd'),
        'username' => 'admin'
    ]);
});
