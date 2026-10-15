@extends('main')

@section('pagename','| CUSTOMERS')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">ACTIVATION CODES 
			  @if(Session::get('loglevel') == "FULL") &nbsp; <a href="/activationcodes_gen" class="btn btn-warning btn-xs btn-user">GENERATE CODES</a> @endif  
			  </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date Crée</th>
					  <th>Code</th>
                      <th>Générateur</th>
                      <th>Status</th>
					  <th>Montant (FCFA)</th>
					  <th>Date Assigné</th>
					  <th>Assigné à</th>
					  <th>Assigneur</th>
					  <th>Date d'utilisation</th>
					  <th></th>
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				    <?php $i=0; ?>
				    @foreach($codes as $inf)
                    <tr>
                      <td>{{ date('Y-m-d H:i',strtotime($inf->datecreation_activationcodes)) }} </td>
					  <td>{{ $inf->ref_activationcodes }}</td>
					  <td>{{ $inf->cpseudo }}</td>
					  <td>
					        @if($inf->assigned_activationcodes == 0)  <a href="#" class="btn btn-success btn-xs">Libre</a>  @endif
							@if($inf->assigned_activationcodes == 1)  <a href="#" class="btn btn-danger btn-xs">Utilisée</a>  @endif
					  </td>
					  <td>{{ $inf->montant_code }}</td>
					  <td>@if($inf->date_assignement_activationcodes != null) {{ date('Y-m-d H:i',strtotime($inf->date_assignement_activationcodes)) }} @endif</td>
					  <td>{{ $prod[$i] }}</td>
					  <td>{{ $assigner[$i] }}</td>
					  <td>@if($inf->dateusage_activationcodes != null){{ date('Y-m-d H:i',strtotime($inf->dateusage_activationcodes)) }} @endif</td>
					  <td>@if($inf->assigned_activationcodes == 0) <a href="/activationcodes_assign/{{$inf->ID_activationcodes}}" class="btn btn-success btn-xs btn-user">Assigner code</a> @endif</td>
                    </tr>
					 <?php $i++; ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection