<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Hospital
    Route::delete('hospitals/destroy', 'HospitalController@massDestroy')->name('hospitals.massDestroy');
    Route::post('hospitals/media', 'HospitalController@storeMedia')->name('hospitals.storeMedia');
    Route::post('hospitals/ckmedia', 'HospitalController@storeCKEditorImages')->name('hospitals.storeCKEditorImages');
    Route::resource('hospitals', 'HospitalController');

    // Status
    Route::delete('statuses/destroy', 'StatusController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusController');

    // Applicant
    Route::delete('applicants/destroy', 'ApplicantController@massDestroy')->name('applicants.massDestroy');
    Route::post('applicants/parse-csv-import', 'ApplicantController@parseCsvImport')->name('applicants.parseCsvImport');
    Route::post('applicants/process-csv-import', 'ApplicantController@processCsvImport')->name('applicants.processCsvImport');
    Route::resource('applicants', 'ApplicantController');

    // Appointment
    Route::delete('appointments/destroy', 'AppointmentController@massDestroy')->name('appointments.massDestroy');
    Route::post('appointments/parse-csv-import', 'AppointmentController@parseCsvImport')->name('appointments.parseCsvImport');
    Route::post('appointments/process-csv-import', 'AppointmentController@processCsvImport')->name('appointments.processCsvImport');
    Route::resource('appointments', 'AppointmentController');

    // Appointment Status
    Route::delete('appointment-statuses/destroy', 'AppointmentStatusController@massDestroy')->name('appointment-statuses.massDestroy');
    Route::resource('appointment-statuses', 'AppointmentStatusController');

    // Specialist
    Route::delete('specialists/destroy', 'SpecialistController@massDestroy')->name('specialists.massDestroy');
    Route::post('specialists/media', 'SpecialistController@storeMedia')->name('specialists.storeMedia');
    Route::post('specialists/ckmedia', 'SpecialistController@storeCKEditorImages')->name('specialists.storeCKEditorImages');
    Route::resource('specialists', 'SpecialistController');

    // Doctor
    Route::delete('doctors/destroy', 'DoctorController@massDestroy')->name('doctors.massDestroy');
    Route::post('doctors/media', 'DoctorController@storeMedia')->name('doctors.storeMedia');
    Route::post('doctors/ckmedia', 'DoctorController@storeCKEditorImages')->name('doctors.storeCKEditorImages');
    Route::resource('doctors', 'DoctorController');

    // Division
    Route::delete('divisions/destroy', 'DivisionController@massDestroy')->name('divisions.massDestroy');
    Route::resource('divisions', 'DivisionController');

    // District
    Route::delete('districts/destroy', 'DistrictController@massDestroy')->name('districts.massDestroy');
    Route::resource('districts', 'DistrictController');

    // Upazila
    Route::delete('upazilas/destroy', 'UpazilaController@massDestroy')->name('upazilas.massDestroy');
    Route::resource('upazilas', 'UpazilaController');

    // Weekly Day
    Route::delete('weekly-days/destroy', 'WeeklyDayController@massDestroy')->name('weekly-days.massDestroy');
    Route::resource('weekly-days', 'WeeklyDayController');

    // Doctor Serial
    Route::delete('doctor-serials/destroy', 'DoctorSerialController@massDestroy')->name('doctor-serials.massDestroy');
    Route::post('doctor-serials/parse-csv-import', 'DoctorSerialController@parseCsvImport')->name('doctor-serials.parseCsvImport');
    Route::post('doctor-serials/process-csv-import', 'DoctorSerialController@processCsvImport')->name('doctor-serials.processCsvImport');
    Route::resource('doctor-serials', 'DoctorSerialController');

    // Guest Patient
    Route::delete('guest-patients/destroy', 'GuestPatientController@massDestroy')->name('guest-patients.massDestroy');
    Route::resource('guest-patients', 'GuestPatientController');

    // Appointment Report
    Route::delete('appointment-reports/destroy', 'AppointmentReportController@massDestroy')->name('appointment-reports.massDestroy');
    Route::post('appointment-reports/media', 'AppointmentReportController@storeMedia')->name('appointment-reports.storeMedia');
    Route::post('appointment-reports/ckmedia', 'AppointmentReportController@storeCKEditorImages')->name('appointment-reports.storeCKEditorImages');
    Route::resource('appointment-reports', 'AppointmentReportController');

    // Blog
    Route::delete('blogs/destroy', 'BlogController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::resource('blogs', 'BlogController');

    // Todays Appointment
    Route::delete('todays-appointments/destroy', 'TodaysAppointmentController@massDestroy')->name('todays-appointments.massDestroy');
    Route::resource('todays-appointments', 'TodaysAppointmentController');

    // Platform
    Route::delete('platforms/destroy', 'PlatformController@massDestroy')->name('platforms.massDestroy');
    Route::post('platforms/media', 'PlatformController@storeMedia')->name('platforms.storeMedia');
    Route::post('platforms/ckmedia', 'PlatformController@storeCKEditorImages')->name('platforms.storeCKEditorImages');
    Route::resource('platforms', 'PlatformController');

    // Designation
    Route::delete('designations/destroy', 'DesignationController@massDestroy')->name('designations.massDestroy');
    Route::resource('designations', 'DesignationController');

    // Gallery
    Route::delete('galleries/destroy', 'GalleryController@massDestroy')->name('galleries.massDestroy');
    Route::post('galleries/media', 'GalleryController@storeMedia')->name('galleries.storeMedia');
    Route::post('galleries/ckmedia', 'GalleryController@storeCKEditorImages')->name('galleries.storeCKEditorImages');
    Route::resource('galleries', 'GalleryController');

    // Video
    Route::delete('videos/destroy', 'VideoController@massDestroy')->name('videos.massDestroy');
    Route::resource('videos', 'VideoController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
