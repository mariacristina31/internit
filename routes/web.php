<?php

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard',
    ]);

    Route::get('/profile', [
        'uses' => 'ProfileController@index',
        'as' => 'profile',
    ]);

    Route::get('/profile-update-pass', [
        'uses' => 'ProfileController@pup',
        'as' => 'profile-update-pass',
    ]);

    Route::get('/profile-update', [
        'uses' => 'ProfileController@pu',
        'as' => 'profile-update',
    ]);

    Route::post('/profile-update-pass', [
        'uses' => 'ProfileController@pupx',
        'as' => 'profile-update-pass',
    ]);

    Route::post('/profile-update', [
        'uses' => 'ProfileController@pux',
        'as' => 'profile-update',
    ]);

    Route::group(['middleware' => ['role:Student']], function () {

        Route::get('/form-company', [
            'uses' => 'HomeController@company',
            'as' => 'requirements.company',
            'middleware' => 'student.is-verified',
        ]);

        Route::get('/timesheet-report', [
            'uses' => 'HomeController@reportTimesheet',
            'as' => 'report.timesheet',
        ]);

        Route::get('/form-information', [
            'uses' => 'HomeController@information',
            'as' => 'requirements.information',
            'middleware' => 'student.is-verified',
        ]);

        Route::get('/form-documents', [
            'uses' => 'HomeController@documents',
            'as' => 'requirements.documents',
            'middleware' => 'student.is-verified',
        ]);

        Route::patch('/update-student-requirements', [
            'uses' => 'HomeController@updateStudent',
            'as' => 'requirements.update-student',
            'middleware' => 'student.is-verified',
        ]);
        Route::patch('/update-student-requirements', [
            'uses' => 'HomeController@updateStudent',
            'as' => 'requirements.update-student',
            'middleware' => 'student.is-verified',
        ]);

    });

    Route::group(['middleware' => ['role:Company']], function () {

        Route::get('/company-students', [
            'uses' => 'DashboardController@companyStudents',
            'as' => 'company-students',
        ]);

        Route::get('/company-timesheets', [
            'uses' => 'DashboardController@timesheets',
            'as' => 'company-timesheets',
        ]);

        Route::get('/student-timesheet/{id}', [
            'uses' => 'DashboardController@studentTimesheet',
            'as' => 'student-timesheet',
        ]);

        Route::patch('/update-student-timesheet/{id}', [
            'uses' => 'DashboardController@updateStudentTimesheet',
            'as' => 'student-timesheet.update',
        ]);

    });

    Route::post('/logout', [
        'uses' => 'Auth\LoginController@logout',
        'as' => 'logout',
    ]);
});

Route::group(['middleware' => 'guest'], function () {

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [
        'uses' => 'Auth\LoginController@loginForm',
        'as' => 'login',
    ]);

    Route::post('/login', [
        'uses' => 'Auth\LoginController@login',
        'as' => 'login',
    ]);
});

Route::group(['middleware' => 'auth', 'middleware' => ['role:Student', 'requirements']], function () {

    Route::resource('timesheet', 'TimesheetController');

    Route::post('/manual-add-time', [
        'uses' => 'TimesheetController@manualAddTime',
        'as' => 'manual.add.time',
    ]);

    Route::get('/ojt-form', [
        'uses' => 'ProfileController@ojtForm',
        'as' => 'ojt.form',
    ]);
});

Route::group(['middleware' => 'auth', 'middleware' => ['role:Admin|Practicum']], function () {

    Route::resource('section', 'SectionController');

    Route::resource('company', 'CompanyController');

    Route::resource('requirement', 'RequirementController');

    Route::resource('post', 'PostController');

    Route::resource('user', 'UserController');

    Route::resource('student', 'StudentController');

    Route::get('/profile-check/{id}', [
        'uses' => 'ProfileController@profilecheck',
        'as' => 'profile.check',
    ]);

});

Route::group(['middleware' => 'auth', 'middleware' => ['role:Admin']], function () {

    Route::resource('user', 'UserController');

    Route::post('/student/import', [
        'uses' => 'StudentController@importCsv',
        'as' => 'student.import',
    ]);

});

Route::group(['middleware' => 'auth', 'prefix' => 'section', 'middleware' => ['role:Admin|Practicum']], function () {

    Route::get('/{section}/students', [
        'uses' => 'SectionController@students',
        'as' => 'section.students',
    ]);

    Route::patch('/student-detach/{student}', [
        'uses' => 'SectionController@studentDetach',
        'as' => 'section.student-detach',
    ]);

});

Route::group(['middleware' => 'auth', 'prefix' => 'company', 'middleware' => ['role:Admin|Practicum']], function () {

    Route::get('/{company}/students', [
        'uses' => 'CompanyController@students',
        'as' => 'company.students',
    ]);

    Route::patch('/student-detach/{student}', [
        'uses' => 'CompanyController@studentDetach',
        'as' => 'company.student-detach',
    ]);

});
