@extends('main')

@section('pagename','| HISTORIQUE IMMOBILIER')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des rechargements immobilier</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
                      <th>Client</th>
                      <th>Forfait</th>
                      <th>Date</th>
                      <th>DÉSIGNATION</th>
                      <th>MONTANT </th>
                      <th>SOLDE </th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  @foreach($historiques as $historiq)
                    <tr>
                    <td>{{ $historiq->cname }} {{ $historiq->cprename }}</td> 
                      <td>{{ $historiq->forfait_name }}</td>
                      <td>{{ date('d-m-Y H:i',strtotime($historiq->foperation_date)) }}</td>
                      <td>{{$historiq->foperation_description}}</td>
                      <td>{{number_format($historiq->operation_amount,0,",",".")}} XOF</td>
                      <td>   {{number_format($historiq->new_solde,0,",",".")}} XOF</td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection