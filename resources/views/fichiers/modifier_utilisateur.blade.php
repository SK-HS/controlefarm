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
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">MODIFIER UN UTILISATEUR</h1>
					  </div>
					  <form class="user" action="/moduser" method="POST" >
					     {!! csrf_field() !!}
						 
					       <input type="hidden" name="idcustomer" class="form-control" placeholder="" value="{{$customer->ID_customer}}">
						  
						  <div class="form-group">
						    <input type="text" name="" class="form-control" placeholder="" value="{{$customer->cpseudo}} - {{$customer->cname}} {{$customer->cprename}}" disabled>
						  </div>
							
							<div class="form-group" id="old">
									<label style="color: black; font-weight: bold; font-size: 12px"> Département </label>
									<select name="dept" class="form-control" style="width: 100%;" required>
									<option value="{{$customer->admin_level}}">@if($customer->admin_level == "FULL") SUPERADMIN @endif
									                                           @if($customer->admin_level == "FIN") EQUIPE FINANCE @endif
																			   @if($customer->admin_level == "SAL") EQUIPE VENTE @endif
																			   @if($customer->admin_level == "REL") EQUIPE COOMERCIALE @endif
																			   @if($customer->admin_level == "TRA") TRADING EQUIPE @endif
									                                           </option>
									<option value="FULL"> SUPERADMIN </option>
									<option value="FIN"> EQUIPE FINANCE </option>
									<option value="SAL"> EQUIPE VENTE </option>
									<option value="REL"> EQUIPE COMMERCIALE </option>
									<option value="TRA"> TRADING EQUIPE </option>
								
									</select>
							</div>
							
							<div class="form-group" id="old">
									<label style="color: black; font-weight: bold; font-size: 12px">Niveau </label>
									<select name="level" class="form-control" style="width: 100%;" required>
									<option value="{{$customer->dept_level}}">@if($customer->dept_level == 0) membre @endif
									                                           @if($customer->dept_level == 1) Chief Equipe @endif
																			   </option>
									<option value="0"> Membre </option>
									<option value="1"> Chief Equipe</option>
								
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
 