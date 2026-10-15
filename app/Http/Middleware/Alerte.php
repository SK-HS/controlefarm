<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Alerte
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
     public function handle($request, Closure $next)
    {
		date_default_timezone_set('UTC');
		$today = date('Y-m-d H:i:s');
		
		$notsup =0;
		$notsup = DB::table('support')
				->where('traite_sup', '=', 0)
			->count();
			
			view()->share('notsup', $notsup);	
			
		$notsup =0;
		$notsu = DB::table('add_supports')
				->where('lus', '=', 0)
			->count();
			
			view()->share('notsu', $notsu);			

		$fore = DB::table('customers')
				->count(); 
			view()->share('fore', $fore);	
				
		$customer = DB::table('customeraccounts')
				->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->where('customeraccounts.ID_forfait', '=', 1)
				->count();
			view()->share('notsu', $notsu);	
		
			view()->share('customer', $customer);	
			
		$bronze = DB::table('customeraccounts')
				->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->where('customeraccounts.ID_forfait', '=', 2)
				->count();
			view()->share('bronze', $bronze);	
				
		$silver = DB::table('customeraccounts')
				->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->where('customeraccounts.ID_forfait', '=', 3)
				->count();
			view()->share('silver', $silver);	
				
		$gold = DB::table('customeraccounts')
				->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->where('customeraccounts.ID_forfait', '=', 4)
				->count();
			view()->share('gold', $gold);	
				
		$diamond = DB::table('customeraccounts')
				->join('customers', 'customeraccounts.ID_customer', '=', 'customers.ID_customer')
				->join('forfaits', 'customeraccounts.ID_forfait', '=', 'forfaits.ID_forfait')
				->where('customeraccounts.ID_forfait', '=', 5)
				->count();	
			view()->share('diamond', $diamond);		
		
		$brocker = DB::table('withdrawal_request')
		            ->where('authorised_withdrawal', '=', 0)
		            ->where('treatment_withdrawal', '=', 1)
					->count();
			view()->share('brocker', $brocker);	
		
		$withpend = DB::table('withdrawal_request')
		            ->where('authorised_withdrawal', '=', 0)
		            ->where('treatment_withdrawal', '=', 0)
					->count();
			view()->share('withpend', $withpend);	
		
		$withstat = DB::table('withdrawal_request')
		            ->where('authorised_withdrawal', '=', 1)
					->count();
			view()->share('withstat', $withstat);	
		
		$scheda = DB::table('customermarque')
		        ->where('fin_souscription', '>=', $today)
				->count();	
			view()->share('scheda', $scheda);	
		
		$schedc = DB::table('customermarque')
		        ->where('fin_souscription', '<=', $today)
				->count();
			view()->share('schedc', $schedc);	
				
        return $next($request);
    }
}