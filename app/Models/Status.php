<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function statusAppointments()
    {
        return $this->hasMany(Appointment::class, 'status_id', 'id');
    }

    public function statusAppointmentStatuses()
    {
        return $this->hasMany(AppointmentStatus::class, 'status_id', 'id');
    }
}
