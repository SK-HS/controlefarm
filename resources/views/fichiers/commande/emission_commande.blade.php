@extends('mainsales')

@section('pagename','| Emission Commande')

@section('content')

    <div class="container-fluid">

        
		
			<div class="card o-hidden border-0 shadow-lg my-5">
			  <div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
				  
				  <div class="col-lg-12">
					<div class="p-5">
					  <div class="text-center">
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">NOUVELLE PROFORMA</h1>
					  </div>
					  <form class="user" action="/newproforma" method="POST" >
					     {!! csrf_field() !!}
						 
						<div class="form-group">
									<label style="font-weight: bold; font-size: 14px; color:black"><b>CLIENT</b></label>
									<select name="typeclient" id="client" class="form-control" style="width: 100%;" required>
									<option disabled selected value>-- Choisir --</option>
									<option value="0">Nouveau Client</option>
									<option value="1">Client Existant</option>
									</select>
						</div>
						
					
							<div class="form-group" id="old" style="display: none;">
									<label style="color: black; font-weight: bold; font-size: 12px"> CLIENT EXISTANT </label>
									<select name="oldclient" class="form-control select2" style="width: 100%;">
									<option disabled selected value>-- Choisir --</option>
									@foreach($customers as $customer)
										<option data-tokens="{{$customer->cpseudo}}" value="{{$customer->ID_customer}}">{{$customer->cpseudo}} - {{$customer->cname}} {{$customer->cprename}}</option>
									@endforeach
									</select>
							</div>

							<div class="form-group" id="new" style="display: none;">
							  <label style="color: black; font-weight: bold; font-size: 12px"> NOUVEAU CLIENT </label>
								<input type="text" class="form-control " name="nameclient" placeholder="Nom et prénoms">
								<input type="text" class="form-control" name="telclient" placeholder="Téléphone">
								<input type="email" class="form-control" name="mailclient" placeholder="Email">
								<input type="text" class="form-control" name="addclient" placeholder="Adresse">
							</div>
							
						<div  class="form-group">
							<label style="font-weight: bold; font-size: 14px; color:black"><b>PRODUIT</b></label>
								@foreach($produits as $prod)
								<div class="i-checks"><label style="color:gray; font-size: 11px !important;"><input type="checkbox" id="" name="produitchoice[]"  value="{{$prod->ID_produit}}" > <i></i>{{ $prod->nom_produit  }}</label></div>
								@endforeach
						</div>
						
					
						<div class="form-group">
						  <input type="text" name="montant" class="form-control" placeholder="montant du TopUp" autocomplete="off" required>
						</div>
						
						
						
						<button class="btn btn-primary btn-user btn-block" id="login-form-submit" name="login-form-submit" value="login">Valider</button>
						<hr>
						
						
					  </form>
					 
					</div>
				  </div>
				</div>
			  </div>
			</div>
				  



        </div>
		
		
		
		

		
		
@endsection


@section('specificscript')
 
	<script type="text/javascript">
	
	    $("#client").change(function()
			{
			var clienttype =$(this).val();


				if(clienttype == '1')
				{
					document.getElementById("old").style.display='block';
					document.getElementById("new").style.display='none';
				}

				else if(clienttype == '0')
				{
				
					document.getElementById("new").style.display='block';
					document.getElementById("old").style.display='none';

				}

			});
	

	</script>

@endsection
 