<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 32,
                'title' => 'hospital_create',
            ],
            [
                'id'    => 33,
                'title' => 'hospital_edit',
            ],
            [
                'id'    => 34,
                'title' => 'hospital_show',
            ],
            [
                'id'    => 35,
                'title' => 'hospital_delete',
            ],
            [
                'id'    => 36,
                'title' => 'hospital_access',
            ],
            [
                'id'    => 37,
                'title' => 'status_create',
            ],
            [
                'id'    => 38,
                'title' => 'status_edit',
            ],
            [
                'id'    => 39,
                'title' => 'status_show',
            ],
            [
                'id'    => 40,
                'title' => 'status_delete',
            ],
            [
                'id'    => 41,
                'title' => 'status_access',
            ],
            [
                'id'    => 42,
                'title' => 'applicant_create',
            ],
            [
                'id'    => 43,
                'title' => 'applicant_edit',
            ],
            [
                'id'    => 44,
                'title' => 'applicant_show',
            ],
            [
                'id'    => 45,
                'title' => 'applicant_delete',
            ],
            [
                'id'    => 46,
                'title' => 'applicant_access',
            ],
            [
                'id'    => 47,
                'title' => 'appointment_management_access',
            ],
            [
                'id'    => 48,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 49,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 50,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 51,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 52,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 53,
                'title' => 'appointment_status_create',
            ],
            [
                'id'    => 54,
                'title' => 'appointment_status_edit',
            ],
            [
                'id'    => 55,
                'title' => 'appointment_status_show',
            ],
            [
                'id'    => 56,
                'title' => 'appointment_status_delete',
            ],
            [
                'id'    => 57,
                'title' => 'appointment_status_access',
            ],
            [
                'id'    => 58,
                'title' => 'specialist_create',
            ],
            [
                'id'    => 59,
                'title' => 'specialist_edit',
            ],
            [
                'id'    => 60,
                'title' => 'specialist_show',
            ],
            [
                'id'    => 61,
                'title' => 'specialist_delete',
            ],
            [
                'id'    => 62,
                'title' => 'specialist_access',
            ],
            [
                'id'    => 63,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 64,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 65,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 66,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 67,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 68,
                'title' => 'location_access',
            ],
            [
                'id'    => 69,
                'title' => 'division_create',
            ],
            [
                'id'    => 70,
                'title' => 'division_edit',
            ],
            [
                'id'    => 71,
                'title' => 'division_show',
            ],
            [
                'id'    => 72,
                'title' => 'division_delete',
            ],
            [
                'id'    => 73,
                'title' => 'division_access',
            ],
            [
                'id'    => 74,
                'title' => 'district_create',
            ],
            [
                'id'    => 75,
                'title' => 'district_edit',
            ],
            [
                'id'    => 76,
                'title' => 'district_show',
            ],
            [
                'id'    => 77,
                'title' => 'district_delete',
            ],
            [
                'id'    => 78,
                'title' => 'district_access',
            ],
            [
                'id'    => 79,
                'title' => 'upazila_create',
            ],
            [
                'id'    => 80,
                'title' => 'upazila_edit',
            ],
            [
                'id'    => 81,
                'title' => 'upazila_show',
            ],
            [
                'id'    => 82,
                'title' => 'upazila_delete',
            ],
            [
                'id'    => 83,
                'title' => 'upazila_access',
            ],
            [
                'id'    => 84,
                'title' => 'weekly_day_create',
            ],
            [
                'id'    => 85,
                'title' => 'weekly_day_edit',
            ],
            [
                'id'    => 86,
                'title' => 'weekly_day_show',
            ],
            [
                'id'    => 87,
                'title' => 'weekly_day_delete',
            ],
            [
                'id'    => 88,
                'title' => 'weekly_day_access',
            ],
            [
                'id'    => 89,
                'title' => 'doctor_management_access',
            ],
            [
                'id'    => 90,
                'title' => 'doctor_serial_create',
            ],
            [
                'id'    => 91,
                'title' => 'doctor_serial_edit',
            ],
            [
                'id'    => 92,
                'title' => 'doctor_serial_show',
            ],
            [
                'id'    => 93,
                'title' => 'doctor_serial_delete',
            ],
            [
                'id'    => 94,
                'title' => 'doctor_serial_access',
            ],
            [
                'id'    => 95,
                'title' => 'guest_patient_create',
            ],
            [
                'id'    => 96,
                'title' => 'guest_patient_edit',
            ],
            [
                'id'    => 97,
                'title' => 'guest_patient_show',
            ],
            [
                'id'    => 98,
                'title' => 'guest_patient_delete',
            ],
            [
                'id'    => 99,
                'title' => 'guest_patient_access',
            ],
            [
                'id'    => 100,
                'title' => 'appointment_report_create',
            ],
            [
                'id'    => 101,
                'title' => 'appointment_report_edit',
            ],
            [
                'id'    => 102,
                'title' => 'appointment_report_show',
            ],
            [
                'id'    => 103,
                'title' => 'appointment_report_delete',
            ],
            [
                'id'    => 104,
                'title' => 'appointment_report_access',
            ],
            [
                'id'    => 105,
                'title' => 'blog_create',
            ],
            [
                'id'    => 106,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 107,
                'title' => 'blog_show',
            ],
            [
                'id'    => 108,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 109,
                'title' => 'blog_access',
            ],
            [
                'id'    => 110,
                'title' => 'patient_management_access',
            ],
            [
                'id'    => 111,
                'title' => 'todays_appointment_create',
            ],
            [
                'id'    => 112,
                'title' => 'todays_appointment_edit',
            ],
            [
                'id'    => 113,
                'title' => 'todays_appointment_show',
            ],
            [
                'id'    => 114,
                'title' => 'todays_appointment_delete',
            ],
            [
                'id'    => 115,
                'title' => 'todays_appointment_access',
            ],
            [
                'id'    => 116,
                'title' => 'platform_create',
            ],
            [
                'id'    => 117,
                'title' => 'platform_edit',
            ],
            [
                'id'    => 118,
                'title' => 'platform_show',
            ],
            [
                'id'    => 119,
                'title' => 'platform_delete',
            ],
            [
                'id'    => 120,
                'title' => 'platform_access',
            ],
            [
                'id'    => 121,
                'title' => 'designation_create',
            ],
            [
                'id'    => 122,
                'title' => 'designation_edit',
            ],
            [
                'id'    => 123,
                'title' => 'designation_show',
            ],
            [
                'id'    => 124,
                'title' => 'designation_delete',
            ],
            [
                'id'    => 125,
                'title' => 'designation_access',
            ],
            [
                'id'    => 126,
                'title' => 'gallery_create',
            ],
            [
                'id'    => 127,
                'title' => 'gallery_edit',
            ],
            [
                'id'    => 128,
                'title' => 'gallery_show',
            ],
            [
                'id'    => 129,
                'title' => 'gallery_delete',
            ],
            [
                'id'    => 130,
                'title' => 'gallery_access',
            ],
            [
                'id'    => 131,
                'title' => 'video_create',
            ],
            [
                'id'    => 132,
                'title' => 'video_edit',
            ],
            [
                'id'    => 133,
                'title' => 'video_show',
            ],
            [
                'id'    => 134,
                'title' => 'video_delete',
            ],
            [
                'id'    => 135,
                'title' => 'video_access',
            ],
            [
                'id'    => 136,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
