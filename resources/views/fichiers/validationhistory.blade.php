@extends('main')

@section('pagename','| VALIDATION HISTORY')

@section('content')

    <div class="container-fluid">

        
		
		<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Historique des TOP-UP</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Paiement Date</th>
                      <th>Paiement methode</th>
                      <th>Paiement Code</th>
                      <th>Montant Paiement</th>
                      <th>Validation Admin</th>
					  <th>Validation date</th>
					  <th>Status </th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  @foreach($pays as $pay)
                    <tr>
                    <!--   <td>{{ $pay->ID_customer }}</td> -->
					  <td>{{ date('Y-m-d',strtotime($pay->paymentdone_date)) }}</td>
                      <td>{{ $pay->paymentmethod_name }}</td>
                      <td>{{ $pay->payment_code }}</td>
                      <td>{{ $pay->paymentdone_amount }}</td>
                      <td>{{ $pay->cpseudo }}  </td>
					  <td>{{ date('Y-m-d',strtotime($pay->paymentdone_verified_date)) }}</td>
					  <td> @if($pay->paymentdone_verified == 1) <a href="#" class="btn btn-success btn-xs btn-user btn-block"> Validé</a> @endif
					       @if($pay->paymentdone_declined == 1) <a href="#" class="btn btn-danger btn-xs btn-user btn-block"> Décliné</a> @endif
					  </td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
        </div>
		  
		  
		<div class="col-xl-12 col-md-6 mb-4">
               <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <center><div class="h4 mb-0 font-weight-bold " style="color: blue"> Total : <strong style="color: red">${{number_format($withsomme,2,","," ")}} </strong></div></center>
                    </div>
                  </div>
                </div>
              </div>
        </div>



        </div>

		
		
@endsection