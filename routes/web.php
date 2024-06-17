<?php
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QrTagController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'approved'])->group(function () {
    //main page connect route
    Route::get('/index', [IndexController::class, 'index'])->name('index');
    //患者検索画面
    Route::get('/kanja-list', [CustomerController::class, 'customerIndex'])->name('kanja-list');
    //検索機能
    Route::get('kanja-search', [CustomerController::class, 'customerSearch'])->name('kanja-search');
    //患者登録画面
    Route::get('/kanja-create', [CustomerController::class, 'customerCreate'])->name('kanja-create');
    //create機能
    Route::get('/kanja-create', [CustomerController::class, 'customerCreate'])->name('kanja.create');
    Route::post('/kanja-store', [CustomerController::class, 'customerStore'])->name('kanja.store');
    //csv一括登録
    Route::get('/csv-page', [MasterController::class, 'csvPage'])->name('csv-page');
    //csv一括登録機能
    Route::post('/csv-upload', [MasterController::class, 'csvUpload'])->name('csv-upload');
    //修正機能
    Route::get('/kanja-edit/{customer_no}', [CustomerController::class, 'customerEdit'])->name('kanja.edit');
    Route::post('/kanja-update/{customer_no}', [CustomerController::class, 'customerUpdate'])->name('kanja.update');
    //詳細画面
    Route::get('/kanja-show/{customer_no}', [CustomerController::class, 'customerShow'])->name('kanja.show');
    //コメント機能
    Route::post('/kanja-show/{customer_no}/comment', [CustomerController::class, 'addComment'])->name('kanja.comment');
    // sort機能
    Route::get('/kanja-sort', [CustomerController::class, 'customerSort'])->name('kanja.sort');
    //イメージアップロード画面
    Route::get('/image-upload', [FacilitiesController::class, 'imageUploadIndex'])->name('image-upload');
    Route::post('/image-toroku', [FacilitiesController::class, 'imageToroku'])->name('image-toroku');
    Route::delete('/image-delete', [FacilitiesController::class, 'imageDelete'])->name('image-delete');
    //Master一覧画面
    Route::get('/master', [MasterController::class, 'MasterViewIndex']);
    Route::post('/master/values', [MasterController::class, 'getValuesByMasterName']);
    //ユーザー一覧画面
    Route::get('/user-info', [UserController::class, 'userIndex'])->name('user-info');
    //ユーザー承認画面
    Route::get('/user-approval', [UserController::class, 'userApproval'])->name('user-approval');
    Route::post('/user-approval-registration/{id}', [UserController::class, 'userApprovalRegistration'])->name('user-approval-registration');
    Route::get('/ward-manager', [UserController::class, 'wardManager'])->name('ward-manager');
    Route::get('/revoke-permission/{id}', [UserController::class, 'revokePermission'])->name('revoke-permission');
    //病棟管理者画面
    Route::post('/ward-update/{id}', [UserController::class, 'updateWard'])->name('ward-update');
    Route::get('/ward-manager/{id}', [UserController::class, 'getWardManager']);
    //QRタグ画面
    Route::get('/qr-tag', [QrTagController::class, 'QrPageIndex'])->name('qr-tag');
});