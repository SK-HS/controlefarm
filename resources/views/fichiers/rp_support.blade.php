@extends('main')

@section('pagename','| SUPPORTS')

@section('content')

    <div class="container-fluid">

		<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des SUPPORTS REQUESTS en attente</h6>
            </div>
            <div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr align="center">
								 <th>REFÉRENCE</th>
								 <th>PSEUDO</th>
								  <th>DATE</th>
								  <th>Objet</th>
								  <th>RÉQUÊTE</th>
								  <th>PIÈCE JOINTE</th>
								  <th>REPONDRE</th>
								  <th></th>
								  <th></th>
							</tr>
						</thead>
					  
						<tbody>
						@foreach($etat as $eta)
							<tr align="center">
					   
								<td>{{ $eta->n_sup }}</td>
								<td>
									@if(!isset($eta->ID_customer)) BOASONCC @endif
									@if(isset($eta->ID_customer)) {{ $eta->cpseudo }} @endif
								</td>
								<td>{{ date('Y-m-d H:i',strtotime($eta->date_add)) }}</td>
								<td>{{ $eta->objet_sup }}</td>
								<td>{{ $eta->text_add }}</td>
								<td>@if(isset($eta->image_add))<a href="/img/support/{{$eta->image_add}}" target="new">
									<img class="img-fluid" src="/img/support/{{$eta->image_add}}" width="30%" alt="Photo">
									</a>@endif
								</td>
								<td>
													  
									<div class="card-body" style="width: 100px">
										<button class="btn btn-primary btn-block " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-edit"></i> </button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<form class="form-horizontal col-sm-12" method="POST" action="/rp_sup/{{$eta->ID_support}}" enctype="multipart/form-data">
													{!! csrf_field() !!}
												<label>Réponse</label>
												<textarea type="text"  name="contenu" class="form-control" style="height: 100px"></textarea>
												<div class="form-group">
												<label>Charger image </label>
												<input type="file"  name="image" class="form-control">
												</div>
												  <p></p>
												<div class="form-group col-sm-12 ">
												<button type="submit" class="btn btn-danger">ENVOYER</button>

												</div>
											</form>
										</div>
									</div>
								</td>
								<td><a href="/custinfo/{{ $eta->ID_customer }}" class="btn btn-warning btn-xs btn-user">Comptes info</a></td>
								<td><a href="/executed_support/{{ $eta->ID_support }}" class="btn btn-success btn-xs btn-user"> RÉQUÊTE EXECUTE</a></td>
							</tr>
						@endforeach
					  </tbody>
					</table>
				</div>
            </div>
        </div>
		  
    </div>

		
		
@endsection