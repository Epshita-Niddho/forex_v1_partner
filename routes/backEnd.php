<?php

/*
|--------------------------------------------------------------------------
| All Routes for Front End
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your NetCoden'S Back End. Just tell NetCoden the URIs it should respond
| to using a Closure or controller method. Build something great!
|
|
|  Designer : NetCoden
|  Developer: NetCoden
|  Maintenance: NetCoden
|  Website: http://netcoden.com
|
*/




/*=================================
=     Authentication Section      =
=================================*/

Route::get('/login', 'AuthController@getLogin');
Route::post('/login', 'AuthController@postLogin');
Route::get('/logout', 'AuthController@getLogout');

/*=================================
=             Register            =
=================================*/

Route::get('/register-as-person', 'AuthController@registerAsPerson');
Route::post('/register-as-person', 'AuthController@postRegisterAsPerson');
Route::get('/register-as-company', 'AuthController@registerAsCompany');
Route::post('/register-as-company', 'AuthController@postRegisterAsCompany');

Route::get('/confirm-registration/{token}', 'AuthController@getConfirmRegistration');
/*=================================
=          Password Resets        =
=================================*/

// password resets
Route::get('/reset-password', 'AuthController@getResetPassword');
Route::post('/reset-password', 'AuthController@postResetPassword');
Route::get('/reset-password-successful/{token}', 'AuthController@getResetPasswordSuccessful');


/*=================================
=          Home Page              =
=================================*/

Route::get('/dashboard',  'DashboardController@getIndex');

/*=================================
=            Profile              =
=================================*/

Route::get('/myprofile',  'DashboardController@myProfile');
Route::get('/company-profile',  'DashboardController@companyProfile');
Route::post('/save-personal-info','DashboardController@savePersonalInfo');
Route::post('/save-identity','DashboardController@saveIdentity');
Route::post('/save-resident','DashboardController@saveResident');

Route::get('/identity-documents-details','DashboardController@identityDetails');
Route::get('/resident-documents-details','DashboardController@residenceDetails');

Route::post('/identity-document-upload','DashboardController@identityDocumentUpload');
Route::post('/resident-document-upload','DashboardController@residentDocumentUpload');

Route::get('/change-password',  'DashboardController@changePassword');
Route::get('/send-password-reset-code','DashboardController@sendPasswordResetCode');
Route::get('/check-verification-code/{code}','DashboardController@checkVerificationCode');
Route::post('/change-password', 'DashboardController@postChangePassword');
Route::post('/save-updated-password', 'DashboardController@saveUpdatedPassword');
Route::get('/password-verification',  'DashboardController@errorNotFound');
Route::post('/password-verification',  'DashboardController@passwordVerification');


Route::post('/get-ib-level-values',  'DashboardController@getIbLevelValues');

Route::get('/statistics',  'DashboardController@getStatistics');

Route::post('/partner-comm-stat-level',  'DashboardController@partnerCommStatLevel');


// Route::get('/commission-statistics-datatable/{limit}/{level}','DashboardController@CommissionStatisticsDatatable');
// Route::get('/get-total-commission/{limit}','DashboardController@getTotalCommission');
// Route::get('/get-total-commission-custom/{from}/{to}','DashboardController@getTotalCommissionCustom');
// Route::get('/commission-statistics-datatable-custom/{level}/{from}/{to}','DashboardController@CommissionStatisticsDatatableCustom');

Route::get('/clients',  'DashboardController@getClients');
Route::post('/partner-clients-level',  'DashboardController@partnerClientsLevel');


Route::get('/ib-level-datatable/{limit}/{level}','DashboardController@ibLevelDatatable');
Route::get('/get-ib-clients/{limit}','DashboardController@getIbClients');
Route::get('/get-ib-clients-custom/{from}/{to}','DashboardController@getIbClientsCustom');

Route::get('/ib-level-datatable-custom/{level}/{from}/{to}','DashboardController@ibLevelDatatableCustom');

/*=================================
=          Fund Withdraw      =
=================================*/

Route::get('/withdraw',  'DashboardController@getFundWithdraw');
Route::post('/withdraw',  'DashboardController@postFundWithdraw');

Route::get('/neteller_withdraw',  'DashboardController@getNetellerWithdraw');
Route::post('/neteller_withdraw',  'DashboardController@postNetellerWithdraw');

Route::get('/skrill_withdraw',  'DashboardController@getSkrillWithdraw');
Route::post('/skrill_withdraw',  'DashboardController@postSkrillWithdraw');

Route::get('/bank_transfer',  'DashboardController@getBankTransfer');
Route::post('/bank_transfer',  'DashboardController@postBankTransfer');

Route::get('/transaction-history',  'DashboardController@getTransactionHistory');
Route::get('/transaction-history-datatable/{limit}','DashboardController@transactionHistoryDatatable');
Route::get('/transaction-history-datatable-custom/{from}/{to}','DashboardController@transactionHistoryDatatableCustom');

Route::get('/verification_code','DashboardController@errorNotFound');

Route::post('/verification_code',  'DashboardController@updateWithdraw');
Route::get('/faqs',  'DashboardController@GetFaqs');

/*=================================
=          Banner                 =
=================================*/

Route::get('/static-banner',  'DashboardController@getStaticBanner');
Route::get('/animated-banner',  'DashboardController@getAnimatedBanner');
Route::get('/html5-banner',  'DashboardController@getHtml5Banner');




