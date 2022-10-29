<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable =[
        'patient_name',
        'patient_phone',
        'patient_age',
        'blood_type_id',
        'bags_num',
        'hospital_address',
        'hospital_name',
        'city_id',
        'client_id',
        'details',
        'latitude',
        'longitude',
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}
