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
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\ExpenseReportsController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainersController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\RiwayatController;

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

/** Website Link Redirection */
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/gate', function () {
    return view('auth.login');
})->name('masuk');

Route::get('/register', function () {
    return view('auth.register');
})->name('daftar');

Route::get('/lupa-kata-sandi', function () {
    return view('auth.passwords.email');
})->name('lupa kata sandi');


/** Auth MultiLevel */
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
});

// -----------------------------settings-------------------------------------//
Route::controller(SettingController::class)->group(function () {
    Route::get('pengaturan/perusahaan', 'companySettings')->middleware('auth')->name('pengaturan-perusahaan');
    Route::post('pengaturan/perusahaan/save', 'saveRecord')->middleware('auth')->name('pengaturan-perusahaansave');
    /** index page */
    Route::get('company/settings/page', 'companySettings')->middleware('auth')->name('company/settings/page');
    Route::post('company/settings/save', 'saveRecord')->middleware('auth')->name('company/settings/save');
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
    Route::get('forget-password', 'getEmail')->name('forget-password');
    Route::post('forget-password', 'postEmail')->name('forget-password');
});

// ----------------------------- reset password -----------------------------//
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('reset-password/{token}', 'getPassword');
    Route::post('reset-password', 'updatePassword');
});

// ----------------------------- manage users ------------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('user/profile', 'user_profile')->middleware('auth')->name('user-profile');
    Route::get('admin/profile', 'admin_profile')->middleware('auth')->name('admin-profile');
    Route::get('super-admin/profile', 'superadmin_profile')->middleware('auth')->name('super-admin-profile');
    Route::post('profile/information/save', 'profileInformation')->name('profile/information/save');
    Route::get('manajemen/pengguna', 'index')->middleware('auth')->name('manajemen-pengguna');
    Route::post('user/add/save', 'addNewUserSave')->name('user/add/save');
    Route::post('update', 'update')->name('update');
    Route::post('user/delete', 'delete')->middleware('auth')->name('user/delete');
    Route::get('riwayat/aktivitas', 'activityLog')->middleware('auth')->name('riwayat-aktivitas');
    Route::get('riwayat/aktivitas/otentikasi', 'activityLogInLogOut')->middleware('auth')->name('riwayat-aktivitas-otentikasi');
    Route::get('admin/kata-sandi', 'changePasswordView')->middleware('auth')->name('admin-kata-sandi');
    Route::get('super-admin/kata-sandi', 'changePasswordView')->middleware('auth')->name('super-admin-kata-sandi');
    Route::get('user/kata-sandi', 'changePasswordView')->middleware('auth')->name('user-kata-sandi');
    Route::post('change/password/db', 'changePasswordDB')->name('change/password/db');
    Route::post('user/profile/pegawai/add', 'profilePegawaiAdd')->name('user/profile/pegawai/add');
    Route::post('user/profile/pegawai/edit', 'profilePegawaiEdit')->name('user/profile/pegawai/edit');
    Route::post('user/profile/posisi/jabatan/add', 'posisiJabatanAdd')->name('user/profile/posisi/jabatan/add');
    Route::post('user/profile/posisi/jabatan/edit', 'posisiJabatanEdit')->name('user/profile/posisi/jabatan/edit');
    Route::get('get-users-data', 'getUsersData')->name('get-users-data');
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
    Route::get('daftar/pegawai/pensiun/list', 'listPensiun')->middleware('auth')->name('daftar/pegawai/pensiun/list');
    Route::post('daftar/pegawai/save', 'saveRecord')->middleware('auth')->name('daftar/pegawai/save');
    Route::get('daftar/pegawai/view/edit/{employee_id}', 'viewRecord');
    Route::post('daftar/pegawai/update', 'updateRecord')->middleware('auth')->name('daftar/pegawai/update');
    Route::get('daftar/pegawai/delete/{employee_id}', 'deleteRecord')->middleware('auth');
    Route::post('daftar/pegawai/search', 'employeeSearch')->name('daftar/pegawai/search');
    Route::post('daftar/pegawai/list/search', 'employeeListSearch')->name('daftar/pegawai/list/search');

    Route::get('form/departments/page', 'index')->middleware('auth')->name('form/departments/page');
    Route::post('form/departments/save', 'saveRecordDepartment')->middleware('auth')->name('form/departments/save');
    Route::post('form/department/update', 'updateRecordDepartment')->middleware('auth')->name('form/department/update');
    Route::post('form/department/delete', 'deleteRecordDepartment')->middleware('auth')->name('form/department/delete');

    Route::get('referensi/agama', 'indexAgama')->middleware('auth')->name('referensi-agama');
    Route::post('form/agama/save', 'saveRecordAgama')->middleware('auth')->name('form/agama/save');
    Route::post('form/agama/update', 'updateRecordAgama')->middleware('auth')->name('form/agama/update');
    Route::post('form/agama/delete', 'deleteRecordAgama')->middleware('auth')->name('form/agama/delete');
    Route::get('form/agama/search', 'searchAgama')->middleware('auth')->name('form/agama/search');

    Route::get('referensi/status', 'indexStatus')->middleware('auth')->name('referensi-status');
    Route::post('form/status/save', 'saveRecordStatus')->middleware('auth')->name('form/status/save');
    Route::post('form/status/update', 'updateRecordStatus')->middleware('auth')->name('form/status/update');
    Route::post('form/status/delete', 'deleteRecordStatus')->middleware('auth')->name('form/status/delete');
    Route::get('form/status/search', 'searchStatus')->middleware('auth')->name('form/status/search');

    Route::get('referensi/pendidikan', 'indexPendidikan')->middleware('auth')->name('referensi-pendidikan');
    Route::post('form/pendidikan/save', 'saveRecordPendidikan')->middleware('auth')->name('form/pendidikan/save');
    Route::post('form/pendidikan/update', 'updateRecordPendidikan')->middleware('auth')->name('form/pendidikan/update');
    Route::post('form/pendidikan/delete', 'deleteRecordPendidikan')->middleware('auth')->name('form/pendidikan/delete');
    Route::get('form/pendidikan/search', 'searchPendidikan')->middleware('auth')->name('form/pendidikan/search');

    Route::get('form/designations/page', 'designationsIndex')->middleware('auth')->name('form/designations/page');
    Route::post('form/designations/save', 'saveRecordDesignations')->middleware('auth')->name('form/designations/save');
    Route::post('form/designations/update', 'updateRecordDesignations')->middleware('auth')->name('form/designations/update');
    Route::post('form/designations/delete', 'deleteRecordDesignations')->middleware('auth')->name('form/designations/delete');

    Route::get('form/timesheet/page', 'timeSheetIndex')->middleware('auth')->name('form/timesheet/page');
    Route::post('form/timesheet/save', 'saveRecordTimeSheets')->middleware('auth')->name('form/timesheet/save');
    Route::post('form/timesheet/update', 'updateRecordTimeSheets')->middleware('auth')->name('form/timesheet/update');
    Route::post('form/timesheet/delete', 'deleteRecordTimeSheets')->middleware('auth')->name('form/timesheet/delete');

    Route::get('form/overtime/page', 'overTimeIndex')->middleware('auth')->name('form/overtime/page');
    Route::post('form/overtime/save', 'saveRecordOverTime')->middleware('auth')->name('form/overtime/save');
    Route::post('form/overtime/update', 'updateRecordOverTime')->middleware('auth')->name('form/overtime/update');
    Route::post('form/overtime/delete', 'deleteRecordOverTime')->middleware('auth')->name('form/overtime/delete');
});

// ------------------------- profile employee --------------------------//
Route::controller(EmployeeController::class)->group(function () {
    Route::get('user/profile/{user_id}', 'profileEmployee')->middleware('auth');
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
    Route::get('dashboard', 'indexDashboard')->middleware('auth')->name('dashboard');
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
});

// ----------------------------- Pencarian Agama ------------------------------//
Route::controller(RiwayatManagementController::class)->group(function () {
    Route::get('get-agama-data', 'getAgamaData')->name('get-agama-data');
});
