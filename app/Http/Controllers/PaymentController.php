<?php

namespace App\Http\Controllers;

use App\paymentdone;
use DateTime;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		$pays = DB::table('paymentdones')
		            ->join('paymentmethods', 'paymentdones.ID_paymentmethod', '=', 'paymentmethods.ID_paymentmethod')
		            ->where('paymentdone_verified', '=', "0")
					->where('paymentdone_declined', '=', "0")
					->orderBy('ID_paymentdone', 'desc')
			        ->get();
		
		return view('fichiers/validation',['pays'=>$pays]); 
		//
    }
	
	
	public function getValidatedtopuphistory()
    {
		
		$payshisto = DB::table('paymentdones')
		            ->join('paymentmethods', 'paymentdones.ID_paymentmethod', '=', 'paymentmethods.ID_paymentmethod')
					->join('customers', 'paymentdones.ID_customer_verifier', '=', 'customers.ID_customer')
		            ->where('ID_customer_verifier', '!=', NULL)
					->orderBy('ID_paymentdone', 'desc')
			        ->get();
		
		$withsomme = DB::table('paymentdones')
				    ->sum('paymentdone_amount'); 
					
		return view('fichiers/validationhistory',['pays'=>$payshisto,'withsomme'=>$withsomme]); 
				
	}
	
	
	public function getWithdrawal()
    {
        
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
		            ->where('treatment_withdrawal', '=', "0")
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
        
		$withsomme = DB::table('withdrawal_request')
		            ->where('authorised_withdrawal', '=', "0")
					->where('treatment_withdrawal', '=', "0")
				    ->sum('amount_withdrawal'); 
			/* 		
		    if($with->account_to_withdrawal == 1) { $acct_to = "Invest A"; }
			if($with->account_to_withdrawal == 2) { $acct_to = "Invest B"; }
			if($with->account_to_withdrawal == 3) { $acct_to = "Invest C"; }
			if($with->account_to_withdrawal == 4) { $acct_to = "Un membre"; }
			if($with->account_to_withdrawal == 5) { $acct_to = "Mobile Money"; }
			if($with->account_to_withdrawal == 6) { $acct_to = "Bitcoin"; }
			if($with->account_to_withdrawal == 7) { $acct_to = "Bank"; } */
		
		return view('fichiers/withdrawal',['with'=>$with,'withsomme'=>$withsomme]); 
		//
    }
	public function getWithdrawal_annuler()
    {
        
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('treatment_withdrawal', '=', "3")
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
        
		$withsomme = DB::table('withdrawal_request')
					->where('treatment_withdrawal', '=', "3")
				    ->sum('amount_withdrawal'); 
		
		return view('fichiers/withdrawal_annule',['with'=>$with,'withsomme'=>$withsomme]); 
		//
    }
	
	
	public function getTraiteamount(int $id)
    {
        
		
		date_default_timezone_set('UTC'); 
        $datecreation = date('Y-m-d H:i:s');
        
		DB::table('withdrawal_request')
                    ->where('ID_withdrawal', $id)
                    ->update(['treatment_withdrawal' => "1", 'ID_treatment' => Session::get('logID'),
					'date_treatment' => $datecreation]);
	
		
		        return redirect()->action([PaymentController::class, 'getWithdrawal']);
		//
    }
	
	
	public function getTransfert()
    {
        
					
		$transfer = DB::table('foperation')
		            ->join('customeraccounts', 'foperation.ID_account', '=', 'customeraccounts.ID_account')
		            ->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
		            ->where('foperation_type', '=', "TRANSFERT")
			        ->get();
					
		//dd($transfer);			
		
		return view('fichiers/transfer',['transfer'=>$transfer]); 
		//
    }
	
	
	public function getWithdrawalstatement()
    {
        
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('treatment_withdrawal', '=', 2)
		            ->where('authorised_withdrawal', '=', 1)
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
					
		
		//dd($transfer);			
		
		return view('fichiers/withdrawalstatement',['with'=>$with]); 
		//
    }
	
	
	public function getWithdrawal_statement_date(Request $request)
    {
        
		$daystart = $request->deb.' '.'00:01:00'; 
		$dayend = $request->fin.' '.'23:59:00' ;
		
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('exact_amount_withdrawal', '!=', null)
					->whereBetween('date_withdrawal', [$daystart, $dayend])
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
					
		
		//dd($transfer);			
		
		return view('fichiers/withdrawalstatementr',['with'=>$with]); 
		//
    }
	
	
	public function getWithdrawal_statement_operation(Request $request)
    {
        
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('exact_amount_withdrawal', '!=', null)
					->where('account_to_withdrawal', $request->operation)
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
					
		
		//dd($transfer);			
		
		return view('fichiers/withdrawalstatementr',['with'=>$with]); 
		//
    }
	
	public function getWithdrawalstatementref(int $id)
    {
        
		$wit = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.authoriser_withdrawal', '=', 'customers.ID_customer')
		            ->where('ID_withdrawal', '=', $id)
			        ->first();
					
					
		//dd($transfer);			
		
		return view('fichiers/withdrawalstatementref',['wit'=>$wit]); 
		//
    }

	

	public function getExactamountwithdrawal(int $id)
    {
		
			date_default_timezone_set('UTC'); 
        $datecreation = date('Y-m-d H:i:s');
        
			$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('ID_withdrawal', '=', $id)
			        ->first();
			        
		$montant = $with->amount_withdrawal - $with->withdrawal_fees;
				
						
		DB::table('withdrawal_request')
                    ->where('ID_withdrawal', $id)
                    ->update(['authorised_withdrawal' =>1, 'exact_amount_withdrawal' => $montant,
					'authoriser_withdrawal' => Session::get('logID'),'reference_exact_amount_withdrawal' => date('dmy'), 
					'authorised_withdrawal_date' => $datecreation,'date_exact_amount_withdrawal' => date('Y-m-d'),
					'treatment_withdrawal' => 2,]);
	
	    
	
	
	    $email_msg =  '<html>
                                <head>
                                <title> COMPTE EFARM CAPITAL </title>
                                </head>
								<body>
									<table> 
									    <tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <h2 >WITHDRAWAL OPERATION INITIATED</h2>
												</div>
											  </div>
											</td>
                                        </tr>

                                        <tr><td height="15"> </td></tr>

										<tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <p  style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;">
													<br>
													<br>
													Merci d\'avoir demandé un retrait depuis votre compte EFARM CAPITAL ! <br>
                                                   Nous avons le plaisir de vous informer que votre demande a été validée par un administrateur. 
                                                   Le virement sera effectué prochainement et sera crédité sur le compte de réception que vous avez sélectionné.

													<br>
													Merci !!!
													
													<br><br><br>
												        Si vous n\'avez pas effectué de demande de retrait sur notre plateforme : www.efarm.com, aucune autre action n\'est requise..
													<br><br><br><br>
													<span style="color:#222222;">Cordialement, EFARM  CAPITAL</span>
												  </p>
												</div>
											  </div>
											</td>
										</tr>

                                    </table>
							    </body>
                             </html>';
							 
				                    $to1 = $with->cemail;
									$to2 = 'infos@efarm-ci.com';
									$subject = 'EFARM | REQUETE DE RETRAIT';
									$message = $email_msg;
									
									// To send HTML mail, the Content-type header must be set
										$headers[] = 'MIME-Version: 1.0';
										$headers[] = 'Content-type: text/html; charset=iso-8859-1';
										$headers[] = 'Return-Path: infos@efarm-ci.com';
										$headers[] = 'From: infos@efarm-ci.com';
										

									// Mail it
									mail($to1, $subject, $message, implode("\r\n", $headers));
									mail($to2, $subject, $message, implode("\r\n", $headers));
	    
	    	Session::flash('retraitvalide', 'Le retrait a été validé avec success.');
		return redirect()->back();
		
// 			return view('fichiers/exact_amount_withdrawal')->withWith($with); 
			
	}	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
		
	
	public function getValidationdone(int $id)
    {
		
		if ((Session::has('logID')) == null)
		   { 
	        return redirect()->action([PagesController::class, 'getLandingpage']);
		   }
		
		
		date_default_timezone_set('UTC'); 
        $datecreation = date('Y-m-d H:i:s');
		
		
		$check = DB::table('paymentdones')
		             ->join('customeraccounts', 'paymentdones.ID_customer', '=', 'customeraccounts.ID_customer')
		             ->where('ID_paymentdone', '=', $id)
			         ->first();
					 
		$forf = DB::table('forfaits')
		        ->where('ID_forfait', '=', $check->ID_forfait_attente)
			    ->first();
					 
					 
		
		//convert in USD
		$USDpaymentdone_amount = $check->paymentdone_amount / 600;
		

           //if upgrade a forfait - using bank or mobile money or else
		if ($check->ID_forfait == "UP")
			
			{      
			       //forfait amount + TVA
				   $forfup = ($forf->forfait_amount * 80)/100;	
				   $forfaittva = (($forfup * 18)/100) + $forfup;   
				
                   if ( $USDpaymentdone_amount >= $forfaittva)
					{
					  $balance =  $USDpaymentdone_amount - $forfaittva ;
					  $balanceacc = $balance + $check->balance_account;
					
					  DB::table('customeraccounts')
								->where('ID_customer', $check->ID_customer)
								->update(['ID_forfait' => $check->ID_forfait_attente, 'balance_account' => $balanceacc]);	
								
					  //RECORD OF FORFAIT BUYING + TVA included 18% - TO BE SEPARATED AND DISPLAYED IN ADMIN
					  DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											    'account_denomination' => 'none', 
											    'foperation_type'  => 'BUY',
												'operation_amount' => $forfaittva, 
												'foperation_date' => $datecreation,
												'foperation_description' => 'forfait upgrade',
												'ID_forfait' => $check->ID_forfait_attente
												]);
											  
						DB::table('foperation')->insert([
											  'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DEPOSIT',
											   'operation_amount' => $balance,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'automatic balance account crediting after forfait upgrade',
											   'ID_forfait' => NULL,
											   'new_solde' => $balanceacc
											   ]);
					
					  
					}
				   else
					{
						
					  $newbalance = $check->balance_account + $USDpaymentdone_amount;
						
					   DB::table('customeraccounts')
								->where('ID_customer', $check->ID_customer)
								->update(['balance_account' => $newbalance]);

					  DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DEPOSIT',
											   'operation_amount' => $USDpaymentdone_amount,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'automatic balance account crediting because of amount too low for forfait upgrade',
											   'new_solde' => $USDpaymentdone_amount
											  ]);
					
					
					}
					
					
					//validation by admin
		            DB::table('paymentdones')
                    ->where('ID_paymentdone', $id)
                    ->update(['paymentdone_verified' => "1", 'ID_customer_verifier' => Session::get('logID'), 'paymentdone_verified_date' => $datecreation]);		 
		
		        return redirect()->action([PagesController::class, 'getLandingpage']);


				
			}
		   
		
		elseif ($check->ID_forfait == NULL)
			
			{
				//forfait amount + TVA
		        $forfaittva = (($forf->forfait_amount * 18)/100) + $forf->forfait_amount; 
			        
                   if ( $USDpaymentdone_amount >= $forfaittva)
					{
					  $balance = $USDpaymentdone_amount - $forfaittva;
					  $balanceacc = $balance + $check->balance_account;
					
					  DB::table('customeraccounts')
								->where('ID_customer', $check->ID_customer)
								->update(['ID_forfait' => $check->ID_forfait_attente, 'balance_account' => $balanceacc]);	
								
					  //RECORD OF FORFAIT BUYING + TVA included 18% - TO BE SEPARATED AND DISPLAYED IN ADMIN
					    DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											    'account_denomination' => 'none', 
											    'foperation_type'  => 'BUY',
												'operation_amount' => $forfaittva, 
												'foperation_date' => $datecreation,
												'foperation_description' => 'forfait acquisition',
												'ID_forfait' => $check->ID_forfait_attente
												]);
											  
						DB::table('foperation')->insert([
											  'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DEPOSIT',
											   'operation_amount' => $balance,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'automatic balance account crediting after forfait acquisition',
											   'ID_forfait' => NULL,
											   'new_solde' => $balanceacc
											   ]);
					
					  
					}
				   else
					{
					    $newbalance = $check->balance_account + $USDpaymentdone_amount;
						
					    DB::table('customeraccounts')
								->where('ID_customer', $check->ID_customer)
								->update(['balance_account' => $newbalance]);

					    DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DEPOSIT',
											   'operation_amount' => $USDpaymentdone_amount,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'automatic balance account crediting because of amount too low for forfait acquisition',
											   'new_solde' => $USDpaymentdone_amount
											  ]);
					
					}
					
					
					
				//validation by admin
		        DB::table('paymentdones')
                    ->where('ID_paymentdone', $id)
                    ->update(['paymentdone_verified' => "1", 'ID_customer_verifier' => Session::get('logID'), 'paymentdone_verified_date' => $datecreation]);		 
		
		        return redirect()->action([PagesController::class, 'getLandingpage']);
				
			}
		
		else
			
			{
					  
					$newbalance = $check->balance_account + $USDpaymentdone_amount;
					  
					  DB::table('customeraccounts')
								->where('ID_customer', $check->ID_customer)
								->update(['balance_account' => $newbalance]);

					  DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DEPOSIT',
											   'operation_amount' => $USDpaymentdone_amount,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'deposit into balance account',
                                               'new_solde' => $newbalance											   
											  ]);	
											  
											  
					//validation by admin
		        DB::table('paymentdones')
                    ->where('ID_paymentdone', $id)
                    ->update(['paymentdone_verified' => "1", 'ID_customer_verifier' => Session::get('logID'), 'paymentdone_verified_date' => $datecreation]);		 
		
		        return redirect()->action([PagesController::class, 'getLandingpage']);
								
			}
							
    }
	
	
	
	
	public function getRefusedtopup(int $id)
    {
		
		if ((Session::has('logID')) == null)
		   { 
	        return redirect()->action([PagesController::class, 'getLandingpage']);
		   }
		   
		   
		
		date_default_timezone_set('UTC'); 
        $datecreation = date('Y-m-d H:i:s');
		
		
		DB::table('paymentdones')
                    ->where('ID_paymentdone', $id)
                    ->update(['paymentdone_declined' => "1", 'ID_customer_verifier' => Session::get('logID'), 'paymentdone_verified_date' => $datecreation]);
		
		$check = DB::table('paymentdones')
		             ->join('customeraccounts', 'paymentdones.ID_customer', '=', 'customeraccounts.ID_customer')
		             ->where('ID_paymentdone', '=', $id)
			         ->first();
					 
		//convert in USD
		$USDpaymentdone_amount = $check->paymentdone_amount / 600;
		
		
		//new customer without forfait
		if ($check->ID_forfait == NULL)
			
			{
				      //return back to forfait choice
					  DB::table('customeraccounts')
								->where('ID_customer', $check->ID_customer)
								->update(['ID_forfait_attente' => NULL]);

                     
					  DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DECLINED',
											   'operation_amount' => $USDpaymentdone_amount,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'TOP-UP declined by ADMIN',
                                               'new_solde' => $check->balance_account											   
											  ]);									
								
				
			}
			
		elseif ($check->ID_forfait == "UP")
			
			{
				  
					    $lastforf = DB::table('foperation')
									->where('ID_account', $check->ID_account)
									->where('foperation_type', "BUY")
									->where('foperation_description', "forfait acquisition")
									->orwhere('foperation_description', "forfait upgrade")
									->orderby('ID_foperation','desc')
									->first();
							//dd($lastforf);
						
					    DB::table('customeraccounts')
								->where('ID_account', $check->ID_account)
								->update(['ID_forfait' => $lastforf->ID_forfait, 'ID_forfait_attente' => $lastforf->ID_forfait]);
					  
					  
					  DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DECLINED',
											   'operation_amount' => $USDpaymentdone_amount,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'TOP-UP declined by ADMIN',
                                               'new_solde' => $check->balance_account											   
											  ]);											  
								
				
			}
		
		else
			{
					  
					DB::table('foperation')->insert([
											   'ID_account' => $check->ID_account,
											   'account_denomination' => 'balance_account',
											   'foperation_type'  => 'DECLINED',
											   'operation_amount' => $USDpaymentdone_amount,
											   'foperation_date' => $datecreation,
											   'foperation_description' => 'TOP-UP declined by ADMIN',
                                               'new_solde' => $check->balance_account											   
											  ]);	
				
			}
			
		
		return redirect()->action([PagesController::class, 'getLandingpage']);
				
	}
	
	
	public function getWithdrawaldone(Request $request,int $id)
    {
		
		date_default_timezone_set('UTC'); 
        $datecreation = date('Y-m-d H:i:s');
		
		/*$code = rand(3000,7200)."-".$datecreation."-".Session::get('logID')."-".rand(1989,5200) ;
			$squash_code = $this->my_simple( $code, 'e' );
			$refcode = substr($squash_code, 0,15);*/
		
		if ((Session::has('logID')) == null)
		   { 
	        return redirect()->action([PagesController::class, 'getLandingpage']);
		   }
		 
			$validatedData = $request->validate([
				  'montant' => 'required',
			]);

		
		
		DB::table('withdrawal_request')
                    ->where('ID_withdrawal', $id)
                    ->update(['authorised_withdrawal' => "1", 'exact_amount_withdrawal' => $validatedData['montant'],
					'authoriser_withdrawal' => Session::get('logID'),'reference_exact_amount_withdrawal' => $request->reference, 
					'authorised_withdrawal_date' => $datecreation,'date_exact_amount_withdrawal' => $request->date_envoi,
					'telephone_exact_amount_withdrawal' => $request->numero,'mode_exact_amount' => $request->mode]);
	
	    
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('ID_withdrawal', '=', $id)
			        ->first();
	
	    $email_msg =  '<html>
                                <head>
                                <title> COMPTE EFARM CROWD CAPITAL </title>
                                </head>
								<body>
									<table> 
									    <tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <h2 >WITHDRAWAL OPERATION INITIATED</h2>
												</div>
											  </div>
											</td>
                                        </tr>

                                        <tr><td height="15"> </td></tr>

										<tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <p  style="text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;">
													<br>
													<br>
													Merci d\'avoir demandé un retrait depuis votre compte EFARM CAPITAL ! <br>
                                                   Nous avons le plaisir de vous informer que votre demande a été validée par un administrateur. 
                                                   Le virement sera effectué prochainement et sera crédité sur le compte de réception que vous avez sélectionné.

													<br>
													Merci !!!
													
													<br><br><br>
												        Si vous n\'avez pas effectué de demande de retrait sur notre plateforme : www.efarm.com, aucune autre action n\'est requise..
													<br><br><br><br>
													<span style="color:#222222;">Cordialement, EFARM  CAPITAL</span>
												  </p>
												</div>
											  </div>
											</td>
										</tr>

                                    </table>
							    </body>
                             </html>';
							 
				                    $to1 = $with->cemail;
									$to2 = 'infos@efarm-ci.com';
									$subject = 'EFARM | REQUETE DE RETRAIT';
									$message = $email_msg;
									
									// To send HTML mail, the Content-type header must be set
										$headers[] = 'MIME-Version: 1.0';
										$headers[] = 'Content-type: text/html; charset=iso-8859-1';
										$headers[] = 'Return-Path: infos@efarm-ci.com';
										$headers[] = 'From: infos@efarm-ci.com';
										

									// Mail it
									mail($to1, $subject, $message, implode("\r\n", $headers));
									mail($to2, $subject, $message, implode("\r\n", $headers));
	    
		return redirect()->action([PaymentController::class, 'getWithdrawal']);
	
	}
	
	
	public function my_simple( $string, $action = 'e' ) 
	{
    
			$secret_key = 'my_sergio_delavega2804naguyguy_key';
			$secret_iv = 'my_sergio_delavega2804naguyguy_iv';
 
			$output = false;
			$encrypt_method = "AES-256-CBC";
			$key = hash( 'sha256', $secret_key );
			$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
		 
			if( $action == 'e' ) {
				$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
			}
			else if( $action == 'd' ){
				$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
			}
		 
			return $output;
    }
	
	
	public function getFees()
    {
		
		$info = DB::table('fees')
		        ->join('foperation', 'fees.ID_foperation', '=', 'foperation.ID_foperation')
				->orderBy('date_fees', 'desc')
				->get();
				
				//dd($info);
				
			return view('fichiers/fees',['fee'=>$info]); 
				
	}
	
	public function feesentretien()
    {
		
		$fraisentretien = DB::table('foperation')
		        ->join('customeraccounts', 'customeraccounts.ID_account', '=', 'foperation.ID_account')
				->join('forfaits', 'forfaits.ID_forfait', '=', 'customeraccounts.ID_forfait')
				->join('customers', 'foperation.ID_customer', '=', 'customers.ID_customer')
				->where('foperation.account_denomination', 'frait_account')
				->orderBy('ID_foperation', 'desc')
				->get();
				
				//dd($fraisentretien);
				
			return view('fichiers/frais_entretien',['fraisentretien'=>$fraisentretien]); 
				
	}
	
	public function getTva()
    {
		
		$info = DB::table('foperation')
		        ->where('account_denomination', '=', 'none')
				->where('foperation_type', '=', 'BUY')
				->where('foperation_description', '=', 'forfait acquisition')
				->orWhere('foperation_description', '=', 'forfait upgrade')
				->get();
				
				//dd($info);
				
			return view('fichiers/tva',['tva'=>$info]); 
				
	}
	
	public function getCapitalisation()
    {
		$info = DB::table('customermarque')
				->join('customers', 'customermarque.ID_customer', '=', 'customers.ID_customer')
				->join('marque', 'customermarque.ID_marque', '=', 'marque.ID_marque')
		        ->where('status', '=', 1)
				->get();
				
				//dd($info);
				
			return view('fichiers/capitalisation',['info'=>$info]); 
				
	}
	
	
	public function getForexecheancier()
    {
		date_default_timezone_set('UTC');
		$today = date('Y-m-d H:i:s');
		
		$info = DB::table('customermarque')
				->join('customers', 'customermarque.ID_customer', '=', 'customers.ID_customer')
		        ->where('fin_souscription', '>=', $today)
				->orderBy('fin_souscription', 'ASC')
				->get();
				
				//dd($info);
				
			return view('fichiers/forexecheancier',['info'=>$info]); 
				
	}
	
	public function getForexecheancierp()
    {
		
		date_default_timezone_set('UTC');
		$today = date('Y-m-d H:i:s');
		
		$info = DB::table('customermarque')
				->join('customers', 'customermarque.ID_customer', '=', 'customers.ID_customer')
		        ->where('fin_souscription', '<=', $today)
				->get();
				
				//dd($info);
				
			return view('fichiers/forexecheancierp',['info'=>$info]); 		
		
	}
	
		
	
	public function get_Report_withdrawal(Request $request)
    {
        
		
		$daystart = $request->deb.' '.'00:01:00'; 
		$dayend = $request->fin.' '.'23:59:00' ;			
			
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
					->where('treatment_withdrawal', '=', "0")
					->whereBetween('date_withdrawal', [$daystart, $dayend])
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
        
		$withsomme = DB::table('withdrawal_request')
		            ->where('authorised_withdrawal', '=', "0")
					->where('treatment_withdrawal', '=', "0")
					->whereBetween('date_withdrawal', [$daystart, $dayend])
				    ->sum('amount_withdrawal'); 
			/* 		
		    if($with->account_to_withdrawal == 1) { $acct_to = "Invest A"; }
			if($with->account_to_withdrawal == 2) { $acct_to = "Invest B"; }
			if($with->account_to_withdrawal == 3) { $acct_to = "Invest C"; }
			if($with->account_to_withdrawal == 4) { $acct_to = "Un membre"; }
			if($with->account_to_withdrawal == 5) { $acct_to = "Mobile Money"; }
			if($with->account_to_withdrawal == 6) { $acct_to = "Bitcoin"; }
			if($with->account_to_withdrawal == 7) { $acct_to = "Bank"; } */
		
		return view('fichiers/withdrawal_date',['with'=>$with,'withsomme'=>$withsomme]); 
		//
    }
	
		
	
	public function get_Report_withdrawalop(Request $request)
    {
        
					
			
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
		            ->where('treatment_withdrawal', '=', "0")
					->where('account_to_withdrawal', $request->operation)
					->orderBy('ID_withdrawal', 'desc')
			        ->get();		
		// dd($with);	
		$withsomme = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
		            ->where('treatment_withdrawal', '=', "0")
					->where('account_to_withdrawal', $request->operation)
				    ->sum('amount_withdrawal'); 
        
		
		return view('fichiers/withdrawal_date',['with'=>$with,'withsomme'=>$withsomme]); 
		//
    }
	
	
	
	public function getTreatment()
    {
        
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
		            ->where('treatment_withdrawal', '=', "1")
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
        
		    $tot = 0;
			/* 		
		    if($with->account_to_withdrawal == 1) { $acct_to = "Invest A"; }
			if($with->account_to_withdrawal == 2) { $acct_to = "Invest B"; }
			if($with->account_to_withdrawal == 3) { $acct_to = "Invest C"; }
			if($with->account_to_withdrawal == 4) { $acct_to = "Un membre"; }
			if($with->account_to_withdrawal == 5) { $acct_to = "Mobile Money"; }
			if($with->account_to_withdrawal == 6) { $acct_to = "Bitcoin"; }
			if($with->account_to_withdrawal == 7) { $acct_to = "Bank"; } */
		
		return view('fichiers/treatment',['with'=>$with,'tot'=>$tot]); 
		//
    }
	
	public function get_Report_treatment_select(Request $request)
    {
		
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
		            ->where('treatment_withdrawal', '=', "1")
					->where('account_to_withdrawal', $request->operation)
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
        
		    $tot = 0;
			/* 		
		    if($with->account_to_withdrawal == 1) { $acct_to = "Invest A"; }
			if($with->account_to_withdrawal == 2) { $acct_to = "Invest B"; }
			if($with->account_to_withdrawal == 3) { $acct_to = "Invest C"; }
			if($with->account_to_withdrawal == 4) { $acct_to = "Un membre"; }
			if($with->account_to_withdrawal == 5) { $acct_to = "Mobile Money"; }
			if($with->account_to_withdrawal == 6) { $acct_to = "Bitcoin"; }
			if($with->account_to_withdrawal == 7) { $acct_to = "Bank"; } */
		
		return view('fichiers/treatment_select',['with'=>$with,'tot'=>$tot]); 
		//
    }
	
	public function getTreatment_select(Request $request)
    {
		$daystart = $request->deb.' '.'00:01:00'; 
		$dayend = $request->fin.' '.'23:59:00' ;
        
		$with = DB::table('withdrawal_request')
		            ->join('customers', 'withdrawal_request.ID_customer', '=', 'customers.ID_customer')
		            ->where('authorised_withdrawal', '=', "0")
		            ->where('treatment_withdrawal', '=', "1")
					->whereBetween('date_withdrawal', [$daystart, $dayend])
					->orderBy('ID_withdrawal', 'desc')
			        ->get();
		    $tot = 0;
			/* 		
		    if($with->account_to_withdrawal == 1) { $acct_to = "Invest A"; }
			if($with->account_to_withdrawal == 2) { $acct_to = "Invest B"; }
			if($with->account_to_withdrawal == 3) { $acct_to = "Invest C"; }
			if($with->account_to_withdrawal == 4) { $acct_to = "Un membre"; }
			if($with->account_to_withdrawal == 5) { $acct_to = "Mobile Money"; }
			if($with->account_to_withdrawal == 6) { $acct_to = "Bitcoin"; }
			if($with->account_to_withdrawal == 7) { $acct_to = "Bank"; } */
		
		return view('fichiers/treatment_select',['with'=>$with,'tot'=>$tot]); 
		//
    }
		
}
