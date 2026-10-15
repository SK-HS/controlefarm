<?php

namespace App\Http\Controllers;

use App\customer;
use App\paymentdone;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		 $info = DB::table('customers')
				// ->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				// ->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->join('countries', 'customers.ccountry', '=', 'countries.ID_country')
				->get();
				
        
		 $forfait = DB::table('forfaits')
				->get();
				
		 
		
		return view('fichiers/customer',['info'=>$info,'forfait'=>$forfait]); 
		  
    }
	
	
    public function Bylicence()
    {
		$forfait = DB::table('forfaits')
				->get();
				
		 
		return view('fichiers/bylicence',['forfait'=>$forfait]); 
		  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //get all countries interval
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
		
		
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
       
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }
	
	public function getUserslicence(int $id)
    {
		
		$info = DB::table('customeraccounts')
				->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->join('countries', 'customers.ccountry', '=', 'countries.ID_country')
				->where('customeraccounts.ID_forfait', '=', $id)
				->get();
				
				
			return view('fichiers/users_licence',['info'=>$info]); 
	}
	
	public function getCustomerpaymentinfo(int $id)
    {
		
		$info = DB::table('customers')
				->where('customers.ID_customer', '=', $id)
				->first();
				
			return view('fichiers/custpayinfo',['info'=>$info]); 
	}
	
	public function getCustomermodificationinfo(int $id)
    {
		
		$info = DB::table('customers')
				->where('customers.ID_customer', '=', $id)
				->first();
				
		$topups = DB::table('customers')
				->join('paymentdones', 'customers.ID_customer', '=', 'paymentdones.ID_customer')
				->where('customers.ID_customer', '=', $id)
				->get();
				
		$licences = DB::table('customeraccounts')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->where('customeraccounts.ID_customer', '=', $id)
				->get();
				
			return view('fichiers/custmodifinfo',['info'=>$info,'licences'=>$licences,'topups'=>$topups]); 
	}	
	
	
	
	    public function update(Request $request, int $id)
    {
		$datecreation = date('Y-m-d H:i:s');
		
				DB::table('customers')
						->where('ID_customer', $id)
						->update(['cname' => $request->cnam, 
								  'cprename' => $request->cprenam, 
						          'cphone' => $request->cphon, 
								  'cemail' => $request->cemai, 
								  'mobilemoney' => $request->mobilemone, 
								  'bitcoin' => $request->bitcoi,
								  'bank_name' => $request->bank_nam,
								  'cadress' => $request->adre,
								  'ayantdroit1' => $request->ayd1,
								  'ayantdroit2' => $request->ayd2,
								  'cidentity' => $request->iden, 
								  
								  ]);  
				
				
				if($request->bankim != null)
					{
					$imageTempName3 = $request->file('bankim')->getPathname();
					$imageName3 = $request->file('bankim')->getClientOriginalName();
					$path3 = base_path() . 'profilephotos/';
					//$path3 = ..\..\'boasonprofilephotos/';
					$request->file('bankim')->move($path3 , $imageName3);
					
					DB::table('customers')
							->where('ID_customer', $id)
							->update(['bank' => $imageName3 ]); 
				}
					
					
				DB::table('noperation')->insert([
							   ['ID_customer' => $id,
							   'ID_admin' => Session::get('logID'),
							   'noperation_type'  => 'MODIFICATION',
							   'noperation_date' => $datecreation,
							   'noperation_description' => 'modification of personal info'
								]]);	
											
											
			
		
		return redirect()->action([CustomerController::class, 'index']);	
		        
			
		   
    }
    
    	public function getsupprimerclient(int $id)
	{
			DB::table('customeraccounts')
			->where('ID_customer', $id)
			->delete(); 

			DB::table('customers')
			->where('ID_customer', $id)
			->delete(); 

            Session::flash('message', 'Le client a été supprimé avec succès'); 

			return redirect()->back();
	}
	
		public function gethistoriqimmo()
    {
        
		$historiques = DB::table('foperation')
		->join('customeraccounts', 'customeraccounts.ID_account', '=', 'foperation.ID_account')
		 ->join('forfaits', 'forfaits.ID_forfait', '=', 'customeraccounts.ID_forfait')
		 ->join('customers', 'customers.ID_customer', '=', 'customeraccounts.ID_customer')
		->where('account_denomination', '=', "IMMOBILIER")
		->orderBy('ID_foperation', 'desc')
		->get();	
		
		return view('fichiers/immobilier/historique_immo',['historiques'=>$historiques]); 
		
    }
    
    	public function getclientsimmo()
    {
        
			$investisseurs = DB::table('customeraccounts')
						->join('customers', 'customers.ID_customer', '=', 'customeraccounts.ID_customer')
						->join('forfaits', 'forfaits.ID_forfait', '=', 'customeraccounts.ID_forfait')
						->where('customeraccounts.comte_immo', '!=', 0)
						->orderBy('customeraccounts.ID_account', 'desc')
						->get();	
		
		return view('fichiers/immobilier/investisseur_immo',['investisseurs'=>$investisseurs]); 
		
    }
	
	
	
}
