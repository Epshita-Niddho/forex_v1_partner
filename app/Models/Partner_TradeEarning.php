<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner_TradeEarning extends Model
{
    protected $table = 'partner_trade_earning';

    // protected $fillable = [ 'parent_ib', 'child_ib', 'level' ];

    public $timestamps = false;

    protected $primaryKey = 'id';
}
