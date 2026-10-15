@extends('main')

@section('pagename','| FEES')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">FRAIS</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date</th>
					  <th>Montant Frais</th>
					  <th>Motif</th>
					  <th>Monatnt Transaction</th>
                      <th>Compte Transaction</th>
                      <th>Type Transaction </th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $total = 0; ?>
				    @foreach($fee as $wit)
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->date_fees)) }}</td>
					  <td>{{ $wit->montant_fees }}</td>
                      <td>{{ $wit->motif_fees }}</td>
                      <td>{{ $wit->operation_amount }}</td>
					  <td>{{ $wit->account_denomination }}</td>
					  <td>{{ $wit->foperation_type }}</td>
                      
					</tr>
					<?php $total = $total + $wit->montant_fees ; ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>
		
		<div class="container-fluid" style="background-color: blue; color: white; font-size: 20px; padding: 10px;">
		 TOTAL FRAIS : {{ $total }}
		</div>

		
		
@endsection