<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class PagesController extends Controller
{
    //
	
	
	public function pdfview(Request $request)
	{
		
		$items = DB::table("commandes")->get();
		
		
		view()->share('items',$items);
		
		if($request->has('download'))
			{
			$pdf = PDF::loadView('fichiers/commande/pdfview');
			return $pdf->download('pdfview.pdf');
			}
		
		return view('fichiers/commande/pdfview');
	}
	
	public function test() {
		    
			return view('fichiers/commande/pdfview'); 
	        }
	
	
	
	public function getIndexmobile() {
		    
			return view('fichiers/loginmobile'); 
	        }
			
			
	public function getIndex() {
		    
			return view('fichiers/login'); 
	        }
			
	
	public function getLandingpage() {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		
		
		//Graph	
		
		return view('fichiers/landingpage'); 
	
	}
	
	
	public function getlisteproforma() {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		$mtn = null;
        $custo = null;
		
		
		if((Session::get('loglevel') == "SAL") &&(Session::get('deplevel') == "0"))
		{
			$proforma = DB::table('commandes')
			        ->where('salesman', '=', Session::get('logID'))
					->orderby('date_commande','desc')
		            ->get();
		    
		}
        else
        {
			$proforma = DB::table('commandes')
					->orderby('date_commande','desc')
		            ->get();
		}
		
				   
				  foreach($proforma as $pro)
					  {
						 $montant = DB::table('detail_commande')
									->where('ID_commande', '=', $pro->ID_commande)
									->SUM('montant_detailcommande');

						if($pro->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $pro->ID_customer)
										->first();	
							}
						else
						   {
							 $cust = '-';  
						   }
							
							$mtn[] = $montant;
                            $custo[] = $cust;							
                           							
					  }
				
		return view('fichiers/commande/proforma',['proforma'=>$proforma,'mtn'=>$mtn,'custo'=>$custo]); 
	
	}
	
	
		public function getactivecustomer(int $id) 
	 {
			DB::table('customers')
				->where('ID_customer', '=', $id)
				->update([ 'admin_check' => 1]); 

				return back();
		
	}
	public function getdeactivecustomer(int $id) 
	 {
			DB::table('customers')
				->where('ID_customer', '=', $id)
				->update([ 'admin_check' => 0]); 

				return back();
		
	}
	
	
	public function getConsultationcommande(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		$commande = DB::table('commandes')
					->where('ID_commande', '=', $id)
		            ->first();
					
		$versement = DB::table('versement_commande')
					->where('ID_commande', '=', $id)
		            ->get();
										
		$proforma = DB::table('detail_commande')
		            ->join('produits', 'detail_commande.ID_produit', '=', 'produits.ID_produit')
					->where('ID_commande', '=', $id)
		            ->get();
				  
				 
						if($commande->ID_customer != null)
						    {
								$custo = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone','cadress')
										->where('ID_customer', '=', $commande->ID_customer)
										->first();	
							}
						else { $custo = "-";} 
							
	
		return view('fichiers/commande/detailproforma',['proforma'=>$proforma,'commande'=>$commande,'versement'=>$versement,'custo'=>$custo]); 
	
	}
	
	
	public function getPreviewproformat(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		
		$commande = DB::table('commandes')
					->where('ID_commande', '=', $id)
		            ->first();
					
					
		$proforma = DB::table('detail_commande')
		            ->join('produits', 'detail_commande.ID_produit', '=', 'produits.ID_produit')
					->where('ID_commande', '=', $id)
		            ->get();
				  
				 
						if($commande->ID_customer != null)
						    {
								$custo = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone','cadress')
										->where('ID_customer', '=', $commande->ID_customer)
										->first();	
							}
						else { $custo = "-";} 
							
	
		return view('fichiers/commande/previewproforma',['proforma'=>$proforma,'commande'=>$commande,'custo'=>$custo]); 
	
	}
	
	
	public function getPreviewfacture(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		
		$commande = DB::table('commandes')
		            ->join('activation_codes', 'commandes.ID_activationcodes', '=', 'activation_codes.ID_activationcodes')
					->where('commandes.ID_commande', '=', $id)
		            ->first();
					
					
		$proforma = DB::table('detail_commande')
		            ->join('produits', 'detail_commande.ID_produit', '=', 'produits.ID_produit')
					->where('ID_commande', '=', $id)
		            ->get();
				  
				 
						if($commande->ID_customer != null)
						    {
								$custo = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone','cadress')
										->where('ID_customer', '=', $commande->ID_customer)
										->first();	
							}
						else { $custo = "-";} 
							
	
		return view('fichiers/commande/previewfacture',['proforma'=>$proforma,'commande'=>$commande,'custo'=>$custo]); 
	
	}
	
	
	public function getPreviewrecu(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		
		$versement = DB::table('versement_commande')
		            ->join('commandes', 'versement_commande.ID_commande', '=', 'commandes.ID_commande')
					->where('versement_commande.ID_versement', '=', $id)
		            ->first();
		
		
						if($versement->ID_customer != null)
						    {
								$custo = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone','cadress')
										->where('ID_customer', '=', $versement->ID_customer)
										->first();	
							}
							
						else { $custo = null;}
						
							
	
		return view('fichiers/commande/previewrecu',['versement'=>$versement,'custo'=>$custo]); 
	
	}
	
	
	
	public function getSoumissioncommande(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
					
		DB::table('commandes')
							->where('ID_commande', '=', $id)
							->update([ 'soumis_client' => 1
									]); 
							
		
		$infocli = DB::table('commandes')
		         ->where('ID_commande', '=', $id)
			     ->first();
				 
				 if($infocli->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $infocli->ID_customer)
										->first();
                                
								$nom = $cust->cname.' '.$cust->cprename;
								$email = $cust->cemail;
										
							}
						else
						   {
							 $nom = $infocli->pname;
							 $email = $infocli->pemail;							 
						   }
								
	
		return redirect()->action([PagesController::class, 'getlisteproforma']);	
	
	}
	
	
	
	public function getAcceptioncommande(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
					
		DB::table('commandes')
							->where('ID_commande', '=', $id)
							->update([  'valide_client' => 1
									]); 
									
									
			$infocli = DB::table('commandes')
		         ->where('ID_commande', '=', $id)
			     ->first();
				 
				 if($infocli->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $infocli->ID_customer)
										->first();
                                
								$nom = $cust->cname.' '.$cust->cprename;
								$email = $cust->cemail;
										
							}
						else
						   {
							 $nom = $infocli->pname;
							 $email = $infocli->pemail;							 
						   }
							
			
			
		//ENVOYER EMAIL AU CLIENT
		$email_msg =  '<html>
                                <head>
                                <title> EFARM </title>
                                </head>
								<body>
									<table> 
									    <tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <h2 >VOTRE COMMANDE A ETE COMMANDE VALIDEE</h2>
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
													Bonjour, '.$nom.' <br>
                                                     Votre commande a été validée.
													 Vous pouvez consulter votre Proforma en cliquant sur le bouton ci-dessous.
													<br><br><br>
													<a target="_blank" href="https://boasonadmin.boasoncc.com/previewproformat/'.$id.'" class="link2" style="color:#ffffff; background-color: #e56002; padding: 20px;" align="center">
														CONSULTER MA FACTURE PROFORMA
													</a>
													<br><br><br>
													If you did not initiate an order, no further action is required.
													<br><br><br><br>
													<span style="color:#222222;">Cordialement, BOASON CROWD CAPITAL</span>
												  </p>
												</div>
											  </div>
											</td>
										</tr>

                                    </table>
							    </body>
                             </html>';
							 
				                    $to1 = $email;
									$to2 = 'boasoncc@gmail.com';
									$subject = 'BOASON CC | COMMANDE VALIDEE';
									$message = $email_msg;
									
									// To send HTML mail, the Content-type header must be set
										$headers[] = 'MIME-Version: 1.0';
										$headers[] = 'Content-type: text/html; charset=iso-8859-1';
										$headers[] = 'Return-Path: validation@boasoncc.com';
										$headers[] = 'From: validation@boasoncc.com';
										

									// Mail it
									mail($to1, $subject, $message, implode("\r\n", $headers));
									mail($to2, $subject, $message, implode("\r\n", $headers));
			
	
		return redirect()->action([PagesController::class, 'getlisteproforma']);	
	
	}
	
	
	public function getenvoifacture(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
					
		DB::table('commandes')
							->where('ID_commande', '=', $id)
							->update([  'facture_sent' => 1
									]); 
									
			$infocli = DB::table('commandes')
		         ->where('ID_commande', '=', $id)
			     ->first();
				 
				 if($infocli->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $infocli->ID_customer)
										->first();
                                
								$nom = $cust->cname.' '.$cust->cprename;
								$email = $cust->cemail;
										
							}
						else
						   {
							 $nom = $infocli->pname;
							 $email = $infocli->pemail;							 
						   }
							

			
		//ENVOYER EMAIL AU CLIENT
		$email_msg =  '<html>
                                <head>
                                <title> BOASON CROWD CAPITAL </title>
                                </head>
								<body>
									<table> 
									    <tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <h2 >VOTRE FACTURE</h2>
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
													Bonjour, '.$nom.' <br>
                                                     Votre achat a été validé.
													 Vous pouvez consulter votre Facture en cliquant sur le bouton ci-dessous.
													<br><br><br>
													<a target="_blank" href="https://boasonadmin.boasoncc.com/previewfacture/'.$id.'" class="link2" style="color:#ffffff; background-color: #e56002; padding: 20px;" align="center">
														CONSULTER MA FACTURE 
													</a>
													<br><br><br>
													If you did not initiate an order, no further action is required.
													<br><br><br><br>
													<span style="color:#222222;">Cordialement, BOASON CROWD CAPITAL</span>
												  </p>
												</div>
											  </div>
											</td>
										</tr>

                                    </table>
							    </body>
                             </html>';
							 
				                    $to1 = $email;
									$to2 = 'boasoncc@gmail.com';
									$subject = 'BOASON CC | FACTURE';
									$message = $email_msg;
									
									// To send HTML mail, the Content-type header must be set
										$headers[] = 'MIME-Version: 1.0';
										$headers[] = 'Content-type: text/html; charset=iso-8859-1';
										$headers[] = 'Return-Path: validation@boasoncc.com';
										$headers[] = 'From: validation@boasoncc.com';
										

									// Mail it
									mail($to1, $subject, $message, implode("\r\n", $headers));
									mail($to2, $subject, $message, implode("\r\n", $headers));
			
		return redirect()->action([PagesController::class, 'getlistefacture']);	
	
	}
	
	
	public function getVersementcommande(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
					
		$proforma = DB::table('commandes')
		            ->where('ID_commande', '=', $id)
		            ->first();
					
					
		$proformamontant = DB::table('detail_commande')
							->where('ID_commande', '=', $id)
							->SUM('montant_detailcommande');
				
					
		$previous = DB::table('versement_commande')
		            ->where('ID_commande', '=', $id)
		            ->SUM('montant_versement');
					
	
		return view('fichiers/commande/versement',['proforma'=>$proforma,'previous'=>$previous,'proformamontant'=>$proformamontant]); 
	
	}
	
	
	public function getlistefacture() {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		$mtn = null;
        $custo = null;	
		
		$facture = DB::table('commandes')
		            ->where('solde_client', '=', 1)
		            ->get();
				  
				  foreach($facture as $pro)
					  {
						 $montant = DB::table('detail_commande')
									->where('ID_commande', '=', $pro->ID_commande)
									->SUM('montant_detailcommande');

						if($pro->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $pro->ID_customer)
										->first();	
							}
						else
						   {
							 $cust = '-';  
						   }
							
							$mtn[] = $montant;
                            $custo[] = $cust;							
                           							
					  }
			
		return view('fichiers/commande/facturate',['facture'=>$facture,'mtn'=>$mtn,'custo'=>$custo]); 
	
	}
	
	
	public function getnewproforma() {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		
		$produits = DB::table('produits')
		            ->get();
					
		$customers = DB::table('customers')
		            ->select('ID_customer','cpseudo','cname','cprename')
		            ->get();
			
		return view('fichiers/commande/emission_commande',['produits'=>$produits,'customers'=>$customers]); 
	
	}
	
	
	public function proformageneration(Request $request)
    {
		
		//dd($request->input());
		$datecreation = date('Y-m-d H:i:s');
		
		
		$lastcomm= DB::table('commandes')
		            ->MAX('ID_commande'); 
					//dd($lastcomm);
		if($lastcomm == null) { $lastcomm = 0; }			
		$newgen = $lastcomm + 1;
		if ((strlen((string)$newgen) == 1)) { $newgen = '00'.$newgen ;} if ((strlen((string)$newgen) == 2)) { $newgen = '0'.$newgen ;}
		$year = date("ymd");
		$nocommande = 'P'.$newgen.$year ; 
		//dd($nocommande);
       
	        if($request->typeclient == 0)
				{
					DB::table('commandes')->insert([
									   ['no_commande' => $nocommande ,
									    'pname' => $request->nameclient,
									    'pemail'  =>$request->mailclient,
									    'pphone' => $request->telclient,
									    'padress' => $request->addclient,
									    'date_commande' => $datecreation,
										'salesman' => Session::get('logID')
									   ]
													  ]); 
				}
			if($request->typeclient == 1)
				{
					DB::table('commandes')->insert([
									   ['no_commande' => $nocommande ,
									    'ID_customer' => $request->oldclient,
									    'date_commande' => $datecreation,
										'salesman' => Session::get('logID')
									   ]
													  ]); 
				}
	   
			$lastcomm= DB::getPdo()->lastInsertId();
			   
			   foreach($request->produitchoice as $c)
				{
					
					$p = DB::table('produits')
							 ->where('ID_produit', '=', $c)
							 ->first();
							 
					if($p->type_produit != 'TOPUP')
						{
							 DB::table('detail_commande')->insert([
									   ['ID_commande' => $lastcomm,
									    'ID_produit' => $c,
									    'montant_detailcommande' => $p->montant_produit_ttc_xof
									   ]
										]); 
						}
					
				}
				
				if($request->montant != null)
						{
							DB::table('detail_commande')->insert([
									   ['ID_commande' => $lastcomm,
									    'ID_produit' => 10,
									    'montant_detailcommande' => $request->montant
									   ]
										]); 
						}
			
		return redirect()->action([PagesController::class, 'getlisteproforma']);	
    }
	
	
	public function versementcommande(Request $request)
    {
		
		//dd($request->input());
		$datecreation = date('Y-m-d H:i:s');
		
		
		$lastcomm= DB::table('versement_commande')
		            ->MAX('ID_versement'); 
					//dd($lastcomm);
		if($lastcomm == null) { $lastcomm = 0; }			
		$newgen = $lastcomm + 1;
		if ((strlen((string)$newgen) == 1)) { $newgen = '00'.$newgen ;} if ((strlen((string)$newgen) == 2)) { $newgen = '0'.$newgen ;}
		$year = date("ymd");
		$norecu = 'R'.$newgen.$year ; 
		//dd($nocommande);
       
        
		$montanttotalverse = $request->accompte + $request->montant	;			
			
			
			//montant total versé sera supérieur au montant à payer // refuser
		    if($montanttotalverse > $request->mtncommande)
				{
				  Session::flash('montantsuperieur', 'Le montant versé est supérieur au montant dû');		
				  return redirect()->action([PagesController::class, 'getlisteproforma']);		
				}
            
            else
			   {
				   
				   DB::table('versement_commande')->insert([
							   ['no_recu' => $norecu ,
								'montant_versement' => $request->montant,
								'ID_commande'  =>$request->idcommande,
								'date_versement' => $datecreation,
								'cashier' => Session::get('logID')
							   ]
								]); 
								
					$lastrecu= DB::getPdo()->lastInsertId();


                    $infocli = DB::table('commandes')
						 ->where('ID_commande', '=', $request->idcommande)
						 ->first();
				 
				    if($infocli->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $infocli->ID_customer)
										->first();
                                
								$nom = $cust->cname.' '.$cust->cprename;
								$email = $cust->cemail;
										
							}
						else
						   {
							 $nom = $infocli->pname;
							 $email = $infocli->pemail;							 
						   }	
					
				   
				//PAIEMENT PARTIEL
				   if($montanttotalverse < $request->mtncommande)
						{
						  
						  DB::table('commandes')
							->where('ID_commande', '=', $request->idcommande)
							->update([ 'echance_client' => 1
									]); 
									
									
									
                            //ENVOYER MAIL RECU DE PAIEMENT	
				                $email_msg =  '<html>
                                <head>
                                <title> BOASON CROWD CAPITAL </title>
                                </head>
								<body>
									<table> 
									    <tr>
											<td align="left">
											  <div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" align="center">
												  <h2 >VOTRE VERSEMENT A BIEN ETE PRIS EN COMPTE</h2>
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
													Bonjour, '.$nom.' <br>
                                                     Votre versement a bien été pris en compte.
													 Merci de cliquer sur le bouton suivant pour consulter votre reçu de paiement.
													<br><br><br>
													<a target="_blank" href="https://boasonadmin.boasoncc.com/previewrecu/'.$lastrecu.'" class="link2" style="color:#ffffff; background-color: #e56002; padding: 20px;" align="center">
														RECU DE PAIEMENT
													</a>
													<br><br><br>
													If you did not initiate an order, no further action is required.
													<br><br><br><br>
													<span style="color:#222222;">Cordialement, BOASON CROWD CAPITAL</span>
												  </p>
												</div>
											  </div>
											</td>
										</tr>

                                    </table>
							        </body>
                                </html>';
							 
				                    $to1 = $email;
									$to2 = 'boasoncc@gmail.com';
									$subject = 'BOASON CC | REÇU DE VERSEMENT ';
									$message = $email_msg;
									
									// To send HTML mail, the Content-type header must be set
										$headers[] = 'MIME-Version: 1.0';
										$headers[] = 'Content-type: text/html; charset=iso-8859-1';
										$headers[] = 'Return-Path: validation@boasoncc.com';
										$headers[] = 'From: validation@boasoncc.com';
										

									// Mail it
									mail($to1, $subject, $message, implode("\r\n", $headers));
									mail($to2, $subject, $message, implode("\r\n", $headers));		
									
								
						}
						
						
				//PAIEMENT TOTAL ET FINAL	
					if($montanttotalverse == $request->mtncommande)
						{
						 	//generation de code facture			 		
							$lastfact= DB::table('commandes')
							->where('no_facture', '!=', null)
							->count(); 
							//dd($lastfact);
							if($lastfact == null) { $lastfact = 0; }			
							$newgen = $lastfact + 1;
							if ((strlen((string)$newgen) == 1)) { $newgen = '00'.$newgen ;} if ((strlen((string)$newgen) == 2)) { $newgen = '0'.$newgen ;}
							$year = date("ymd");
							$nofacture = 'F'.$newgen.$year ;
							
							//recuperation du premier code disponible
							$codeactivation= DB::table('activation_codes')
							                 ->where('assigned_activationcodes', '=', 0)
		                                     ->MIN('ID_activationcodes'); 

							//mise a jour de la commande
						 	DB::table('commandes')
							->where('ID_commande', '=', $request->idcommande)
							->update([ 'solde_client' => 1,
							           'echance_client' => 1,
							           'no_facture' => $nofacture,
									   'ID_activationcodes' => $codeactivation
									]); 
									
							//assignation de montant et commande au code		
							DB::table('activation_codes')
							->where('ID_activationcodes', '=', $codeactivation)
							->update([ 'ID_commande' => $request->idcommande,
							           'montant_code' => $request->mtncommande,
									   'assigned_activationcodes' => 1
									]);
									
									
					
									
						//ENVOYER MAIL	RECU DE PAIEMENT	
							$email_msg =  '<html>
											<head>
											<title> BOASON CROWD CAPITAL </title>
											</head>
											<body>
												<table> 
													<tr>
														<td align="left">
														  <div class="contentEditableContainer contentTextEditable">
															<div class="contentEditable" align="center">
															  <h2 >VOTRE VERSEMENT A BIEN ETE PRIS EN COMPTE</h2>
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
																Bonjour, '.$nom.' <br>
																 Votre versement a bien été pris en compte.
																 Merci de cliquer sur le bouton suivant pour consulter votre reçu.
																<br><br><br>
																<a target="_blank" href="https://boasonadmin.boasoncc.com/previewrecu/'.$lastrecu.'" class="link2" style="color:#ffffff; background-color: #e56002; padding: 20px;" align="center">
																	RECU DE PAIEMENT
																</a>
																<br><br><br>
																If you did not initiate an order, no further action is required.
																<br><br><br><br>
																<span style="color:#222222;">Cordialement, BOASON CROWD CAPITAL</span>
															  </p>
															</div>
														  </div>
														</td>
													</tr>

										  

												</table>
											</body>
										 </html>';
										 
												$to1 = $email;
												$to2 = 'boasoncc@gmail.com';
												$subject = 'BOASON CC | REÇU DE VERSEMENT ';
												$message = $email_msg;
												
												// To send HTML mail, the Content-type header must be set
													$headers[] = 'MIME-Version: 1.0';
													$headers[] = 'Content-type: text/html; charset=iso-8859-1';
													$headers[] = 'Return-Path: validation@boasoncc.com';
													$headers[] = 'From: validation@boasoncc.com';
													

												// Mail it
												mail($to1, $subject, $message, implode("\r\n", $headers));
												mail($to2, $subject, $message, implode("\r\n", $headers));
												
												
												
					$id = $request->idcommande;						
					//ENVOYER MAIL	FACTURE	
							$email_msg =  '<html>
											<head>
											<title> BOASON CROWD CAPITAL </title>
											</head>
											<body>
												<table> 
													<tr>
														<td align="left">
														  <div class="contentEditableContainer contentTextEditable">
															<div class="contentEditable" align="center">
															  <h2 >VOTRE VERSEMENT A BIEN ETE PRIS EN COMPTE</h2>
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
																Bonjour, '.$nom.' <br>
																 Votre versement a bien été pris en compte.
																 Merci de cliquer sur le bouton suivant pour consulter votre reçu.
																<br><br><br>
																<a target="_blank" href="https://boasonadmin.boasoncc.com/previewfacture/'.$id.'" class="link2" style="color:#ffffff; background-color: #e56002; padding: 20px;" align="center">
																	FACTURE
																</a>
																<br><br><br>
																If you did not initiate an order, no further action is required.
																<br><br><br><br>
																<span style="color:#222222;">Cordialement, BOASON CROWD CAPITAL</span>
															  </p>
															</div>
														  </div>
														</td>
													</tr>

										  

												</table>
											</body>
										 </html>';
										 
												$to1 = $email;
												$to2 = 'boasoncc@gmail.com';
												$subject = 'BOASON CC | REÇU DE VERSEMENT ';
												$message = $email_msg;
												
												// To send HTML mail, the Content-type header must be set
													$headers[] = 'MIME-Version: 1.0';
													$headers[] = 'Content-type: text/html; charset=iso-8859-1';
													$headers[] = 'Return-Path: validation@boasoncc.com';
													$headers[] = 'From: validation@boasoncc.com';
													

												// Mail it
												mail($to1, $subject, $message, implode("\r\n", $headers));
												mail($to2, $subject, $message, implode("\r\n", $headers));
									
					}				
									
				   
			    Session::flash('versementok', 'Le versement a été effectué avec succès');   
			   return redirect()->action([PagesController::class, 'getlisteproforma']);	
			   
			   }				
		
		
    }
	
	
    public function getlisteutilisateurs() {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		$utilisateur = DB::table('customers')
						->where('admin_check', '=', 1)
						->get();
				  
		return view('fichiers/utilisateurs',['utilisateur'=>$utilisateur]); 
	
	}
	
	
	public function getnewutilisateur() {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
					
		$customers = DB::table('customers')
		            ->select('ID_customer','cpseudo','cname','cprename')
		            ->get();
			
	
		return view('fichiers/ajouter_utilisateur',['customers'=>$customers]); 
	
	}
	
	
	public function ajouteruser(Request $request)
    {
			DB::table('customers')
				->where('ID_customer', '=', $request->user)
				->update([ 'admin_check' => 1,
						   'admin_level' => $request->dept,
						   'dept_level' => $request->level
						]); 
						
			return redirect()->action([PagesController::class, 'getlisteutilisateurs']);					
		
    }
	
	public function getmodifieruser(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		$utilisateur = DB::table('customers')
						->where('ID_customer', '=', $id)
						->first();			
					
	
		return view('fichiers/modifier_utilisateur',['utilisateur'=>$utilisateur]); 
	
	}
	
	
	public function modiuser(Request $request)
    {
			DB::table('customers')
				->where('ID_customer', '=', $request->idcustomer)
				->update([ 'admin_level' => $request->dept,
						   'dept_level' => $request->level
						]); 
									
							
				   
			return redirect()->action([PagesController::class, 'getlisteutilisateurs']);					
		
    }
	
	
    public function getmodifcommande(int $id) {
		
		//alerte
		$verif = DB::table('paymentdones')
		         ->where('paymentdone_verified', '=', 0)
			     ->count();
				 
		Session::put('alertverif', $verif);

		$withdraw = DB::table('withdrawal_request')
		         ->where('authorised_withdrawal', '=', 0)
			     ->count();
		Session::put('alertwithdraw', $withdraw);
		//alerte
		
		$produits = DB::table('produits')
		            ->get();
		
		$comm = DB::table('commandes')
						->where('ID_commande', '=', $id)
						->first();

             
						if($comm->ID_customer != null)
						    {
								$cust = DB::table('customers')
								        ->select('cpseudo','cname','cprename','cemail','cphone')
										->where('ID_customer', '=', $comm->ID_customer)
										->first();	
								
							}
						else
						   {
							 $cust = null; 
						   }
														
       

        $detcommtopup = DB::table('detail_commande')
						->where('ID_commande', '=', $id)
						->where('ID_produit', '=', 10)
						->first(); 						
									
		//dd($detcommtopup);			
	
		return view('fichiers/commande/modifier_commande',['comm'=>$comm,'detcommtopup'=>$detcommtopup,
														'cust'=>$cust,'produits'=>$produits]); 
	
	}
	
	
	public function modipro(Request $request)
    {
			
			if((isset($request->nameclient)) && ($request->nameclient != null))
			{
				DB::table('commandes')
				->where('ID_commande', '=', $request->idcommande)
				->update([ 
				           'pname' => $request->nameclient,
				           'pemail' => $request->mailclient,
						   'pphone' => $request->telclient,
						   'padress' => $request->addclient
						]); 
						
			}
			
			
			if($request->produitchoice != null)
			{			    
				DB::table('detail_commande')
					 ->where('ID_commande', '=', $request->idcommande)
					 ->where('ID_produit', '!=', 10)
					 ->delete();
				
				DB::table('detail_commande')
					->where('ID_commande', '=', $request->idcommande)
					->where('ID_produit', '=', 10)
					->update([ 
					           'montant_detailcommande' => $request->montant
							]);

				foreach($request->produitchoice as $c)
				{					
					$p = DB::table('produits')
							 ->where('ID_produit', '=', $c)
							 ->first();
							 
					if($p->type_produit != 'TOPUP')
						{
							 DB::table('detail_commande')->insert([
									   ['ID_commande' => $request->idcommande,
									    'ID_produit' => $c,
									    'montant_detailcommande' => $p->montant_produit_ttc_xof
									   ]
										]); 
						}					
				}				
			}						
							
				   
			return redirect()->action([PagesController::class, 'getlisteproforma']);							
    }
	
	
	public function getSupport() {
		
		    $etat = DB::table('support')
						->join('customers', 'support.ID_customer', '=', 'customers.ID_customer')
						->where ('traite_sup', '=', '0')
						->orderBy('ID_support', 'DESC')
			            ->get();
						
		    $etats = DB::table('add_supports')
						->join('support', 'add_supports.ID_support', '=', 'support.ID_support')
						->where('add_supports.ID_support', '=','support.ID_support')
						->where ('add_supports.lus', '=', '0')
						->orderBy('add_supports.ID_add_support', 'DESC')
			            ->first();
						
			return view('fichiers/support',['etat'=>$etat,'etats'=>$etats]);
	}
	
	
	public function getSupports() {
		
		    $etat = DB::table('support')
						->join('customers', 'support.ID_customer', '=', 'customers.ID_customer')
						->join('add_supports', 'support.ID_support', '=', 'add_supports.ID_support')
						->where ('support.traite_sup', '=', '0')
						->where ('add_supports.lus', '=', '0')
			            ->get();
						
						
			return view('fichiers/supports',['etat'=>$etat]);
	}
	
	public function getExecuted_support(int $id) {
		
		    $etat = DB::table('support')
						->where ('ID_support', '=', '$id')
			            ->first();
						
			date_default_timezone_set('UTC'); 
			$datecreation = date('Y-m-d H:i:s');		
			if (Session::has('logID')) {$user = Session::get('logID');}
		
		  DB::table('support')
					->where('ID_support', $id)
					->update(['date_traite' => $datecreation, 'ID_admin' => $user, 'traite_sup' => 1]);	
						
			return redirect()->action([PagesController::class, 'getSupport']);	
	}
	
	public function GetAll() {
		
		    $etat = DB::table('support')
						->orderBy('date_sup', 'desc')
			            ->get();
			return view('fichiers/all_support',['etat'=>$etat]);
			
	}
	
	public function postSuprep(Request $request,int $id)
    {
		
		
		date_default_timezone_set('UTC'); 
        $datecreation = date('Y-m-d H:i:s');
        if (Session::has('logID')) {$user = Session::get('logID');}		
			
		DB::table('add_supports')->insert([
			'ID_support' => $id, 
			'ID_admin' => $user,
			'date_add' => $datecreation,
			'text_add' => $request->contenu,
			'lus' => 1
		]);
			
		$last= DB::getPdo()->lastInsertId();
		if (isset($request->image))
		{
			$imageTempName = $request->file('image')->getPathname();
			$imageName = $request->file('image')->getClientOriginalName();
			$path = base_path() . '/public/img/support';
			$request->file('image')->move($path , $imageName);

			DB::table('add_supports')
			->where('ID_support', $last)
			->update(['image_add' => $imageName]);
		}	
			Session::flash('SupportOk', 'Votre reponse a été envoyé avec succès.');
		    return redirect()->action([PagesController::class, 'getSupport']);			
	}
	
	public function getReponse_support(int $id) {
		
		    $etat = DB::table('add_supports')
						->join('support', 'add_supports.ID_support', '=', 'support.ID_support')
						->join('customers', 'support.ID_customer', '=', 'customers.ID_customer')
						->where('add_supports.ID_support', '=',$id)
						->orderBy('add_supports.ID_add_support', 'DESC')
			            ->get();
			
					DB::table('add_supports')
						->where('ID_support', $id)
						->update(['lus' => 1 ]); 
						
			return view('fichiers/rp_support',['etat'=>$etat]);			
	}
	
	public function getRep_support(int $id) {
			
			
		    $etats = DB::table('support')
						->join('customers', 'support.ID_customer', '=', 'customers.ID_customer')
						->where('ID_support', '=',$id)
			            ->first();
						
		    $etat = DB::table('add_supports')
						->join('support', 'add_supports.ID_support', '=', 'support.ID_support')
						->join('customers', 'support.ID_customer', '=', 'customers.ID_customer')
						->where('add_supports.ID_support', '=',$id)
						->orderBy('add_supports.ID_add_support', 'DESC')
			            ->get();
						
			return view('fichiers/p_support',['etat'=>$etat,'etats'=>$etats]);			
	}
		
}
