<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\ExpenseReportsController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainersController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SIPController;
use App\Http\Controllers\NotificationController;
use AzisHapidin\IndoRegion\IndoRegion;


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

/** for side bar menu active */
function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('auth.login');
});

/** Auth MultiLevel */
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home',function() {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::patch('/update-tema/{id}', 'updateTemaAplikasi')->name('updateTemaAplikasi');
    Route::get('/notifikasi/dibaca/{id}', 'bacaNotifikasi')->name('notifikasi.dibaca');
    Route::post('/notifikasi/dibaca/semua', 'bacasemuaNotifikasi')->name('notifikasi.dibaca-semua');
    Route::get('/ulangtahun', 'ulangtahun')->name('ulangtahun');
    Route::get('/masaberlakusip', 'masaberlakuSIP')->name('masaberlakusip');
    Route::get('/masaberlakuspkdokter', 'masaberlakuSPKDokter')->name('masaberlakuspkdokter');
    Route::get('/masaberlakuspkperawat', 'masaberlakuSPKPerawat')->name('masaberlakuspkperawat');
    Route::get('/masaberlakuspknakeslain', 'masaberlakuSPKNakesLain')->name('masaberlakuspknakeslain');
});

// -----------------------------settings-------------------------------------//
Route::controller(SettingController::class)->group(function () {
    /** index page */
    Route::get('pengaturan/perusahaan', 'companySettings')->middleware('auth')->name('pengaturan-perusahaan');
    Route::post('pengaturan/perusahaan/save', 'saveRecord')->middleware('auth')->name('pengaturan-perusahaan-save');
    /** save record or update */
    Route::get('roles/permissions/page', 'rolesPermissions')->middleware('auth')->name('roles/permissions/page');
    Route::post('roles/permissions/save', 'addRecord')->middleware('auth')->name('roles/permissions/save');
    Route::post('roles/permissions/update', 'editRolesPermissions')->middleware('auth')->name('roles/permissions/update');
    Route::post('roles/permissions/delete', 'deleteRolesPermissions')->middleware('auth')->name('roles/permissions/delete');
    Route::get('localization/page', 'localizationIndex')->middleware('auth')->name('localization/page');
    /** index page localization */
    Route::get('salary/settings/page', 'salarySettingsIndex')->middleware('auth')->name('salary/settings/page');
    /** index page salary settings */
    Route::get('email/settings/page', 'emailSettingsIndex')->middleware('auth')->name('email/settings/page');
    /** index page email settings */
});

// -----------------------------login----------------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// ----------------------------- lock screen --------------------------------//
Route::controller(LockScreen::class)->group(function () {
    Route::get('lock_screen', 'lockScreen')->middleware('auth')->name('lock_screen');
    Route::post('unlock', 'unlock')->name('unlock');
});

// ------------------------------ register ----------------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('register');
});

// ----------------------------- forget password ----------------------------//
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('lupa-kata-sandi', 'getEmail')->name('lupa-kata-sandi');
    Route::post('lupa-kata-sandi', 'postEmail')->name('lupa-kata-sandi');    
});

// ----------------------------- reset password -----------------------------//
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('ubah-kata-sandi/{token}', 'getPassword')->name('ubah-kata-sandi');
    Route::post('ubah-kata-sandi', 'updatePassword')->name('ubah-kata-sandi');
});

// ----------------------------- manage users ------------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('user/profile', 'user_profile')->middleware('auth')->name('user-profile');
    Route::post('/getkotakabupaten', 'getkotakabupaten')->name('getkotakabupaten');
    Route::post('/getkecamatan', 'getkecamatan')->name('getkecamatan');
    Route::post('/getdesakelurahan', 'getdesakelurahan')->name('getdesakelurahan');
    Route::get('admin/profile', 'admin_profile')->middleware('auth')->name('admin-profile');
    Route::get('super-admin/profile', 'superadmin_profile')->middleware('auth')->name('super-admin-profile');
    Route::get('kepala-ruangan/profile', 'kepalaruangan_profile')->middleware('auth')->name('kepala-ruangan-profile');
    Route::post('profile/information/save', 'profileInformation')->name('profile/information/save');
    Route::post('profile/information/save2', 'profileInformation2')->name('profile/information/save2');
    Route::post('profile/information/foto/save', 'fotoProfile')->name('profile/information/foto/save');
    Route::get('manajemen/pengguna', 'index')->middleware('auth')->name('manajemen-pengguna');
    Route::post('user/add/save', 'addNewUserSave')->name('user/add/save');
    Route::post('update', 'update')->name('update');
    Route::post('user/delete', 'delete')->middleware('auth')->name('user/delete');
    Route::get('riwayat/aktivitas', 'activityLog')->middleware('auth')->name('riwayat-aktivitas');
    Route::get('riwayat/aktivitas/otentikasi', 'activityLogInLogOut')->middleware('auth')->name('riwayat-aktivitas-otentikasi');
    Route::get('admin/kata-sandi', 'changePasswordView')->middleware('auth')->name('admin-kata-sandi');
    Route::get('super-admin/kata-sandi', 'changePasswordView')->middleware('auth')->name('super-admin-kata-sandi');
    Route::get('kepala-ruangan/kata-sandi', 'changePasswordView')->middleware('auth')->name('kepala-ruangan-kata-sandi');
    Route::get('user/kata-sandi', 'changePasswordView')->middleware('auth')->name('user-kata-sandi');
    Route::post('change/password/db', 'changePasswordDB')->name('change/password/db');
    Route::post('user/profile/pegawai/add', 'profilePegawaiAdd')->name('user/profile/pegawai/add');
    Route::post('user/profile/pegawai/edit', 'profilePegawaiEdit')->name('user/profile/pegawai/edit');
    Route::post('user/profile/posisi/jabatan/add', 'posisiJabatanAdd')->name('user/profile/posisi/jabatan/add');
    Route::post('user/profile/posisi/jabatan/edit', 'posisiJabatanEdit')->name('user/profile/posisi/jabatan/edit');
    Route::get('get-users-data', 'getUsersData')->name('get-users-data');
    Route::post('user/profile/upload-ktp', 'uploadDokumenKTP')->name('user/profile/upload-ktp');
});

// --------------------------------- job ---------------------------------//
Route::controller(JobController::class)->group(function () {
    Route::get('form/job/list', 'jobList')->name('form/job/list');
    Route::get('form/job/view/{id}', 'jobView');
    Route::get('user/dashboard/index', 'userDashboard')->middleware('auth')->name('user/dashboard/index');
    Route::get('jobs/dashboard/index', 'jobsDashboard')->middleware('auth')->name('jobs/dashboard/index');
    Route::get('user/dashboard/all', 'userDashboardAll')->middleware('auth')->name('user/dashboard/all');
    Route::get('user/dashboard/save', 'userDashboardSave')->middleware('auth')->name('user/dashboard/save');
    Route::get('user/dashboard/applied/jobs', 'userDashboardApplied')->middleware('auth')->name('user/dashboard/applied/jobs');
    Route::get('user/dashboard/interviewing', 'userDashboardInterviewing')->middleware('auth')->name('user/dashboard/interviewing');
    Route::get('user/dashboard/offered/jobs', 'userDashboardOffered')->middleware('auth')->name('user/dashboard/offered/jobs');
    Route::get('user/dashboard/visited/jobs', 'userDashboardVisited')->middleware('auth')->name('user/dashboard/visited/jobs');
    Route::get('user/dashboard/archived/jobs', 'userDashboardArchived')->middleware('auth')->name('user/dashboard/archived/jobs');
    Route::get('jobs', 'Jobs')->middleware('auth')->name('jobs');
    Route::get('job/applicants/{job_title}', 'jobApplicants')->middleware('auth');
    Route::get('job/details/{id}', 'jobDetails')->middleware('auth');
    Route::get('cv/download/{id}', 'downloadCV')->middleware('auth');

    Route::post('form/jobs/save', 'JobsSaveRecord')->name('form/jobs/save');
    Route::post('form/apply/job/save', 'applyJobSaveRecord')->name('form/apply/job/save');
    Route::post('form/apply/job/update', 'applyJobUpdateRecord')->name('form/apply/job/update');

    Route::get('page/manage/resumes', 'manageResumesIndex')->middleware('auth')->name('page/manage/resumes');
    Route::get('page/shortlist/candidates', 'shortlistCandidatesIndex')->middleware('auth')->name('page/shortlist/candidates');
    Route::get('page/interview/questions', 'interviewQuestionsIndex')->middleware('auth')->name('page/interview/questions'); // view page
    Route::post('save/category', 'categorySave')->name('save/category'); // save record category
    Route::post('save/questions', 'questionSave')->name('save/questions'); // save record questions
    Route::post('questions/update', 'questionsUpdate')->name('questions/update'); // update question
    Route::post('questions/delete', 'questionsDelete')->middleware('auth')->name('questions/delete'); // delete question
    Route::get('page/offer/approvals', 'offerApprovalsIndex')->middleware('auth')->name('page/offer/approvals');
    Route::get('page/experience/level', 'experienceLevelIndex')->middleware('auth')->name('page/experience/level');
    Route::get('page/candidates', 'candidatesIndex')->middleware('auth')->name('page/candidates');
    Route::get('page/schedule/timing', 'scheduleTimingIndex')->middleware('auth')->name('page/schedule/timing');
    Route::get('page/aptitude/result', 'aptituderesultIndex')->middleware('auth')->name('page/aptitude/result');

    Route::post('jobtypestatus/update', 'jobTypeStatusUpdate')->name('jobtypestatus/update'); // update status job type ajax

});

