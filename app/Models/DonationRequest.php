<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\City');
    }

}