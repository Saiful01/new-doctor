<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSerial extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'doctor_serials';

    public const IS_BOOK_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_RADIO = [
        'Morning' => 'Morning',
        'Evening' => 'Evening',
    ];

    protected $fillable = [
        'doctor_id',
        'hospital_id',
        'type',
        'title',
        'is_book',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function serialAppointments()
    {
        return $this->hasMany(Appointment::class, 'serial_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
