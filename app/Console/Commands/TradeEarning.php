<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use App\Models\CMS_Liveaccount;
use App\Models\CMS_Iblevel;
use App\Models\CMS_IbCommission;


use App\Mail\CustomMail;
use Carbon\Carbon;

//use DB;


class TradeEarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trade:earning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store IB comission statistics in DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    //->where('mt5_orders_history.TimeDone','>=',$st)->where('mt5_orders_history.TimeDone','<=',$et)
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    while (true) {
	    	
	      // Ib Total Trade Earning Calculation
	      
	      //ini_set('max_execution_time', '-1');
	      $ib_clients=DB::table('cms_liveaccount')->where('ib_status',1)->select('affiliate_prom_code')->get();

	      $st = '2020-09-06';
	      $et = '2020-09-09';

	      $current_date = date('Y-m-d');
	      //$st = date('Y-m-d');
	      // $st = date('Y-m-d', strtotime($current_date.'-1 day'));
	      // $et = date('Y-m-d', strtotime($current_date.'+1 day'));
	      
	      foreach ($ib_clients as $key => $ib_client) {
	        $affiliate_prom_code=$ib_client->affiliate_prom_code;
	        $affiliate_prom_code=5122;
	        
	        $mt5_orders_history = CMS_Iblevel::join('cms_liveaccount','cms_liveaccount.affiliate_prom_code','cms_ib_level.child_ib')
	            ->join('cms_account','cms_account.email','cms_liveaccount.email')
	            ->join('mt5_orders_history','cms_account.account_no','mt5_orders_history.Login')
	            ->join('mt5_deals','mt5_orders_history.Order','mt5_deals.Order')
	            ->where('cms_ib_level.parent_ib',$affiliate_prom_code)
	            ->where('mt5_orders_history.Type','<',2)
	            ->where('mt5_orders_history.State',4)
	            ->where('mt5_deals.VolumeClosed','<>',0)
	            ->where('mt5_orders_history.TimeDone','>=',$st)
	            ->where('mt5_orders_history.TimeDone','<=',$et)
	            ->select('mt5_deals.PositionID','mt5_orders_history.Symbol','mt5_orders_history.VolumeInitial','mt5_orders_history.TimeDone','cms_ib_level.child_ib','cms_ib_level.level','cms_account.act_type')
	            ->get();
	        dd(count($mt5_orders_history));
	        
	        $total_earnings = 0;

	        foreach ($mt5_orders_history as $key=>$moh) {

	          $open_time_trade = DB::table('mt5_deals')->where('mt5_deals.order',$moh->PositionID)->where('mt5_deals.VolumeClosed',0)->first();
	          if($open_time_trade){
	            $open_time=$open_time_trade->Time;
	            $start = strtotime($open_time);
	            $end = strtotime($moh->TimeDone);
	            //$ttt = $end-$start;
	            if(($end-$start)<180){
	              unset($mt5_orders_history[$key]);
	              continue;
	            }
	          }
	          
	          $record_exist=DB::table('partner_trade_earning')->where('position_id',$moh->PositionID)->where('level',$moh->level)->count();
	          //return $record_exist;
	          
	          if ($record_exist==0) {

	            $ib_commission = CMS_IbCommission::join('partner_currency_groups','partner_currency_groups.id','cms_ib_commission.partner_currency_group_id')
	            ->join('partner_currency_symbols','partner_currency_symbols.partner_currency_group_id','partner_currency_groups.id')
	            ->where('cms_ib_commission.master_ib',$affiliate_prom_code)
	            ->where('cms_ib_commission.level',$moh->level)
	            ->where('cms_ib_commission.group_name',$moh->act_type)
	            ->where('partner_currency_symbols.symbol',$moh->Symbol)
	            ->select('cms_ib_commission.commission')->first();


	            if($ib_commission){
	              $total_earnings=$ib_commission->commission*$moh->VolumeInitial/10000;

	              DB::table('partner_trade_earning')
	                  ->insert([
	                    'ib_code' => $affiliate_prom_code,
	                    'position_id'=>$moh->PositionID,
	                    'from_date'=>$open_time_trade->Time,
	                    'to_date'=>$moh->TimeDone,
	                    'volume'=>$moh->VolumeInitial,
	                    'commission_rate'=>$ib_commission->commission,
	                    'total_commission'=>$total_earnings,
	                    'child_ib'=>$moh->child_ib,
	                    'level'=>$moh->level,
	                    'symbol'=>$moh->Symbol,
	                    'act_type'=>$moh->act_type,
	                    'created_at'=>date("Y-m-d H:i:s")
	                  ]);
	            }

	          }


	        }
	        echo 'IB '.$affiliate_prom_code.' Done'.PHP_EOL;
	      }
	      echo 'success for date '.$st.'--'.$et;
	    }
    }
}
