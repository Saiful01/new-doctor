<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'divisions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'bn_name',
        'url',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function divisionDistricts()
    {
        return $this->hasMany(District::class, 'division_id', 'id');
    }

    public function divisionApplicants()
    {
        return $this->hasMany(Applicant::class, 'division_id', 'id');
    }
}
