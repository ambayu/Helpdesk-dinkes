<?php

use App\Http\Controllers\pages\Page2;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\UserTeams;
use App\Http\Controllers\apps\AccessRoles;
use App\Http\Controllers\apps\CreateAdmin;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\apps\UserViewAccount;
use App\Http\Controllers\apps\AccessPermission;
use App\Http\Controllers\pages\front_pages\Landing;
use App\Http\Controllers\pages\front_pages\Layanan;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\pages\front_pages\HelpCenter;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\pages\front_pages\ListPermintaan;
use App\Http\Controllers\pages\front_pages\HelpCenterArticle;

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

// Main Page Route
Route::get('/', [Landing::class, 'index'])->name('index');
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// pages
Route::get('/pages/profile-teams', [UserTeams::class, 'index'])->name('pages-profile-teams');
Route::get('/pages/profile-user', [UserProfile::class, 'index'])->name('pages-profile-user');

//list permintaan
Route::get('/pages/list-permintaan', [ListPermintaan::class, 'index'])->name('list-permintaan');
Route::get('/pages/list-permintaan-selesai', [ListPermintaan::class, 'selesai'])->name('list-permintaan-selesai');
Route::get('/pages/list-permintaan-proses', [ListPermintaan::class, 'proses'])->name('list-permintaan-proses');
Route::get('/pages/list-permintaan-belum-proses', [ListPermintaan::class, 'belum'])->name('list-permintaan-belum');

//pergantian layanan
Route::get('/pages/page-pergantian-layanan', [ListPermintaan::class, 'pergantian'])->name('pergantian-layanan');
Route::get('/pages/page-permintaan', [ListPermintaan::class, 'permintaan'])->name('permintaan');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/auth/login-masuk', [LoginBasic::class, 'loginMasuk'])->name('auth-login-masuk');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');



//Front Pge

Route::get('/layanan/request_server', [Layanan::class, 'index'])->name('index');
Route::get('/front-pages/help-center', [HelpCenter::class, 'index'])->name('front-pages-help-center');
Route::get('/front-pages/help-center-article', [HelpCenterArticle::class, 'index'])->name('front-pages-help-center-article');


// super admin


//access role
Route::get('/app/access-roles', [AccessRoles::class, 'index'])->name('app-access-roles.index');
Route::post('/app/access-roles', [AccessRoles::class, 'store'])->name('app-access-roles.store');
Route::put('/app/access-roles/{role}', [AccessRoles::class, 'update'])->name('app-access-roles.update');
Route::put('/app/access-roles/{role}', [AccessRoles::class, 'update'])->name('app-access-roles.update');
Route::delete('/app/access-roles/{role}', [AccessRoles::class, 'destroy'])->name('app-access-roles.destroy');


//permission
Route::get('/app/access-permission', [AccessPermission::class, 'index'])->name('app-access-permission.index');
Route::post('/app/access-permission', [AccessPermission::class, 'store'])->name('app-access-permission.store');
Route::post('/app/access-permission/assigned/{permission}', [AccessPermission::class, 'assigned'])->name('app-access-permission.assigned');
Route::get('/app/access-permission-list', [AccessPermission::class, 'permissionList'])->name('app-access-permission.list');

Route::get('/app/access-permission-list/{permission}', [AccessPermission::class, 'getpermissionList'])->name('app-access-permission.list.get');
Route::delete('/app/access-permission-delete/{role}', [AccessPermission::class, 'destroy'])->name('app-access-permission.destroy');


//admin
Route::get('/app/create-admin', [CreateAdmin::class, 'index'])->name('create-admin.index');
Route::post('/app/create-admin', [CreateAdmin::class, 'store'])->name('create-admin.store');
Route::delete('/app/create-admin/delete/{role}', [CreateAdmin::class, 'destroy'])->name('create-admin.destroy');
Route::get('/app/create-admin/list', [CreateAdmin::class, 'adminList'])->name('create-admin.list');
Route::post('/app/create-admin/update-status', [CreateAdmin::class, 'updateStatus'])->name('create-admin.updateStatus');
Route::post('/app/create-admin/change-role/{user}', [CreateAdmin::class, 'changeRole'])->name('create-admin.change-role');
Route::get('/app/user/view/account/{user}', [UserViewAccount::class, 'index'])->name('app-user-view-account');

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
});
