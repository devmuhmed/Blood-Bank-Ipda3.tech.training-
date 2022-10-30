<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable=['title','content'];

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
    public function donationRequests()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

}
