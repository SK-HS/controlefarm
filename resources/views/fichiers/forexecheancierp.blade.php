@extends('main')

@section('pagename','| Echeanciers FOREXTRIP')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">ÉCHEANCIERS FOREXTRIP INVALIDE</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th> Date Début</th>
					  <th> Date Fin</th>
					  <th>Client</th>
					  <th>Montant</th>
					  <th>Profit Jour</th>
					  <th>Total profit</th>
					  <th>Retout Capital</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				   <?php $total = 0; ?>
				    @foreach($info as $wit)
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->debut_souscription)) }}</td>
					  <td>{{ date('Y-m-d H:i',strtotime($wit->fin_souscription)) }}</td>
                      <td>{{ $wit->cpseudo }}</td>
                      <td>{{ $wit->customermarque_amount }}</td>
					  <td>{{ number_format($wit->expected_dailyprofit,2,","," ") }}</td>
                      <td>{{ number_format($wit->expected_dailyprofit * 300,2,","," ") }}</td>
                      <td>{{ number_format($wit->retourcapital,2,","," ") }}</td>
					  
					  </tr>
					  
					  <?php $total = $total + $wit->customermarque_amount; ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		<div class="container-fluid" style="background-color: blue; color: white; font-size: 20px; padding: 10px;">
		 TOTAL Capitalisation INVALIDE: {{ $total }}
		</div>


        </div>
		
		
		

		
		
@endsection