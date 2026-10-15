@extends('mainsales')

@section('pagename','| Proforma')

@section('content')

    <div class="container-fluid">

              <h6 class="m-0 font-weight-bold text-primary" align="center"> 
			 @if(Session::get('loglevel') == "SAL") <a href="/nouvelle_proforma" class="btn btn-info" style="padding: 2px !important; font-size: 14px; background-color: #094b91; !important;"> &nbsp;&nbsp; <i class="fa fa-plus"></i> &nbsp;&nbsp; </a> @endif
			  </h6>
		
		     <div class="card shadow mb-4">
			 
			       <div  class="form-group">
					@if(session()->has('montantsuperieur'))
					<div class="alert alert-danger">
					<a class="alert-link" style="color: white !important; font-size: 12px !important;">{{session()->get('montantsuperieur')}}</a>.
					</div>
					@endif
                    </div>
					
					<div  class="form-group">
					@if(session()->has('versementok'))
					<div class="alert alert-success">
					<a class="alert-link" style="color: white !important; font-size: 12px !important;">{{session()->get('versementok')}}</a>.
					</div>
					@endif
                    </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px; ">
                  <thead>
                    PROFORMA
                  </thead>
                   
                  <tbody>
				   <?php $i = 0; ?>
				    @foreach($proforma as $wit)
                    <tr>
                      <td style="font-size: 8px !important;">{{ date('d-m-Y H:i',strtotime($wit->date_commande)) }}</td>
					  <td style="font-size: 10px !important; font-weight: bold; text-transform: uppercase;"><a style="color: black;"> @if($wit->ID_customer == null)  {{ substr($wit->pname, 0, 13) }}  @else {{ $custo[$i]->cname }} {{ substr($custo[$i]->cprename, 0, 7) }}  @endif <br> <span style="color: lightgray;"> {{ $wit->no_commande }} </span> </a></td>
                      <td style="font-size: 8px !important;"><b>{{ number_format($mtn[$i], 0) }} XOF</b>
					     <br>
						 @if(($wit->valide_client == 1) && ($wit->solde_client == 0))
						 @if(Session::get('loglevel') == "FIN") <a href="versementcommande/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: red; border-color: red; width: 40px !important;">Payer</a>@endif
						 @endif		
					  </td>
                      <td>
					     
						 
						 @if($wit->solde_client == 1)  <a href="consultercommande/{{ $wit->ID_commande}}" class="btn btn-success btn-user btn-xs" style="padding: 2px !important; font-size: 8px !important; width: 40px !important;">Soldé</a> @endif
						 @if(($wit->echance_client == 1) && ($wit->solde_client == 0))  <a href="consultercommande/{{ $wit->ID_commande}}" class="btn btn-warning btn-user btn-xs" style="padding: 2px !important; font-size: 8px !important; width: 40px !important;">Paiement</a> @endif
						 @if(($wit->valide_client == 1) && ($wit->echance_client == 0))  <a href="consultercommande/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 8px !important; width: 40px !important;">Accepté</a>@endif
						 @if(($wit->soumis_client == 1) && ($wit->valide_client == 0)) <a href="consultercommande/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: purple; border-color: purple; width: 40px !important;">Soumis</a>    @endif
						 @if($wit->soumis_client == 0) <a href="consultercommande/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: gray; border-color: gray; width: 40px !important; color: white">Details</a>@endif
                      
						  	 
					  </td>
                      
					  </tr>
					  <?php $i++; ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>
		
		
		
		

		
		
@endsection