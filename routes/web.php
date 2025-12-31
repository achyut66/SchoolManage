<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\SchoolTypeController;
use App\Http\Controllers\SchoolDetailsController;
use App\Http\Controllers\TeachersPersonalDetailController;
use App\Http\Controllers\TeachersEducationDetailController;
use App\Http\Controllers\TeachersWorkDetailsController;
use App\Http\Controllers\PalikaProfileController;
use App\Http\Controllers\CasteController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\GradeSettingController;
use App\Http\Controllers\LicenseLevelController;
use App\Http\Controllers\StudentParentDetailsController;
use App\Http\Controllers\StudentsEducationDetailController;
use App\Http\Controllers\StudentsGuardianDetailsController;
use App\Http\Controllers\CurriculmSettingController;
use App\Http\Controllers\StudentResultController;
use App\Http\Controllers\SettingStudentFeeController;
use App\Http\Controllers\StudentFeePaymentController;
use App\Http\Controllers\TeacherLeaveController;
use App\Http\Controllers\TeachersSalaryPaymentController;
use App\Http\Controllers\SettingTeachersSalary;
use App\Http\Controllers\OtherStaffDetailsController;
use App\Http\Controllers\OtherStaffPaymentController;
use App\Http\Controllers\ExamSettingController;
use App\Http\Controllers\ExamScheduleController;
use App\Http\Controllers\ExamTypeResultController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authcheck', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
  Route::get('/',[DashboardController::class,'index'])->name('dashboard');
  //Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  /*------------------------------------------------------------
    roles
  ------------------------------------------------------------------*/
  Route::get('roles', [RoleController::class, 'index']);
  Route::get('add-role', [RoleController::class, 'create'])->name('add-role');
  Route::post('save-roles', [RoleController::class, 'store'])->name('save-roles');
  Route::get('edit-role', [RoleController::class, 'edit'])->name('edit-role');
  Route::post('update-role/{id}', [RoleController::class, 'update'])->name('update-role');

  //permission controller
  Route::get('modules', [PermissionController::class,'index'])->name('modules');
  Route::get('add-modules', [PermissionController::class,'create'])->name('add-modules');
  Route::post('save-modules', [PermissionController::class,'store'])->name('save-modules');
  Route::get('edit-modules', [PermissionController::class,'edit'])->name('edit-modules');
  Route::post('update-modules/{id}', [PermissionController::class,'update'])->name('update-modules');
  Route::get('show-modules/{id}', [PermissionController::class,'show'])->name('show-modules');
  Route::post('assign-userpermission/{id}', [PermissionController::class,'createPermission'])->name('assign-userpermission');
  Route::get('revoke-permission/{userid}/{permission}', [PermissionController::class,'revokeUserPermission'])->name('revoke-permission');

 /*------------------------------------------------------------
    users 
  ---------------------------------------------------------*/
  Route::resource('users', UserController::class);
  Route::get('create',[UserController::class,'create']);
  Route::post('save-user',[UserController::class, 'store'])->name('save-user');
  Route::get('edit-user/{id}',[UserController::class,'edit'])->name('edit-user');
  Route::post('/update-user/{id}', [UserController::class,'update'])->name('update-user');

  /*--------------------------------------------------------------
  // school management setting
  ----------------------------------------------------------------*/
  Route::get('school-type', [SchoolTypeController::class,'index'])->name('school-type');
  Route::get('school-type-add', [SchoolTypeController::class,'create'])->name('school-type-add');
  Route::post('save-school-type', [SchoolTypeController::class,'store'])->name('save-school-type');
  Route::get('school-type-edit', [SchoolTypeController::class,'edit'])->name('school-type-edit');
  Route::post('update-school-type/{id}',[SchoolTypeController::class,'update'])->name('update-school-type');
  // Route::get('school-type', [SchoolTypeController::class,'index'])->name('school-type');

  /*--------------------------------------------------------------
  // school details
  ----------------------------------------------------------------*/
  Route::get('school-details', [SchoolDetailsController::class,'index'])->name('school-details');
  Route::get('school-details-add', [SchoolDetailsController::class,'create'])->name('school-tdetails-add');
  Route::post('school-details-save', [SchoolDetailsController::class,'store'])->name('school-details-save');
  Route::get('school-details-edit', [SchoolDetailsController::class,'edit'])->name('school-details-edit');
  Route::post('school-details-update/{id}', [SchoolDetailsController::class,'update'])->name('school-details-update');
  Route::get('school-details-delete/{id}', [SchoolDetailsController::class,'destroy'])->name('school-details-delete');

  /*--------------------------------------------------------------
  // teachers personal info collection
  ----------------------------------------------------------------*/
  Route::get('teachers-personal-detail', [TeachersPersonalDetailController::class,'create'])->name('teachers-personal-detail');
  Route::get('teachers-personal-list', [TeachersPersonalDetailController::class,'index'])->name('teachers-personal-list');
  Route::get('teachers-personal-data-add', [TeachersPersonalDetailController::class,'create'])->name('teachers-personal-data-add');
  Route::post('teachers-personal-data-save', [TeachersPersonalDetailController::class,'store'])->name('teachers-personal-data-save');
  Route::get('teachers-personal-detail-edit/{id}', [TeachersPersonalDetailController::class,'edit'])->name('teachers-personal-detail-edit');
  Route::post('teachers-personal-detail-update/{id}', [TeachersPersonalDetailController::class,'update'])->name('teachers-personal-detail-update');
  Route::get('teachers-personal-detail-delete/{id}', [TeachersPersonalDetailController::class,'destroy'])->name('teachers-personal-detail-delete');
  Route::get('teachers-profile-detail/{id}', [TeachersPersonalDetailController::class,'show'])->name('teachers-profile-detail');
  Route::get('teachers-details-export/', [TeachersPersonalDetailController::class,'export'])->name('teachers-details-export');//export
  Route::post('teacher-search', [TeachersPersonalDetailController::class,'search'])->name('teacher-search');
  Route::get('convert-date', [TeachersPersonalDetailController::class,'convertBSTOAD'])->name('convert-date');
  Route::get('teachers-account', [TeachersPersonalDetailController::class,'teachersSalaryCollection'])->name('teachers-account');

   /*--------------------------------------------------------------
  // teachers education info collection
  ----------------------------------------------------------------*/
  Route::get('teachers-education-detail-list/{id}', [TeachersEducationDetailController::class,'index'])->name('teachers-education-detail-list');
  Route::get('teachers-education-create/{id}', [TeachersEducationDetailController::class,'create'])->name('teachers-education-create');
  Route::post('teachers-education-detail-save', [TeachersEducationDetailController::class,'store'])->name('teachers-education-detail-save');
  //Route::get('teachers-education-detail-list', [TeachersEducationDetailController::class,'show'])->name('teachers-education-detail-list');
  Route::get('teachers-education-detail-edit/{id}', [TeachersEducationDetailController::class,'edit'])->name('teachers-education-detail-edit');
  Route::post('teachers-education-detail-update/{id}', [TeachersEducationDetailController::class,'update'])->name('teachers-education-detail-update');
  Route::get('teachers-education-detail-delete/{id}', [TeachersEducationDetailController::class,'destroy'])->name('teachers-education-detail-delete');
  /*--------------------------------------------------------------
  // teachers work and training details
  ----------------------------------------------------------------*/
  Route::get('teachers-work-detail/{id}', [TeachersWorkDetailsController::class,'index'])->name('teachers-work-detail');
  Route::get('teachers-work-detail-create/{id}', [TeachersWorkDetailsController::class,'create'])->name('teachers-work-detail-create');
  Route::post('teachers-work-detail-save', [TeachersWorkDetailsController::class,'store'])->name('teachers-work-detail-save');
  Route::get('teachers-work-detail-list/{id}', [TeachersWorkDetailsController::class,'show'])->name('teachers-work-detail-list');
  Route::get('teachers-work-detail-edit/{id}', [TeachersWorkDetailsController::class,'edit'])->name('teachers-work-detail-edit');
  Route::post('teachers-work-detail-update/{id}', [TeachersWorkDetailsController::class,'update'])->name('teachers-work-detail-update');
  Route::get('teachers-work-detail-delete/{id}', [TeachersWorkDetailsController::class,'destroy'])->name('teachers-work-detail-delete');

  Route::get('system-config',[PalikaProfileController::class, 'index'])->name('system-config');
  Route::post('update-config',[PalikaProfileController::class, 'update'])->name('update-config');
  // Route::post('school-update',[PalikaProfileController::class, 'getSchoolProfile'])->name('getprofile-school');
  Route::get('palika-profile/{id?}',[PalikaProfileController::class, 'getPalikaProfile'])->name('palika-profile');

  /*--------------------------------------------------------------
    Caste Controller
  ----------------------------------------------------------------*/
  Route::get('caste', [CasteController::class,'index'])->name('caste');
  Route::get('add-caste', [CasteController::class,'create'])->name('add-caste');
  Route::post('save-caste', [CasteController::class,'store'])->name('save-caste');
  Route::get('edit-caste', [CasteController::class,'edit'])->name('edit-caste');
  Route::post('update-caste/{id}', [CasteController::class,'update'])->name('update-caste');
  Route::get('delete-caste/{id}', [CasteController::class,'destroy'])->name('delete-caste');

  /*--------------------------------------------------------------
   Religion
  ----------------------------------------------------------------*/
  Route::get('religion', [ReligionController::class,'index'])->name('religion');
  Route::get('add-religion', [ReligionController::class,'create'])->name('add-religion');
  Route::post('save-religion', [ReligionController::class,'store'])->name('save-religion');
  Route::get('edit-religion', [ReligionController::class,'edit'])->name('edit-religion');
  Route::post('update-religion/{id}', [ReligionController::class,'update'])->name('update-religion');
  Route::get('delete-religion/{id}', [ReligionController::class,'destroy'])->name('delete-religion');

  /*--------------------------------------------------------------
   Grade settings
  ----------------------------------------------------------------*/
  Route::get('grade', [GradeSettingController::class,'index'])->name('grade');
  Route::get('add-grade', [GradeSettingController::class,'create'])->name('add-grade');
  Route::post('save-grade', [GradeSettingController::class,'store'])->name('save-grade');
  Route::get('edit-grade', [GradeSettingController::class,'edit'])->name('edit-grade');
  Route::post('update-grade/{id}', [GradeSettingController::class,'update'])->name('update-grade');
  // Route::get('delete-grade/{id}', [GradeSettingController::class,'destroy'])->name('delete-grade');
  Route::delete('/grade-destroy/{gradeSetting}', [GradeSettingController::class, 'destroy'])->name('grade-destroy');
  Route::get('/get-sections/{grade}', [StudentParentDetailsController::class, 'getSections'])->name('get.sections');



  /*--------------------------------------------------------------
   Curriculum settings
  ----------------------------------------------------------------*/
  Route::get('curriculum', [CurriculmSettingController::class,'index'])->name('curriculum');
  Route::get('add-curriculum', [CurriculmSettingController::class,'create'])->name('add-curriculum');
  Route::post('save-curriculum', [CurriculmSettingController::class,'store'])->name('save-curriculum');
  Route::delete('delete-curriculum/{grade}',[CurriculmSettingController::class, 'destroy'])->name('delete-curriculum');

  /*--------------------------------------------------------------
   Student Fee settings
  ----------------------------------------------------------------*/
  Route::get('studentfee', [SettingStudentFeeController::class,'index'])->name('studentfee');
  Route::get('add-studentfee', [SettingStudentFeeController::class,'create'])->name('add-studentfee');
  Route::post('save-studentfee', [SettingStudentFeeController::class,'store'])->name('save-studentfee');
  Route::delete('delete-studentfee/{gradeId}',[SettingStudentFeeController::class, 'destroy'])->name('delete-studentfee');

  /*--------------------------------------------------------------
   Teacher Salary settings
  ----------------------------------------------------------------*/
  
  Route::get('teacherssalary', [SettingTeachersSalary::class,'index'])->name('teacherssalary');
  Route::get('add-teacherssalary', [SettingTeachersSalary::class,'create'])->name('add-teacherssalary');
  Route::post('save-teacherssalary', [SettingTeachersSalary::class,'store'])->name('save-teacherssalary');
  Route::delete('delete-teacherssalary/{gradeId}',[SettingTeachersSalary::class, 'destroy'])->name('delete-teacherssalary');


  /*--------------------------------------------------------------
   License
  ----------------------------------------------------------------*/
  Route::get('licenselevel', [LicenseLevelController::class,'index'])->name('licenselevel');
  Route::get('add-licenselevel', [LicenseLevelController::class,'create'])->name('add-licenselevel');
  Route::post('save-licenselevel', [LicenseLevelController::class,'store'])->name('save-licenselevel');
  Route::get('edit-licenselevel', [LicenseLevelController::class,'edit'])->name('edit-licenselevel');
  Route::post('update-licenselevel/{id}', [LicenseLevelController::class,'update'])->name('update-licenselevel');
  Route::get('delete-licenselevel/{id}', [LicenseLevelController::class,'destroy'])->name('delete-licenselevel');

/*-------------------------------------------------------------------
Print Pages  
---------------------------------------------------------------------*/
  Route::get('import-teacher-details', [TeachersPersonalDetailController::class,'importDetails'])->name('import-teacher-details');
  Route::post('save-import-details', [TeachersPersonalDetailController::class,'saveImportDetails'])->name('save-import-details');
  Route::get('teacherpd-prints', [TeachersPersonalDetailController::class,'printDetails'])->name('teacherpd-prints');
  Route::get('teacherpd-ajax-prints/{statusID}/{name}/{licenceNo}', [TeachersPersonalDetailController::class,'printajaxDetails'])->name('teacherpd-ajax-prints');
  Route::get('teacherpd-export/{statusID}/{name}/{licenceNo}', [TeachersPersonalDetailController::class,'exportBySearch'])->name('teacherpd-export');

   // students details personal
   /*----------------------------------------------------------------*/
   Route::get('student-parent-detail', [StudentParentDetailsController::class,'create'])->name('student-parent-detail');
   Route::get('student-parent-list', [StudentParentDetailsController::class,'index'])->name('student-parent-list');
   Route::get('student-parent-data-add', [StudentParentDetailsController::class,'create'])->name('student-parent-data-add');
   Route::post('student-parent-data-save', [StudentParentDetailsController::class,'store'])->name('student-parent-data-save');
   Route::get('student-parent-detail-edit/{id}', [StudentParentDetailsController::class,'edit'])->name('student-parent-detail-edit');
   Route::get('student-parent-detail-show/{id}', [StudentParentDetailsController::class,'show'])->name('student-parent-detail-show');
   Route::post('student-parent-detail-update/{id}', [StudentParentDetailsController::class,'update'])->name('student-parent-detail-update');
   Route::post('/student-parent-search',[StudentParentDetailsController::class, 'search'])->name('student-parent-search');
   Route::get('/students-print', [StudentParentDetailsController::class, 'print'])->name('students.print');
   Route::get('/students-export', [StudentParentDetailsController::class, 'export'])->name('students.export');
   Route::get('/students/students-result-dashboard', [StudentParentDetailsController::class, 'studentsExam'])->name('students-result-dashboard');


   Route::get('students/{id}/personal',[StudentParentDetailsController::class, 'personalForm'])->name('students.personal');
   Route::get('students/{id}/education', [StudentParentDetailsController::class, 'educationForm'])->name('students.education');
   Route::get('students/{id}/parents', [StudentParentDetailsController::class, 'parentForm'])->name('students.parents');

   Route::get('student-details/students-record-transfer', [StudentParentDetailsController::class, 'recordTransfer'])->name('students-record-transfer');
   Route::get('student-details/students-fee-collection', [StudentParentDetailsController::class, 'studentFeeCollection'])->name('students-fee-collection');
   Route::get('student-details/students-fee-paid-list', [StudentParentDetailsController::class, 'goToPaidList'])->name('students-fee-paid-list');

    /*--------------------------------------------------------------*/
     // students details educational
   /*----------------------------------------------------------------*/
   Route::get('students/{id}/education',[StudentsEducationDetailController::class, 'create'])->name('students.education');
   Route::post('students/{id}/education',[StudentsEducationDetailController::class, 'store'])->name('students.education.store');
   Route::get('students/{id}/education/edit',[StudentsEducationDetailController::class, 'edit'])->name('students.education.edit');
   Route::put('students/{id}/education',[StudentsEducationDetailController::class, 'update'])->name('students.education.update');

  //  Route::get('students/{id}/education',[StudentsEducationDetailController::class, 'educationForm'])->name('students.education');
    /*--------------------------------------------------------------*/
     // students details parents
   /*----------------------------------------------------------------*/
   Route::get('students/{id}/parents',[StudentsGuardianDetailsController::class, 'create'])->name('students.parents');
   Route::post('students/{id}/parents',[StudentsGuardianDetailsController::class, 'store'])->name('students.parents.store');
   Route::get('students/{id}/parents/edit',[StudentsGuardianDetailsController::class, 'edit'])->name('students.parents.edit');
   Route::put('students/{id}/parents',[StudentsGuardianDetailsController::class, 'update'])->name('students.parents.update');
   Route::get('parents-info',[StudentsGuardianDetailsController::class,'index'])->name('parents-information'); 
   Route::get('/parents/{id}/modal', [StudentsGuardianDetailsController::class, 'showModal'])->name('parents.modal');
   Route::get('/parents/print', [StudentsGuardianDetailsController::class, 'print'])->name('parents.print');

   /*--------------------------------------------------------------*/
    // report
   Route::get('teachers-as-type', [TeachersPersonalDetailController::class,'teacher_as_type'])->name('teachers-as-type');
   Route::get('teachers/type/print',[TeachersPersonalDetailController::class, 'teachers_type_print'])->name('teachers.type.print');

  //  migration

  Route::post('student-data-migration', [StudentParentDetailsController::class, 'migrationSave'])->name('student-data-migration');
  Route::get('transfor-report/get-student-data-migration', [StudentParentDetailsController::class, 'getAllMigration'])->name('get-student-data-migration');
  Route::get('/migration/print', [StudentParentDetailsController::class, 'printMigration'])->name('students.migration.print');

  // disable the student admission
  
  Route::post('disable-admission/{id}',[StudentParentDetailsController::class, 'disableAdmission'])->name('disable-student-admission');
  Route::post('disable-teacher-information/{id}',[TeachersPersonalDetailController::class, 'disableTeacherInformation'])->name('disable-teacher-information');
  
  // student result
  Route::get('student-data/student-result-dash/{id}/{typeId}', [StudentParentDetailsController::class, 'goToResultAdd'])->name('student-result-add');
  
  Route::post('student-result-save', [StudentResultController::class, 'store'])->name('student-result-save');
  Route::get('student-result-list', [StudentResultController::class, 'index'])->name('student-result-list');
  Route::get('student-result-edit/{id}/{typeId}', [StudentResultController::class, 'edit'])->name('student-result-edit');
  Route::post('student-result-update/{id}/{typeId}', [StudentResultController::class, 'update'])->name('student-result-update');
  Route::get('student-result-show/{id}/{typeId}', [StudentResultController::class, 'show'])->name('student-result-show');
  Route::get('/result/{student_id}/{typeId}/pdf', [StudentResultController::class, 'downloadPdf'])->name('result.pdf');
  Route::get('/result/approval-by-principle', [StudentResultController::class, 'approvedBy'])->name('result.approval');
  Route::post('/result/approval-save', [StudentResultController::class, 'doApprove'])->name('result.approved');

  // student fee payment
  Route::get('/student-details/fee-payment/{id}', [StudentFeePaymentController::class, 'index'])->name('student-fee-payment');
  Route::post('/student-details/fee-payment', [StudentFeePaymentController::class, 'store'])->name('student-fee-payment-save');
  Route::get('/student-details/paid-students-details', [StudentFeePaymentController::class, 'goToPaidList'])->name('paid-student-details');
  Route::get('/student-details/paid-students-details/ledger/{id}', [StudentFeePaymentController::class, 'gotoLedger'])->name('paid-student-details-ledger');
  Route::get('/student-details/paid-students-details/ledgerPrint/{id}', [StudentFeePaymentController::class, 'gotoLedgerPrint'])->name('paid-student-details-ledgerPrint');

  // teachers salary payment
  Route::get('/teacher-details/salary-payment/{id}', [TeachersSalaryPaymentController::class, 'index'])->name('teachers-salary-payment');
  Route::post('/teacher-details/salary-payment', [TeachersSalaryPaymentController::class, 'store'])->name('teachers-salary-payment-save');
  Route::get('/teacher-details/paid-teachers-details', [TeachersSalaryPaymentController::class, 'goToPaidList'])->name('paid-teacher-details');
  Route::get('/teacher-details/paid-teachers-details/ledger/{id}', [TeachersSalaryPaymentController::class, 'gotoLedger'])->name('paid-teachers-details-ledger');
  Route::get('/teacher-details/paid-teachers-details/ledgerPrint/{id}', [TeachersSalaryPaymentController::class, 'gotoLedgerPrint'])->name('paid-teachers-details-ledgerPrint');
  Route::get('/teacher-details/salarypaid-teachers-details',[TeachersSalaryPaymentController::class, 'goToPaidList'])->name('salarypaid-teachers-details');
  Route::get('/teacher-details/salary-ledger/{id}',[TeachersSalaryPaymentController::class, 'gotoLedger'])->name('paid-teacher-details-ledger');
  Route::get('/teacher-details/salary-ledgerPrint/{id}',[TeachersSalaryPaymentController::class, 'gotoLedgerPrint'])->name('paid-teacher-details-ledgerPrint');

  // teacher in leave
  Route::post('/teacher-leave/store', [TeacherLeaveController::class, 'store'])
  ->name('teacher-leave-save');

  // other staff details
  Route::get('/otherstaff/staff-details',[OtherStaffDetailsController::class,'index'])->name('other-staff-details');
  Route::post('/otherstaff/staff-details-save',[OtherStaffDetailsController::class,'store'])->name('other-staff-details-save');
  Route::post('/otherstaff/update', [OtherStaffDetailsController::class, 'update'])
  ->name('other-staff-details-update');
  Route::get('/otherstaff/make-payment/{id}',[OtherStaffDetailsController::class,'gotoPayment'])->name('other-staff-make-payment');

  // other staff payment 
  Route::post('other-staff/payment/', [OtherStaffPaymentController::class, 'store'])->name('other-staff-payment');
  Route::get('other-staff/ledger/{id}', [OtherStaffPaymentController::class, 'gotoLedger'])->name('other-staff-ledger');
  Route::get('other-staff/ledgerPrint/{id}', [OtherStaffPaymentController::class, 'gotoLedgerPrint'])->name('other-staff-ledgerPrint');

  // exam settings
  Route::get('exam/exam-setting', [ExamSettingController::class, 'index'])->name('exam-setting');
  Route::get('exam/add-exam-setting', [ExamSettingController::class, 'create'])->name('add-exam-setting');
  Route::post('exam/save-exam-setting', [ExamSettingController::class, 'store'])->name('save-exam-setting');
  Route::get('exam/edit-exam-setting', [ExamSettingController::class, 'edit'])->name('edit-exam-setting');
  Route::post('exam/update-exam-setting/{id}', [ExamSettingController::class, 'update'])->name('update-exam-setting');
  Route::delete('exam/delete-exam-setting/{id}', [ExamSettingController::class, 'destroy'])->name('delete-exam-setting');

  // exam schedule setting

  Route::get('exam/schedule-setting', [ExamScheduleController::class, 'index'])->name('schedule-setting');
  Route::get('exam/add-schedule-setting', [ExamScheduleController::class, 'create'])->name('add-schedule-setting');
  Route::post('exam/save-schedule-setting', [ExamScheduleController::class, 'store'])->name('save-schedule-setting');
  Route::get('exam/edit-schedule-setting', [ExamScheduleController::class, 'edit'])->name('edit-schedule-setting');
  Route::post('exam/update-schedule-setting/{id}', [ExamScheduleController::class, 'update'])->name('update-schedule-setting');
  Route::delete('exam/delete-schedule-setting/{id}', [ExamScheduleController::class, 'destroy'])->name('delete-schedule-setting');

  // exam type result
  Route::post('exam/save-exam-type-result', [ExamTypeResultController::class, 'store'])->name('save-exam-type-result');
});

