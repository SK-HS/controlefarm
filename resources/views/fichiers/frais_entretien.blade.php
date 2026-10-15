@extends('main')

@section('pagename','| FRAIS ENTRETIEN')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">FRAIS ENTRETIEN</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>REF</th> 
					  <th>Date</th>
					  <th>Client</th>
					  <th>Forfait</th>
					  <th>Monatnt Transaction</th>
                      <!--<th>Compte Transaction</th>-->
                      <!--<th>Type Transaction </th>-->
					  <th>Détails</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				 
				    @foreach($fraisentretien as $key=>$wit)
                    <tr>
                   
                      <td> {{++$key}}</td>
                      <td>{{ date('Y-m-d H:i',strtotime($wit->foperation_date)) }}</td>
					  <td>{{ $wit->cname }} {{ $wit->cprename }}</td>
					  <td>{{ $wit->forfait_name }}</td>
                      <td>{{ $wit->operation_amount }}</td>
                      <td>{{ $wit->foperation_description }}</td>
					  <!--<td>{{ $wit->account_denomination }}</td>-->
					  <!--<td>{{ $wit->foperation_type }}</td>-->
                      
					</tr>
				
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>
		
		<!--<div class="container-fluid" style="background-color: blue; color: white; font-size: 20px; padding: 10px;">-->
		 <!--TOTAL FRAIS :-->
		<!--</div>-->

		
		
@endsection