// ---------------------------- form employee ---------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('daftar/pegawai/card', 'cardAllEmployee')->middleware('auth')->name('daftar/pegawai/card');
    Route::get('daftar/pegawai/list', 'listAllEmployee')->middleware('auth')->name('daftar/pegawai/list');
    Route::get('daftar/pegawai/pensiun/card', 'cardPensiun')->middleware('auth')->name('daftar/pegawai/pensiun/card');
    Route::post('daftar/pegawai/pensiun/card/search', 'searchpegawaipensiunCard')->middleware('auth')->name('daftar/pegawai/pensiun/card/search');
    Route::get('daftar/pegawai/pensiun/list', 'listPensiun')->middleware('auth')->name('daftar/pegawai/pensiun/list');
    Route::post('daftar/pegawai/pensiun/list/search', 'searchpegawaipensiunList')->middleware('auth')->name('daftar/pegawai/pensiun/list/search');
    Route::get('daftar/ruangan/pegawai/card', 'cardRuangan')->middleware('auth')->name('daftar/ruangan/pegawai/card');
    Route::get('daftar/ruangan/pegawai/list', 'listRuangan')->middleware('auth')->name('daftar/ruangan/pegawai/list');
    Route::post('daftar/pegawai/save', 'saveRecord')->middleware('auth')->name('daftar/pegawai/save');
    Route::get('daftar/pegawai/view/edit/{employee_id}', 'viewRecord');
    Route::post('daftar/pegawai/update', 'updateRecord')->middleware('auth')->name('daftar/pegawai/update');
    Route::get('daftar/pegawai/delete/{employee_id}', 'deleteRecord')->middleware('auth');
    Route::post('daftar/pegawai/search', 'employeeSearch')->name('daftar/pegawai/search');
    Route::post('daftar/ruangan/pegawai/card/search', 'employeeCardSearchRuangan')->name('daftar/ruangan/pegawai/card/search');
    Route::post('daftar/ruangan/pegawai/list/search', 'employeeListSearchRuangan')->name('daftar/ruangan/pegawai/list/search');
    Route::post('daftar/pegawai/list/search', 'employeeListSearch')->name('daftar/pegawai/list/search');
    Route::post('daftar/pegawai/card/search', 'employeeCardSearch')->name('daftar/pegawai/card/search');
    Route::get('form/departments/page', 'index')->middleware('auth')->name('form/departments/page');
    Route::post('form/departments/save', 'saveRecordDepartment')->middleware('auth')->name('form/departments/save');
    Route::post('form/department/update', 'updateRecordDepartment')->middleware('auth')->name('form/department/update');
    Route::post('form/department/delete', 'deleteRecordDepartment')->middleware('auth')->name('form/department/delete');
    Route::get('referensi/agama', 'indexAgama')->middleware('auth')->name('referensi-agama');
    Route::get('get-agama-data', 'getAgamaData')->name('get-agama-data');
    Route::post('form/agama/save', 'saveRecordAgama')->middleware('auth')->name('form/agama/save');
    Route::post('form/agama/update', 'updateRecordAgama')->middleware('auth')->name('form/agama/update');
    Route::post('form/agama/delete', 'deleteRecordAgama')->middleware('auth')->name('form/agama/delete');
    Route::get('form/agama/search', 'searchAgama')->middleware('auth')->name('form/agama/search');

    Route::get('referensi/kedudukan', 'indexKedudukan')->middleware('auth')->name('referensi-kedudukan');
    Route::get('get-kedudukan-data', 'getKedudukanData')->name('get-kedudukan-data');
    Route::post('form/kedudukan/save', 'saveRecordKedudukan')->middleware('auth')->name('form/kedudukan/save');
    Route::post('form/kedudukan/update', 'updateRecordKedudukan')->middleware('auth')->name('form/kedudukan/update');
    Route::post('form/kedudukan/delete', 'deleteRecordKedudukan')->middleware('auth')->name('form/kedudukan/delete');
    Route::get('form/kedudukan/search', 'searchKedudukan')->middleware('auth')->name('form/kedudukan/search');

    Route::get('referensi/pendidikan', 'indexPendidikan')->middleware('auth')->name('referensi-pendidikan');
    Route::get('get-pendidikan-data', 'getPendidikanData')->name('get-pendidikan-data');
    Route::post('form/pendidikan/save', 'saveRecordPendidikan')->middleware('auth')->name('form/pendidikan/save');
    Route::post('form/pendidikan/update', 'updateRecordPendidikan')->middleware('auth')->name('form/pendidikan/update');
    Route::post('form/pendidikan/delete', 'deleteRecordPendidikan')->middleware('auth')->name('form/pendidikan/delete');
    Route::get('form/pendidikan/search', 'searchPendidikan')->middleware('auth')->name('form/pendidikan/search');

    Route::get('referensi/unit/organisasi', 'indexUnitOrganisasi')->middleware('auth')->name('referensi-unit-organisasi');
    Route::post('form/unitorganisasi/save', 'saveRecordUnitOrganisasi')->middleware('auth')->name('form/unitorganisasi/save');
    Route::post('form/unitorganisasi/update', 'updateRecordUnitOrganisasi')->middleware('auth')->name('form/unitorganisasi/update');
    Route::post('form/unitorganisasi/delete', 'deleteRecordUnitOrganisasi')->middleware('auth')->name('form/unitorganisasi/delete');
    // Route::get('form/unitorganisasi/search', 'searchPendidikan')->middleware('auth')->name('form/unitorganisasi/search');

    Route::get('referensi/ruangan', 'indexRuangan')->middleware('auth')->name('referensi-ruangan');
    Route::get('get-ruangan-data', 'getRuanganData')->name('get-ruangan-data');
    Route::post('form/ruangan/save', 'saveRecordRuangan')->middleware('auth')->name('form/ruangan/save');
    Route::post('form/ruangan/update', 'updateRecordRuangan')->middleware('auth')->name('form/ruangan/update');
    Route::post('form/ruangan/delete', 'deleteRecordRuangan')->middleware('auth')->name('form/ruangan/delete');
    Route::get('form/ruangan/search', 'searchRuangan')->middleware('auth')->name('form/ruangan/search');
    Route::get('referensi/sumpah', 'indexSumpah')->middleware('auth')->name('referensi-sumpah');
    Route::get('get-sumpah-data', 'getSumpahData')->name('get-sumpah-data');
    Route::post('form/sumpah/save', 'saveRecordSumpah')->middleware('auth')->name('form/sumpah/save');
    Route::post('form/sumpah/update', 'updateRecordSumpah')->middleware('auth')->name('form/sumpah/update');
    Route::post('form/sumpah/delete', 'deleteRecordSumpah')->middleware('auth')->name('form/sumpah/delete');
    Route::get('form/sumpah/search', 'searchSumpah')->middleware('auth')->name('form/sumpah/search');

    Route::get('referensi/status', 'indexStatus')->middleware('auth')->name('referensi-status');
    Route::get('get-status-data', 'getStatusData')->name('get-status-data');
    Route::post('form/status/save', 'saveRecordStatus')->middleware('auth')->name('form/status/save');
    Route::post('form/status/update', 'updateRecordStatus')->middleware('auth')->name('form/status/update');
    Route::post('form/status/delete', 'deleteRecordStatus')->middleware('auth')->name('form/status/delete');
    Route::get('form/status/search', 'searchStatus')->middleware('auth')->name('form/status/search');

    Route::get('referensi/pangkat', 'indexGolongan')->middleware('auth')->name('referensi-pangkat');
    Route::get('get-golongan-data', 'getGolonganData')->name('get-golongan-data');
    Route::post('form/golongan/save', 'saveRecordGolongan')->middleware('auth')->name('form/golongan/save');
    Route::post('form/golongan/update', 'updateRecordGolongan')->middleware('auth')->name('form/golongan/update');
    Route::post('form/golongan/delete', 'deleteRecordGolongan')->middleware('auth')->name('form/golongan/delete');
    Route::get('form/golongan/search', 'searchGolongan')->middleware('auth')->name('form/golongan/search');
});

// ------------------------- profile employee --------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('user/profile/{user_id}', 'profileEmployee')->middleware('auth');
    Route::post('/getkota', 'getkota')->name('getkota');
    Route::post('/getkecamatan_employee', 'getkecamatan_employee')->name('getkecamatan_employee');
    Route::post('/getkelurahan', 'getkelurahan')->name('getkelurahan');
});

// --------------------------- form holiday ---------------------------//
Route::controller(HolidayController::class)->group(function () {
    Route::get('form/holidays/new', 'holiday')->middleware('auth')->name('form/holidays/new');
    Route::post('form/holidays/save', 'saveRecord')->middleware('auth')->name('form/holidays/save');
    Route::post('form/holidays/update', 'updateRecord')->middleware('auth')->name('form/holidays/update');
});

// -------------------------- form leaves ----------------------------//
Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leaves/new', 'leaves')->middleware('auth')->name('form/leaves/new');
    Route::get('form/leavesemployee/new', 'leavesEmployee')->middleware('auth')->name('form/leavesemployee/new');
    Route::post('form/leaves/save', 'saveRecord')->middleware('auth')->name('form/leaves/save');
    Route::post('form/leaves/edit', 'editRecordLeave')->middleware('auth')->name('form/leaves/edit');
    Route::post('form/leaves/edit/delete', 'deleteLeave')->middleware('auth')->name('form/leaves/edit/delete');
});

// ------------------------ form attendance  -------------------------//
Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leavesettings/page', 'leaveSettings')->middleware('auth')->name('form/leavesettings/page');
    Route::get('attendance/page', 'attendanceIndex')->middleware('auth')->name('attendance/page');
    Route::get('attendance/employee/page', 'AttendanceEmployee')->middleware('auth')->name('attendance/employee/page');
    Route::get('form/shiftscheduling/page', 'shiftScheduLing')->middleware('auth')->name('form/shiftscheduling/page');
    Route::get('form/shiftlist/page', 'shiftList')->middleware('auth')->name('form/shiftlist/page');
});

// ------------------------ form payroll  ----------------------------//
Route::controller(PayrollController::class)->group(function () {
    Route::get('form/salary/page', 'salary')->middleware('auth')->name('form/salary/page');
    Route::post('form/salary/save', 'saveRecord')->middleware('auth')->name('form/salary/save');
    Route::post('form/salary/update', 'updateRecord')->middleware('auth')->name('form/salary/update');
    Route::post('form/salary/delete', 'deleteRecord')->middleware('auth')->name('form/salary/delete');
    Route::get('form/salary/view/{user_id}', 'salaryView')->middleware('auth');
    Route::get('form/payroll/items', 'payrollItems')->middleware('auth')->name('form/payroll/items');
    Route::get('extra/report/pdf', 'reportPDF')->middleware('auth');
});

// ---------------------------- reports  ----------------------------//
Route::controller(ExpenseReportsController::class)->group(function () {
    Route::get('form/expense/reports/page', 'index')->middleware('auth')->name('form/expense/reports/page');
    Route::get('form/invoice/reports/page', 'invoiceReports')->middleware('auth')->name('form/invoice/reports/page');
    Route::get('form/daily/reports/page', 'dailyReport')->middleware('auth')->name('form/daily/reports/page');
    Route::get('form/leave/reports/page', 'leaveReport')->middleware('auth')->name('form/leave/reports/page');
    Route::get('form/payments/reports/page', 'paymentsReportIndex')->middleware('auth')->name('form/payments/reports/page');
    Route::get('form/employee/reports/page', 'employeeReportsIndex')->middleware('auth')->name('form/employee/reports/page');
});

// --------------------------- performance  -------------------------//
Route::controller(PerformanceController::class)->group(function () {
    Route::get('form/performance/indicator/page', 'index')->middleware('auth')->name('form/performance/indicator/page');
    Route::get('form/performance/page', 'performance')->middleware('auth')->name('form/performance/page');
    Route::get('form/performance/appraisal/page', 'performanceAppraisal')->middleware('auth')->name('form/performance/appraisal/page');
    Route::post('form/performance/indicator/save', 'saveRecordIndicator')->middleware('auth')->name('form/performance/indicator/save');
    Route::post('form/performance/indicator/delete', 'deleteIndicator')->middleware('auth')->name('form/performance/indicator/delete');
    Route::post('form/performance/indicator/update', 'updateIndicator')->middleware('auth')->name('form/performance/indicator/update');
    Route::post('form/performance/appraisal/save', 'saveRecordAppraisal')->middleware('auth')->name('form/performance/appraisal/save');
    Route::post('form/performance/appraisal/update', 'updateAppraisal')->middleware('auth')->name('form/performance/appraisal/update');
    Route::post('form/performance/appraisal/delete', 'deleteAppraisal')->middleware('auth')->name('form/performance/appraisal/delete');
});

// --------------------------- training  ----------------------------//
Route::controller(TrainingController::class)->group(function () {
    Route::get('form/training/list/page', 'index')->middleware('auth')->name('form/training/list/page');
    Route::post('form/training/save', 'addNewTraining')->middleware('auth')->name('form/training/save');
    Route::post('form/training/delete', 'deleteTraining')->middleware('auth')->name('form/training/delete');
    Route::post('form/training/update', 'updateTraining')->middleware('auth')->name('form/training/update');
});

// --------------------------- trainers  ----------------------------//
Route::controller(TrainersController::class)->group(function () {
    Route::get('form/trainers/list/page', 'index')->middleware('auth')->name('form/trainers/list/page');
    Route::post('form/trainers/save', 'saveRecord')->middleware('auth')->name('form/trainers/save');
    Route::post('form/trainers/update', 'updateRecord')->middleware('auth')->name('form/trainers/update');
    Route::post('form/trainers/delete', 'deleteRecord')->middleware('auth')->name('form/trainers/delete');
});

// ------------------------- training type  -------------------------//
Route::controller(TrainingTypeController::class)->group(function () {
    Route::get('form/training/type/list/page', 'index')->middleware('auth')->name('form/training/type/list/page');
    Route::post('form/training/type/save', 'saveRecord')->middleware('auth')->name('form/training/type/save');
    Route::post('form//training/type/update', 'updateRecord')->middleware('auth')->name('form//training/type/update');
    Route::post('form//training/type/delete', 'deleteTrainingType')->middleware('auth')->name('form//training/type/delete');
});

// ----------------------------- sales  ----------------------------//
Route::controller(SalesController::class)->group(function () {

    // -------------------- estimate  -------------------//
    Route::get('form/estimates/page', 'estimatesIndex')->middleware('auth')->name('form/estimates/page');
    Route::get('create/estimate/page', 'createEstimateIndex')->middleware('auth')->name('create/estimate/page');
    Route::get('edit/estimate/{estimate_number}', 'editEstimateIndex')->middleware('auth');
    Route::get('estimate/view/{estimate_number}', 'viewEstimateIndex')->middleware('auth');

    Route::post('create/estimate/save', 'createEstimateSaveRecord')->middleware('auth')->name('create/estimate/save');
    Route::post('create/estimate/update', 'EstimateUpdateRecord')->middleware('auth')->name('create/estimate/update');
    Route::post('estimate_add/delete', 'EstimateAddDeleteRecord')->middleware('auth')->name('estimate_add/delete');
    Route::post('estimate/delete', 'EstimateDeleteRecord')->middleware('auth')->name('estimate/delete');
    // ---------------------- payments  ---------------//
    Route::get('payments', 'Payments')->middleware('auth')->name('payments');
    Route::get('expenses/page', 'Expenses')->middleware('auth')->name('expenses/page');
    Route::post('expenses/save', 'saveRecord')->middleware('auth')->name('expenses/save');
    Route::post('expenses/update', 'updateRecord')->middleware('auth')->name('expenses/update');
    Route::post('expenses/delete', 'deleteRecord')->middleware('auth')->name('expenses/delete');
    // ---------------------- search expenses  ---------------//
    Route::get('expenses/search', 'searchRecord')->middleware('auth')->name('expenses/search');
    Route::post('expenses/search', 'searchRecord')->middleware('auth')->name('expenses/search');
});

// ----------------------- training type  --------------------------//
Route::controller(PersonalInformationController::class)->group(function () {
    Route::post('user/information/save', 'saveRecord')->middleware('auth')->name('user/information/save');
});

// ----------------------- rekapitulasi  --------------------------//
Route::controller(RekapitulasiController::class)->group(function () {
    Route::get('rekapitulasi', 'index')->middleware('auth')->name('rekapitulasi');
});

