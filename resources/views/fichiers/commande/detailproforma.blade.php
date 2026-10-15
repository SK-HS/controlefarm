@extends('mainsales')

@section('pagename','| Proforma')

@section('content')

    <div class="container-fluid">

			   
              <h6 class="m-0 font-weight-bold text-primary" align="center"> 
			   DETAILS PROFORMA - {{ $commande->no_commande }} 
			  </h6>
		<br>
		     <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px; ">
                  <thead>
				     <span style="font-size: 10px !important; font-weight: bold; text-transform: uppercase;">{{ date('d-m-Y H:i',strtotime($commande->date_commande)) }} </span> 
                   </thead>
                   
                  <tbody>
				    <tr>
                      <td style="font-size: 12px !important; font-weight: 900; text-transform: uppercase;" colspan="2"> @if($commande->ID_customer == null)  {{ $commande->pname }}  @else {{ $custo->cname }} {{ $custo->cprename }}  @endif 
					 <span style="font-size: 10px !important; font-weight: 400 !important; text-transform: lowercase;">
					 </br> @if($commande->ID_customer == null)  {{ $commande->pphone }}  @else {{ $custo->cphone }}   @endif 
                      </br> @if($commande->ID_customer == null)  {{ $commande->pemail }}  @else {{ $custo->cemail }}  @endif 
                      <span style="text-transform: capitalize;"></br> @if($commande->ID_customer == null)  {{ $commande->padress }}  @else {{ $custo->cadress }}   @endif </span> 
                     </span> 					  
					  </td>  
					 <td align="right">
					     @if($commande->solde_client == 1)  <a href="#" class="btn btn-success btn-user btn-xs" style="padding: 2px !important; font-size: 8px !important; width: 40px !important;">Soldé</a> @endif
						 @if(($commande->echance_client == 1) && ($commande->solde_client == 0))  <a href="#" class="btn btn-warning btn-user btn-xs" style="padding: 2px !important; font-size: 8px !important; width: 40px !important;">Paiement</a> @endif
						 @if(($commande->valide_client == 1) && ($commande->echance_client == 0))  <a href="#" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 8px !important; width: 40px !important;">Accepté</a>@endif
						 @if(($commande->soumis_client == 1) && ($commande->valide_client == 0)) <a href="#" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: purple; border-color: purple; width: 40px !important;">Soumis</a>    @endif
						 @if($commande->soumis_client == 0) <a href="#" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: gray; border-color: gray; width: 40px !important; color: white">Details</a>@endif
                      
					  </td>
					 </tr>
					<?php $t =0;  ?> 
					<tr style="background-color: #c0cbea !important;">
                      <td style="font-size: 10px !important;"><b>Produit</b></td>
					  <td style="font-size: 10px !important;" align="right"><b>Hors Taxes</b></td>
					  <td style="font-size: 10px !important;" align="right"><b>TVA</b></td>
					  
					</tr>
				    @foreach($proforma as $prof)
                    <tr>
                      <td style="font-size: 10px !important;">{{ $prof->nom_produit }}</td>
					  
					  <?php $mont =0;  if($prof->type_produit == 'TOPUP') { $mont = $prof->montant_detailcommande; } else { $mont = $prof->montant_produit_ht_xof;  } ?>
					  <td style="font-size: 10px !important;" align="right" ><b>{{ number_format($mont, 0) }} XOF</b></td>
					  <td style="font-size: 10px !important;" align="right" ><b>{{ number_format(($prof->tva_produit), 0) }} XOF</b></td>
					</tr>
					<?php $t = $t + ($mont + $prof->tva_produit); ?> 
					@endforeach
					<tr>
				
					   <td style="font-size: 10px !important; font-weight: bold;" colspan="2" align="center" ><b>TOTAL TTC : </b></td>
                       <td style="font-size: 10px !important; background-color: #c0cbea !important; font-weight: bold" align="right"  ><b>{{ number_format($t, 0) }} XOF</b></td>
					 </tr>
					<tr>
                      <td>
					  </td>
					  <td>
					     @if((($commande->soumis_client == 0) || ($commande->soumis_client == 1)) && ($commande->valide_client == 0))
							  <a href="..\modifiercommande/{{ $commande->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 5px !important; font-size: 14px !important; width: 70px !important;">Modifier</a>
					     @endif
					     
					  </td>
					  <td align="right">
					       @if($commande->soumis_client == 0) 
							   <a href="..\soumettrecommande/{{ $commande->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 5px !important; font-size: 14px !important; background-color: purple; border-color: purple; width: 70px !important;">valider</a> 
					       @endif
						   
						   @if(($commande->soumis_client == 1) && ($commande->valide_client == 0))
							   <a href="..\acceptercommande/{{ $commande->ID_commande}}" class="btn btn-info btn-warning btn-xs" style="padding: 5px !important; font-size: 10px !important; background-color: orange; border-color: orange; width: 70px !important;" onclick="return confirm('Le client a t il vraiment accepté la proforma ? Cette opération est irreversible.')">Acceptation</a> 
					       @endif
					  </td>
                      
					  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  
		  
		  <br>
		     <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px; ">
                 
                  <tbody>
				   
					<tr>
                      <td>
                          @if(($commande->soumis_client == 0) || ($commande->soumis_client == 1))
							   <a href="..\previewproformat/{{ $commande->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 5px !important; font-size: 12px !important; width: 90px !important;">PROFORMA</a>
					      @endif
					  </td>
					  
					  
					  <td align="right">
					      @if($commande->echance_client == 1)
							   @foreach($versement as $verse)
							    <a href="..\previewrecu/{{ $verse->ID_versement}}" class="btn btn-info btn-user btn-xs" style="padding: 5px !important; font-size: 10px !important; width: 120px !important;">REÇU - {{ $verse->no_recu }}</a>
							   <br><br>
							   @endforeach
					       @endif
					  </td>
                      
					</tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>
		
		
		
		

		
		
@endsection