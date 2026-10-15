@extends('mainsales')

@section('pagename','| UTILISATEUR')

@section('content')

    <div class="container-fluid">

        
		
			<div class="card o-hidden border-0 shadow-lg my-5">
			  <div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
				  
				  <div class="col-lg-12">
					<div class="p-5">
					  <div class="text-center">
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">AJOUTER UN UTILISATEUR</h1>
					  </div>
					  <form class="user" action="/newuser" method="POST" >
					     {!! csrf_field() !!}
						 
							<div class="form-group" id="old">
									<label style="color: black; font-weight: bold; font-size: 12px"> Choisir l'utilisateur </label>
									<select name="user" class="form-control select2" style="width: 100%;" required>
									<option disabled selected value>-- Choisir --</option>
									@foreach($customers as $customer)
										<option value="{{$customer->ID_customer}}">{{$customer->cpseudo}} - {{$customer->cname}} {{$customer->cprename}}</option>
									@endforeach
									</select>
							</div>
							
							<div class="form-group" id="old">
									<label style="color: black; font-weight: bold; font-size: 12px"> Choisir son département </label>
									<select name="dept" class="form-control" style="width: 100%;" required>
									<option disabled selected value>-- Choisir --</option>
									<option value="FULL"> SUPERADMIN </option>
									<option value="FIN"> FINANCE TEAM </option>
									<option value="SAL"> SALES TEAM </option>
									<option value="REL"> RELATION TEAM </option>
									<option value="TRA"> TRADING TEAM </option>
								
									</select>
							</div>
							
							<div class="form-group" id="old">
									<label style="color: black; font-weight: bold; font-size: 12px"> Choisir son niveau </label>
									<select name="level" class="form-control" style="width: 100%;" required>
									<option disabled selected value>-- Choisir --</option>
									<option value="0"> Team member </option>
									<option value="1"> Chief of team </option>
								
									</select>
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
 