<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS_IbCommission extends Model
{
    protected $table = 'cms_ib_commission';

    protected $fillable = [ 'master_ib', 'level', 'group_name','partner_currency_group_id' ];

    public $timestamps = false;

    protected $primaryKey = 'intid';

    public function partnerCurrencySymbols()
    {
        return $this->hasMany('App\partnerCurrencySymbol');
    }
}
