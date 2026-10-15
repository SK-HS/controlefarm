@extends('main')

@section('pagename','| ALL SUPPORT')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des SUPPORTS</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
						  <th>DATE</th>
						  <th>REFÉRENCE</th>
						  <th>DATE VALIDATION</th>
						  <th>STATUT</th>
						  <th></th>
                    </tr>
                  </thead>
                  
                  <tbody>
				    @foreach($etat as $eta)
                    <tr align="center">
                   
                     <td>{{ date('Y-m-d H:i',strtotime($eta->date_sup)) }}</td>
                     <td><a href="/rep_support/{{ $eta->ID_support }}" target="new">{{ $eta->n_sup }}</a></td>
                     <td>
						  @if($eta->traite_sup == 1){{ date('Y-m-d H:i',strtotime($eta->date_traite)) }} @endif
						  @if($eta->traite_sup == 0) @endif
					  </td>
					  <td>
						  @if($eta->traite_sup == 1)  <a href="#" class="btn btn-success btn-xs"><i class="fas fa-check"></i></a>  @endif
						  @if($eta->traite_sup == 0)  <a href="#" class="btn btn-danger btn-xs"><i class="fas fa-exclamation-triangle"></i></a>  @endif
					 </td>
                     <td><a href="/custinfo/{{ $eta->ID_customer }}" class="btn btn-warning btn-xs btn-user">Comptes info</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection