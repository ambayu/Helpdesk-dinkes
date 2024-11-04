<?php

use App\Http\Controllers\pages\Page2;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\UserTeams;
use App\Http\Controllers\apps\AccessRoles;
use App\Http\Controllers\apps\CreateAdmin;
use App\Http\Controllers\ResponController;
use App\Http\Controllers\apps\ChangeBidang;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\apps\CreateLayanan;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\apps\UserViewAccount;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PermintaanUbahBidang;
use App\Http\Controllers\apps\AccessPermission;
use App\Http\Controllers\apps\BidangController;
use App\Http\Controllers\authentications\LoginSSO;
use App\Http\Controllers\CaraPenggunaanController;
use App\Http\Controllers\pages\front_pages\Landing;
use App\Http\Controllers\pages\front_pages\Layanan;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\apps\BidangManageController;
use App\Http\Controllers\apps\CekPermintaanController;
use App\Http\Controllers\apps\LayananManageController;
use App\Http\Controllers\pages\front_pages\HelpCenter;
use App\Http\Controllers\authentications\RegisterBasic;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
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
Route::get('/', [Landing::class, 'index']);
Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');
Route::get('/cari-tiket/{tiket}', [HelpCenter::class, 'tiket'])->name('cari-tiket');


Route::get('/login', [LoginSSO::class, 'index'])->name('login');
Route::get('/login-admin', [LoginBasic::class, 'index'])->name('login-admin');
Route::post('/auth/login-masuk', [LoginBasic::class, 'loginMasuk'])->name('auth-login-masuk');
Route::get('/auth/login-masuk-sso', [LoginBasic::class, 'loginMasukSSO'])->name('auth-login-masuk-sso');
// Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

//layanan
Route::get('/layanan/{slug}', [Layanan::class, 'index'])->name('layanan.index');
Route::get('/syarat-layanan/{slug}', [Layanan::class, 'syarat_layanan'])->name('layanan.syarat_layanan');
Route::get('/bantuan-layanan/{slug}', [Layanan::class, 'bantuan_layanan'])->name('layanan.bantuan_layanan');
Route::post('/layanan', [Layanan::class, 'store'])->name('layanan.store');

Route::get('/front-pages/help-center', [HelpCenter::class, 'index'])->name('front-pages-help-center');
// Route::get('/front-pages/help-center-article', [HelpCenterArticle::class, 'index'])->name('front-pages-help-center-article');


Route::get('/front-pages/cara-penggunaan', [CaraPenggunaanController::class, 'index'])->name('front-pages-cara-penggunaan');



