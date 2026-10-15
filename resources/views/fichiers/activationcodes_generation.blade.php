@extends('main')

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
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">ACTIVATION CODES GENERATION</h1>
					  </div>
					  <form class="user" action="/codes_generation" method="POST">
					     {!! csrf_field() !!}
					  
					
					    <div class="form-group">
							<input type="text" class="form-control" style="color: #142a69"  value ="Nombre de Codes à Générer" disabled>	
						</div>
						<div class="form-group">
							<input type="text" class="form-control"  value="" placeholder="Nombre de codes" name="nbrcode">	
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