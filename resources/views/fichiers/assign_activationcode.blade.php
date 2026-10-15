@extends('main')

@section('pagename','| ACTIVATION CODE')

@section('content')

    <div class="container-fluid">

        
		
			<div class="card o-hidden border-0 shadow-lg my-5">
			  <div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
				  
				  <div class="col-lg-12">
					<div class="p-5">
					  <div class="text-center">
						<h1 class="h4 text-gray-900 mb-4" style="font-size: 14px !important; font-weight: bold;">ATTRIBUER UN CODE D'ACTIVATION À UN CLIENT</h1>
					  </div>
					  <form class="user" action="/assigncode" method="POST" >
					     {!! csrf_field() !!}
						 
						
					
						<div class="form-group">
								<label style="color: black; font-weight: bold; font-size: 12px"> CLIENT </label>
								<select name="client" class="form-control select2" style="width: 100%;">
								<option disabled selected value>-- Choisir --</option>
								@foreach($customers as $customer)
									<option data-tokens="{{$customer->cpseudo}}" value="{{$customer->ID_customer}}">{{$customer->cpseudo}} - {{$customer->cname}} {{$customer->cprename}}</option>
								@endforeach
								</select>
						</div>

						<div class="form-group">
						  <input type="text" name="montant" class="form-control" placeholder="montant du code (en FCFA)" autocomplete="off" required>
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
 