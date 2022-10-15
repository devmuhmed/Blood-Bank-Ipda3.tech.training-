<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('email', 'phone', 'name');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationrequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function bloodtype()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

}