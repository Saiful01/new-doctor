<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'appointments';

    public const APPLICANT_TYPE_SELECT = [
        'Self'  => 'Self',
        'Other' => 'Other',
    ];

    protected $dates = [
        'appoint_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const APPOINT_TYPE_SELECT = [
        'New Visit'    => 'New Visit',
        'Report Visit' => 'Report Visit',
        'Re Visit'     => 'Re Visit',
    ];

    protected $fillable = [
        'applicant_id',
        'doctor_id',
        'hospital_id',
        'guest_patient_id',
        'serial_id',
        'appoint_type',
        'appointment_token',
        'applicant_type',
        'appoint_date',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function appointmentAppointmentStatuses()
    {
        return $this->hasMany(AppointmentStatus::class, 'appointment_id', 'id');
    }

    public function appointmentAppointmentReports()
    {
        return $this->hasMany(AppointmentReport::class, 'appointment_id', 'id');
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function guest_patient()
    {
        return $this->belongsTo(GuestPatient::class, 'guest_patient_id');
    }

    public function serial()
    {
        return $this->belongsTo(DoctorSerial::class, 'serial_id');
    }

    public function getAppointDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAppointDateAttribute($value)
    {
        $this->attributes['appoint_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