// ----------------------- Informasi Riwayat Pendidikan --------------------------//
Route::middleware(['auth'])->group(function () {
    Route::get('riwayat/pendidikan', [RiwayatController::class, 'pendidikan'])->name('riwayat-pendidikan');
    Route::post('riwayat/pendidikan/tambah-data', [RiwayatController::class, 'tambahRiwayatPendidikan'])->name('riwayat/pendidikan/tambah-data');
    Route::post('riwayat/pendidikan/edit-data', [RiwayatController::class, 'editRiwayatPendidikan'])->name('riwayat/pendidikan/edit-data');
    Route::post('riwayat/pendidikan/hapus-data', [RiwayatController::class, 'hapusRiwayatPendidikan'])->name('riwayat/pendidikan/hapus-data');
    Route::get('riwayat/pendidikan/cari', [RiwayatController::class, 'searchRiwayatPendidikan'])->name('riwayat/pendidikan/cari');

    // ----------------------- Informasi Riwayat Golongan --------------------------//
    Route::get('riwayat/golongan', [RiwayatController::class, 'golongan'])->name('riwayat-golongan');
    Route::post('riwayat/golongan/tambah-data', [RiwayatController::class, 'tambahRiwayatGolongan'])->name('riwayat/golongan/tambah-data');
    Route::post('riwayat/golongan/edit-data', [RiwayatController::class, 'editRiwayatGolongan'])->name('riwayat/golongan/edit-data');
    Route::post('riwayat/golongan/hapus-data', [RiwayatController::class, 'hapusRiwayatGolongan'])->name('riwayat/golongan/hapus-data');
    Route::get('riwayat/golongan/cari', [RiwayatController::class, 'searchRiwayatGolongan'])->name('riwayat/golongan/cari');

    // ----------------------- Informasi Riwayat Jabatan --------------------------//
    Route::get('riwayat/jabatan', [RiwayatController::class, 'jabatan'])->name('riwayat-jabatan');
    Route::post('riwayat/jabatan/tambah-data', [RiwayatController::class, 'tambahRiwayatJabatan'])->name('riwayat/jabatan/tambah-data');
    Route::post('riwayat/jabatan/edit-data', [RiwayatController::class, 'editRiwayatJabatan'])->name('riwayat/jabatan/edit-data');
    Route::post('riwayat/jabatan/hapus-data', [RiwayatController::class, 'hapusRiwayatJabatan'])->name('riwayat/jabatan/hapus-data');
    Route::get('riwayat/jabatan/cari', [RiwayatController::class, 'searchRiwayatJabatan'])->name('riwayat/jabatan/cari');

    // ----------------------- Informasi Riwayat Diklat --------------------------//
    Route::get('riwayat/diklat', [RiwayatController::class, 'diklat'])->name('riwayat-diklat');
    Route::post('riwayat/diklat/tambah-data', [RiwayatController::class, 'tambahRiwayatDiklat'])->name('riwayat/diklat/tambah-data');
    Route::post('riwayat/diklat/edit-data', [RiwayatController::class, 'editRiwayatDiklat'])->name('riwayat/diklat/edit-data');
    Route::post('riwayat/diklat/hapus-data', [RiwayatController::class, 'hapusRiwayatDiklat'])->name('riwayat/diklat/hapus-data');
    Route::get('riwayat/diklat/cari', [RiwayatController::class, 'searchRiwayatDiklat'])->name('riwayat/diklat/cari');
    Route::get('get-diklat-data', [RiwayatController::class, 'getDiklatData'])->name('get-diklat-data');

    // ----------------------- Informasi Riwayat PMK --------------------------//
    Route::get('riwayat/pmk', [RiwayatController::class, 'pmk'])->name('riwayat-pmk');
    Route::get('get-pmk-data', [RiwayatController::class, 'getPMKData'])->name('get-pmk-data');
    Route::post('riwayat/pmk/tambah-data', [RiwayatController::class, 'tambahRiwayatPMK'])->name('riwayat/pmk/tambah-data');
    Route::post('riwayat/pmk/edit-data', [RiwayatController::class, 'editRiwayatPMK'])->name('riwayat/pmk/edit-data');
    Route::post('riwayat/pmk/hapus-data', [RiwayatController::class, 'hapusRiwayatPMK'])->name('riwayat/pmk/hapus-data');

    // ----------------------- Informasi Riwayat Angka Kredit --------------------------//
    Route::get('riwayat/angka/kredit', [RiwayatController::class, 'angkakredit'])->name('riwayat-angka-kredit');
    // Route::get('get-angkakredit-data', [RiwayatController::class, 'getAngkaKreditData'])->name('get-angkakredit-data');
    Route::post('riwayat/angkakredit/tambah-data', [RiwayatController::class, 'tambahRiwayatAngkaKredit'])->name('riwayat/angkakredit/tambah-data');
    Route::post('riwayat/angkakredit/edit-data', [RiwayatController::class, 'editRiwayatAngkaKredit'])->name('riwayat/angkakredit/edit-data');
    Route::post('riwayat/angkakredit/hapus-data', [RiwayatController::class, 'hapusRiwayatAngkaKredit'])->name('riwayat/angkakredit/hapus-data');
    Route::get('riwayat/angkakredit/cari', [RiwayatController::class, 'searchRiwayatAngkaKredit'])->name('riwayat/angkakredit/cari');

    // ----------------------- Informasi Riwayat Hukuman Disiplin --------------------------//
    Route::get('riwayat/hukuman/disiplin', [RiwayatController::class, 'hukumandisiplin'])->name('riwayat-hukuman-disiplin');
    Route::post('riwayat/hukumandisiplin/tambah-data', [RiwayatController::class, 'tambahRiwayatHukumanDisiplin'])->name('riwayat/hukumandisiplin/tambah-data');
    Route::post('riwayat/hukumandisiplin/edit-data', [RiwayatController::class, 'editRiwayatHukumanDisiplin'])->name('riwayat/hukumandisiplin/edit-data');
    Route::post('riwayat/hukumandisiplin/hapus-data', [RiwayatController::class, 'hapusRiwayatHukumanDisiplin'])->name('riwayat/hukumandisiplin/hapus-data');
    Route::get('riwayat/hukumandisiplin/cari', [RiwayatController::class, 'searchRiwayatHukumanDisiplin'])->name('riwayat/hukumandisiplin/cari');

    // ----------------------- Informasi Riwayat Penghargaan --------------------------//
    Route::get('riwayat/penghargaan', [RiwayatController::class, 'penghargaan'])->name('riwayat-penghargaan');
    Route::post('riwayat/penghargaan/tambah-data', [RiwayatController::class, 'tambahRiwayatPenghargaan'])->name('riwayat/penghargaan/tambah-data');
    Route::post('riwayat/penghargaan/edit-data', [RiwayatController::class, 'editRiwayatPenghargaan'])->name('riwayat/penghargaan/edit-data');
    Route::post('riwayat/penghargaan/hapus-data', [RiwayatController::class, 'hapusRiwayatPenghargaan'])->name('riwayat/penghargaan/hapus-data');
    Route::get('riwayat/penghargaan/cari', [RiwayatController::class, 'searchRiwayatPenghargaan'])->name('riwayat/penghargaan/cari');

    // ----------------------- Informasi Riwayat Organisasi --------------------------//
    Route::get('riwayat/organisasi', [RiwayatController::class, 'organisasi'])->name('riwayat-organisasi');
    Route::post('riwayat/organisasi/tambah-data', [RiwayatController::class, 'tambahRiwayatOrganisasi'])->name('riwayat/organisasi/tambah-data');
    Route::post('riwayat/organisasi/edit-data', [RiwayatController::class, 'editRiwayatOrganisasi'])->name('riwayat/organisasi/edit-data');
    Route::post('riwayat/organisasi/hapus-data', [RiwayatController::class, 'hapusRiwayatOrganisasi'])->name('riwayat/organisasi/hapus-data');
    Route::get('riwayat/organisasi/cari', [RiwayatController::class, 'searchRiwayatOrganisasi'])->name('riwayat/organisasi/cari');

    // ----------------------- Informasi Riwayat Tugas Belajar --------------------------//
    Route::get('riwayat/tugas/belajar', [RiwayatController::class, 'tugasbelajar'])->name('riwayat-tugas-belajar');
    Route::post('riwayat/tugasbelajar/tambah-data', [RiwayatController::class, 'tambahRiwayatTugasBelajar'])->name('riwayat/tugasbelajar/tambah-data');
    Route::post('riwayat/tugasbelajar/edit-data', [RiwayatController::class, 'editRiwayatTugasBelajar'])->name('riwayat/tugasbelajar/edit-data');
    Route::post('riwayat/tugasbelajar/hapus-data', [RiwayatController::class, 'hapusRiwayatTugasBelajar'])->name('riwayat/tugasbelajar/hapus-data');
    Route::get('riwayat/tugasbelajar/cari', [RiwayatController::class, 'searchRiwayatTugasBelajar'])->name('riwayat/tugasbelajar/cari');

    // ----------------------- Informasi Riwayat Pasangan --------------------------//
    Route::get('riwayat/pasangan', [RiwayatController::class, 'pasangan'])->name('riwayat-pasangan');
    Route::post('riwayat/pasangan/tambah-data', [RiwayatController::class, 'tambahRiwayatPasangan'])->name('riwayat/pasangan/tambah-data');
    Route::post('riwayat/pasangan/edit-data', [RiwayatController::class, 'editRiwayatPasangan'])->name('riwayat/pasangan/edit-data');
    Route::post('riwayat/pasangan/hapus-data', [RiwayatController::class, 'hapusRiwayatPasangan'])->name('riwayat/pasangan/hapus-data');
    Route::get('riwayat/pasangan/cari', [RiwayatController::class, 'searchRiwayatPasangan'])->name('riwayat/pasangan/cari');

    // ----------------------- Informasi Riwayat Anak --------------------------//
    Route::get('riwayat/anak', [RiwayatController::class, 'anak'])->name('riwayat-anak');
    Route::post('riwayat/anak/tambah-data', [RiwayatController::class, 'tambahRiwayatAnak'])->name('riwayat/anak/tambah-data');
    Route::post('riwayat/anak/edit-data', [RiwayatController::class, 'editRiwayatAnak'])->name('riwayat/anak/edit-data');
    Route::post('riwayat/anak/hapus-data', [RiwayatController::class, 'hapusRiwayatAnak'])->name('riwayat/anak/hapus-data');
    Route::get('riwayat/anak/cari', [RiwayatController::class, 'searchRiwayatAnak'])->name('riwayat/anak/cari');

    // ----------------------- Informasi Riwayat Orang Tua --------------------------//
    Route::get('riwayat/orangtua', [RiwayatController::class, 'orangtua'])->name('riwayat-orangtua');
    Route::post('riwayat/orangtua/tambah-data', [RiwayatController::class, 'tambahRiwayatOrangTua'])->name('riwayat/orangtua/tambah-data');
    Route::post('riwayat/orangtua/edit-data', [RiwayatController::class, 'editRiwayatOrangTua'])->name('riwayat/orangtua/edit-data');
    Route::post('riwayat/orangtua/hapus-data', [RiwayatController::class, 'hapusRiwayatOrangTua'])->name('riwayat/orangtua/hapus-data');
    Route::get('riwayat/orangtua/cari', [RiwayatController::class, 'searchRiwayatOrangTua'])->name('riwayat/orangtua/cari');
});

