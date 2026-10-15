@extends('main')

@section('pagename','| SUPPORTS')

@section('content')

    <div class="container-fluid">

		<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">INFORMATION SUPPORTS REQUESTS</h6>
            </div>
            <div class="card-body">
			
				
            <div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr align="center">
								<th>REFÉRENCE</th>
								<th>DATE</th>
								<th>PSEUDO</th>
								<th>Objet</th>
								<th>RÉQUÊTE</th>
								<th>PIÈCE JOINTE</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
					  
						<tbody>
							<tr align="center">
					   
								<td>{{ $etats->n_sup }}</td>
								<td>{{ date('Y-m-d H:i',strtotime($etats->date_sup)) }}</td>
								<td>{{ $etats->cpseudo }}</td>
								<td>{{ $etats->objet_sup }}</td>
								<td>{{ $etats->text_sup }}</td>
								<td>@if(isset($etats->pj_sup))<a href="/img/support/{{$etats->pj_sup}}" target="new">
									<img class="img-fluid" src="/img/support/{{$etats->pj_sup}}" width="30%">
									</a>@endif</td>
								<td><a href="/custinfo/{{ $etats->ID_customer }}" class="btn btn-warning btn-xs btn-user">Comptes info</a></td>
								<td><a href="/executed_support/{{ $etats->ID_support }}" class="btn btn-success btn-xs btn-user"> RÉQUÊTE EXECUTE</a></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
			
            <div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr align="center">
								  <th>DATE</th>
								  <th>RÉQUÊTE</th>
								  <th>PIÈCE JOINTE</th>
							</tr>
						</thead>
					  
						<tbody>
						@foreach($etat as $eta)
							<tr align="center">
					   
								<td>{{ date('Y-m-d H:i',strtotime($eta->date_add)) }}</td>
								<td>{{ $eta->text_add }}</td>
								<td>@if(isset($eta->image_add))<a href="/img/support/{{$eta->image_add}}" target="new">
									<img class="img-fluid" src="/img/support/{{$eta->image_add}}" width="30%" alt="Photo">
									</a>@endif
								</td>
							</tr>
						@endforeach
					  </tbody>
					</table>
				</div>
            </div>
        </div>
        </div>
		  
    </div>

		
		
@endsection