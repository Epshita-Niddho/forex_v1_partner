<?php

namespace App\Http\Controllers\BackEnd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\CMS_Liveaccount;
use App\Models\CMS_Iblevel;
use App\Models\CMS_IbCommission;
use App\Models\Partner_Withdraw;
use Mail;
use Session;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAccess');
    }

    public function serverConfigs(){
    $server_configs=DB::table('server_configs')->first();
    return $server_configs;

  }

    public function email_adds(){
    $email_adds=DB::table('cms_email_addresses')->first();
    return $email_adds;
  }

    public function errorNotFound(){
    	return view('errors.404');
    }



    // function for showing dashboard


    public function getIndex()
    {

		$login_email=session('login_email');
		$affiliate=DB::table('cms_liveaccount')->where('email',$login_email)->first();
		
		
		$affiliate_prom_code=$affiliate->affiliate_prom_code;
		
		$referral_accounts = CMS_Iblevel::where('parent_ib',$affiliate_prom_code)->count();

		$mt5_orders_history = CMS_Iblevel::join('cms_liveaccount','cms_liveaccount.affiliate_prom_code','cms_ib_level.child_ib')->join('cms_account','cms_account.email','cms_liveaccount.email')->join('mt5_orders_history','cms_account.account_no','mt5_orders_history.Login')->join('mt5_deals','mt5_orders_history.Order','mt5_deals.Order')->where('cms_ib_level.parent_ib',$affiliate_prom_code)->where('mt5_orders_history.Type','<',2)->where('mt5_orders_history.State',4)->where('mt5_deals.VolumeClosed','<>',0)->select('mt5_deals.PositionID','mt5_orders_history.Symbol','mt5_orders_history.TimeDone','mt5_orders_history.VolumeInitial','cms_ib_level.level','cms_account.act_type')->get();

		$total_earnings = 0;

		foreach ($mt5_orders_history as $key=>$moh) {
				$open_time_trade = DB::table('mt5_deals')->where('mt5_deals.order',$moh->PositionID)->where('mt5_deals.VolumeClosed',0)->first();
			if($open_time_trade){
			$open_time=$open_time_trade->Time;
			$start = strtotime($open_time);
			$end = strtotime($moh->TimeDone);

			if(($end-$start)<0){
				unset($mt5_orders_history[$key]);
				continue;
			}

			}
			$ib_commission = CMS_IbCommission::join('partner_currency_groups','partner_currency_groups.id','cms_ib_commission.partner_currency_group_id')->join('partner_currency_symbols','partner_currency_symbols.partner_currency_group_id','partner_currency_groups.id')->where('cms_ib_commission.master_ib',$affiliate_prom_code)->where('cms_ib_commission.level',$moh->level)->where('cms_ib_commission.group_name',$moh->act_type)->where('partner_currency_symbols.symbol',$moh->Symbol)->select('cms_ib_commission.commission')->first();
			if($ib_commission){
				$total_earnings+=$ib_commission->commission*$moh->VolumeInitial/10000;
			}

		}

		if($total_earnings>0){
			$total_earnings = round($total_earnings,2);
		}

		$total_withdraw = Partner_Withdraw::where([
				['email','=',$login_email],
				['status','<>','2']
				])->sum('amount');
		if($total_withdraw<0){
			$total_withdraw = -round($total_withdraw,2);
		}
		

		$available_balance = $total_earnings-$total_withdraw;
		if($available_balance>0){
			$available_balance = round($available_balance,2);
		}
		else{
			$available_balance = 0;
		}
			
		
					 
		$history=Partner_Withdraw::where('email',session('login_email'))->orderBy('id', 'desc')->limit(5)->get();

		$client_portal_url=DB::table('general_information')->select('client_portal_url')->first();
		$client_url=$client_portal_url->client_portal_url;
        
        // var_dump($label_x) ;exit;
    	return view('backEnd.dashboard.index1',compact('mt5_orders_history','referral_accounts','total_earnings','history','available_balance','total_withdraw','affiliate_prom_code','client_url'));
    }

    public function getIbLevelValues()
    {
		// getting volume
    	$login_email= session('login_email');
    	// $login_email= 'anikfx2014@gmail.com';
		$time_to_d = Carbon::now();
        $time_from_d = Carbon::now()->addDay(-28);

        $info = CMS_Liveaccount::where('email',$login_email)->first();
        $affiliate_prom_code = $info->affiliate_prom_code;

        $label	= [];
		// pushing today's date into label
		array_push($label, $time_to_d->format('m/d'));

         for($i=1;$i<11;$i++){
         	${'level'.$i.'_raw'} = CMS_Liveaccount::Join('cms_ib_level','cms_ib_level.parent_ib','=','cms_liveaccount.affiliate_prom_code')->Join('cms_liveaccount as master','cms_ib_level.child_ib','=','master.affiliate_prom_code')->Join('cms_account','master.email','=','cms_account.email')->Join('mt5_orders_history','mt5_orders_history.Login','cms_account.account_no')->Join('mt5_deals','mt5_orders_history.Order','mt5_deals.Order')->select([DB::raw('mt5_orders_history.Login, date(mt5_orders_history.TimeDone) close_date,SUM(mt5_orders_history.VolumeInitial)/10000 as volume,mt5_orders_history.TimeDone,mt5_deals.PositionID')])->where([['cms_account.act_type','<>','DEMO'],['mt5_orders_history.Type','<',2],['mt5_orders_history.State','=',4],['cms_account.act_type','<>',NULL]])->where('cms_liveaccount.email',$login_email)->where('cms_ib_level.level',$i)->whereBetween('mt5_orders_history.TimeDone',[$time_from_d,$time_to_d])->where('mt5_deals.VolumeClosed','<>',0)->orderBy('mt5_orders_history.TimeDone','desc')->groupBy('mt5_orders_history.TimeDone')->get();

         	foreach(${'level'.$i.'_raw'} as $key=>$moh){
                // Search open time for this trade
                $open_time_trade = DB::table('mt5_deals')->where('mt5_deals.order',$moh->PositionID)->where('mt5_deals.VolumeClosed',0)->first();
                if($open_time_trade){
                    $open_time=$open_time_trade->Time;
                    $start = strtotime($open_time);
                    $end = strtotime($moh->TimeDone);

                    if(($end-$start)<0){
                        unset(${'level'.$i.'_raw'}[$key]);
                        continue;
                    }
                }
         	}

         	${'level'.$i} = [];
         	${'raw_flag'.$i} = 0;

            //pushing vol for level 1st elememnt
            ${'raw_elements'.$i} = count(${'level'.$i.'_raw'});
            if (${'raw_flag'.$i} < ${'raw_elements'.$i}) {
                 ${'raw_day'.$i} = Carbon::parse(${'level'.$i.'_raw'}[${'raw_flag'.$i}]->TimeDone)->format('m/d');
                if (${'raw_day'.$i} == $time_to_d->format('m/d')) {
                    array_push(${'level'.$i}, floatval(${'level'.$i.'_raw'}[${'raw_flag'.$i}]->volume));
                    ${'raw_flag'.$i} += 1;
                }
                else{
                    array_push(${'level'.$i}, 0);
                }
            } else {
                array_push(${'level'.$i}, 0);
            }
		    // end pushing level 1st element
         }

		
		for ($j=1; $j <= 28; $j++) {

			$day = $time_to_d->addDay(-1); 
			// checking raw date and vol to label date and preparing level data

			for($i=1;$i<11;$i++){
                // for level1
                if (${'raw_flag'.$i} < ${'raw_elements'.$i}) {
                     ${'raw_day'.$i} = Carbon::parse(${'level'.$i.'_raw'}[${'raw_flag'.$i}]->TimeDone)->format('m/d');

                    if (${'raw_day'.$i} == $time_to_d->format('m/d')) {
                        array_push(${'level'.$i}, floatval(${'level'.$i.'_raw'}[${'raw_flag'.$i}]->volume));
                        ${'raw_flag'.$i} += 1;
                    }
                    else{
                        array_push(${'level'.$i}, 0);
                    }
                } else {
                    array_push(${'level'.$i}, 0);
                }
                // end pushing value to level1 array
			}

			// preparing label data
			if ($j%7 == 0) {
				$day_formatted = $time_to_d->format('m/d');
				array_push($label, $day_formatted);
			}
			else{
				array_push($label,' ');
			}
		}

		$level1 = array_reverse($level1);
		$level2 = array_reverse($level2);
		$level3 = array_reverse($level3);
		$level4 = array_reverse($level4);
		$level5 = array_reverse($level5);
		$level6 = array_reverse($level6);
		$level7 = array_reverse($level7);
		$level8 = array_reverse($level8);
		$level9 = array_reverse($level9);
		$level10 = array_reverse($level10);
		$label_x = array_reverse($label);
    	return $data = ['level1' => $level1,'level2' => $level2,'level3' => $level3,'level4' => $level4,'level5' => $level5,'level6' => $level6,'level7' => $level7,'level8' => $level8,'level9' => $level9,'level10' => $level10,'label_x' =>  $label_x];
    }
	
	

    public function getStatistics()
    {
		$req_level = 1;
		$login_email=session('login_email');
		$info=CMS_Liveaccount::where('email',$login_email)->select('affiliate_prom_code')->first();
		$affiliate_prom_code = $info->affiliate_prom_code;
					  

    	return view('backEnd.dashboard.statistics',compact('affiliate_prom_code'));
    }


    public function partnerCommStatLevel(Request $request){

    	$req_level=$request->level;
    	$start = $request->start;
    	if(!$start){
    		$start = '1970-01-01';
    	}
    	// $end = $request->end;
    	$end =date( 'Y-m-d H:i:s', strtotime( $request->end ) + 86399);
    	



		$info=DB::table('cms_liveaccount')->where('affiliate_prom_code',$request->id)->first();
		
		$mt5_orders_history = CMS_Iblevel::join('cms_liveaccount','cms_liveaccount.affiliate_prom_code','cms_ib_level.child_ib')->join('cms_account','cms_account.email','cms_liveaccount.email')->join('mt5_orders_history','cms_account.account_no','mt5_orders_history.Login')->join('mt5_deals','mt5_orders_history.Order','mt5_deals.Order')->join('partner_currency_symbols','partner_currency_symbols.symbol','mt5_orders_history.Symbol')->join('partner_currency_groups','partner_currency_groups.id','partner_currency_symbols.partner_currency_group_id')->where('cms_ib_level.parent_ib',$request->id)->where('mt5_orders_history.Type','<',2)->where('mt5_orders_history.State',4)->where('cms_ib_level.level',$req_level)->whereBetween('mt5_orders_history.TimeDone',[$start,$end])->where('mt5_deals.VolumeClosed','<>',0)->selectRaw('mt5_deals.PositionID,mt5_orders_history.Symbol,cms_ib_level.level,cms_account.act_type,cms_liveaccount.fname,cms_liveaccount.lname,cms_liveaccount.country,cms_liveaccount.affiliate_prom_code,cms_account.account_no,mt5_orders_history.TimeDone,mt5_orders_history.Type,mt5_orders_history.VolumeInitial/10000 AS volume')->orderBy('mt5_orders_history.TimeDone','desc')->get();

		$total_volume = 0;
		$total_ib_commission = 0;
		foreach ($mt5_orders_history as $key=>$moh) {
			
			// Search open time for this trade
			$open_time_trade = DB::table('mt5_deals')->where('mt5_deals.order',$moh->PositionID)->where('mt5_deals.VolumeClosed',0)->first();
			if($open_time_trade){
			$open_time=$open_time_trade->Time;
			$start = strtotime($open_time);
			$end = strtotime($moh->TimeDone);

			if(($end-$start)<0){
				unset($mt5_orders_history[$key]);
				continue;
			}

			}

			$moh->ib_commission=0; 

			$ib_commission = CMS_IbCommission::join('partner_currency_groups','partner_currency_groups.id','cms_ib_commission.partner_currency_group_id')->join('partner_currency_symbols','partner_currency_symbols.partner_currency_group_id','partner_currency_groups.id')->where('cms_ib_commission.master_ib',$request->id)->where('cms_ib_commission.level',$moh->level)->where('cms_ib_commission.group_name',$moh->act_type)->where('partner_currency_symbols.symbol',$moh->Symbol)->select('cms_ib_commission.commission')->first();
			
			if($ib_commission){
				$moh->ib_commission=$ib_commission->commission*$moh->volume;
			}
			$total_volume+=$moh->volume;
			$total_ib_commission+=$moh->ib_commission;

			
			
		}

		$total_volume = round($total_volume,2);
		$total_ib_commission = round($total_ib_commission,2);

    	return view('backEnd.dashboard.comm_stat',compact('mt5_orders_history','info','req_level','total_volume','total_ib_commission'));
    }



    // Ib Clients

    public function getClients(){
    	$req_level = 1;
		$login_email=session('login_email');
		$info=CMS_Liveaccount::where('email',$login_email)->select('affiliate_prom_code')->first();
		$affiliate_prom_code = $info->affiliate_prom_code;
    	return view('backEnd.dashboard.clients',compact('affiliate_prom_code'));
    }


    public function partnerClientsLevel(Request $request){

    	$req_level=$request->level;
    	// $start = $request->start;
    	// if(!$start){
    	// 	$start = '1970-01-01';
    	// }
    	// $end = $request->end;

		$info=DB::table('cms_liveaccount')->where('affiliate_prom_code',$request->id)->first();
		
		// $clients = CMS_Iblevel::join('cms_liveaccount','cms_liveaccount.affiliate_prom_code','cms_ib_level.child_ib')->where('cms_ib_level.parent_ib',$request->id)->where('cms_ib_level.level',$req_level)->whereBetween('cms_liveaccount.reg_time',[$start,$end])->get();
		
		$clients = CMS_Iblevel::join('cms_liveaccount','cms_liveaccount.affiliate_prom_code','cms_ib_level.child_ib')->where('cms_ib_level.parent_ib',$request->id)->where('cms_ib_level.level',$req_level)->get();

		

    	return view('backEnd.dashboard.client_levels',compact('clients','req_level','info'));
    }



	
	public function getFundWithdraw(){
		$trading_accounts=DB::table('cms_account')->join('mt5_users','mt5_users.Login','cms_account.account_no')->where([
			['cms_account.email',session('login_email')],
			['cms_account.act_type','<>','DEMO'],
			['cms_account.is_mt5','1']
			])->select('cms_account.account_no','cms_account.act_type')->get();

		 $payment_method = CMS_Liveaccount::where('email',session('login_email'))->select('partner_payment_method')->first();

		if ($payment_method['partner_payment_method'] != 'all') {
			$methods = explode(',',$payment_method['partner_payment_method']);
		}
		else {
			$methods = 'all';
		}
		
		return view('backEnd.dashboard.fund_withdrawal',compact('trading_accounts','methods'));
	}
	


	public function getFaqs(){
		
		return view('backEnd.dashboard.faqs');
	}
	
	
	public function postFundWithdraw(Request $request){

		$login_email=session('login_email');
		$affiliate=DB::table('cms_liveaccount')->where('email',$login_email)->first();
		
		
			$affiliate_prom_code=$affiliate->affiliate_prom_code;
			$name=$affiliate->fname." ".$affiliate->lname;
		
		$available_balance = $this->checkAvailableBalance($affiliate_prom_code);

	if(is_numeric($request->amount)==false){
		return redirect('/withdraw')->withErrors(['Please Enter a valid amount']);
	}
    elseif($request->amount<1){
    	return redirect('/withdraw')->withErrors(['Minimium Balance Transfer is $1']);
    }
    elseif($available_balance>=$request->amount){
    	$request->payment_type='Transfer to Trading Account';
    	$email_adds = $this->email_adds();
		  $from_email_id=$email_adds->noreply_email;
		  $from_name=config('app.name');
    	
    	$user_mail=session('login_email');
    	$mail_subject='Verification Code for fund transfer';
    	$verification_code=mt_rand(100000, 999999);
    	session(['verification_code' => $verification_code]);
    	$data = array('name' => $name , 'verification_code' => session('verification_code'));
    	
    	Mail::send('backEnd.dashboard.email-template',
            $data, function($message)use ($from_email_id,$from_name,$user_mail, $name,$mail_subject)
        {
            $message->from($from_email_id,$from_name);
            $message->to($user_mail, $name)->subject($mail_subject);
        });
        
       

        return view('backEnd.dashboard.verification_code',compact('request'));
    }
else {
	return redirect('/withdraw')->withErrors(['Your balance is not sufficient for this fund transfer request']);
	
}
		
	}




	public function supportedMethod($method)
	{
		 $methods = CMS_Liveaccount::where('email',session('login_email'))->select('partner_payment_method')->first();
		if ($methods['partner_payment_method'] != 'all') {
			$s_methods = explode(',', $methods['partner_payment_method']);
			foreach ($s_methods as $s_method) {
				if ($s_method == $method) {
					return true;
				}
				
			}
			return false;
		}
		else{
			return true;
		}
	}



	public function getNetellerWithdraw(Request $request){
	 $this->supportedMethod('neteller');
		if ($this->supportedMethod('neteller') == true) {
			 $methods = CMS_Liveaccount::where('email',session('login_email'))->select('partner_payment_method')->first();

			if ($methods['partner_payment_method'] != 'all') {
			$methods = explode(',', $methods['partner_payment_method']);
			
		}
			return view('backEnd.dashboard.neteller_withdrawal',compact('methods'));
		}
		else{
			return view('errors.404');
		}
		
			
		
	}

	public function getSkrillWithdraw(Request $request){
		
			if ($this->supportedMethod('skrill') == true) {
				$methods = CMS_Liveaccount::where('email',session('login_email'))->select('partner_payment_method')->first();
				if ($methods['partner_payment_method'] != 'all') {
			$methods = explode(',', $methods['partner_payment_method']);
			
		}
			return view('backEnd.dashboard.skrill_withdrawal',compact('methods'));
		}
		else{
			return view('errors.404');
		}
		
		
	}

	public function getBankTransfer(){
		

			if ($this->supportedMethod('bank') == true) {
				$methods = CMS_Liveaccount::where('email',session('login_email'))->select('partner_payment_method')->first();
				if ($methods['partner_payment_method'] != 'all') {
			$methods = explode(',', $methods['partner_payment_method']);
			
		}
			return view('backEnd.dashboard.bank_transfer',compact('methods'));
		}
		else{
			return view('errors.404');
		}
		
	}
	
	

	public function postNetellerWithdraw(Request $request){
			$login_email=session('login_email');
		$affiliate=DB::table('cms_liveaccount')->where('email',$login_email)->first();
		
		
			$affiliate_prom_code=$affiliate->affiliate_prom_code;
			$name=$affiliate->fname." ".$affiliate->lname;
		
	$available_balance = $this->checkAvailableBalance($affiliate_prom_code);

	if(is_numeric($request->amount)==false){
		return view('backEnd.dashboard.neteller_withdrawal')->withErrors(['Please Enter a valid amount']);
	}
	elseif(is_numeric($request->account)==false || $request->account<1000000000){
		return view('backEnd.dashboard.neteller_withdrawal')->withErrors(['Your given Neteller account no. is invalid.']);
	}
    elseif($request->amount<20){
    	return view('backEnd.dashboard.neteller_withdrawal')->withErrors(['Minimium Neteller withdraw is $20']);
    }
    elseif($available_balance>=$request->amount){
    	$request->payment_type='Neteller';
    	$email_adds = $this->email_adds();
		  $from_email_id=$email_adds->noreply_email;
		  $from_name=config('app.name');
    	$user_mail=session('login_email');
    	$mail_subject='Verification Code for fund transfer';
    	$verification_code=mt_rand(100000, 999999);
    	session(['verification_code' => $verification_code]);
    	Session::save();
    	$data = array('name' => $name , 'verification_code' => session('verification_code'));
    	Mail::send('backEnd.dashboard.email-template',
            $data, function($message)use ($from_email_id,$from_name,$user_mail, $name,$mail_subject)
        {
            $message->from($from_email_id,$from_name);
            $message->to($user_mail, $name)->subject($mail_subject);
        });
        
       

        return view('backEnd.dashboard.verification_code',compact('request'));
    }
else {
	return view('backEnd.dashboard.neteller_withdrawal')->withErrors(['Your balance is not sufficient for this withdrawal request']);
}

	}




	public function postSkrillWithdraw(Request $request){
			$login_email=session('login_email');
		$affiliate=DB::table('cms_liveaccount')->where('email',$login_email)->first();
		
		
			$affiliate_prom_code=$affiliate->affiliate_prom_code;
			$name=$affiliate->fname." ".$affiliate->lname;
		
		$available_balance = $this->checkAvailableBalance($affiliate_prom_code);

	if(is_numeric($request->amount)==false){
		return view('backEnd.dashboard.skrill_withdrawal')->withErrors(['Please Enter a valid amount']);
	}
    elseif($request->amount<20){
    	return view('backEnd.dashboard.skrill_withdrawal')->withErrors(['Minimium Skrill withdraw is $20']);
    }
    elseif($available_balance>=$request->amount){
    	$request->payment_type='Skrill';
    	$email_adds = $this->email_adds();
		  $from_email_id=$email_adds->noreply_email;
		  $from_name=config('app.name');
    	$user_mail=session('login_email');
    	$mail_subject='Verification Code for fund transfer';
    	$verification_code=mt_rand(100000, 999999);
    	session(['verification_code' => $verification_code]);
    	$data = array('name' => $name , 'verification_code' => session('verification_code'));
    	
    	Mail::send('backEnd.dashboard.email-template',
            $data, function($message)use ($from_email_id,$from_name,$user_mail, $name,$mail_subject)
        {
            $message->from($from_email_id,$from_name);
            $message->to($user_mail, $name)->subject($mail_subject);
        });
        
       

        return view('backEnd.dashboard.verification_code',compact('request'));
    }
else {
	return view('backEnd.dashboard.skrill_withdrawal')->withErrors(['Your balance is not sufficient for this withdrawal request']);
}

	}




	public function postBankTransfer(Request $request){
			$login_email=session('login_email');
		$affiliate=DB::table('cms_liveaccount')->where('email',$login_email)->first();
		
		
			$affiliate_prom_code=$affiliate->affiliate_prom_code;
			$name=$affiliate->fname." ".$affiliate->lname;
		
		$available_balance = $this->checkAvailableBalance($affiliate_prom_code);

	if(is_numeric($request->amount)==false){
		return view('backEnd.dashboard.bank_transfer')->withErrors(['Please Enter a valid amount']);
	}
    elseif($request->amount<50){
    	return view('backEnd.dashboard.bank_transfer')->withErrors(['Minimium Bank Wire Transfer is $50']);
    }
    elseif($available_balance>=$request->amount){
    	$request->payment_type='Bank Wire Transfer';
    	$email_adds = $this->email_adds();
		  $from_email_id=$email_adds->noreply_email;
		  $from_name=config('app.name');
    	$user_mail=session('login_email');
    	$mail_subject='Verification Code for fund transfer';
    	$verification_code=mt_rand(100000, 999999);
    	session(['verification_code' => $verification_code]);
    	$data = array('name' => $name , 'verification_code' => session('verification_code'));
    	
    	Mail::send('backEnd.dashboard.email-template',
            $data, function($message)use ($from_email_id,$from_name,$user_mail, $name,$mail_subject)
        {
            $message->from($from_email_id,$from_name);
            $message->to($user_mail, $name)->subject($mail_subject);
        });
        
       

        return view('backEnd.dashboard.verification_code',compact('request'));
    }
else {
	return view('backEnd.dashboard.bank_transfer')->withErrors(['Your balance is not sufficient for this withdrawal request']);
}

	}
	


public function updateWithdraw(Request $request){
	

	if($request->verification_code!=session('verification_code')){
		return view('backEnd.dashboard.verification_code',compact('request'))->withErrors(['Verification code is incorrect. ']);
	}

	else{
		$account_info=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
		$fname=$account_info->fname;
		$lname=$account_info->lname;
		$country=$account_info->country;
		$reference=time();
		$amount=(-1)*$request->amount;
		


	if($request->payment_type=='Transfer to Trading Account'){
			$status=1;
			
      
			$myvalue = $request->trading_account;
$arr = explode(' ',trim($myvalue));

          
         $server_configs=$this->serverConfigs();
  $server=$server_configs->mt5_server;
  $server_login=$server_configs->mt5_login;
  $server_password=$server_configs->mt5_password;
    
          
  
  $login=$arr[0];
  $comment='Partner Tx#'.$reference;
 $a=exec(storage_path('/api/mt5/DepositBalanceWeb.exe')." \"".$server."\" \"".$server_login."\" \"".$server_password."\" \"".$login."\" \"".$request->amount."\" \"".$comment);
 
 


  if($a!='Successful'){
            return Redirect::back();
          }

          $email_adds = $this->email_adds();
		  $from_email_id=$email_adds->withdraw_email_to;
		  $from_name=config('app.name');
		$user_mail=session('login_email');
		$name=$fname." ".$lname;
		
		$mail_subject='Withdraw Confirmation';
		$data=array(
				'amount'=>(-1)*$amount,
				'name'=>$name
			);
		Mail::send('backEnd.dashboard.approve-mail',
            $data, function($message)use ($user_mail, $name,$mail_subject,$from_email_id,$from_name)
        {
            $message->from($from_email_id,$from_name);
            $message->to($user_mail, $name)->subject($mail_subject);
        });


		}




		else{

			$status=0;
		}



		$insert=DB::table('partner_withdraw')
		->insert(
    ['reference_no' => $reference,
     'fname'=>$fname,
     'lname'=>$lname,
     'email'=>session('login_email'),
     'amount'=>$amount,
     'payment_type'=>$request->payment_type,
     'payment_email'=>$request->email,
     'payment_id'=>$request->account,
     'bank_name'=>$request->bank_name,
     'bank_country'=>$request->bank_country,
     'bank_acc_name'=>$request->bank_acc_name,
     'iban_num'=>$request->iban_num,
     'swift_num'=>$request->swift_num,
     'bank_address'=>$request->bank_address,
     'correspondent_bank'=>$request->correspondent_bank,
     'trading_account'=>$request->trading_account,
     'verification_code'=>session('verification_code'),
     'status'=>$status
     ]
);

		DB::table('cms_log')
    ->insert(
    ['ref_id' => $reference,
     'table_name'=>'partner_withdraw',
     'naration'=>session('login_email'),
     'ip_address'=>$_SERVER['REMOTE_ADDR'],
     
     'date_time'=>date("Y-m-d H:i:s",$reference)
     ]
);

		$name=$fname." ".$lname;
		$data = array(
					 'name' => $name ,
					 'reference' => $reference,
					 'email'=>session('login_email'),
					 'amount'=>$request->amount,
					 'payment_type'=>$request->payment_type,
					 'payment_email'=>$request->email,
					 'account'=>$request->account,
					 'bank_name'=>$request->bank_name,
				     'bank_country'=>$request->bank_country,
				     'bank_acc_name'=>$request->bank_acc_name,
				     'iban_num'=>$request->iban_num,
				     'swift_num'=>$request->swift_num,
				     'bank_address'=>$request->bank_address,
				     'correspondent_bank'=>$request->correspondent_bank,
				     'trading_account'=>$request->trading_account,
					 'verification_code'=>session('verification_code')
		 );

		$email_adds = $this->email_adds();
		  $from_email_id=$email_adds->withdraw_email_from;
		  $user_mail=$email_adds->withdraw_email_to;
		$user_name=config('app.name');;
		if($request->payment_type=='Transfer to Trading Account'){
			$mail_subject='New Internal Transfer From Partner';
			$from_name='Internal Transfer';
		}
		else{
			$mail_subject='New withdraw request arrived';
			$from_name='Partner Fund Withdraw';
		}

    	Mail::send('backEnd.dashboard.withdraw-request-mail',
            $data, function($message)use ($from_email_id,$from_name,$user_mail, $user_name,$mail_subject)
        {
            $message->from($from_email_id,$from_name);
            $message->to($user_mail, $user_name)->subject($mail_subject);
        });

		//Notifications
		


    DB::table('admins')
      ->where('id',$account_info->manager)
      ->orWhere([
        'country_access'=>'All',
        'manager'=>0
    ])
      ->orWhere([
        'country_access'=>$account_info->country,
        'manager'=>0
      ])
    ->increment('partnerWithdraw', 1);

		return view('backEnd.dashboard.successful-withdraw-request');
	}

}	


		public function getTransactionHistory(){
			
			return view('backEnd.dashboard.transaction-history');
		}

		public function transactionHistoryDatatable(Request $request){
		$limit = $request->limit;
		$time_to_d = Carbon::now();
        $time_from_d = Carbon::now()->addDay(-$limit);

			$history=DB::table('partner_withdraw')->select(['amount','payment_type','reference_no','created_at',DB::raw('(						CASE 
                                        WHEN partner_withdraw.status = 0 THEN "Pending"
                                        WHEN partner_withdraw.status = 1 THEN "Approved"
                                        WHEN partner_withdraw.status = 2 THEN "Cancelled"
                                        
                                        END) as status')])->where('email',session('login_email'))->whereBetween('created_at',[$time_from_d,$time_to_d]);

			$datatables = Datatables::of($history);

        
        return $datatables
        ->editColumn('amount',function($post){return abs($post->amount);})
        ->editColumn('status',function($post){
        	if($post->status == 'Pending'){
        		return "<button class='btn btn-info'>".$post->status."</button>";
        	}
        	elseif($post->status == 'Approved'){
        		return "<button class='btn btn-success'>".$post->status."</button>";
        	}
        	else{
        		return "<button class='btn btn-danger'>".$post->status."</button>";
        	}
        })
        ->filterColumn('status', function($query, $keyword) {
                $query->whereRaw("(CASE 
                                        WHEN partner_withdraw.status = 0 THEN 'Pending'
                                        WHEN partner_withdraw.status = 1 THEN 'Approved'
                                        WHEN partner_withdraw.status = 2 THEN 'Cancelled'
                                        
                                        END) like ?", ["%$keyword%"]);
            })
        ->make(true);

		}

		public function transactionHistoryDatatableCustom(Request $request){
		
		$from = $request->from;
    	$to = $request->to;
    	list($day_from,$month_from,$year_from)  = explode('-', $from);
    	list($day_to,$month_to,$year_to)  = explode('-', $to);

    	 $time_from_d = Carbon::createFromDate($year_from, $month_from, $day_from);
    	 $time_to_d = Carbon::createFromDate($year_to, $month_to, $day_to);

			$history=DB::table('partner_withdraw')->select(['amount','payment_type','reference_no','created_at',DB::raw('(CASE 
                                        WHEN partner_withdraw.status = 0 THEN "Pending"
                                        WHEN partner_withdraw.status = 1 THEN "Approved"
                                        WHEN partner_withdraw.status = 2 THEN "Cancelled"
                                        
                                        END) as status')])->where('email',session('login_email'))->whereBetween('created_at',[$time_from_d,$time_to_d]);

			$datatables = Datatables::of($history);

        
        return $datatables
        ->editColumn('amount',function($post){return abs($post->amount);})
        ->editColumn('status',function($post){
        	if($post->status == 'Pending'){
        		return "<button class='btn btn-info'>".$post->status."</button>";
        	}
        	elseif($post->status == 'Approved'){
        		return "<button class='btn btn-success'>".$post->status."</button>";
        	}
        	else{
        		return "<button class='btn btn-danger'>".$post->status."</button>";
        	}
        })
        ->filterColumn('status', function($query, $keyword) {
                $query->whereRaw("(CASE 
                                        WHEN partner_withdraw.status = 0 THEN 'Pending'
                                        WHEN partner_withdraw.status = 1 THEN 'Approved'
                                        WHEN partner_withdraw.status = 2 THEN 'Cancelled'
                                        
                                        END) like ?", ["%$keyword%"]);
            })
        ->make(true);

		}


		public function getStaticBanner(){
			$affiliate=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
			
			$affiliate_prom_code = $affiliate->affiliate_prom_code;

			$client_url = DB::table('general_information')->select('client_portal_url')->first();

			$resolutions=DB::table('partner_banner')->select('partner_banner.resolution')->where('banner_type','static_banner')->get();

			$banners=DB::table('partner_banner')->join('partner_banner_name','partner_banner.id','=','partner_banner_name.partner_banner_id')->select('partner_banner.resolution','partner_banner_name.name')->where('banner_type','static_banner')->get();
			// print_r($banners);exit;
			return view ('backEnd.dashboard.static-banner',compact('resolutions','banners','affiliate_prom_code','client_url'));
		}

		public function getAnimatedBanner(){
			
			$affiliate=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
			
			$affiliate_prom_code = $affiliate->affiliate_prom_code;

			$client_url = DB::table('general_information')->select('client_portal_url')->first();

			$resolutions=DB::table('partner_banner')->select('partner_banner.resolution')->where('banner_type','animated_banner')->get();

			$banners=DB::table('partner_banner')->join('partner_banner_name','partner_banner.id','=','partner_banner_name.partner_banner_id')->select('partner_banner.resolution','partner_banner_name.name')->where('banner_type','animated_banner')->get();
			// print_r($banners);exit;
			return view ('backEnd.dashboard.animated-banner',compact('resolutions','banners','affiliate_prom_code','client_url'));
		}

		public function getHtml5Banner(){
			$affiliate=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
			
			$affiliate_prom_code = $affiliate->affiliate_prom_code;

			$client_url = DB::table('general_information')->select('client_portal_url')->first();

			$resolutions=DB::table('partner_banner')->select('partner_banner.resolution')->where('banner_type','html5_banner')->get();

			$banners=DB::table('partner_banner')->join('partner_banner_name','partner_banner.id','=','partner_banner_name.partner_banner_id')->select('partner_banner.resolution','partner_banner_name.name')->where('banner_type','html5_banner')->get();
			// print_r($banners);exit;
			return view ('backEnd.dashboard.html5-banner',compact('resolutions','banners','affiliate_prom_code','client_url'));
		}

		public function identityDetails(){

			  $doc=DB::table('cms_verification')->where(['email'=>session('login_email'),'document_type' => 'ID Proof'])->where('status','<>',2)->orderBy('int_id','desc')->get();
			if(Auth::guard('admin')->user()->owner_type=="personal"){
			    return view ('backEnd.dashboard.identity-details',compact('doc'));
			  }
			elseif(Auth::guard('admin')->user()->owner_type=="corporate"){
			    return view ('backEnd.dashboard.company-identity-details',compact('doc'));
			  }
			}

			public function residenceDetails(){
			  $doc=DB::table('cms_verification')->where(['email'=>session('login_email'),'document_type' => 'Address Proof'])->where('status','<>',2)->orderBy('int_id','desc')->get();
			if(Auth::guard('admin')->user()->owner_type=="personal"){
			  return view ('backEnd.dashboard.residence-details',compact('doc'));
			}
			elseif(Auth::guard('admin')->user()->owner_type=="corporate"){
			    return view ('backEnd.dashboard.company-residence-details',compact('doc'));
			  }
			}


			public function identityDocumentUpload(Request $request)
			{
			  $this->validate($request, [
			
				'file' => 'mimes:jpeg,png,jpg,gif,tif,tiff,pdf|max:3072'
			
			  ]);
			  $client_url = DB::table('general_information')->select('client_portal_url')->first();
			  if($request->file){
				$document_type="ID Proof";
			
				$file = 'IdProof-'.time().'.'.$request->file->getClientOriginalExtension();
			
				$request->file->move(public_path('/documents/'), $file);
				$intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
				$intId=$intIds->intId;
				DB::table('cms_verification')->insert([
				  'document_type'=>$document_type,
				  'document'=>$client_url->client_portal_url.'/documents/'.$file,
				  'date_time'=>date("Y-m-d H:i:s"),
				  'status'=>'0',
				  'email'=>session('login_email'),
				  'userId'=>$intId
				]);
			  }
			
			}
			
			public function residentDocumentUpload(Request $request)
			{
			  $this->validate($request, [
			
				'file' => 'mimes:jpeg,png,jpg,gif,tif,tiff,pdf|max:3072'
			
			  ]);
			  $client_url = DB::table('general_information')->select('client_portal_url')->first();
			  if($request->file){
				$document_type="Address Proof";
			
				$file = 'ResProof-'.time().'.'.$request->file->getClientOriginalExtension();
			
				$request->file->move(public_path('/documents/'), $file);
				$intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
				$intId=$intIds->intId;
				DB::table('cms_verification')->insert([
				  'document_type'=>$document_type,
				  'document'=>$client_url->client_portal_url.'/documents/'.$file,
				  'date_time'=>date("Y-m-d H:i:s"),
				  'status'=>'0',
				  'email'=>session('login_email'),
				  'userId'=>$intId
				]);
			  }
			
			}	


		public function myProfile(){
			if(Auth::guard('admin')->user()->owner_type=="corporate"){
				return view('errors.404');
			}
			$profile = CMS_Liveaccount::select('email','password_preference','fname','lname','company_name','mobile','dob','second_mobile','country','citizenship','address','source_of_income','gender','birthday')->where('email',session('login_email'))->first();
			$verification = CMS_Liveaccount::select('identity','resident')->where('email',session('login_email'))->first();
			$identity = $verification['identity'];
			$resident = $verification['resident'];
			$sum = $identity + $resident;
			$condition1 = $sum == 2;
		    $sub_condition1 = $identity == 0 || $resident == 0;
		    $condition2 = $sum == 1 || $sum == 3;
		    $condition3 = $sum == 4;
		    // var_dump($sub_condition1);exit;
		    $doc=DB::table('cms_verification')->where('email',session('login_email'))->where('status','<>',2)->get();
			return view('backEnd.dashboard.myprofile',compact('profile','condition1','sub_condition1','condition2','condition3','identity','resident','doc'));
		}


		public function companyProfile(){
			if(Auth::guard('admin')->user()->owner_type=="personal"){
				return view('errors.404');
			}
			$profile = CMS_Liveaccount::select('email','fname','mobile','second_mobile','country','reg_no','address','trading_experience')->where('email',session('login_email'))->first();
			$verification = CMS_Liveaccount::select('identity','resident')->where('email',session('login_email'))->first();
			$identity = $verification['identity'];
			$resident = $verification['resident'];
			$sum = $identity + $resident;
			$condition1 = $sum == 2;
		    $sub_condition1 = $identity == 0 || $resident == 0;
		    $condition2 = $sum == 1 || $sum == 3;
		    $condition3 = $sum == 4;
		    // var_dump($sub_condition1);exit;
		    $doc=DB::table('cms_verification')->where('email',session('login_email'))->get();
			return view('backEnd.dashboard.company_profile',compact('profile','condition1','sub_condition1','condition2','condition3','identity','resident','doc'));
		}

		public function savePersonalInfo(Request $request)
		{
			
			$password_preference = $request->password_preference;
			$partner_password = $request->partner_password;
			$company_name = $request->company_name;
			$second_mobile = $request->second_mobile;
			$citizenship = $request->citizenship;
			$source_of_income = $request->source_of_income;
			$reg_no = $request->reg_no;
			$trading_experience = $request->trading_experience;
			$gender = $request->gender;
						
			if ($password_preference == 'no') {
				$password_preference = 'client';
			}
			else{
				$password_preference = 'partner';
			}
			if ($partner_password) {
				$partner_password = password_hash($partner_password, PASSWORD_BCRYPT);
				CMS_Liveaccount::where('email',session('login_email'))->update([
				'partner_password' => $partner_password,
				'password_preference' => $password_preference,
				'company_name' => $company_name,
				'second_mobile' => $second_mobile,
				'citizenship' => $citizenship,
				'source_of_income' => $source_of_income,
				'reg_no' => $reg_no,
				'trading_experience' => $trading_experience,
				'gender' => $gender
				]);
			}
			else{
			CMS_Liveaccount::where('email',session('login_email'))->update([
				'password_preference' => $password_preference,
				'company_name' => $company_name,
				'second_mobile' => $second_mobile,
				'citizenship' => $citizenship,
				'source_of_income' => $source_of_income,

				'reg_no' => $reg_no,
				'trading_experience' => $trading_experience,
				'gender' => $gender
				]);
			}
		}

	public function saveIdentity(Request $request){

	$this->validate($request, [

    'id_front' => 'mimes:jpeg,png,jpg,gif,pdf|max:5120',
    'id_back' => 'mimes:jpeg,png,jpg,gif,pdf|max:5120',
  ]);
	$id_front = '';
	$id_back = '';
	
  $partner_url = DB::table('general_information')->select('partner_portal_url')->first();
  if($request->id_front){
    $document_type="ID Proof";

    $id_front = 'IdProof-'.time().'.'.$request->id_front->getClientOriginalExtension();

    $request->id_front->move(public_path('/documents/'), $id_front);
    $intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
    $intId=$intIds->intId;
    DB::table('cms_verification')->insert([
      'document_type'=>$document_type,
      'document'=>$partner_url->partner_portal_url.'/'.$id_front,
      'date_time'=>date("Y-m-d H:i:s"),
      'status'=>'0',
      'email'=>session('login_email'),
      'userId'=>$intId
    ]);


  }

  if($request->id_back){
    $document_type="ID Proof";

    $id_back = 'IdProof-'.time().'.'.$request->id_back->getClientOriginalExtension();

    $request->id_back->move(public_path('/documents/'), $id_back);
    $intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
    $intId=$intIds->intId;
    DB::table('cms_verification')->insert([
      'document_type'=>$document_type,
      'document'=>$partner_url->partner_portal_url.'/'.$id_back,
      'date_time'=>date("Y-m-d H:i:s"),
      'status'=>'0',
      'email'=>session('login_email'),
      'userId'=>$intId
    ]);


  }

  if(!$request->id_front && !$request->id_back){
    return Redirect::back()->with('msg','Can not be uploaded');
  }

  $email_adds = $this->email_adds();
  $from_email_id=$email_adds->noreply_email;
  $user_name=config('app.name');
  $user_mail2=$email_adds->backoffice_email;
  $user_mail1=$email_adds->support_email;
  $intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
  $partner_Name=$intIds->fname.' '.$intIds->lname;     

  $mail_subject='Partner request for profile verification';
  $data=array(
    'email'=>session('login_email'),
    'name'=>$partner_Name,
    'id_front'=>$id_front,
    'id_back'=>$id_back,
    'url' => $partner_url->partner_portal_url
  );
  Mail::send('backEnd.mail.documents',
    $data, function($message) use ($user_mail1,$mail_subject,$from_email_id)
    {
      $message->from($from_email_id,'Partner Identity Verification');
      $message->to($user_mail1, $user_name)->subject($mail_subject);
    });
  Mail::send('backEnd.mail.documents',
    $data, function($message) use ($user_mail2,$mail_subject,$from_email_id)
    {
      $message->from($from_email_id,'Partner Identity Verification');
      $message->to($user_mail2, $user_name)->subject($mail_subject);
    });
  // Session::flash('msg','Your Document has been uploaded successfully');

     //Notifications


  DB::table('admins')
  ->where('id',$intIds->manager)
  ->orWhere([
    'country_access'=>'All',
    'manager'=>0
  ])
  ->orWhere([
    'country_access'=>$intIds->country,
    'manager'=>0
  ])
  ->increment('documentUpload', 1);

  return Redirect::back()->with('msg','Identity document uploaded successfully');

		}
	
	public function saveResident(Request $request){

	$this->validate($request, [
    'resident' => 'mimes:jpeg,png,jpg,gif,pdf|max:5120'

  ]);
	
	$addressImageName ='';
  $partner_url = DB::table('general_information')->select('partner_portal_url')->first();

  if($request->resident){
    $document_type="Address Proof";

    $addressImageName = 'ResProof-'.time().'.'.$request->resident->getClientOriginalExtension();

    $request->resident->move(public_path('documents/'), $addressImageName);
    $intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();

    $intId=$intIds->intId;

    DB::table('cms_verification')->insert([
      'document_type'=>$document_type,
      'document'=>$partner_url->partner_portal_url.'/'.$addressImageName,
      'date_time'=>date('Y-m-d H:i:s'),
      'status'=>'0',
      'email'=>session('login_email'),
      'userId'=>$intId
    ]);

  }
  else{
    return Redirect::back()->with('msg','Can not be uploaded');
  }

  $email_adds = $this->email_adds();
  $from_email_id=$email_adds->noreply_email;
  $user_name=config('app.name');
  $user_mail2=$email_adds->backoffice_email;
  $user_mail1=$email_adds->support_email;
  $intIds=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
  $partner_Name=$intIds->fname.' '.$intIds->lname;     

  $mail_subject='Partner request for resident verification';
  $data=array(
    'email'=>session('login_email'),
    'name'=>$partner_Name,
    'url' => $partner_url->partner_portal_url,
    'addressImageName'=>$addressImageName
  );
  Mail::send('backEnd.mail.documents-resident',
    $data, function($message) use ($user_mail1,$mail_subject,$from_email_id)
    {
      $message->from($from_email_id,'Partner Resident Verification');
      $message->to($user_mail1, $user_name)->subject($mail_subject);
    });
  Mail::send('backEnd.mail.documents-resident',
    $data, function($message) use ($user_mail2,$mail_subject,$from_email_id)
    {
      $message->from($from_email_id,'Partner Resident Verification');
      $message->to($user_mail2, $user_name)->subject($mail_subject);
    });
  // Session::flash('msg','Your Document has been uploaded successfully');

     //Notifications


  DB::table('admins')
  ->where('id',$intIds->manager)
  ->orWhere([
    'country_access'=>'All',
    'manager'=>0
  ])
  ->orWhere([
    'country_access'=>$intIds->country,
    'manager'=>0
  ])
  ->increment('documentUpload', 1);

  return Redirect::back()->with('msg','Resident\'s document uploaded successfully');

		}



		// Change Password

		public function changePassword(){
			return view('backEnd.dashboard.change-password');
		 }

public function sendPasswordResetCode(){
  $profile=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
  $name=$profile->fname.' '.$profile->lname;

  $email_adds = $this->email_adds();
  $from_email_id=$email_adds->support_email;
  $from_name=config('app.name');
  $user_mail=session('login_email');
  $mail_subject='Verification Code for Password Change';
  $verification_code=mt_rand(100000, 999999);
  session(['password_verification_code' => $verification_code]);
  Session::save();
  $data = array('name' => $name , 'verification_code' => $verification_code);
  Mail::send('backEnd.mail.change-password',
    $data, function($message)use ($from_email_id,$from_name,$user_mail, $name,$mail_subject)
    {
      $message->from($from_email_id,$from_name);
      $message->to($user_mail, $name)->subject($mail_subject);
    });
}

public function checkVerificationCode(Request $request){
  $code = $request->code;
  if (session('password_verification_code')==$code) {
    return 1;
  }
  else return 0;
}



public function postChangePassword(Request $request){
  if($request->new_password!=$request->confirm_new_password){
    Session::flash('error','Password does not match. Please Reenter.');
    return Redirect::back();
  }
  else{
    $profile=DB::table('cms_liveaccount')->where('email',session('login_email'))->first();
    $name=$profile->fname.' '.$profile->lname;

    $email_adds = $this->email_adds();
    $from_email_id=$email_adds->support_email;
    
    $from_name=config('app.name');;
    $user_mail=session('login_email');
    $mail_subject='Verification Code for Password Change';
    $verification_code=mt_rand(100000, 999999);
    session(['password_verification_code' => $verification_code]);
    Session::save();
    $data = array('name' => $name , 'verification_code' => $verification_code);
    Mail::send('backEnd.dashboard.change-password',
      $data, function($message)use ($from_email_id,$from_name,$user_mail, $name,$mail_subject)
      {
        $message->from($from_email_id,$from_name);
        $message->to($user_mail, $name)->subject($mail_subject);
      });
    return view('backEnd.dashboard.password-verification',compact('request')); 


  }

}


public function passwordVerification(Request $request){if($request->verification_code!=session('password_verification_code')){
  return view('backEnd.dashboard.password-verification',compact('request'))->withErrors(['Verification code is incorrect. ']);
}

else{
  Session::forget('password_verification_code');
  $password=password_hash($request->new_password, PASSWORD_BCRYPT);
  DB::table('cms_liveaccount')
  ->where('email', session('login_email'))
  ->update([
    'password' => $password
  ]);
  Session::flash('msg','Your Password has been changed successfully');
  return view('backEnd.dashboard.change-password').redirect('/logout');
}
}

public function saveUpdatedPassword(Request $request)
{
  Session::forget('password_verification_code');
  $password=password_hash($request->pass, PASSWORD_BCRYPT);
  DB::table('cms_liveaccount')
  ->where('email', session('login_email'))
  ->update([
    'partner_password' => $password
  ]);
  Session::flash('msg','Your Password has been changed successfully');
}




	// Check Available Balance Function

	private function checkAvailableBalance($id){
		$info=CMS_Liveaccount::where('affiliate_prom_code',$id)->first();
		$affiliate_prom_code = $info->affiliate_prom_code;
		

		$mt5_orders_history = CMS_Iblevel::join('cms_liveaccount','cms_liveaccount.affiliate_prom_code','cms_ib_level.child_ib')->join('cms_account','cms_account.email','cms_liveaccount.email')->join('mt5_orders_history','cms_account.account_no','mt5_orders_history.Login')->join('mt5_deals','mt5_orders_history.Order','mt5_deals.Order')->where('cms_ib_level.parent_ib',$affiliate_prom_code)->where('mt5_orders_history.Type','<',2)->where('mt5_orders_history.State',4)->where('mt5_deals.VolumeClosed','<>',0)->select('mt5_deals.PositionID','mt5_orders_history.Symbol','mt5_orders_history.TimeDone','mt5_orders_history.VolumeInitial','cms_ib_level.level','cms_account.act_type')->get();

		$total_earnings = 0;

		foreach ($mt5_orders_history as $key=>$moh) {
				$open_time_trade = DB::table('mt5_deals')->where('mt5_deals.order',$moh->PositionID)->where('mt5_deals.VolumeClosed',0)->first();
			if($open_time_trade){
			$open_time=$open_time_trade->Time;
			$start = strtotime($open_time);
			$end = strtotime($moh->TimeDone);

			if(($end-$start)<0){
				unset($mt5_orders_history[$key]);
				continue;
			}

			}
			$ib_commission = CMS_IbCommission::join('partner_currency_groups','partner_currency_groups.id','cms_ib_commission.partner_currency_group_id')->join('partner_currency_symbols','partner_currency_symbols.partner_currency_group_id','partner_currency_groups.id')->where('cms_ib_commission.master_ib',$affiliate_prom_code)->where('cms_ib_commission.level',$moh->level)->where('cms_ib_commission.group_name',$moh->act_type)->where('partner_currency_symbols.symbol',$moh->Symbol)->select('cms_ib_commission.commission')->first();
			if($ib_commission){
				$total_earnings+=$ib_commission->commission*$moh->VolumeInitial/10000;
			}

		}

		if($total_earnings>0){
			$total_earnings = round($total_earnings,2);
		}

		$total_withdraw = Partner_Withdraw::where([
				['email','=',$info->email],
				['status','<>','2']
				])->sum('amount');
		if($total_withdraw<0){
			$total_withdraw = -round($total_withdraw,2);
		}
		

		$available_balance = $total_earnings-$total_withdraw;
		if($available_balance>0){
			$available_balance = round($available_balance,2);
		}
		else{
			$available_balance = 0;
		}

		return $available_balance;
	}
	
	
	
}
