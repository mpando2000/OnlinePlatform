<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\OnlineSessionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StudentPromotionController;

// search
Route::get('/search', [SearchController::class, 'search'])->name('search');



Route::get('/adminLTE', [IndexController::class, 'adminLTE'])->name('adminLTE');
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::post('/select-role', [IndexController::class, 'selectRole'])->name('select.role');

Route::prefix('api')->group(function () {
    Route::get('/subjects', [SchoolClassController::class, 'getSubjects']);
});

// CSRF token refresh route
Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});


Route::get('/loginForm', [AuthController::class,'loginForm'])->name('loginForm');
Route::get('/login', function () {
    return redirect()->route('loginForm');
});
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::get('/regForm', [AuthController::class,'regForm'])->name('regForm');
Route::get('/register', function () {
    return redirect()->route('regForm');
});
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');
Route::post('/fetch-subjects', [AuthController::class, 'fetchSubjects'])->name('fetch.subjects');



Route::middleware(['auth','role:admin'])->group(function (){
    Route::get('/admin/dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user-management',[AdminController::class, 'users'])->name('admin.users');
    Route::get('/addUser', [AdminController::class, 'userForm']);
    Route::post('/user/add', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::get('/viewUser/{user}',[AdminController::class, 'viewUser']);
    Route::get('/editUser/{user}', [AdminController::class, 'editForm'])->name('admin.editUserForm');
    Route::put('/editedUser/{user}', [AdminController::class, 'updatedUser']);
    Route::delete('/deleteUser/{user}', [AdminController::class, 'destroy']);




    // route status
    Route::post('/admin/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('admin.users.updateStatus');
    Route::patch('/admin/users/{user}/status', [AuthController::class, 'updateStatus'])->name('admin.updateStatus');

    // reset password
    Route::get('/admin/reset-password/{user}', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');
    Route::post('/admin/reset-password/{user}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');


    Route::get('admin/admin-users/create', [AdminController::class,'createAdminUser'])->name('adminUsers.create');
    Route::post('admin/admin-users', [AdminController::class, 'storeAdminUser'])->name('adminUsers.store');

    Route::get('admin/teachers/{user}/assign-class-subject', [AdminController::class,'assignClassSubject'])->name('adminUsers.assign-class-subject');
    Route::post('admin/teachers/{teacher}/assign-class-subject', [AdminController::class,'storeClassSubjectAssignment'])->name('adminUsers.store-class-subject-assign');
    Route::delete('admin/teachers/{teacher}/remove-class-assignment', [AdminController::class,'removeClassAssignment'])->name('adminUsers.remove-class-assignment');




    Route::get('/admin/classes',[SchoolClassController::class, 'classes'])->name('admin.classes');
    Route::get('/addClass', [SchoolClassController::class, 'classForm']);
    Route::post('/storeClass', [SchoolClassController::class, 'addClass'])->name('storeClass');
    Route::get('/editClassForm/{school_class}', [SchoolClassController::class, 'editClassForm'])->name('editClassForm');
    Route::put('/updateClass/{school_class}', [SchoolClassController::class, 'updateClass'])->name('updateClass');
    Route::delete('/deleteClass/{school_class}', [SchoolClassController::class, 'destroyClass'])->name('destroyClass');
    Route::get('/viewClass/{school_class}',[SchoolClassController::class, 'viewClass'])->name('admin.class');

    // Schools management routes
    Route::resource('admin/schools', \App\Http\Controllers\Admin\SchoolController::class, ['as' => 'admin']);

    Route::get('/viewClass/{school_class}/addSubject', [SchoolClassController::class, 'subjectForm'])->name('subjectForm');
    Route::post('/viewClass/{school_class}/storeSubject', [SchoolClassController::class, 'addSubject'])->name('storeSubject');
    Route::get('/editSubjectForm/{subject}', [SchoolClassController::class, 'editSubjectForm'])->name('editSubjectForm');
    Route::put('/updateSubject/{subject}', [SchoolClassController::class, 'updateSubject'])->name('updateSubject');
    Route::delete('/deleteSubject/{subject}', [SchoolClassController::class, 'destroySubject'])->name('destroySubject');

    Route::get('/admin/onlineSessions', [OnlineSessionController::class, 'adminIndex'])->name('admin.onlineSessions');
    Route::get('/admin/create-meeting', [OnlineSessionController::class, 'adminCreateMeeting'])->name('admin.createMeeting');
    Route::get('/admin/joinOnlineSessions', [OnlineSessionController::class, 'adminJoinIndex'])->name('admin.joinOnlineSessions');
    Route::post('/admin/join-meeting', [OnlineSessionController::class, 'joinMeeting'])->name('admin.joinMeeting');


    Route::get('/admin/reports',[ReportController::class, 'reports'])->name('admin.report');
    Route::get('/admin/user-report',[ReportController::class, 'userReport'])->name('admin.user.reports');
    Route::get('/admin/user-report-print',[ReportController::class, 'userReportPrint'])->name('admin.reportPrint');
    Route::get('/admin/class-report',[ReportController::class, 'classReport'])->name('admin.class.reports');
    Route::get('/admin/class-report-print',[ReportController::class, 'classReportPrint'])->name('admin.classPrint');

    Route::get('/admin/class/{class}/subject/{subject}', [SchoolClassController::class, 'viewSubject'])->name('admin.subjects');
    Route::get('/admin/class/{class}/subject/{subject}/materials/upload', [MaterialController::class, 'materialForm'])->name('adminMaterials.upload');
    Route::post('/admin/class/{class}/subject/{subject}/materials/upload', [MaterialController::class, 'addMaterial'])->name('adminMaterials.store');


    //quizzes
    Route::get('/admin/quizzes', [QuizController::class, 'adminIndex'])->name('admin.quizzes.index');
    Route::get('/admin/quizzes/create', [QuizController::class, 'adminCreateQuiz'])->name('admin.quizzes.create');
    Route::get('/admin/get-subjects/{classId}', [QuizController::class, 'adminGetSubjectsByClass']);
    Route::post('/admin/quizzes', [QuizController::class, 'adminStoreQuiz'])->name('admin.quizzes.store');
    Route::get('admin/quizzes/upload', [QuizController::class,'adminUploadForm'])->name('admin.quizzes.upload');
    Route::post('admin/quizzes/upload', [QuizController::class,'adminUploadQuiz'])->name('admin.quizzes.upload.post');
    Route::get('/admin/quizzes/{quiz}', [QuizController::class, 'adminShowQuiz'])->name('admin.quizzes.show');
    Route::get('/admin/quizzes/{quiz}/edit', [QuizController::class, 'adminEditQuiz'])->name('admin.quizzes.edit');
    Route::put('/admin/quizzes/{quiz}', [QuizController::class, 'adminUpdateQuiz'])->name('admin.quizzes.update');
    Route::delete('/admin/quizzes/{quiz}', [QuizController::class, 'adminDestroyQuiz'])->name('admin.quizzes.destroy');
    Route::get('/admin/quizzes/{quiz}/results',[QuizController::class, 'adminViewQuizResults'])->name('admin.quizzes.results');
    Route::get('/admin/quizzes/{quiz}/upload-results-form', [QuizController::class,'adminUploadQuizResultsForm'])->name('admin.quizzes.uploadResults.form');
    Route::post('/admin/quizzes/{quiz}/upload-results', [QuizController::class,'adminUploadQuizResults'])->name('admin.quizzes.uploadResults');

    Route::get('/admin/quizzes/{quiz}/download-results-template', [QuizController::class, 'downloadResultsTemplate'])->name('admin.quizzes.downloadTemplate');


    //blog
    Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('/admin/blogs', [BlogController::class, 'store'])->name('blogs.store');

    // Slider management routes
    Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
    Route::get('/admin/sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
    Route::post('/admin/sliders', [SliderController::class, 'store'])->name('admin.sliders.store');
    Route::get('/admin/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('/admin/sliders/{slider}', [SliderController::class, 'update'])->name('admin.sliders.update');
    Route::delete('/admin/sliders/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    Route::post('/admin/sliders/update-order', [SliderController::class, 'updateOrder'])->name('admin.sliders.updateOrder');

    // Student Promotions
    Route::get('/admin/promotions', [StudentPromotionController::class, 'index'])->name('admin.promotions.index');
    Route::get('/admin/promotions/form', [StudentPromotionController::class, 'showForm'])->name('admin.promotions.form');
    Route::post('/admin/promotions/promote', [StudentPromotionController::class, 'promote'])->name('admin.promotions.promote');
    Route::post('/admin/promotions/bulk-promote', [StudentPromotionController::class, 'bulkPromote'])->name('admin.promotions.bulk');
    Route::get('/admin/promotions/history', [StudentPromotionController::class, 'history'])->name('admin.promotions.history');
    Route::get('/admin/promotions/student/{student}', [StudentPromotionController::class, 'studentHistory'])->name('admin.promotions.student-history');
    Route::delete('/admin/promotions/{promotion}/undo', [StudentPromotionController::class, 'undo'])->name('admin.promotions.undo');

});






Route::middleware(['auth','role:teacher'])->group(function (){
    Route::get('/teacher/change-password', [AuthController::class, 'teacherChangePasswordForm'])->name('teacher.change.password');
    Route::post('/teacher/change-password', [AuthController::class, 'teacherChangePassword'])->name('teacher.change.password.submit');

    Route::get('/teacher/dashboard',[TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/classes',[TeacherController::class, 'teacherClasses'])->name('teacher.classes');
    Route::get('/teacher/addClass', [TeacherController::class, 'teacherClassForm']);
    Route::post('/teacherStoreClass', [TeacherController::class, 'teacherAddClass'])->name('teacherStoreClass');
    Route::delete('/teacher/deleteClass/{school_class}', [SchoolClassController::class, 'destroyClass']);
    Route::get('/teacher/viewClass/{school_class}',[TeacherController::class, 'teacherViewClass'])->name('teacher.class');


    Route::get('/class/{class}/subject/{subject}', [TeacherController::class, 'viewSubject'])->name('teacher.subjects');
    Route::get('/class/{class}/subject/{subject}/materials/upload', [TeacherController::class, 'materialForm'])->name('teacherMaterials.upload');
    Route::post('/class/{class}/subject/{subject}/materials/upload', [TeacherController::class, 'addMaterial'])->name('teacherMaterials.store');
    Route::get('/showMaterial/{material}',[TeacherController::class, 'showMaterial'])->name('material.show');
    Route::get('/viewMaterial/{material}', [TeacherController::class, 'viewMaterialFile'])->name('material.view');
    Route::get('/downloadMaterial/{material}', [TeacherController::class, 'downloadMaterial'])->name('material.download');
    Route::delete('/deleteMaterial/{material}', [TeacherController::class, 'destroyMaterial'])->name('material.delete');


    //assignment
    Route::get('/teacher/assignments',[AssignmentController::class, 'assignments'])->name('teacher.assignments');
    Route::get('/addAssignment', [AssignmentController::class, 'assignmentForm']);
    Route::post('/add', [AssignmentController::class, 'addAssignment'])->name('assignments.store');
    Route::get('/teacher/assignments/submissions', [AssignmentController::class, 'reviewSubmissions'])->name('teacher.assignments.submissions');
    Route::get('/showAssignment/{assignment}',[AssignmentController::class, 'showAssignment'])->name('assignment.show');
    Route::delete('/deleteAssignment/{assignment}', [AssignmentController::class, 'destroy']);
    Route::get('/teacher/assignments/{assignment}/view', [AssignmentController::class, 'viewAssignment'])->name('teacher.assignment.open');
    Route::post('/submissions/{submission}/grade', [AssignmentController::class, 'gradeSubmission'])->name('submission.grade');
    Route::get('submissions', [SubmissionController::class, 'index'])->name('teacher.submissions');
    Route::post('assignments/{assignment}/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
    Route::get('submissions/view/{submission}', [SubmissionController::class, 'showSubmission'])->name('submission.show');
    Route::get('submissions/download/{submission}', [SubmissionController::class, 'downloadSubmission'])->name('submission.download');

    Route::get('/teacher/get-subjects/{classId}', [AssignmentController::class, 'teacherGetSubjectsByClass']);


    //blog
    Route::get('/teacher/blogs', [TeacherController::class, 'blog'])->name('teacher.blog');
    Route::post('/teacher/blogs', [TeacherController::class, 'store'])->name('teacher.blog.store');

    // teacher manage user
    Route::get('/teacher/user-management',[TeacherController::class, 'users'])->name('teacher.users');
    Route::get('/teacher/viewUser/{user}',[TeacherController::class, 'viewUser']);
    Route::get('/teacher/editUser/{user}', [TeacherController::class, 'editForm']);
    Route::put('/teacher/editedUser/{user}', [TeacherController::class, 'updatedUser']);
    Route::delete('/teacher/deleteUser/{user}', [TeacherController::class, 'destroy']);

    //teacher Online sessions
    Route::get('/teacher/onlineSessions', [OnlineSessionController::class, 'index'])->name('teacher.onlineSessions');
    Route::get('/teacher/create-meeting', [OnlineSessionController::class, 'createMeeting'])->name('teacher.createMeeting');
    Route::get('/teacher/joinOnlineSessions', [OnlineSessionController::class, 'teacherJoinIndex'])->name('teacher.joinOnlineSessions');
    Route::post('/teacher/join-meeting', [OnlineSessionController::class, 'joinMeeting'])->name('teacher.joinMeeting');

    //reports
    Route::get('/teacher/reports',[ReportController::class, 'teacherReports'])->name('teacher.report');
    Route::get('/teacher/user-report',[ReportController::class, 'teacherUserReport'])->name('teacher.user.reports');
    Route::get('/teacher/user-report-print',[ReportController::class, 'teacherUserReportPrint'])->name('teacher.reportPrint');
    Route::get('/teacher/class-report',[ReportController::class, 'teacherClassReport'])->name('teacher.class.reports');
    Route::get('/teacher/class-report-print',[ReportController::class, 'teacherClassReportPrint'])->name('teacher.classPrint');

    //quizzes
    Route::get('/teacher/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/teacher/quizzes/create', [QuizController::class, 'createQuiz'])->name('quizzes.create');
    Route::post('/teacher/quizzes', [QuizController::class, 'storeQuiz'])->name('quizzes.store');
    Route::get('/teacher/quizzes/upload', [QuizController::class,'uploadForm'])->name('quizzes.upload');
    Route::post('/teacher/quizzes/upload', [QuizController::class,'uploadQuiz'])->name('quizzes.upload.post');
    Route::get('/teacher/quizzes/results', [QuizController::class, 'resultsIndex'])->name('teacher.quizzes.results');
    Route::get('/teacher/quizzes/{quiz}/file', [QuizController::class, 'viewQuizFile'])->name('quizzes.file');
    Route::get('/teacher/quizzes/{quiz}', [QuizController::class, 'showQuiz'])->name('quizzes.show');
    Route::get('/teacher/quizzes/{quiz}/edit', [QuizController::class, 'editQuiz'])->name('quizzes.edit');
    Route::put('/teacher/quizzes/{quiz}', [QuizController::class, 'updateQuiz'])->name('quizzes.update');
    Route::delete('/teacher/quizzes/{quiz}', [QuizController::class, 'destroyQuiz'])->name('quizzes.destroy');

    Route::get('/teacher/quizzes/{quiz}/results',[QuizController::class, 'viewQuizResults'])->name('view.quizzes.results');
    Route::get('/teacher/quizzes/{quiz}/upload-results', [QuizController::class,'uploadQuizResultsForm'])->name('quizzes.uploadResultsForm');
    Route::get('/teacher/quizzes/{quiz}/download-template', [QuizController::class, 'downloadTemplate'])->name('quizzes.downloadTemplate');
    Route::post('/teacher/quizzes/{quiz}/upload-results', [QuizController::class,'storeQuizResults'])->name('quizzes.uploadResults');



});

Route::middleware(['auth','role:student'])->group(function (){
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change.password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password.submit');

    Route::get('/student/dashboard',[StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/student/class',[StudentController::class, 'subjects'])->name('student.class');
    Route::get('/student/class/{subject}/materials', [StudentController::class, 'showMaterials'])->name('student.subject.materials');
    Route::get('/student/materials/{material}/download', [StudentController::class, 'materialDownload'])->name('student.materials.download');
    Route::get('/student/materials/{material}/view', [StudentController::class, 'viewMaterial'])->name('student.material.open');

    Route::get('/student/assignments', [AssignmentController::class, 'listAssignments'])->name('student.assignments');
    Route::get('/assignments/{assignmentId}/download', [AssignmentController::class, 'downloadAssignment'])->name('student.assignments.download');
    Route::get('/student/assignments/{assignment}/submitForm', [AssignmentController::class, 'assignmentSubmissionForm'])->name('student.assignment.form');
    Route::post('/student/assignments/{assignment}/submit', [AssignmentController::class, 'submitAssignment'])->name('student.assignments.submit');
    Route::get('/student/showAssignment/{assignment}',[AssignmentController::class, 'assignmentDetails'])->name('student.assignment.show');
    Route::get('/student/assignments/{assignment}/view', [AssignmentController::class, 'viewAssignment'])->name('student.assignment.open');


    //blog
    Route::get('/student/blogs', [StudentController::class, 'blog'])->name('student.blog');
    Route::post('/student/blogs', [StudentController::class, 'store'])->name('student.blog.store');

    //quizzes
    Route::get('/student/quizzes', [QuizController::class, 'studentIndex'])->name('student.quizzes');
    Route::get('/student/quizzes/{quiz}/file', [QuizController::class, 'viewQuizFile'])->name('student.quizzes.file');
    Route::get('/student/quizzes/{quiz}/start', [QuizController::class, 'takeQuiz'])->name('quizzes.start');

    // Route to submit the quiz answers
    Route::post('/student/quizzes/{quiz}/submit', [QuizController::class, 'submitQuiz'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/results', [QuizController::class, 'showQuizResults'])->name('quizzes.results');


    //online sessions
    Route::get('/student/onlineSessions', [OnlineSessionController::class, 'studentIndex'])->name('student.onlineSessions');
    Route::post('/student/join-meeting', [OnlineSessionController::class, 'joinMeeting'])->name('student.joinMeeting');


});

//routes for all

Route::middleware(['auth'])->group(function () {
    Route::get('/to-do-list', [ToDoListController::class, 'index'])->name('to-do-list');
    Route::post('/to-do-list', [ToDoListController::class, 'store'])->name('to-do-list.store');
    Route::patch('/to-do-list/{id}', [ToDoListController::class, 'update'])->name('to-do-list.update');
    Route::delete('/to-do-list/{id}', [ToDoListController::class, 'destroy'])->name('to-do-list.destroy');




});
