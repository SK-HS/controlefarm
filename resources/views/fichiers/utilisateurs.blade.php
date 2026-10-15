@extends('main')

@section('pagename','| UTILISATEURS')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des Utilsateurs
			   &nbsp;&nbsp;<a href="/nouvelle_utilisateur" class="btn btn-info btn-xs" style="padding: 2px !important; font-size: 14px !important;">&nbsp;&nbsp; <i class="fa fa-plus"></i> &nbsp;&nbsp; </a>
			</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Departement</th>
					  <th>Level</th>
					  <th>Utilisateurs</th>
					  <th>Identifiant</th>
                     
					  
					  <th></th>
                    </tr>
                  </thead>
                  
                  <tbody>
				    @foreach($utilisateur as $wit)
                    <tr>
                      <td>
					        @if($wit->admin_level == "FULL")  SUPERADMIN  @endif
							@if($wit->admin_level == "FIN")  FINANCE TEAM @endif
							@if($wit->admin_level == "SAL")  SALES TEAM  @endif
							@if($wit->admin_level == "REL")  RELATION TEAM  @endif
							@if($wit->admin_level == "TRA")  TRADING TEAM  @endif
							
					  </td>
                      <td>
					        @if($wit->dept_level == 0)  Team member  @endif
							@if($wit->dept_level == 1)  Chief of team @endif
					  </td>
					  <td>{{ $wit->cname }} {{ $wit->cprename }}</td>
                      <td>{{ $wit->cpseudo }}</td>
					  <td><a href="/modifuser/{{ $wit->ID_customer }}" class="btn btn-warning btn-xs btn-user">modifier</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection