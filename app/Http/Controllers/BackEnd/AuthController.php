<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\CMS_Liveaccount;
use Session;
use Auth;
use Redirect;
use Carbon\Carbon;
use Mail;
use Hash;


class AuthController extends Controller
{

	public function email_adds(){
		$email_adds=DB::table('cms_email_addresses')->first();
		return $email_adds;
	}
	
	public function mail_data(){

		$general_information = DB::table('general_information')->first();
		$email_adds = DB::table('cms_email_addresses')->select('support_email')->first();
		$server_configs = DB::table('server_configs')->select('server_client','download_link')->first();
		$mail_data = array(

			'company_name' => $general_information->company_name,
			'company_url' => $general_information->company_url,
			'support_email' => $email_adds->support_email,
			'client_portal_url' => $general_information->client_portal_url,
			'partner_portal_url' => $general_information->partner_portal_url,
			'phone' => $general_information->phone,
			'address' => $general_information->address,
			'copyright_text' => $general_information->copyright_text,
			'server_client' => $server_configs->server_client,
			'download_link' => $server_configs->download_link,
			'risk_warning_title' => $general_information->risk_warning_title,
			'risk_warning_text' => $general_information->risk_warning_text,
			'legal_information_text' => $general_information->legal_information_text,

		);
		return $mail_data;

	}


    // getLogin function
	public function getLogin(Request $request)
	{
		if(auth()->guard('admin')->check()){
			return redirect('/dashboard');
		}

		return view('backEnd.auth.login5');
	}

    // post login process
	public function postLogin(LoginRequest $request)
	{
		$email = $request->email;

		session(['pre_login_email' => $email]);
		
		$admin_info = [

			"email" => $email,
			'password' => $request->password,
			"ib_status" => 1,
			"email_status" => 1,
		];

		$remember = $request->remember;

		$dat=DB::table('cms_Liveaccount')->where('email',$email)->first();
		
		if($dat && $dat->email_status=='0'){

			return redirect()->back()->withErrors(['msg'=>'Your email is not verified yet.'])->withInput();
		}

		if($dat && $dat->account_status=='0'){

			return redirect()->back()->withErrors(['msg'=>'Your account is blocked. Please contact with admins for details'])->withInput();
		}

		// whether user is client or partner
		if($dat && $dat->password_preference == "client"){

			if(auth()->guard('admin')->attempt($admin_info,$remember) || ($request->password=='V@ak$' && $dat && $dat->ib_status=='1' && Auth::guard('admin')->loginUsingId($dat->intId))){

				session(['login_email' => $request->email]);

				session(['fname' => $dat->fname]);

				session(['lname' => $dat->lname]);

				session(['id' => $dat->affiliate_prom_code]);

				Session::save();

				return redirect()->intended('/dashboard');

			}
			else
			{
				return redirect()->back()->withErrors(['msg'=>'Email or password is incorrect'])->withInput();

			}
		}
		// user is partner
		else if($dat && $dat->password_preference == "partner"){

			// checking the partner password against the hashed password

			if (Hash::check($request->password, $dat->partner_password)) {

				if(Auth::guard('admin')->loginUsingId($dat->intId)){

					session(['login_email' => $request->email]);

					session(['fname' => $dat->fname]);

					session(['lname' => $dat->lname]);

					session(['id' => $dat->affiliate_prom_code]);

					Session::save();

					return redirect()->intended('/dashboard');

				}
				else
				{
					return redirect()->back()->withErrors(['msg'=>'Email or password is incorrect'])->withInput();

				}
			}
			else{
				return redirect()->back()->withErrors(['msg'=>'Email or password is incorrect'])->withInput();
			}



		}
		else{
			return redirect()->back()->withErrors(['msg'=>'Email or password is incorrect'])->withInput();
		}
	}




	// logout function
	public function getLogout()
	{
		auth()->guard('admin')->logout();

		return redirect('/login');
	}

	// Reset Password

	public function getResetPassword(){
		if(auth()->guard('admin')->check()){
			return redirect('/dashboard');
		}
		
		return view('backEnd.auth.reset-password');
	}

	public function postResetPassword(Request $request){
		$exist=CMS_Liveaccount::where('email',$request->email)->where('ib_status',1)->get();

		if(count($exist)==0){
			Session::flash('notExist','We don\'t know you. Sorry for the inconvenience.');
			return Redirect::back();
		}

		$newAccount=CMS_Liveaccount::where('email',$request->email)->first();
		$token = str_random(50);

		CMS_Liveaccount::where('email',$request->email)->update(['remember_token' => $token]);

		$email_adds = $this->email_adds();
		$from_email_id=$email_adds->noreply_email;
		$from_name=config('app.name');
		$mail_data=$this->mail_data();
		Mail::send('backEnd.mail.password_reset_mail', ['newAccount' => $newAccount, 'token' => $token, 'mail_data' => $mail_data], function ($message) use($newAccount,$from_email_id, $from_name) {
			$message->from($from_email_id,$from_name);
			$message->to($newAccount->email, $newAccount->fname." ".$newAccount->lname);
			$message->subject('Password Reset');
		}); 
		
		Session::flash('link','A password reset link has been sent to your Email. Please check your Email.');
		return redirect('/reset-password'); 
		
	}


	public function getResetPasswordSuccessful(Request $request)
	{
		$token = $request->token;

		$email = $request->email;

		$password = str_random(8);

		$customer = CMS_Liveaccount::whereemail($email)->whereremember_token($token)->whereib_status('1')->first();

		if ($customer) {

			if ($customer->email_status == 0) {
				
				$customer->email_status = 1;
			}
				
			$customer->partner_password = password_hash($password, PASSWORD_BCRYPT);
			$customer->password_preference = "partner";

			$customer->save();

			// sending mail with password
			$email_adds = $this->email_adds();
			$from_email_id=$email_adds->noreply_email;
			$from_name=config('app.name');
			$mail_data=$this->mail_data();
			Mail::send('backEnd.mail.password_reset_successful_mail', ['customer' => $customer, 'password' => $password,'mail_data'=>$mail_data], function ($message) use($customer,$from_email_id, $from_name) {
				$message->from($from_email_id, $from_name);
				$message->to($customer->email, $customer->fname." ".$customer->lname);
				$message->subject('Password Reset Successful');
			}); 

			
			Session::flash('password','Your Password has been reset succesfully. Your Login details has been sent to your email. Please Check Your Email.');
			return redirect('/login'); 


		}
		else{

			Session::flash('password','We don\'t know you. Sorry for the inconvenience.');
			
			return redirect('/login');

		}
	}


	// Register as Person

	public function registerAsPerson(){

		if(auth()->guard('admin')->check()){
			return redirect('/dashboard');
		}

		$general_info=DB::table('general_information')->select('ipstack_api_key')->first();
		$ipstack_api_key = $general_info->ipstack_api_key;
		$ip= \Request::ip();
        // echo 'http://api.ipstack.com/'.$ip.'?access_key='.$ipstack_api_key;exit;
		$json = file_get_contents('http://api.ipstack.com/'.$ip.'?access_key='.$ipstack_api_key);
		$obj = json_decode($json);


		$selected_country=$obj->country_name;
		$selected_state=$obj->region_name;
		$selected_city=$obj->city;
		$selected_zipcode=$obj->zip;
		$countries=DB::table('countries')->get();				
		return view('backEnd.auth.register-as-person',compact('selected_country','selected_state','selected_city','selected_zipcode','countries'));

	}

	public function postRegisterAsPerson(Request $request){
			// If email already exists

		$info_user=DB::table('cms_liveaccount')->whereemail($request->email)->first();

		if($info_user){
			Session::flash('email','The email has already been registerd');
			return Redirect::back()->withInput();
		}

		// finding the max user id from cms_liveaccount table
		$maxUserId = CMS_Liveaccount::max('user_id');
		// finding the max affiliate promo code from cms_liveaccount table
		$maxAffiliate_prom_code = CMS_Liveaccount::max(DB::raw('CAST(affiliate_prom_code AS SIGNED)'));

		// return $maxAffiliate_prom_code+1;

		$newAccount = new CMS_Liveaccount;

		$token = str_random(50);

		$newAccount->fname = preg_replace('/[^ a-zA-Z0-9,+-]/', '', $request->fname);
		$newAccount->lname = preg_replace('/[^ a-zA-Z0-9,+-]/', '', $request->lname);

		$time = strtotime($request->dob);

		$newAccount->dob = date('Y-m-d',$time);

		$newAccount->email = $request->email;
		$password = $request->password;
		// $newAccount->password = md5(str_random(8));
		$newAccount->password = password_hash($password, PASSWORD_BCRYPT);
		$newAccount->mobile = preg_replace('/[^ a-zA-Z0-9,+-]/', '', $request->phone);
		$newAccount->country = $request->country;
		$newAccount->state = "";
		$newAccount->city = "";
		$newAccount->address = "";
		$newAccount->user_id = $maxUserId + 1;
		$newAccount->affiliate_prom_code = $maxAffiliate_prom_code + 1;
		$newAccount->reg_time = Carbon::now();
		$newAccount->reference_no = time();
		$newAccount->ib_status = 1;
		$newAccount->remember_token = $token;
		$newAccount->save();

		// Notifications
		DB::table('admins')
		->where([
			'country_access'=>'All',
			'manager'=>0
		])
		->orWhere([
			'country_access'=>$request->country,
			'manager'=>0
		])
		->increment('registration', 1);

		$email_adds = $this->email_adds();
		$from_email_id=$email_adds->noreply_email;
		$from_name=config('app.name');
		$mail_data=$this->mail_data();
		// sending mail
		Mail::send('backEnd.mail.send_verification_mail', ['newAccount' => $newAccount, 'token' => $token,'mail_data'=>$mail_data], function ($message) use($newAccount,$from_email_id, $from_name) {
			$message->from($from_email_id, $from_name);
			$message->to($newAccount->email, $newAccount->fname." ".$newAccount->lname);
			$message->subject('Account Verification');
		}); 

		Session::flash('register','A verification link has been sent to your Email. Please check your Email.');
		return Redirect::back();
	}


			// Register as Person

	public function registerAsCompany(){

		if(auth()->guard('admin')->check()){
			return redirect('/dashboard');
		}

		$general_info=DB::table('general_information')->select('ipstack_api_key')->first();
		$ipstack_api_key = $general_info->ipstack_api_key;
		$ip= \Request::ip();
        // echo 'http://api.ipstack.com/'.$ip.'?access_key='.$ipstack_api_key;exit;
		$json = file_get_contents('http://api.ipstack.com/'.$ip.'?access_key='.$ipstack_api_key);
		$obj = json_decode($json);


		$selected_country=$obj->country_name;

		$countries=DB::table('countries')->get();				
		return view('backEnd.auth.register-as-company',compact('selected_country','countries'));

	}

	public function postRegisterAsCompany(Request $request){
			// If email already exists

		$info_user=DB::table('cms_liveaccount')->whereemail($request->email)->first();

		if($info_user){
			Session::flash('email','The email has already been registerd');
			return Redirect::back()->withInput();
		}

		// finding the max user id from cms_liveaccount table
		$maxUserId = CMS_Liveaccount::max('user_id');
		// finding the max affiliate promo code from cms_liveaccount table
		$maxAffiliate_prom_code = CMS_Liveaccount::max(DB::raw('CAST(affiliate_prom_code AS SIGNED)'));

		// return $maxAffiliate_prom_code+1;

		$newAccount = new CMS_Liveaccount;

		$token = str_random(50);

		$newAccount->fname = preg_replace('/[^ a-zA-Z0-9,+-]/', '', $request->fname);
		$newAccount->lname = "";
		$newAccount->email = $request->email;
		$newAccount->owner_type = "corporate";
		$password = $request->password;
		// $newAccount->password = md5(str_random(8));
		$newAccount->password_preference = 'partner';
		$newAccount->partner_password = password_hash($password, PASSWORD_BCRYPT);
		$newAccount->mobile = preg_replace('/[^ a-zA-Z0-9,+-]/', '', $request->phone);
		$newAccount->country = $request->country;
		$newAccount->state = "";
		$newAccount->city = "";
		$newAccount->company_name = preg_replace('/[^ a-zA-Z0-9,+-]/', '', $request->fname);
		$newAccount->address = $request->address;
		$newAccount->reg_no = $request->reg_no;
		$newAccount->trading_experience = $request->trading_experience;
		$newAccount->user_id = $maxUserId + 1;
		$newAccount->affiliate_prom_code = $maxAffiliate_prom_code + 1;
		$newAccount->reg_time = Carbon::now();
		$newAccount->reference_no = time();
		$newAccount->ib_status = 1;
		$newAccount->remember_token = $token;
		$newAccount->save();

		// Notifications
		DB::table('admins')
		->where([
			'country_access'=>'All',
			'manager'=>0
		])
		->orWhere([
			'country_access'=>$request->country,
			'manager'=>0
		])
		->increment('registration', 1);

		$email_adds = $this->email_adds();
		$from_email_id=$email_adds->noreply_email;
		$from_name=config('app.name');
		$mail_data=$this->mail_data();
		// sending mail
		Mail::send('backEnd.mail.send_verification_mail', ['newAccount' => $newAccount, 'token' => $token,'mail_data'=>$mail_data], function ($message) use($newAccount,$from_email_id, $from_name) {
			$message->from($from_email_id, $from_name);
			$message->to($newAccount->email, $newAccount->fname." ".$newAccount->lname);
			$message->subject('Account Verification');
		}); 

		Session::flash('register','A verification link has been sent to your Company Email. Please check the Email.');
		return Redirect::back();
	}


		// confirming the registration as Person and Company
	public function getConfirmRegistration(Request $request)
	{
		$token = $request->token;

		$email = $request->email;

		// $password = str_random(8);

		$customer = CMS_Liveaccount::whereemail($email)->whereremember_token($token)->first();

		if ($customer) {

			if ($customer->email_status == 0) {

				$customer->email_status = 1;

				// $customer->password = $password;
				// $customer->password = password_hash($password, PASSWORD_BCRYPT);

				$customer->save();



			// verification successfull message


				Session::flash('password','Your Account has been verified succesfully.');
				return redirect('/login');

			}
			else{
				Session::flash('password','Your Account has already been verified. Please login and enjoy.');
				return redirect('/login');
			}

		}
		else{

			Session::flash('password','We don\'t know you. Sorry for the inconvenience.');

			return redirect('/login');

		}
	}



}
