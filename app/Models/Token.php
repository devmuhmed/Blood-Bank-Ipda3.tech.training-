<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('token', 'type');
    public function client(){
        return $this->belongsTo('App\Models\Client');
    }
}
