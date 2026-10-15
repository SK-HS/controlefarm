@extends('main')

@section('pagename','| CUSTOMER INFOS')

@section('content')


	<form class="form-horizontal col-sm-12" method="POST" action="/update/{{$inf->ID_customer}}" enctype="multipart/form-data">
	{!! csrf_field() !!} 
     <div class="container-fluid">

          <!-- Page Heading -->
          <center><h1 class="h3 mb-1 text-gray-800">Informations Client</h1></center>
          
          <!-- Content Row -->
          <div class="row">

            <!-- First Column -->
            <div class="col-lg-3">

              <!-- Custom Text Color Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">BIO</h6>
                </div>
                <div class="card-body">
				 <div class="p-3 bg-gray-100">
				  Nom
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="cnam" @if($inf->cname != null) value="{{ $inf->cname}}" @else  placeholder="cname" @endif>
							
				  </div>
				 <div class="p-3 bg-gray-200">
				  Prénom(s)
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="cprenam" @if($inf->cprename != null) value="{{ $inf->cprename}}" @else  placeholder="cprename" @endif>
				 </div>
				 <div class="p-3 bg-gray-100">
				  N° Identité
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="iden" @if($inf->cidentity != null) value="{{ $inf->cidentity}}" @else  placeholder="cidentity" @endif>
				 </div>
				 <div class="p-3 bg-gray-100">
				  Email
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="cemai" @if($inf->cemail != null) value="{{ $inf->cemail}}" @else  placeholder="cemail" @endif>
				 </div>
				 <div class="p-3 bg-gray-200">
				  Téléphone
					<input type="number_format" class="form-control form-control-user" id="exampleInputPassword" name="cphon" @if($inf->cphone != null) value="{{ $inf->cphone}}" @else  placeholder="cphone" @endif>
				 </div>
				 <div class="p-3 bg-gray-100">
				  Détails Adresse
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="adre" @if($inf->cadress != null) value="{{ $inf->cadress}}" @else  placeholder="cadress" @endif>
				 </div>
				 <div class="p-3 bg-gray-200">
				  Ayant Droit 1
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="ayd1" @if($inf->ayantdroit1 != null) value="{{ $inf->ayantdroit1}}" @else  placeholder="ayantdroit1" @endif>
				 </div>
				 <div class="p-3 bg-gray-100">
				  Ayant Droit 2
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="ayd2" @if($inf->ayantdroit2 != null) value="{{ $inf->ayantdroit2}}" @else  placeholder="ayantdroit2" @endif>
				 </div>
				   
                </div>
              </div>

              <!-- Custom Font Size Utilities -->
             

            </div>

            <!-- Second Column -->
            <div class="col-lg-3">

              <!-- Background Gradient Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">BANK</h6>
                </div>
                <div class="card-body">
				
				 <div class="p-3 bg-gray-200">
				  
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="bank_nam" @if($inf->bank_name != null) value="{{ $inf->bank_name}}" @else  placeholder="bank_name" @endif>
				 </div>
                  <div class="p-3 bg-gray-100"> @if ($inf->bank != null) <a  style="font-size: 10px;" href="https://application.efarm-ci.com/images/pj/{{ $inf->bank }}" target="new">Consulter RIB Bancaire </a> @endif</div>
				 <div class="p-3 bg-gray-200">
				 Nouveau RIB
					<input type="file" class="form-control form-control-user" id="exampleInputPassword" name="bankim" @if($inf->bank != null) value="{{ $inf->bank}}" @else  placeholder="bank" @endif>
				 </div>
                </div>
              </div>

			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">MOBILE MONEY</h6>
                </div>
				 <div class="p-3 bg-gray-100">
					<input type="number_format" class="form-control form-control-user" id="exampleInputPassword" name="mobilemone" @if($inf->mobilemoney != null) value="{{ $inf->mobilemoney}}" @else  placeholder="mobilemoney" @endif>
				 </div>
            </div>
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">WAVE</h6>
                </div>
				 <div class="p-3 bg-gray-100">
					<input type="number_format" class="form-control form-control-user" id="exampleInputPassword" name="wave" @if($inf->wave != null) value="{{ $inf->wave}}" @else  placeholder="Wave" @endif>
				 </div>
            </div>
			<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">PayPal</h6>
                </div>
				 <div class="p-3 bg-gray-100">
					<input type="number_format" class="form-control form-control-user" id="exampleInputPassword" name="paypal" @if($inf->paypal != null) value="{{ $inf->paypal}}" @else  placeholder="PayPal" @endif>
				 </div>
            </div>
			  
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">BITCOIN</h6>
                </div>
				 <div class="p-3 bg-gray-100">
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="bitcoi" @if($inf->bitcoin != null) value="{{ $inf->bitcoin}}" @else  placeholder="bitcoin" @endif>
				 </div>
              </div>
			  
            </div>

            <!-- Third Column -->
            <div class="col-lg-3">

              <!-- Grayscale Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-warning">TOP-UPS</h6>
                </div>
				
				@foreach($topups as $topup)
				 <div class="p-3 bg-gray-100">
					<input type="text" class="form-control form-control-user" id="exampleInputPassword" name="bitcoi"  placeholder="{{$topup->paymentdone_amount}}" disabled>
				 </div>
				@endforeach 
              </div>
            </div>
            
           <div class="col-lg-3">

              <!-- Grayscale Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-warning">LICENCES</h6>
                </div>
				
				<div class="table-responsive">
                <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
                      <th>LICENCE</th>
                      <th>PRIX </th>
                      <th>PROFIT</th>
                      <th>COMPTE BALANCE</th>
                      <th>COMPTE COURANT</th>
                      <th>PRIME</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				    @foreach($licences as $licence)
                    <tr>
                   
                     
                     <td>{{ $licence->forfait_name }}</td>
                     <td>{{ $licence->forfait_amount }}</td>
                     <td>{{ $licence->profit_account }}</td>
                     <td>{{ $licence->balance_account }}</td>
                     <td>{{ $licence->courant_account }}</td>
                     <td>{{ $licence->prime_account }}</td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
            </div>

				<button class="btn btn-primary btn-user btn-block" id="login-form-submit" name="login-form-submit">Valider</button>
				<hr>
						
          </div>

        </div>

	</form>		
		
@endsection