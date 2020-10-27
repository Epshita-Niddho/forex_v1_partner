<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ABLiveAccount extends Model
{
    protected $table = 'ab_liveaccount';

    public $timestamps = false;

    protected $fillable = [ 'full_name', 'email', 'phone', 'country', 'affiliate_code'];
}
