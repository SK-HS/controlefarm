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
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">MODIFIER PROFORMA</h1>
					  </div>
					  <form class="user" action="/modifiproforma" method="POST" >
					     {!! csrf_field() !!}
						 
						 <input type="hidden" name="idcommande" class="form-control" placeholder="" value="{{$comm->ID_commande}}">
						 
						 @if($cust == null)
						
							<div class="form-group">
							  <label style="color: black; font-weight: bold; font-size: 12px"> NOUVEAU CLIENT </label>
								<input type="text" class="form-control " name="nameclient" placeholder="Nom et prénoms" value="{{$comm->pname}}">
								<input type="text" class="form-control" name="telclient" placeholder="Téléphone" value="{{$comm->pphone}}">
								<input type="email" class="form-control" name="mailclient" placeholder="Email" value="{{$comm->pemail}}">
								<input type="text" class="form-control" name="addclient" placeholder="Adresse" value="{{$comm->padress}}">
							</div>
						@else
							
						<div class="form-group">
						  <input type="text" name="" class="form-control" placeholder="" value="{{ $cust->cname }} {{ $cust->cprename }}" disabled>
						</div>
						
						@endif

			  	
						<div  class="form-group">
							<label style="font-weight: bold; font-size: 14px; color:black"><b>PRODUIT</b></label>
								@foreach($produits as $prod)
								<div class="i-checks"><label style="color:gray; font-size: 11px !important;"><input type="checkbox" id="" name="produitchoice[]"  value="{{$prod->ID_produit}}" > <i></i>{{ $prod->nom_produit  }}</label></div>
								@endforeach
						</div>
						
					
						<div class="form-group">
						<label style="font-weight: bold; font-size: 14px; color:black">MONTANT TOPUP</label>
						  <input type="text" name="montant" class="form-control" placeholder="montant du TopUp" autocomplete="off" value="{{$detcommtopup->montant_detailcommande}}" required>
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
 