@extends('main')

@section('pagename','| TVA')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">TVA</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date</th>
					  <th>Motif</th>
					  <th>Montant TVA</th>
					  <th>Montant Forfait</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				   <?php $total = 0; $totalf = 0; ?>
				    @foreach($tva as $wit)
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->foperation_date)) }}</td>
					  <td>{{ $wit->foperation_description }}</td>
                      <td>{{ $wit->operation_amount - ($wit->operation_amount / 1.18) }}</td>
                      <td>{{ $wit->operation_amount / 1.18 }}</td>
                      
					</tr>
					  <?php $total = $total + ($wit->operation_amount - ($wit->operation_amount / 1.18)) ; $totalf = $totalf + ($wit->operation_amount / 1.18); ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>
		
		<div class="container-fluid" style="background-color: blue; color: white; font-size: 20px; padding: 10px;">
		 TOTAL TVA : {{ $total }}
		</div>
		
		<div class="container-fluid" style="background-color: orange; color: white; font-size: 20px; padding: 10px;">
		 TOTAL FORFAITS : {{ $totalf }}
		</div>

		
		
@endsection