// ----------------------- Informasi Layanan Cuti --------------------------//
Route::controller(LayananController::class)->group(function () {
    Route::get('layanan/cuti', 'tampilanCutiPegawai')->name('layanan-cuti');
    // Route::get('get-cuti-data', 'getCutiData')->name('get-cuti-data');
    Route::get('layanan/cuti/kelengkapan/{id}', 'cetakDokumenKelengkapan')->name('layanan-cuti-kelengkapan');
    Route::get('layanan/cuti/kelengkapan2/{id}', 'cetakDokumenKelengkapan2')->name('layanan-cuti-kelengkapan2');
    Route::get('layanan/cuti/admin', 'tampilanCutiPegawaiAdmin')->name('layanan-cuti-admin');
    Route::get('layanan/cuti/eselon-3', 'tampilanCutiPegawaiEselon3')->name('layanan-cuti-eselon3');
    Route::get('layanan/cuti/eselon-4', 'tampilanCutiPegawaiEselon4')->name('layanan-cuti-eselon4');
    Route::get('layanan/cuti/admin/kelengkapan/{id}', 'cetakDokumenKelengkapan')->name('layanan-cuti-admin-kelengkapan');
    Route::get('layanan/cuti/admin/kelengkapan2/{id}', 'cetakDokumenKelengkapan2')->name('layanan-cuti-admin-kelengkapan2');
    Route::get('layanan/cuti/admin/rekomendasi/{id}', 'cetakDokumenRekomendasi')->name('layanan-cuti-admin-rekomendasi');
    Route::get('layanan/cuti/admin/rekomendasi2/{id}', 'cetakDokumenRekomendasi2')->name('layanan-cuti-admin-rekomendasi2');
    Route::get('layanan/cuti/kepala-ruangan', 'tampilanCutiPegawaiKepalaRuangan')->name('layanan-cuti-kepala-ruangan');
    Route::get('layanan/cuti/kepala-ruangan/kelengkapan/{id}', 'cetakDokumenKelengkapanKepalaRuangan')->name('layanan-cuti-kepala-ruangan-kelengkapan');
    Route::post('layanan/cuti/tambah-data', 'tambahDataCuti')->name('layanan/cuti/tambah-data');
    Route::post('layanan/cuti/edit-data', 'editDataCuti')->name('layanan/cuti/edit-data');
    Route::get('layanan/cuti/cari', 'pencarianLayananCuti')->name('layanan/cuti/cari');
    Route::get('layanan/cuti/cari/admin', 'pencarianLayananCutiAdmin')->name('layanan/cuti/cari/admin');
    Route::get('layanan/cuti/cari/eselon-3', 'pencarianLayananCutiEselon3')->name('layanan/cuti/cari/eselon-3');
    Route::get('layanan/cuti/cari/eselon-4', 'pencarianLayananCutiEselon4')->name('layanan/cuti/cari/eselon-4');
    Route::get('layanan/cuti/cari/kepala-ruangan', 'pencarianLayananCutiKepalaRuangan')->name('layanan/cuti/cari/kepala-ruangan');
    Route::patch('/update-status/{id}', 'updateStatus')->name('updateStatus');
    Route::post('layanan/kgb/tambah-data', 'tambahDataKGB')->name('layanan/kgb/tambah-data');
    Route::post('layanan/kgb/edit-data', 'editDataKGB')->name('layanan/kgb/edit-data');
    Route::get('layanan/kenaikan/gaji/berkala', 'tampilanKGB')->name('kenaikan-gaji-berkala');
    Route::get('layanan/kenaikan/gaji/berkala/admin', 'tampilanKGBAdmin')->name('kenaikan-gaji-berkala-admin');
    Route::get('layanan/kenaikan/gaji/berkala/admin/cari', 'filterKGBAdmin')->name('layanan/kenaikan/gaji/berkala/admin/cari');
    Route::get('layanan/kenaikan/gaji/berkala/cari', 'filterKGBUser')->name('layanan/kenaikan/gaji/berkala/cari');
    Route::get('layanan/kenaikan/gaji/berkala/{id}', 'cetakKGB2')->name('layanan-kenaikan-gaji-berkala');
    Route::get('layanan/kenaikan/gaji/berkala/admin/{id}', 'cetakKGB')->name('layanan-kenaikan-gaji-berkala-admin');
    Route::post('layanan/kenaikan/gaji/berkala/hapus-data', 'hapusKenaikanGajiBerkala')->name('layanan/kenaikan-gaji-berkala/hapus-data');
    Route::get('layanan/perpanjang-kontrak', 'tampilanPerpanjangKontrak')->name('perpanjang-kontrak');
    Route::get('layanan/perpanjang-kontrak-admin', 'tampilanPerpanjangKontrakAdmin')->name('perpanjang-kontrak-admin');
    Route::get('layanan/perpanjang-kontrak-admin-cari', 'filterPerpanjangKontrakAdmin')->name('layanan/perpanjang-kontrak-admin-cari');
    Route::get('layanan/perpanjang-kontrak-cari', 'filterPerpanjangKontrak')->name('layanan/perpanjang-kontrak-cari');
    Route::post('layanan/kontrak/tambah-data', 'tambahDataKontrak')->name('layanan/kontrak/tambah-data');
    Route::post('layanan/kontrak/edit-data', 'editDataKontrak')->name('layanan/kontrak/edit-data');
    Route::get('layanan/perpanjang-kontrak/{id}', 'cetakPerpanjanganKontrak2')->name('layanan-perpanjang-kontrak');
    Route::get('layanan/perpanjang-kontrak-admin/{id}', 'cetakPerpanjanganKontrak')->name('layanan-perpanjang-kontrak-admin');
    Route::get('layanan/perpanjang-kontrak-admin', 'tampilanPerpanjangKontrakAdmin')->name('perpanjang-kontrak-admin');
    Route::post('layanan/perpanjangan-kontrak/hapus-data', 'hapusPerpanjanganKontrak')->name('layanan/perpanjangan-kontrak/hapus-data');
    Route::get('layanan/perjanjian-kontrak', 'tampilanPerjanjianKontrak')->name('perjanjian-kontrak');
    Route::get('layanan/perjanjian-kontrak-admin', 'tampilanPerjanjianKontrakAdmin')->name('perjanjian-kontrak-admin');
    Route::get('layanan/perjanjian-kontrak-admin-cari', 'filterPerjanjianKontrakAdmin')->name('layanan/perjanjian-kontrak-admin-cari');
    Route::get('layanan/perjanjian-kontrak-cari', 'filterPerjanjianKontrak')->name('layanan/perjanjian-kontrak-cari');
    Route::post('layanan/perjanjian-kontrak/tambah-data', 'tambahDataPerjanjianKontrak')->name('layanan/perjanjian-kontrak/tambah-data');
    Route::post('layanan/perjanjian-kontrak/edit-data', 'editDataPerjanjianKontrak')->name('layanan/perjanjian-kontrak/edit-data');
    Route::post('layanan/perjanjian-kontrak/delete', 'hapusPerjanjianKontrak')->name('layanan/perjanjian-kontrak/delete');
    Route::get('layanan/perjanjian-kontrak/{id}', 'cetakPerjanjianKontrak2')->name('layanan-perjanjian-kontrak');
    Route::get('layanan/perjanjian-kontrak-admin/{id}', 'cetakPerjanjianKontrak')->name('layanan-perjanjian-kontrak-admin');
    Route::get('layanan/peta-jabatan', 'tampilanPetaJabatan')->name('peta-jabatan');
    Route::get('layanan/surat-tanda-registrasi-admin', 'tampilanSTRAdmin')->name('surat-tanda-registrasi-admin');
    Route::get('layanan/surat-tanda-registrasi-admin-cari', 'filterSTRAdmin')->name('surat-tanda-registrasi-admin-cari');
    Route::get('layanan/surat-tanda-registrasi-cari', 'filterSTR')->name('surat-tanda-registrasi-cari');
    Route::get('layanan/surat-tanda-registrasi', 'tampilanSTR')->name('surat-tanda-registrasi');
    Route::post('layanan/surat-tanda-registrasi/tambah-data', 'tambahDataSTR')->name('layanan/surat-tanda-registrasi/tambah-data');
    Route::post('layanan/surat-tanda-registrasi/edit-data', 'editDataSTR')->name('layanan/surat-tanda-registrasi/edit-data');
    Route::post('layanan/surat-tanda-registrasi/hapus-data', 'hapusDataSTR')->name('layanan/surat-tanda-registrasi/hapus-data');
    Route::get('layanan/perjanjian-kinerja-admin', 'TampilanPerjanjianKinerjaAdmin')->name('perjanjian-kinerja-admin');
    Route::get('layanan/perjanjian-kinerja-admin-cari', 'filterPerjanjianKinerjaAdmin')->name('layanan/perjanjian-kinerja-admin-cari');
    Route::get('layanan/perjanjian-kinerja-cari', 'filterPerjanjianKinerja')->name('layanan/perjanjian-kinerja-cari');
    Route::get('layanan/perjanjian-kinerja', 'TampilanPerjanjianKinerja')->name('perjanjian-kinerja');
    Route::post('layanan/perjanjian-kinerja/tambah-data', 'tambahDataPerjanjianKinerja')->name('layanan/perjanjian-kinerja/tambah-data');
    Route::post('layanan/perjanjian-kinerja/edit-data', 'editDataPerjanjianKinerja')->name('layanan/perjanjian-kinerja/edit-data');
    Route::post('layanan/perjanjian-kinerja/hapus-data', 'hapusDataPerjanjianKinerja')->name('layanan/perjanjian-kinerja/hapus-data');
    Route::get('layanan/perjanjian-kinerja/{id}', 'cetakPerjanjianKinerja2')->name('layanan-perjanjian-kinerja');
    Route::get('layanan/perjanjian-kinerja-admin/{id}', 'cetakPerjanjianKinerja')->name('layanan-perjanjian-kinerja-admin');
    Route::post('ruangan/pegawai/list/cari', 'pencarianPegawaiKepalaRuanganList')->name('ruangan/pegawai/list/cari');
    Route::post('ruangan/pegawai/card/cari', 'pencarianPegawaiKepalaRuanganCard')->name('ruangan/pegawai/card/cari');
});

// ----------------------- SIP Dokter --------------------------//
Route::controller(SIPController::class)->group(function () {
    Route::get('transaksi/sip-dokter', 'tampilanSIPDokter')->name('sip-dokter');
    Route::get('transaksi/sip-dokter-admin', 'tampilanSIPDokterAdmin')->name('sip-dokter-admin');
    Route::get('transaksi/sip-dokter-admin-cari', 'filterSIPDokterAdmin')->name('sip-dokter-admin-cari');
    Route::get('transaksi/sip-dokter-cari', 'filterSIPDokter')->name('sip-dokter-cari');
    Route::post('transaksi/sip-dokter/tambah-data', 'tambahDataSIPDokter')->name('transaksi/sip-dokter/tambah-data');
    Route::post('transaksi/sip-dokter/edit-data', 'editSIPDokter')->name('transaksi/sip-dokter/edit-data');
    Route::post('transaksi/sip-dokter/hapus-data', 'hapusDataSIPDokter')->name('transaksi/sip-dokter/hapus-data');

    Route::get('transaksi/spk-dokter', 'tampilanSPKDokter')->name('spk-dokter');
    Route::get('transaksi/spk-dokter-admin', 'tampilanSPKDokterAdmin')->name('spk-dokter-admin');
    Route::get('transaksi/spk-dokter-admin-cari', 'filterSPKDokterAdmin')->name('spk-dokter-admin-cari');
    Route::get('transaksi/spk-dokter-cari', 'filterSPKDokter')->name('spk-dokter-cari');
    Route::post('transaksi/spk-dokter/tambah-data', 'tambahDataSPKDokter')->name('transaksi/spk-dokter/tambah-data');
    Route::post('transaksi/spk-dokter/edit-data', 'editSPKDokter')->name('transaksi/spk-dokter/edit-data');
    Route::post('transaksi/spk-dokter/hapus-data', 'hapusDataSPKDokter')->name('transaksi/spk-dokter/hapus-data');

    Route::get('transaksi/spk-perawat', 'tampilanSPKPerawat')->name('spk-perawat');
    Route::get('transaksi/spk-perawat-admin', 'tampilanSPKPerawatAdmin')->name('spk-perawat-admin');
    Route::get('transaksi/spk-perawat-admin-cari', 'filterSPKPerawatAdmin')->name('spk-perawat-admin-cari');
    Route::get('transaksi/spk-perawat-cari', 'filterSPKPerawat')->name('spk-perawat-cari');
    Route::post('transaksi/spk-perawat/tambah-data', 'tambahDataSPKPerawat')->name('transaksi/spk-perawat/tambah-data');
    Route::post('transaksi/spk-perawat/edit-data', 'editSPKPerawat')->name('transaksi/spk-perawat/edit-data');
    Route::post('transaksi/spk-perawat/hapus-data', 'hapusDataSPKPerawat')->name('transaksi/spk-perawat/hapus-data');

    Route::get('transaksi/spk-nakes-lain', 'tampilanSPKNakesLain')->name('spk-nakes-lain');
    Route::get('transaksi/spk-nakes-lain-admin', 'tampilanSPKNakesLainAdmin')->name('spk-nakes-lain-admin');
    Route::get('transaksi/spk-nakes-lain-admin-cari', 'filterSPKNakesLainAdmin')->name('spk-nakes-lain-admin-cari');
    Route::get('transaksi/spk-nakes-lain-cari', 'filterSPKNakesLain')->name('spk-nakes-lain-cari');
    Route::post('transaksi/spk-nakes-lain/tambah-data', 'tambahDataSPKNakesLain')->name('transaksi/spk-nakes-lain/tambah-data');
    Route::post('transaksi/spk-nakes-lain/edit-data', 'editSPKNakesLain')->name('transaksi/spk-nakes-lain/edit-data');
    Route::post('transaksi/spk-nakes-lain/hapus-data', 'hapusDataSPKNakesLain')->name('transaksi/spk-nakes-lain/hapus-data');
});

// ----------------------- Export Excel --------------------------//
Route::controller(ExportExcelController::class)->group(function () {
    Route::get('export-sip-dokter', 'exportSIPDokter')->name('export-sip-dokter');
    Route::get('export-spk-dokter', 'exportSPKDokter')->name('export-spk-dokter');
    Route::get('export-spk-perawat', 'exportSPKPerawat')->name('export-spk-perawat');
    Route::get('export-spk-nakes-lain', 'exportSPKNakesLain')->name('export-spk-nakes-lain');
    Route::get('export-daftar-pegawai', 'exportDaftarPegawai')->name('export-daftar-pegawai');
});

// ----------------------- Tampilan Notifikasi --------------------------//
Route::controller(NotificationController::class)->group(function () {
    Route::get('tampilan/semua/notifikasi', 'tampilanNotifikasi')->name('tampilan-semua-notifikasi');
    Route::get('/tampilan/semua/notifikasi/hapus/data/{id}', 'hapusNotifikasi')->name('tampilan-semua-notifikasi-hapus-data');
});