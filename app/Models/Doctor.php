<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Doctor extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'doctors';

    protected $appends = [
        'pro_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
        'designation_id',
        'gender',
        'address',
        'short_details',
        'overview',
        'fee',
        'old_fee',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function doctorDoctorSerials()
    {
        return $this->hasMany(DoctorSerial::class, 'doctor_id', 'id');
    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class);
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function days()
    {
        return $this->belongsToMany(WeeklyDay::class);
    }

    public function getProImageAttribute()
    {
        $file = $this->getMedia('pro_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
