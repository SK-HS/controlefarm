@extends('main')

@section('pagename','| WITHDRAWAL SENT TO BROKER')

@section('content')

    <div class="container-fluid">

        

			<section class="content">
			  <div class="container-fluid">
				<div class="row">
				  <div class="col-md-1"></div>
				  <div class="col-md-5 col-sm-6">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
					  <div class="card-body box-profile">

					 <form method="POST" action="/report_treatment_select" role="form">
					 {!! csrf_field() !!}
					 <div class="row">
							<div class="col-md-10 offset-md-1">
								<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
									  <label>Type d'opération</label>
									  <select class="form-control select2bs4" style="width: 100%;" name="operation">
										<option selected="selected"></option>
										<option value="1">Invest A</option>
										<option value="2">Invest B</option>
										<option value="3">Invest C</option>
										<option value="4">Un membre</option>
										<option value="6">Bitcoin</option>
										<option value="6">Bitcoin</option>
										<option value="5">Mobile Money</option>
										<option value="7">Bank</option>
										<option value="8">Mastercard</option>
										<option value="9">Transfert à compte invest</option>
										<option value="10">Wave</option>
										<option value="11">PayPal</option>
									  </select>
									</div>
								</div>
								<div class="col-sm-4"> 
										<label>&nbsp;</label>
										<button class="btn btn-primary btn-user btn-block"  id="login-form-submit">Recherche</button>
								</div>
								</div>
							</div>
						</div>
						</form>
					  </div>
					  <!-- /.card-body -->
					</div>
					<!-- /.card -->

					<!-- About Me Box -->
					<!-- /.card -->
				  </div>
				<div class="col-5">
				
					<div class="card card-primary card-outline ">
				 
					  <!-- /.card-header -->
					  <div class="card-body">
						<div class="col-sm12"> 
						<div class="col-sm12"> 
					 <form method="POST" action="/treatment_select_date" role="form">
					 {!! csrf_field() !!}
					 <div class="row">
							<div class="col-md-10 offset-md-1">
								<div class="row">
								<div class="col-sm-4">
								 <div class="form-group">
								 <label>Début</label>
								 <input type="date" class="form-control pull-right" name="deb">
								 </div>
								</div>
								<div class="col-sm-4"> 
										<div class="form-group">
										 <label>Fin</label>
										<input type="date" class="form-control pull-right" name="fin" >
										</div>
								</div>
								<div class="col-sm-4"> 
										<label>&nbsp;</label>
										<button class="btn btn-primary btn-user btn-block"  id="login-form-submit">Recherche</button>
								</div>
								</div>
							</div>
						</div>
						
				 </form>
				 </div>
				 </div>
					</div>
				  </div>
				</div>
			  </div>
			</section>
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DEMANDES DE RETRAIT envoyées par courtier</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date</th>
					  <th>Utilisateur</th>
					  <th>Opérateur</th>
                      <th>Montant</th>
                      <th>Frais</th>
					  <th>Paiement</th>
					  <th>XOF Paiement</th>
                      <th>Compte</th>
					  <th></th>
					  <!--<th></th>-->
                    </tr>
                  </thead>
                  <?php $i = 0; ?>
                  <tbody>
				    @foreach($with as $wit)
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->date_withdrawal)) }}</td>
                      <td>{{ $wit->cpseudo }}</td>
                      <td>
					         @if($wit->account_to_withdrawal == 1)  "Invest A"  @endif
							@if($wit->account_to_withdrawal == 2)  "Invest B"  @endif
							@if($wit->account_to_withdrawal == 3)  "Invest C"  @endif
							@if($wit->account_to_withdrawal == 4)  "Un membre"  @endif
							@if($wit->account_to_withdrawal == 5)  "Mobile Money"  @endif
							@if($wit->account_to_withdrawal == 6)  "Bitcoin" @endif
							@if($wit->account_to_withdrawal == 7)  "Bank" @endif
							@if($wit->account_to_withdrawal == 8)  Mastercard @endif
							@if($wit->account_to_withdrawal == 9)  Transfert à compte invest @endif
							@if($wit->account_to_withdrawal == 10)  Wave @endif
							@if($wit->account_to_withdrawal == 11)  PayPal @endif
					  </td>
                      <td>{{ $wit->amount_withdrawal }}</td>
                      <td>{{ $wit->withdrawal_fees }}</td>
					  <td>{{ $wit->amount_withdrawal - $wit->withdrawal_fees }}</td>
					  <td>{{ floor((($wit->amount_withdrawal - $wit->withdrawal_fees) * 550) / 5) * 5  }}</td>
					  <td>
					  
							 @if($wit->account_to_withdrawal == 1)  "Invest A"  @endif
							@if($wit->account_to_withdrawal == 2)  "Invest B"  @endif
							@if($wit->account_to_withdrawal == 3)  "Invest C"  @endif
							@if($wit->account_to_withdrawal == 4)  "Un membre"  @endif
							@if($wit->account_to_withdrawal == 5)  "Mobile Money"  @endif
							@if($wit->account_to_withdrawal == 6)  "Bitcoin" @endif
							@if($wit->account_to_withdrawal == 7)  "Bank" @endif
							@if($wit->account_to_withdrawal == 8)  Mastercard @endif
							@if($wit->account_to_withdrawal == 9)  Transfert à compte invest @endif
							@if($wit->account_to_withdrawal == 10)  Wave @endif
							@if($wit->account_to_withdrawal == 11)  PayPal @endif
					  </td>
					  <!--<td><a href="" class="btn btn-danger btn-xs btn-user"> Denied by Broker</td>-->
                      <td><a href="/exact_amount/{{ $wit->ID_withdrawal }}" class="btn btn-success btn-xs btn-user"> Confirmer le paiement
					  </a></td>
                    </tr>
					 <?php $tot = $tot + ($wit->amount_withdrawal - $wit->withdrawal_fees) ;   $i++;  ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		
		     <div class="card shadow mb-4" hidden>
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DEMANDES DE RETRAIT envoyées aux personnesr</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date</th>
					  <th>Utilisateur</th>
					  <th>Opérateur</th>
                      <th>Montant</th>
                      <th>Frais</th>
					  <th>USD Paiement</th>
					  <th>XOF Paiement</th>
                      <th>Compte</th>
					  <!--<th></th>-->
					  <th></th>
                    </tr>
                  </thead>
                  <?php $i = 0; ?>
                  <tbody>
				    @foreach($with as $wit)
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->date_withdrawal)) }}</td>
                      <td>{{ $wit->cpseudo }}</td>
                      <td>
					        @if($wit->account_to_withdrawal == 1)  "Invest A"  @endif
							@if($wit->account_to_withdrawal == 2)  "Invest B"  @endif
							@if($wit->account_to_withdrawal == 3)  "Invest C"  @endif
							@if($wit->account_to_withdrawal == 4)  "Un membre"  @endif
							@if($wit->account_to_withdrawal == 5)  "Mobile Money"  @endif
							@if($wit->account_to_withdrawal == 6)  "Bitcoin" @endif
							@if($wit->account_to_withdrawal == 7)  "Bank" @endif
							@if($wit->account_to_withdrawal == 8)  Mastercard @endif
							@if($wit->account_to_withdrawal == 9)  Transfert à compte invest @endif
							@if($wit->account_to_withdrawal == 10)  Wave @endif
							@if($wit->account_to_withdrawal == 11)  PayPal @endif
					  </td>
                      <td>{{ $wit->amount_withdrawal }}</td>
                      <td>{{ $wit->withdrawal_fees }}</td>
					  <td>{{ $wit->amount_withdrawal - $wit->withdrawal_fees }}</td>
					  <td>{{ floor((($wit->amount_withdrawal - $wit->withdrawal_fees) * 550) / 5) * 5  }}</td>
					  <td>
					  
						 @if($wit->account_to_withdrawal == 1)  "Invest A"  @endif
							@if($wit->account_to_withdrawal == 2)  "Invest B"  @endif
							@if($wit->account_to_withdrawal == 3)  "Invest C"  @endif
							@if($wit->account_to_withdrawal == 4)  "Un membre"  @endif
							@if($wit->account_to_withdrawal == 5)  "Mobile Money"  @endif
							@if($wit->account_to_withdrawal == 6)  "Bitcoin" @endif
							@if($wit->account_to_withdrawal == 7)  "Bank" @endif
							@if($wit->account_to_withdrawal == 8)  Mastercard @endif
							@if($wit->account_to_withdrawal == 9)  Transfert à compte invest @endif
							@if($wit->account_to_withdrawal == 10)  Wave @endif
							@if($wit->account_to_withdrawal == 11)  PayPal @endif
					  </td>
					  <!--<td><a href="" class="btn btn-danger btn-xs btn-user"> Denied by Broker </td>-->
                      <td><a href="/exact_amount/{{ $wit->ID_withdrawal }}" class="btn btn-success btn-xs btn-user"> Confirmer Paiement
					  </a></td>
                    </tr>
					 <?php $tot = $tot + ($wit->amount_withdrawal - $wit->withdrawal_fees) ;   $i++;  ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  
		<div class="col-xl-12 col-md-6 mb-4">
               <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <center><div class="h4 mb-0 font-weight-bold " style="color: blue"> Montant total à payer: <strong style="color: red">${{number_format($tot,2,","," ")}} </strong></div></center>
                    </div>
					<a download="Withdrawal Sent to Broker.xls" class="btn btn-sm btn-success" href="#" onclick="return ExcellentExport.excel(this, 'datatable', 'rapport');">Exporter vers Excel</a>
                  </div>
                </div>
              </div>
        </div>


        </div>

		
		
@endsection