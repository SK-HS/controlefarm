@extends('main')

@section('pagename','| WITHDRAWAL STATEMENT')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Détail RETRAIT effectué</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date d'exécution</th>
					  <th>Client</th>
					  <th>Envoyé</th>
                      <th>Montant demandé</th>
					
                    </tr>
                  </thead>
                  
                  <tbody>
					
					
					@foreach($transfer as $wit1)
                    <tr>
                   
					  <td>{{ date('Y-m-d H:i',strtotime($wit1->foperation_date)) }}</td>
                      <td>{{ $wit1->cpseudo }}</td>
                      <td>{{ $wit1->foperation_description }} </td>
                      <td>{{ $wit1->operation_amount }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection