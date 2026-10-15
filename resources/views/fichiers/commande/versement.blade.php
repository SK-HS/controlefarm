@extends('mainsales')

@section('pagename','|Versement Commande')

@section('content')

    <div class="container-fluid">

        
		
			<div class="card o-hidden border-0 shadow-lg my-5">
			  <div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
				  <? $rap = 0;  ?>
				  <div class="col-lg-12">
					<div class="p-5">
					  <div class="text-center">
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">VERSEMENT PROFORMA</h1>
					  </div>
					  <form class="user" action="/newversement" method="POST" >
					     {!! csrf_field() !!}
						 
						<div class="form-group">
						  <input type="text" name="" class="form-control" placeholder="" value="{{ $proforma->no_commande}}" disabled>
						</div>
						
						<div class="form-group">
						  <input type="text" name="" class="form-control" placeholder="" value="Montant : {{ number_format($proformamontant, 0) }} XOF" disabled>
						</div>
						
						<div class="form-group">
						  <input type="text" name="" class="form-control" placeholder="" value="Acompte : {{ number_format($previous, 0) }} XOF" disabled>
						</div>
						
						<div class="form-group">
						   <?php  $rap = $proformamontant - $previous ; ?>
						  <input type="text" name="" class="form-control" placeholder="" style="color: red" value="Reste à Payer : {{ number_format($rap, 0) }} XOF" disabled>
						</div>
						
						<div class="form-group">
						  <input type="text" name="montant" class="form-control" placeholder="Montant versé" autocomplete="off" required>
						</div>
						
						
						<div class="form-group">
						  <input type="hidden" name="idcommande" class="form-control" value="{{ $proforma->ID_commande}}" >
						  <input type="hidden" name="mtncommande" class="form-control" value="{{ $proformamontant }}" >
						  <input type="hidden" name="accompte" class="form-control" value="{{ $previous }}" >
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
 