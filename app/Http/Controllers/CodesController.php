<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use DB;

class CodesController extends Controller
{
    
	
	
	public function getcodes() {
		
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
		
		$prod = null;
		$assigner = null;
		
		$codes= DB::table('activation_codes')
		            ->join('customers', 'activation_codes.admincreator_activationcodes', '=', 'customers.ID_customer')
		            ->get();
					
				foreach($codes as $c)
				{
					$p = DB::table('customers')
							 ->where('ID_customer', '=', $c->user_activationcodes)
							 ->first();
							 
					$a = DB::table('customers')
							 ->where('ID_customer', '=', $c->admin_assigner_activationcodes)
							 ->first();
							 
					if($p == null) { $prod[] = "-"; } else { $prod[] = $p->cpseudo ; }
					if($a == null) { $assigner[] = "-"; } else { $assigner[] = $a->cpseudo; }
							 
					
					
				}
					
			/* foreach($codes as $c)
				{
					$p = DB::table('produits')
							 ->where('ID_produit', '=', $c->ID_produit)
							 ->first();
							 
					if($p == null) { $prod[] = '-' ; } else { $prod[] = $p->nom_produit ; } 
				} */
			
		return view('fichiers/activationcodes')->withCodes($codes)->withProd($prod)->withAssigner($assigner); 
	
	}
	
	
	public function getcodesgen() {
		
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
		
		
		return view('fichiers/activationcodes_generation'); 
	
	}
	
	
	public function codesgeneration(Request $request)
    {
		
		//dd($request->input());
		//$dec = $this->my_simple( 'NXNtUzY2RkpWVGVhTkZZRHpQajdZZkJJSTAySitmYTgrV3VlTzJwU1MzOD0=', 'd' );
		
		$datecreation = date('Y/m/d H:i:s');
       
	   
			 //  for($i=1; $i<=$request->nbrcode; $i++ )
			 //   {
				  $code = rand(3000,7200)."-".$datecreation."-".Session::get('logID')."-".rand(1989,5200) ;
		          $squash_code = $this->my_simple( $code, 'e' );
                  $refcode = substr($squash_code, 0,10);

                  DB::table('activation_codes')->insert([
									   ['activationcodes' => $squash_code,
									   'ref_activationcodes' => $refcode,
									   'datecreation_activationcodes'  => $datecreation,
									   'admincreator_activationcodes' => Session::get('logID')]
													  ]);  
			 //   }
			
			
			
		return redirect()->action([CodesController::class, 'getcodes']);	
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
	
	
	
	public function getcodesassignmentpage($id) 
	{
		
		$customers = DB::table('customers')
		            ->select('ID_customer','cpseudo','cname','cprename')
		            ->get();
					
					
		Session::put('acticode', $id);			
					
		 return view('fichiers/assign_activationcode')->withCustomers($customers);
		 
	}
	
	
	public function codeassignation(Request $request)
    {
       
            date_default_timezone_set('UTC');
		    $enregistrement = date('Y-m-d H:i');
			
			$validatedData = $request->validate([
				  'client' => 'required',
				'montant' => 'required'
			]);

            
			
		    
			DB::table('activation_codes')
				->where('ID_activationcodes', Session::get('acticode'))
				->update(['montant_code' => $validatedData['montant'], 
				          'user_activationcodes' => $validatedData['client'],
						  'admin_assigner_activationcodes' => Session::get('logID'),
						  'assigned_activationcodes' => 1,
						  'date_assignement_activationcodes' => $enregistrement
						  
						 ]);	
			
		return redirect()->action([CodesController::class, 'getcodes']);	
			
	
    }
	
	
	
}
