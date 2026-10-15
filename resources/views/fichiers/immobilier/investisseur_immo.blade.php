@extends('main')

@section('pagename','| INVESTISSEUR IMMOBILIER')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des investisseurs immobilier</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
                      <th>INVESTISSEUR</th>
                      <th>FORFAIT</th>
                      <th>SOLDE </th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  @foreach($investisseurs as $historiq)
                    <tr>
                    <td>{{ $historiq->cname }} {{ $historiq->cprename }}</td> 
                      <td>{{ $historiq->forfait_name }}</td>
                      <td>   {{number_format($historiq->comte_immo,0,",",".")}} XOF</td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection