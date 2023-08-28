<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazila extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'upazilas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'district_id',
        'name',
        'bn_name',
        'url',
        'police_station_name',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function upazilaApplicants()
    {
        return $this->hasMany(Applicant::class, 'upazila_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
