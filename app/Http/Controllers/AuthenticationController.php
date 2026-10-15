<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    
	
	
	public function postlogin(Request $request) 
	{
	 
	 
	    date_default_timezone_set('UTC'); 
        $datecreation = now();
		
       
		$validatedData = $request->validate([
				  'identity' => 'required',
			      'pass' => 'required'
			]);
        
		
        //check	if consumer	 and admin
	    $check = DB::table('customers')
		       ->where('cpseudo', '=', $validatedData['identity'])
			   ->where('admin_check', '=', "1")
			   ->first();
			   
			 
			if(!empty($check))
			{
				if (Hash::check($validatedData['pass'], $check->cpass))
				{
					
					//redirection
					if (($check->cemailactived == 1) && ($check->cuseractive == 1)) 
					{ 
					Session::put('logID', $check->ID_customer);
					Session::put('logpseudo', $check->cpseudo);	
					Session::put('lognam', $check->cname);	
					Session::put('logprenam', $check->cprename);	
					Session::put('logactiv', $check->cuseractive);
					Session::put('loglevel', $check->admin_level);
					Session::put('deplevel', $check->dept_level);
                    //log in database
                    DB::table('connexiondairies')->insert(
                    ['connexion_status' => 1, 'connexion_date' => $datecreation, 'connexion_ip' => $_SERVER["REMOTE_ADDR"], 'ID_customer' => $check->ID_customer, 'connexion_platform' => "webadmin" ]
                    );
					
					
					DB::table('customers')
                        ->where('ID_customer', $check->ID_customer)
                        ->update(['clastconnected' => $datecreation]);
						
					if(($check->admin_level == "FULL") || ($check->admin_level == "FIN")) { return redirect()->action([PagesController::class, 'getLandingpage']); }
					if($check->admin_level == "SAL") { return redirect()->action([PagesController::class, 'getlisteproforma']); }
					
					}		
					
					
				    if (($check->cemailactived == 1) && ($check->cuseractive == 0)) 
				    {
					//log in database
                    DB::table('connexiondairies')->insert(
                    ['connexion_status' => 0, 'connexion_date' => $datecreation, 'connexion_ip' => $_SERVER["REMOTE_ADDR"], 'ID_customer' => $check->ID_customer, 'connexion_platform' => "webadmin" ]
                    );
					Session::flash('deactivatedmessage', 'vous avez été desactivé par l\'administrateur principal. Veuillez le contacter');
					return view('fichiers/login'); 	
				    }
					
			    }
				 
			    else 
			    { 
			      //log in database
			      DB::table('connexiondairies')->insert(
                    ['connexion_status' => 0, 'connexion_date' => $datecreation, 'connexion_ip' => $_SERVER["REMOTE_ADDR"], 'ID_customer' => $check->ID_customer, 'connexion_platform' => "webadmin" ]
                    );
				  Session::flash('mdpmessage', 'Identifiant ou Mot de passe incorrect.'); 
				  return view('fichiers/login'); 
				 
			    }

		    }
			
			else
			{
			
			return view('fichiers/login'); 
			}
	  
	  
    }
	
	
	
	
	public function getLogout()
	{
        Session::flush();
		Session::save();
		
		return redirect()->action([PagesController::class, 'getIndex']);
		
    }
	
	
	
	
	
	
	
	
	
	
	
	//
}
