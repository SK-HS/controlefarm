@extends('main')

@section('pagename','| WITHDRAWAL STATEMENT')

@section('content')

    <div class="container-fluid">

        
			<section class="content">
			  <div class="container-fluid">
				<div class="row">
				  <div class="col-md-1"></div>
				  <div class="col-md-4 col-sm-6">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
					  <div class="card-body box-profile">

					 <form method="POST" action="/withdrawal_statement_operation" role="form">
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
										<option value="11">paypal</option>
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
				<div class="col-6">
				
					<div class="card card-primary card-outline ">
				 
					  <!-- /.card-header -->
					  <div class="card-body">
						<div class="col-sm12"> 
						<div class="col-sm12"> 
					 <form method="POST" action="/withdrawal_statement_date" role="form">
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
										 <label>fin</label>
										<input type="date" class="form-control pull-right" name="fin" >
										</div>
								</div>
								<div class="col-sm-4"> 
										<label>&nbsp;</label>
										<button class="btn btn-primary btn-user btn-block"  id="login-form-submit">Search</button>
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
              <h6 class="m-0 font-weight-bold text-primary">DEMANDES RETRAITS VALIDEE</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
					  <th>Date Requet</th>
					  <th>Date Traité</th>
					  <th>Client</th>
					  <th>Envoyé à</th>
                      <th>Montant demandé</th>
					  <th>Montant envoyé (FCFA)</th>
					  <th>Date d'envoi</th>
					  <th>Honoraires perçus</th>
					  <th>Envoi de référence</th>
                      
					
                    </tr>
                  </thead>
                  
                  <tbody>
                      <?php $tot = 0  ?>
				    @foreach($with as $wit)
                    <tr>
                   
                      <td>{{ date('Y-m-d H:i',strtotime($wit->date_withdrawal)) }}</td>
					  <td>@if($wit->date_treatment != null) {{ date('Y-m-d H:i',strtotime($wit->date_treatment)) }} @endif</td>
                      <td>{{ $wit->cpseudo }}</td>
                      <td>
					      	 @if($wit->account_to_withdrawal == 1)  "Invest A"  @endif
							@if($wit->account_to_withdrawal == 2)  "Invest B"  @endif
							@if($wit->account_to_withdrawal == 3)  "Invest C"  @endif
							@if($wit->account_to_withdrawal == 4)  "Un membre"  @endif
							@if($wit->account_to_withdrawal == 5)  {{$wit->mobilemoney}}  @endif
							@if($wit->account_to_withdrawal == 6)   {{$wit->bitcoin}} @endif
							@if($wit->account_to_withdrawal == 7)  {{$wit->bank_name}}=> {{$wit->bank}} @endif
							@if($wit->account_to_withdrawal == 8)  {{$wit->cartevisa}} @endif
							@if($wit->account_to_withdrawal == 9)  Transfert à compte invest @endif
							@if($wit->account_to_withdrawal == 10)  {{$wit->wave}} @endif
							@if($wit->account_to_withdrawal == 11)  {{$wit->paypal}} @endif
					  </td>
                      <td>{{ $wit->amount_withdrawal }}</td>
					  <td>{{ $wit->exact_amount_withdrawal }}</td>
					  
					  <td>@if($wit->date_exact_amount_withdrawal != null){{ date('Y-m-d',strtotime($wit->date_exact_amount_withdrawal)) }} @endif</td>
					  <td>{{ $wit->withdrawal_fees }}</td>
					  <td><a href="/withdrawalstatementref/{{$wit->ID_withdrawal}}" target="new">{{$wit->reference_exact_amount_withdrawal }}</a></td>
                      
                    </tr>
                    <?php $tot += $wit->exact_amount_withdrawal ?>
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
                      <center><div class="h4 mb-0 font-weight-bold " style="color: blue"> Total : <strong style="color: red"> {{$tot}} </strong></div></center>
                    </div>
                  </div>
                </div>
              </div>
        </div>


        </div>

		
		
@endsection