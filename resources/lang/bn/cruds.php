<?php

return [
    'userManagement' => [
        'title'          => 'ব্যবহারকারী ব্যবস্থাপনা',
        'title_singular' => 'ব্যবহারকারী ব্যবস্থাপনা',
    ],
    'permission' => [
        'title'          => 'অনুমতিসমূহ',
        'title_singular' => 'অনুমতি',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'ভূমিকা/রোলগুলি',
        'title_singular' => 'ভূমিকা/রোল',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'ব্যবহারকারীগণ',
        'title_singular' => 'ব্যবহারকারী',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'FAQ Management',
        'title_singular' => 'FAQ Management',
    ],
    'faqCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'hospital' => [
        'title'          => 'Hospital',
        'title_singular' => 'Hospital',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'details'               => 'Details',
            'details_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'address'               => 'Address',
            'address_helper'        => ' ',
        ],
    ],
    'status' => [
        'title'          => 'Status',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'applicant' => [
        'title'          => 'Applicant',
        'title_singular' => 'Applicant',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'phone'              => 'Phone',
            'phone_helper'       => ' ',
            'email'              => 'Email',
            'email_helper'       => ' ',
            'address'            => 'Address',
            'address_helper'     => ' ',
            'password'           => 'Password',
            'password_helper'    => ' ',
            'is_active'          => 'Is Active',
            'is_active_helper'   => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'blood_group'        => 'Blood Group',
            'blood_group_helper' => ' ',
            'division'           => 'Division',
            'division_helper'    => ' ',
            'district'           => 'District',
            'district_helper'    => ' ',
            'upazila'            => 'Upazila',
            'upazila_helper'     => ' ',
            'age'                => 'Age',
            'age_helper'         => ' ',
            'dob'                => 'Date of Birth',
            'dob_helper'         => ' ',
            'gender'             => 'Gender',
            'gender_helper'      => ' ',
        ],
    ],
    'appointmentManagement' => [
        'title'          => 'Appointment Management',
        'title_singular' => 'Appointment Management',
    ],
    'appointment' => [
        'title'          => 'Appointment',
        'title_singular' => 'Appointment',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'applicant'                => 'Applicant',
            'applicant_helper'         => ' ',
            'hospital'                 => 'Hospital',
            'hospital_helper'          => ' ',
            'appointment_token'        => 'Appointment Token',
            'appointment_token_helper' => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
            'guest_patient'            => 'Guest Patient',
            'guest_patient_helper'     => ' ',
            'serial'                   => 'Serial',
            'serial_helper'            => ' ',
            'appoint_type'             => 'Appoint Type',
            'appoint_type_helper'      => ' ',
            'applicant_type'           => 'Applicant Type',
            'applicant_type_helper'    => ' ',
            'appoint_date'             => 'Appoint Date',
            'appoint_date_helper'      => ' ',
            'doctor'                   => 'Doctor',
            'doctor_helper'            => ' ',
        ],
    ],
    'appointmentStatus' => [
        'title'          => 'Appointment Status',
        'title_singular' => 'Appointment Status',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'appointment'        => 'Appointment',
            'appointment_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'specialist' => [
        'title'          => 'Specialist',
        'title_singular' => 'Specialist',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'is_active'         => 'Is Active',
            'is_active_helper'  => ' ',
            'logo'              => 'Logo',
            'logo_helper'       => ' ',
        ],
    ],
    'doctor' => [
        'title'          => 'Doctor',
        'title_singular' => 'Doctor',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'phone'                => 'Phone',
            'phone_helper'         => ' ',
            'email'                => 'Email',
            'email_helper'         => ' ',
            'address'              => 'Address',
            'address_helper'       => ' ',
            'short_details'        => 'Short Details',
            'short_details_helper' => ' ',
            'overview'             => 'Overview',
            'overview_helper'      => ' ',
            'specialist'           => 'Specialist',
            'specialist_helper'    => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'pro_image'            => 'Pro Image',
            'pro_image_helper'     => ' ',
            'fee'                  => 'Fee',
            'fee_helper'           => ' ',
            'old_fee'              => 'Old Fee',
            'old_fee_helper'       => ' ',
            'hospital'             => 'Hospital',
            'hospital_helper'      => ' ',
            'gender'               => 'Gender',
            'gender_helper'        => ' ',
            'day'                  => 'Available Day',
            'day_helper'           => ' ',
            'designation'          => 'Designation',
            'designation_helper'   => ' ',
        ],
    ],
    'location' => [
        'title'          => 'Locations',
        'title_singular' => 'Location',
    ],
    'division' => [
        'title'          => 'Division',
        'title_singular' => 'Division',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => 'Division name',
            'bn_name'           => 'Name in bangla',
            'bn_name_helper'    => 'Division name in bangla',
            'url'               => 'Url',
            'url_helper'        => 'Division website',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'district' => [
        'title'          => 'District',
        'title_singular' => 'District',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'bn_name'           => 'Name in bangla',
            'bn_name_helper'    => ' ',
            'url'               => 'Url',
            'url_helper'        => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'division'          => 'Division',
            'division_helper'   => ' ',
            'lat'               => 'Lat',
            'lat_helper'        => ' ',
            'lon'               => 'Lon',
            'lon_helper'        => ' ',
        ],
    ],
    'upazila' => [
        'title'          => 'Upazila',
        'title_singular' => 'Upazila',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'name'                       => 'Name',
            'name_helper'                => ' ',
            'bn_name'                    => 'Name in bangla',
            'bn_name_helper'             => ' ',
            'url'                        => 'Url',
            'url_helper'                 => ' ',
            'police_station_name'        => 'Police Station Name',
            'police_station_name_helper' => ' ',
            'type'                       => 'Type',
            'type_helper'                => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'district'                   => 'District',
            'district_helper'            => ' ',
        ],
    ],
    'weeklyDay' => [
        'title'          => 'Weekly Day',
        'title_singular' => 'Weekly Day',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'doctorManagement' => [
        'title'          => 'Doctor Management',
        'title_singular' => 'Doctor Management',
    ],
    'doctorSerial' => [
        'title'          => 'Doctor Serial',
        'title_singular' => 'Doctor Serial',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'doctor'            => 'Doctor',
            'doctor_helper'     => ' ',
            'hospital'          => 'Hospital',
            'hospital_helper'   => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'is_book'           => 'Is Book',
            'is_book_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'guestPatient' => [
        'title'          => 'Guest Patient',
        'title_singular' => 'Guest Patient',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'dob'               => 'Date of Birth',
            'dob_helper'        => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'appointmentReport' => [
        'title'          => 'Appointment Report',
        'title_singular' => 'Appointment Report',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'appointment'        => 'Appointment',
            'appointment_helper' => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'details'            => 'Details',
            'details_helper'     => ' ',
            'report'             => 'Report',
            'report_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'blog' => [
        'title'          => 'Blog',
        'title_singular' => 'Blog',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'details'               => 'Details',
            'details_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'files'                 => 'Files',
            'files_helper'          => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'patientManagement' => [
        'title'          => 'Patient Management',
        'title_singular' => 'Patient Management',
    ],
    'todaysAppointment' => [
        'title'          => 'Todays Appointment',
        'title_singular' => 'Todays Appointment',
    ],
    'platform' => [
        'title'          => 'Platform',
        'title_singular' => 'Platform',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'title'                          => 'Title',
            'title_helper'                   => ' ',
            'phone'                          => 'Phone',
            'phone_helper'                   => ' ',
            'extra_phone'                    => 'Extra Phone',
            'extra_phone_helper'             => ' ',
            'email'                          => 'Email',
            'email_helper'                   => ' ',
            'address'                        => 'Address',
            'address_helper'                 => ' ',
            'logo'                           => 'Logo',
            'logo_helper'                    => ' ',
            'facebook_url'                   => 'Facebook Url',
            'facebook_url_helper'            => ' ',
            'youtube_url'                    => 'Youtube Url',
            'youtube_url_helper'             => ' ',
            'twiter_url'                     => 'Twiter Url',
            'twiter_url_helper'              => ' ',
            'linked_in_url'                  => 'Linked In Url',
            'linked_in_url_helper'           => ' ',
            'about_us'                       => 'About Us',
            'about_us_helper'                => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'objectives'                     => 'Objectives',
            'objectives_helper'              => ' ',
            'professional_experience'        => 'Professional Experience',
            'professional_experience_helper' => ' ',
            'academic_qualification'         => 'Academic Qualification',
            'academic_qualification_helper'  => ' ',
            'training'                       => 'Training',
            'training_helper'                => ' ',
            'services'                       => 'Services',
            'services_helper'                => ' ',
        ],
    ],
    'designation' => [
        'title'          => 'Designation',
        'title_singular' => 'Designation',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'gallery' => [
        'title'          => 'Gallery',
        'title_singular' => 'Gallery',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'images'            => 'Images',
            'images_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'video' => [
        'title'          => 'Video',
        'title_singular' => 'Video',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'title'               => 'Title',
            'title_helper'        => ' ',
            'youtube_link'        => 'Youtube Link',
            'youtube_link_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],

];