// authentication
Route::middleware(['auth'])->group(function () {

  //dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::post('/news', [DashboardController::class, 'store'])->name('news.store');

  // Profil
  Route::get('/pages/profile-teams', [UserTeams::class, 'index'])->name('pages-profile-teams')->middleware(['permission:view-team-profile']);
  Route::get('/pages/profile-user', [UserProfile::class, 'index'])->name('pages-profile-user')->middleware(['permission:view-user-profile']);
  Route::get('/pages/profile-edit', [UserProfile::class, 'edit'])->name('pages-profile-edit')->middleware(['permission:view-user-edit']);
  Route::post('/pages/profile-edit', [UserProfile::class, 'update'])->name('pages-profile-update')->middleware(['permission:view-user-edit']);

  //access role
  Route::get('/app/access-roles', [AccessRoles::class, 'index'])->name('app-access-roles.index')->middleware(['permission:view-roles']);
  Route::post('/app/access-roles', [AccessRoles::class, 'store'])->name('app-access-roles.store')->middleware(['permission:view-roles-create']);
  Route::put('/app/access-roles/{role}', [AccessRoles::class, 'update'])->name('app-access-roles.update')->middleware(['permission:view-roles-update']);
  Route::delete('/app/access-roles/{role}', [AccessRoles::class, 'destroy'])->name('app-access-roles.destroy')->middleware(['permission:view-roles-delete']);


  //permission
  Route::get('/app/access-permission', [AccessPermission::class, 'index'])->name('app-access-permission.index')->middleware(['permission:view-permissions']);
  Route::post('/app/access-permission', [AccessPermission::class, 'store'])->name('app-access-permission.store')->middleware(['permission:view-permissions-create']);
  Route::post('/app/access-permission/assigned/{permission}', [AccessPermission::class, 'assigned'])->name('app-access-permission.assigned')->middleware(['permission:view-permissions-update']);
  Route::delete('/app/access-permission-delete/{role}', [AccessPermission::class, 'destroy'])->name('app-access-permission.destroy')->middleware(['permission:view-permissions-delete']);
  //permission list
  Route::get('/app/access-permission-list', [AccessPermission::class, 'permissionList'])->name('app-access-permission.list');
  Route::get('/app/access-permission-list/{permission}', [AccessPermission::class, 'getpermissionList'])->name('app-access-permission.list.get');


  //admin
  Route::get('/app/create-admin', [CreateAdmin::class, 'index'])->name('app-admin-tambah.index')->middleware(['permission:create-admin']);
  Route::post('/app/create-admin', [CreateAdmin::class, 'store'])->name('create-admin.store')->middleware(['permission:create-admin']);
  Route::delete('/app/create-admin/delete/{role}', [CreateAdmin::class, 'destroy'])->name('create-admin.destroy')->middleware(['permission:create-admin']);
  Route::post('/app/create-admin/update-status', [CreateAdmin::class, 'updateStatus'])->name('create-admin.updateStatus')->middleware(['permission:create-admin']);
  Route::post('/app/create-admin/change-role/{user}', [CreateAdmin::class, 'changeRole'])->name('create-admin.change-role')->middleware(['permission:create-admin']);
  //admin list
  Route::get('/app/create-admin/list', [CreateAdmin::class, 'adminList'])->name('create-admin.list');
  Route::get('/app/user/view/account/{user}', [UserViewAccount::class, 'index'])->name('app-user-view-account');
  Route::post('/app/user/view/account/{user}', [UserViewAccount::class, 'update'])->name('app-user-view-account-update');


  //Create layanan
  Route::get('/app/create-layanan', [CreateLayanan::class, 'index'])->name('app-layanan-create-layanan.index')->middleware(['permission:create-service']);
  Route::post('/app/create-layanan', [CreateLayanan::class, 'store'])->name('create-layanan.store')->middleware(['permission:create-service']);
  //Create layanan list
  Route::get('/app/layanan/{slug}', [CreateLayanan::class, 'list'])->name('kirim-permintaan.list');
  Route::get('/app/layanan-api/{slug}', [CreateLayanan::class, 'list_api'])->name('kirim-permintaan.list-api');
  Route::post('/app/layanan/list', [CreateLayanan::class, 'list_store'])->name('create-layanan.list-store');
  Route::post('/app/layanan/list-edit/{id}', [CreateLayanan::class, 'list_edit_store'])->name('create-layanan.list-edit-store');
  Route::get('/app/layanan/list-hapus/{id}', [CreateLayanan::class, 'list_hapus_store'])->name('create-layanan.list-hapus-store');



  //kelola layanan
  Route::get('/app/syarat-layanan', [LayananManageController::class, 'syarat'])->name('app-layanan-kelola.syarat')->middleware(['permission:manage-service']);
  Route::get('/app/kelola-layanan', [LayananManageController::class, 'index'])->name('app-layanan-kelola.index')->middleware(['permission:create-service']);
  Route::put('/app/kelola-layanan/update/{menu}', [LayananManageController::class, 'update'])->name('kelola-layanan.update')->middleware(['permission:create-service']);
  Route::delete('/app/kelola-layanan/delete/{menu}', [LayananManageController::class, 'destroy'])->name('kelola-layanan.destroy')->middleware(['permission:create-service']);
  Route::post('/app/syarat-layanan', [LayananManageController::class, 'store'])->name('app-layanan-kelola.syarat-store')->middleware(['permission:manage-service']);

  //kelola layanan list
  Route::get('/app/kelola-layanan/list', [LayananManageController::class, 'list'])->name('kelola-layanan.list');
  Route::get('/app/syarat-layanan/list', [LayananManageController::class, 'list_syarat'])->name('kelola-layanan.list-syarat');
  Route::get('/app/syarat-layanan/list/{menu}', [LayananManageController::class, 'list_syarat_cari'])->name('kelola-layanan.list-syarat-cari');


  //tambah bidang
  Route::get('/app/create-bidang', [BidangController::class, 'index'])->name('app-bidang-tambah.index')->middleware(['permission:create-department']);
  Route::post('/app/create-bidang', [BidangController::class, 'store'])->name('create-bidang.store')->middleware(['permission:create-department']);
  Route::delete('/app/delete-bidang/{bidang}', [BidangController::class, 'destroy'])->name('delete-bidang.destroy')->middleware(['permission:create-department']);
  Route::post('/app/update-bidang/{bidang}', [BidangController::class, 'update'])->name('update-bidang.update')->middleware(['permission:create-department']);
  //bidang list
  Route::get('/app/bidang/list', [BidangController::class, 'list'])->name('create-bidang.list-store');
  Route::get('/app/bidang/list/{bidang}', [BidangController::class, 'cari_list'])->name('create-bidang.cari_list');


  //ubah bidang
  Route::get('/app/change-bidang', [ChangeBidang::class, 'index'])->name('app-bidang-ubah.index')->middleware(['permission:edit-department']);;
  Route::get('/app/change-bidang/list', [ChangeBidang::class, 'list'])->name('change-admin-bidang.list')->middleware(['permission:edit-department']);;
  Route::post('/app/change-bidang/update/{roleBidang}', [ChangeBidang::class, 'update'])->name('change-admin-bidang.update')->middleware(['permission:edit-department']);;



  //list permintaan
  Route::get('/pages/list-permintaan', [ListPermintaan::class, 'index'])->name('list-permintaan');
  Route::get('/pages/list-permintaan-selesai', [ListPermintaan::class, 'selesai'])->name('list-permintaan-selesai');
  Route::get('/pages/list-permintaan-proses', [ListPermintaan::class, 'proses'])->name('list-permintaan-proses');
  Route::get('/pages/list-permintaan-belum-proses', [ListPermintaan::class, 'belum'])->name('list-permintaan-belum');

  //pergantian layanan
  Route::get('/pages/page-pergantian-layanan', [ListPermintaan::class, 'pergantian'])->name('pergantian-layanan');
  Route::get('/pages/page-permintaan', [ListPermintaan::class, 'permintaan'])->name('permintaan');


  //permintaan ubah bidang
  Route::get('/app/permintaan-ubah-layanan', [PermintaanUbahBidang::class, 'index'])->name('app-layanan-permintaan-ubah-layanan.index');
  Route::post('/app/permintaan-ubah-layanan/change/{pindahBidang}', [PermintaanUbahBidang::class, 'change'])->name('permintaan-ubah-layanan.change');
  //list permintaan ubah bidang
  Route::get('/app/permintaan-ubah-layanan/list', [PermintaanUbahBidang::class, 'list'])->name('permintaan-ubah-layanan.list');




  //penilaian
  Route::get('/app/penilaian/', [PenilaianController::class, 'index'])->name('penilaian.index');
  Route::get('/app/penilaian/list', [PenilaianController::class, 'list'])->name('penilaian.list');
  //action penilaian
  Route::post('/app/penilaian/status', [PenilaianController::class, 'store'])->name('penilaian.store');

  //permintaan
  Route::get('/app/cek-permintaan/', [CekPermintaanController::class, 'index'])->name('cek-permintaan.index');
  Route::get('/app/cek-permintaan/{status}', [CekPermintaanController::class, 'status'])->name('cek-permintaan.status');
  Route::get('/app/cek-permintaan/cari/{tiket}', [CekPermintaanController::class, 'cari'])->name('cek-permintaan.cari');
  Route::post('/app/cek-permintaan/', [CekPermintaanController::class, 'search'])->name('cek-permintaan.search');
  Route::get('/app/cek-permintaan/search/{answer}', [CekPermintaanController::class, 'answer'])->name('cek-permintaan.answer');

  //action permintaan
  Route::post('/app/cek-permintaan/selesai/{answer}', [ResponController::class, 'selesai'])->name('cek-permintaan-selesai.store');
  Route::post('/app/cek-permintaan/penilaian/{answer}', [ResponController::class, 'penilaian'])->name('cek-permintaan-penilaian.store');
  Route::post('/app/cek-permintaan/respon/{answer}', [ResponController::class, 'store'])->name('cek-permintaan-respon.store');
  Route::post('/app/cek-permintaan/pindah/{answer}', [ResponController::class, 'pindah'])->name('cek-permintaan-pindah.store');

  //notifikasi
  Route::get('/notifikasi/{notif}', [NotifikasiController::class, 'view'])->name('notifikasi.view');
});

//wajib login
Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {});
