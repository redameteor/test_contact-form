<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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
//お問い合わせフォーム 公開画面
Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts/thanks', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

//認証関連　/register /login は Fortify が自動生成

//管理画面 ログイン必須
Route::middleware('auth')->group(function (){
    Route::get('/admin', [ContactController::class, 'admin']);
    Route::get('/admin/reset', [ContactController::class, 'reset']);
    Route::post('/admin/delete', [ContactController::class, 'destroy']);
    Route::get('/admin/export', [ContactController::class, 'export']);
});