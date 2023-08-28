<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('appointment_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/todays-appointments*") ? "c-show" : "" }} {{ request()->is("admin/appointments*") ? "c-show" : "" }} {{ request()->is("admin/appointment-statuses*") ? "c-show" : "" }} {{ request()->is("admin/appointment-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.appointmentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('todays_appointment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.todays-appointments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/todays-appointments") || request()->is("admin/todays-appointments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.todaysAppointment.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('appointment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.appointments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.appointment.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('appointment_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.appointment-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/appointment-statuses") || request()->is("admin/appointment-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.appointmentStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('appointment_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.appointment-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/appointment-reports") || request()->is("admin/appointment-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-prescription c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.appointmentReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('doctor_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/doctors*") ? "c-show" : "" }} {{ request()->is("admin/doctor-serials*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.doctorManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('doctor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.doctors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/doctors") || request()->is("admin/doctors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.doctor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('doctor_serial_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.doctor-serials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/doctor-serials") || request()->is("admin/doctor-serials/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.doctorSerial.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('patient_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/applicants*") ? "c-show" : "" }} {{ request()->is("admin/guest-patients*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-female c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.patientManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('applicant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.applicants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/applicants") || request()->is("admin/applicants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.applicant.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('guest_patient_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.guest-patients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/guest-patients") || request()->is("admin/guest-patients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-ninja c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.guestPatient.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('hospital_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.hospitals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hospitals") || request()->is("admin/hospitals/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.hospital.title') }}
                </a>
            </li>
        @endcan
        @can('status_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/statuses") || request()->is("admin/statuses/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-signal c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.status.title') }}
                </a>
            </li>
        @endcan
        @can('specialist_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.specialists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/specialists") || request()->is("admin/specialists/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.specialist.title') }}
                </a>
            </li>
        @endcan
        @can('weekly_day_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.weekly-days.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/weekly-days") || request()->is("admin/weekly-days/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.weeklyDay.title') }}
                </a>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('blog_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.blogs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blogs") || request()->is("admin/blogs/*") ? "c-active" : "" }}">
                    <i class="fa-fw fab fa-blogger-b c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.blog.title') }}
                </a>
            </li>
        @endcan
        @can('platform_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.platforms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/platforms") || request()->is("admin/platforms/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.platform.title') }}
                </a>
            </li>
        @endcan
        @can('designation_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.designations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/designations") || request()->is("admin/designations/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-pen-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.designation.title') }}
                </a>
            </li>
        @endcan
        @can('gallery_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.galleries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/galleries") || request()->is("admin/galleries/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-images c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.gallery.title') }}
                </a>
            </li>
        @endcan
        @can('location_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/divisions*") ? "c-show" : "" }} {{ request()->is("admin/districts*") ? "c-show" : "" }} {{ request()->is("admin/upazilas*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-map-marker-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.location.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('division_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.divisions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/divisions") || request()->is("admin/divisions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.division.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('district_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.districts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/districts") || request()->is("admin/districts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marked c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.district.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('upazila_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.upazilas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/upazilas") || request()->is("admin/upazilas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marked c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.upazila.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('video_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.videos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/videos") || request()->is("admin/videos/*") ? "c-active" : "" }}">
                    <i class="fa-fw fab fa-youtube c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.video.title') }}
                </a>
            </li>
        @endcan
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>