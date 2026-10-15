@extends('main')

@section('pagename','| USERS')

@section('content')

    <div class="container-fluid">


      
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">USERS</h6>
            </div>
			
			
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Nom</th>
					  <th>Prénoms</th>
					  <th>Pseudo</th>
                      <th>Email</th>
                      <th>Téléphone</th>
                      <th>Localisation</th>
					  <th>Status</th>
					  <th></th>
					  <th></th>
                    </tr>
                  </thead>
                  
                  <tbody>
				    @foreach($info as $inf)
                    <tr>
                   
                     
                      <td>{{ $inf->cname }}</td>
					  <td>{{ $inf->cprename }}</td>
					  <td>{{ $inf->cpseudo }}</td>
					  <td>{{ $inf->cemail }}</td>
					  <td>{{ $inf->cphone }}</td>
					  <td>{{ $inf->country_name }}</td>
                      <td><center>
					        @if($inf->admin_check == 1) 
					        <a href="/deactive-customer/{{ $inf->ID_customer }}" class="btn btn-success btn-xs"><i class="fas fa-check"></i></a>
                            @else
						  <a href="/active-customer/{{ $inf->ID_customer }}" class="btn btn-danger btn-xs"><i class="fas fa-exclamation-triangle"></i></a>
                             @endif
					  </center></td>
					  <td><a href="/modifinfo/{{ $inf->ID_customer }}" class="btn btn-primary btn-xs btn-user"><i class="fas fa-edit"></i></a></td>
					 <td><a href="/supprimer-client/{{ $inf->ID_customer }}" id="#" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');" class="btn btn-danger btn-xs btn-user"><i class="fas fa-trash"></i></a></td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection