<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'applicants';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const IS_ACTIVE_RADIO = [
        'Active'   => 'Active',
        'InActive' => 'InActive',
    ];

    public const GENDER_RADIO = [
        'Male'   => 'Male',
        'Female' => 'Female',
        'Other'  => 'Other',
    ];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'blood_group',
        'gender',
        'division_id',
        'district_id',
        'upazila_id',
        'address',
        'age',
        'dob',
        'password',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const BLOOD_GROUP_SELECT = [
        'O Positive (O+)'    => 'O Positive (O+)',
        'A Positive (A+)'    => 'A Positive (A+)',
        'B Positive (B+)'    => 'B Positive (B+)',
        'AB Positive (AB+)'  => 'AB Positive (AB+)',
        'O Negative (O-)'    => 'O Negative (O-)',
        'A Negative (A-)'    => 'A Negative (A-)',
        'B Negative (B-)'    => 'B Negative (B-)',
        'AB Negative  (AB-)' => 'AB Negative (AB-)',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function applicantAppointments()
    {
        return $this->hasMany(Appointment::class, 'applicant_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
