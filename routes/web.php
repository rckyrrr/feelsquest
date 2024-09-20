<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\QOTDController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;


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

Route::get('/calendar',[CounselingController::class,'calender']);
Route::get('/createSession',[CounselingController::class,'callback']);
Route::get('/', function () {
    return view('user.Homepage');
});

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'login']);
Route::get('/registrasi',[LoginController::class, 'index']);
Route::post('/registrasi',[LoginController::class, 'registrasi']);
Route::get('/logout',[LoginController::class, 'logout']);
Route::post('/otp',[LoginController::class, 'otp']);
Route::post('/remove-session',[LoginController::class, 'removeSession']);

Route::get('/paket', [PackageController::class, 'index']);
Route::get('/test-mental',[TestController::class, 'index']);
Route::get('/konselor',[MenuController::class, 'konselor']);



Route::get('/gabung', function () {
    return view('user.Konselor_Gabung');
});

Route::get('/kontak', function () {
    return view('user.Kontak');
});

Route::get('/FAQ',[FaqController::class, 'index']);

Route::get('/tentang-kami',[MenuController::class, 'tentangKami']);



Route::get('/all', [TransactionController::class, 'getAllTransactions']);


Route::middleware('auth:web')->group(function () {
    /*  ==== USER === */
    /* Dashboard User */
    Route::get('/dashboard/user',[UserController::class, 'dashboard']);
    /* Tes Mental */
    Route::get('/test', [TestController::class, 'test']);
    Route::get('/tes-mental/user',[UserController::class, 'testMental']);
    Route::post('/test-store',[TestController::class, 'TestResultBai']);

    /* Konseling */
    Route::get('/konseling/user', [CounselingController::class, 'index']);
    Route::get('/konseling/paket', [CounselingController::class, 'paketKonseling']);
    Route::get('/konseling/jadwal', [CounselingController::class, 'jadwalKonseling']);
    Route::get('/konseling/user/detail', [CounselingController::class, 'detailKonseling']);
    Route::get('/konseling/pra-konseling', [CounselingController::class, 'praCounseling']);
    Route::post('/konseling/add-konseling', [CounselingController::class, 'create']);
    Route::post('/konseling/add-feedback', [CounselingController::class, 'feedbackUser']);

    /*Transaksi*/

    Route::get('/transaksi/user', [TransactionController::class, 'index']);
    Route::post('/transaksi/createInvoice', [TransactionController::class, 'createInvoice']);
    Route::get('/transaksi/payment', [TransactionController::class, 'invoice']);
    Route::get('/transaksi/payment-success', [TransactionController::class, 'payment_success']);
    Route::post('/useCoupon',[CouponController::class, 'useCoupon']);
    Route::post('/transaksi/cancel/{id}',[TransactionController::class, 'cancel']);
    Route::get('/transaksi/invoice/download/{uuid}',[TransactionController::class, 'generatePDF']);

    /*Profile User*/
    Route::get('/profile/user', [UserController::class, 'profile']);
    Route::get('/editprofile/user', [UserController::class, 'editProfile']);
    Route::post('/editedprofile/user', [UserController::class, 'editedProfile']);
});

    /*  ==== KONSELOR === */

Route::get('/dashboard/konselor', [CounselorController::class,'dashboard']);
Route::get('/konseling/konselor', [CounselorController::class,'konseling']);
Route::get('/konseling/konselor/sesi-konseling', [CounselorController::class,'sesiCounseling']);
Route::post('/konseling/konselor/end-konseling', [CounselorController::class,'endCounseling']);
Route::post('/konseling/konselor/add-evaluasi-konseling', [CounselorController::class,'addEvaluasiCounseling']);
Route::get('/konseling/konselor/evaluasi-konseling', [CounselorController::class,'evaluasiCounseling']);
Route::get('/konseling/konselor/detail-konseling', [CounselorController::class,'detailCounseling']);
Route::get('/tes-mental/konselor', [CounselorController::class,'test']);
Route::get('/tes-mental/konselor/perkembangan', [CounselorController::class,'perkembanganTest']);
Route::post('/tes-mental/konselor/perkembangan', [CounselorController::class,'addPerkembangan']);
Route::get('/tes-mental/konselor/hasil-tes', [CounselorController::class,'hasilTest']);
Route::post('/tes-mental/konselor/hasil-tes', [CounselorController::class,'addHasilTest']);
Route::get('/keuangan/konselor', [CounselorController::class,'keuanganCounselor']);
Route::get('/profile/konselor', [UserController::class, 'profile']);
Route::get('/editprofile/konselor', [UserController::class, 'editProfile']);
Route::post('/addJadwalSibuk', [CounselorController::class, 'addJadwalSibuk']);
Route::delete('/deleteJadwalSibuk/{id}', [CounselorController::class, 'deleteJadwalSibuk']);

/* === ADMIN === */
Route::get('/dashboard/admin',[AdminController::class, 'index']);
Route::get('/dashboard/superadmin',[AdminController::class, 'index']);
Route::get('/data-keuangan',[AdminController::class, 'dataFinancial']);
Route::get('/data-user',[AdminController::class, 'dataUser']);
Route::get('/data-website',[AdminController::class, 'dataWebsite']);
Route::get('/data-keuangan/data-transaksi',[AdminController::class, 'dataTransaksi']);
Route::get('/data-keuangan/data-gaji',[AdminController::class, 'dataKeuangan']);

Route::post('/addFeature',[FeatureController::class, 'addFeature']);
Route::post('/updateStatusFeature/{id}',[FeatureController::class, 'updateStatus']);
Route::post('/updateFeature/{id}',[FeatureController::class, 'updateFeature']);

Route::post('/addPackage',[PackageController::class, 'addPackage']);
Route::post('/updatePackage/{id}',[PackageController::class, 'updatePackage']);
Route::post('/deletePackage/{id}',[PackageController::class, 'updateStatus']);

Route::post('/addFaq',[FaqController::class, 'addFAQ']);
Route::post('/deleteFaq/{id}',[FaqController::class, 'deleteFAQ']);
Route::post('/updateFaq/{id}',[FaqController::class, 'updateFAQ']);

Route::post('/addQOTD',[QOTDController::class, 'addQOTD']);
Route::post('/deleteQOTD/{id}',[QOTDController::class, 'deleteQOTD']);
Route::post('/updateQOTD/{id}',[QOTDController::class, 'updateQOTD']);

Route::post('/addCoupon',[CouponController::class, 'addCoupon']);
Route::post('/updateCoupon/{id}',[CouponController::class, 'updateCoupon']);
Route::post('/deleteCoupon/{id}',[CouponController::class, 'deleteCoupon']);

Route::post('/addCounselor',[AdminController::class, 'addCounselor']);
Route::post('/updateCounselor/{id}',[AdminController::class, 'updateCounselor']);
Route::post('/addAdmin',[AdminController::class, 'addAdmin']);
Route::post('/updateAdmin/{id}',[AdminController::class, 'updateAdmin']);
Route::post('/inactiveUser/{id}',[AdminController::class, 'inactiveUser']);

Route::post('/editDataPerusahaan',[AdminController::class, 'EditDataPerusahaan']);

Route::post('/addTim',[AdminController::class, 'addTim']);
Route::put('/editTim/{id}',[AdminController::class, 'editTim']);
Route::delete('/deleteTim/{id}',[AdminController::class, 'deleteTim']);

/* ===== INVOICE ===== */
Route::get('/invoice', function () {
    return view('admin.Invoice');
});
