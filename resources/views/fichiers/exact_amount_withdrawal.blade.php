@extends('main')

@section('pagename','| EXACT AMOUNT')

@section('content')


	<form class="form-horizontal col-sm-12" method="POST" action="/executed/{{ $with->ID_withdrawal }}" enctype="multipart/form-data">
	{!! csrf_field() !!} 
     <div class="container-fluid">

          <!-- Page Heading -->
          <center><h1 class="h3 mb-1 text-gray-800 text-success">EXACT AMOUNT</h1></center>
          
          <!-- Content Row -->
          <div class="row">


            <!-- Third Column -->
            <div class="col-lg-2">

              <!-- Grayscale Utilities -->
              
            </div>
			
			<div class="col-lg-8">

              <div class="card shadow mb-4">
				<div class="p-3 bg-gray-100">
					<label>Mode de paiement</label><br>
					<select class="form-control" name="mode"  data-parsley-required>
						<option></option>
						<option value="Bank">Bank</option>
						<option value="Bitcoin">Bitcoin</option>
						<option value="Mobile Money">Mobile Money</option>
						<option value="Wave">Wave</option>
					</select>
				</div>
				 <div class="p-3 bg-gray-200">
				 <label>N° Compte</label>
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="numero">
				 </div>
				 <div class="p-3 bg-gray-100">
				 <label>Montant</label>
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="montant">
				 </div>
				 <div class="p-3 bg-gray-200">
				 <label>Réference</label>
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="reference">
				 </div>
				 <div class="p-3 bg-gray-100">
				 <label>Date d'envoi</label>
					<input type="date" class="form-control form-control-user" id="exampleInputPassword" name="date_envoi">
				 </div>
              </div>
				<button class="btn btn-primary btn-user btn-block" id="login-form-submit" name="login-form-submit">Valider</button>
				<hr>
            </div>

						
          </div>

        </div>

	</form>		
		
@endsection