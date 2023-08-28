<?php


use App\Http\Controllers\Api\V1\Admin\ApplicantApiController;
use App\Http\Controllers\Api\V1\Admin\DistrictApiController;
use App\Http\Controllers\Api\V1\Admin\DivisionApiController;
use App\Http\Controllers\Api\V1\Admin\UpazilaApiController;
use App\Http\Controllers\Api\V1\Admin\UsersApiController;

Route::post('/admin/login', [UsersApiController::class, 'loginUser']);
Route::post('/applicant/login', [ApplicantApiController::class, 'patientLogin']);
Route::post('/applicant/registration', [ApplicantApiController::class, 'patientRegistration']);
Route::post('/applicant/registration-otp/send', [ApplicantApiController::class, 'otpSend']);
Route::post('/applicant/otp/verify', [ApplicantApiController::class, 'otpVerify']);
Route::get('/divisions', [DivisionApiController::class, 'index']);
Route::get('/districts', [DistrictApiController::class, 'index']);
Route::get('/upazilas', [UpazilaApiController::class, 'index']);

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Hospital
    Route::post('hospitals/media', 'HospitalApiController@storeMedia')->name('hospitals.storeMedia');
    Route::apiResource('hospitals', 'HospitalApiController');

    // Status
    Route::apiResource('statuses', 'StatusApiController');

    // Applicant
    Route::apiResource('applicants', 'ApplicantApiController');

    // Appointment
    Route::apiResource('appointments', 'AppointmentApiController');

    // Specialist
    Route::post('specialists/media', 'SpecialistApiController@storeMedia')->name('specialists.storeMedia');
    Route::apiResource('specialists', 'SpecialistApiController');

    // Doctor
    Route::post('doctors/media', 'DoctorApiController@storeMedia')->name('doctors.storeMedia');
    Route::apiResource('doctors', 'DoctorApiController');

    // Division
    Route::apiResource('divisions', 'DivisionApiController');

    // District
    Route::apiResource('districts', 'DistrictApiController');

    // Upazila
    Route::apiResource('upazilas', 'UpazilaApiController');

    // Weekly Day
    Route::apiResource('weekly-days', 'WeeklyDayApiController');

    // Doctor Serial
    Route::apiResource('doctor-serials', 'DoctorSerialApiController');

    // Guest Patient
    Route::apiResource('guest-patients', 'GuestPatientApiController');

    // Appointment Report
    Route::post('appointment-reports/media', 'AppointmentReportApiController@storeMedia')->name('appointment-reports.storeMedia');
    Route::apiResource('appointment-reports', 'AppointmentReportApiController');

    // Blog
    Route::post('blogs/media', 'BlogApiController@storeMedia')->name('blogs.storeMedia');
    Route::apiResource('blogs', 'BlogApiController');

    // Platform
    Route::post('platforms/media', 'PlatformApiController@storeMedia')->name('platforms.storeMedia');
    Route::apiResource('platforms', 'PlatformApiController');

    // Designation
    Route::apiResource('designations', 'DesignationApiController');

    // Gallery
    Route::post('galleries/media', 'GalleryApiController@storeMedia')->name('galleries.storeMedia');
    Route::apiResource('galleries', 'GalleryApiController');

    // Video
    Route::apiResource('videos', 'VideoApiController');
});
