@extends('main')

@section('pagename','| WITHDRAWAL STATEMENT')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des RETRAITS effectués</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date Demande</th>
					  <th>Date Exécutée</th>
                      <th> Date Envoi</th>
					  <th>Exécuteur</th>
					  <th>Envoyé à</th>
					  <th>Envoyer numéro</th>
                      <th>Montant demandé</th>
                      <th>Envoi référence</th>
                      <th>Montant envoyé</th>
					
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->date_withdrawal)) }}</td>
					  <td>{{ date('Y-m-d H:i',strtotime($wit->authorised_withdrawal_date)) }}</td>
					  <td>{{ date('Y-m-d',strtotime($wit->date_exact_amount_withdrawal)) }}</td>
                      <td>{{ $wit->cpseudo }}</td>
                      <td>
					        @if($wit->account_to_withdrawal == 1)  "Invest A"  @endif
							@if($wit->account_to_withdrawal == 2)  "Invest B"  @endif
							@if($wit->account_to_withdrawal == 3)  "Invest C"  @endif
							@if($wit->account_to_withdrawal == 4)  "Un membre"  @endif
							@if($wit->account_to_withdrawal == 5)  "Mobile Money"  @endif
							@if($wit->account_to_withdrawal == 6)  "Bitcoin" @endif
							@if($wit->account_to_withdrawal == 7)  "Bank" @endif
							@if($wit->account_to_withdrawal == 8)  Mastercard @endif
							@if($wit->account_to_withdrawal == 9)  Transfert à compte invest @endif
							@if($wit->account_to_withdrawal == 10)  Wave @endif
					  </td>
                      <td>{{ $wit->telephone_exact_amount_withdrawal }}</td>
                      <td>{{ $wit->amount_withdrawal }}</td>
					  <td>{{$wit->reference_exact_amount_withdrawal }}</td>
                      <td>{{ $wit->exact_amount_withdrawal }}</td>
                    </tr>
					
					
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection