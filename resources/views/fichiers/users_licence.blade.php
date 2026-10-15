@extends('main')

@section('pagename','| USERS LICENCE')

@section('content')

    <div class="container-fluid">

    

      
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">USERS</h6>
            </div>
			
			
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
					        @if($inf->cuseractive == 1)  <a href="#" class="btn btn-success btn-xs"><i class="fas fa-check"></i></a>  @endif
							@if($inf->cuseractive == 0)  <a href="#" class="btn btn-danger btn-xs"><i class="fas fa-exclamation-triangle"></i></a>  @endif
					  </center></td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection