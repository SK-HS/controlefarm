
@extends('mainsales')

@section('pagename','| Proforma')

@section('content')

   
    <div id="htmlContent" class="container-fluid">

		     <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table"  width="100%" cellspacing="0" style="font-size: 12px;  ">
                  <thead>
				     <tr>
					  <th colspan="2"><img class="img-profile" width="30%" src="{{asset('images/new_logo.png')}}"></th>
					  <th colspan="2"><span style="font-size: 10px !important; font-weight: bold; color: black;">
                          BOASON CROWD CAPITAL <br>
							Côte d'Ivoire, Abidjan <br>
							Plateau, Boulevard de la République, <br>
							Immeuble XL, 6èm Étage. <br>
							+225 07 89 22 82 74 <br>
							support@boasoncc.com <br>
							www.boasoncc.com <br>
							Impôt Id : 21 00 164 H <br>

					  </span> 
					  </th>
					  
					  </tr>
				     </thead>
                   
                  <tbody>
				    <tr>
                      <td align="center" colspan="4" style="font-size: 28px !important; font-weight: 900; text-transform: uppercase; color: black" colspan="2">
					   PRO FORMA
					  </td>
					</tr>
				    <tr>
                      <td style="font-size: 14px !important; font-weight: 900; text-transform: uppercase; color: black" colspan="3"> @if($commande->ID_customer == null)  {{ $commande->pname }}  @else {{ $custo->cname }} {{ $custo->cprename }}  @endif 
					   <span style="font-size: 13px !important; font-weight: 400 !important; text-transform: lowercase; color: black">
					    <span style="text-transform: capitalize;"></br> @if($commande->ID_customer == null)  {{ $commande->padress }}  @else {{ $custo->cadress }}   @endif </span> 
                       </br> @if($commande->ID_customer == null)  {{ $commande->pemail }}  @else {{ $custo->cemail }}  @endif
                       </br> @if($commande->ID_customer == null)  {{ $commande->pphone }}  @else {{ $custo->cphone }}   @endif 					   
                      
                       </span> 					  
					  </td>  
					 <td align="right">
					    <span style="font-size: 14px !important; text-transform: capitalize; color: #4e73df">{{ $commande->no_commande }} </span> </br>
                        <span style="font-size: 12px !important; color: #4e73df">{{ date('d-m-Y H:i',strtotime($commande->date_commande)) }}	</span>					
						 
					 </td>
					</tr>
					<?php $t =0; $b =0; $ip = 0;?> 
					<tr style="background-color: #4e73df !important; color: white;">
                      <td style="font-size: 10px !important;"><b>Produit</b></td>
					  <td style="font-size: 10px !important;"><b>Taux&nbsp;&nbsp;&nbsp;</b></td>
					  <td style="font-size: 10px !important;"><b>Impôt&nbsp;&nbsp;</b></td>
					   <td style="font-size: 10px !important;"><b>Montant</b></td>
					  
					</tr>
				    @foreach($proforma as $prof)
                    <tr>
                      <td style="font-size: 12px !important;">{{ $prof->nom_produit }}</td>
					  <?php $mont =0; if($prof->type_produit == 'TOPUP') { $mont = $prof->montant_detailcommande; } else { $mont = $prof->montant_produit_ht_xof;  } ?>
					  <td style="font-size: 12px !important;" align="right" ><b>{{ number_format($mont, 0) }}  XOF</b></td>
					  <td style="font-size: 12px !important;" align="right" ><b>{{ number_format(($prof->tva_produit), 0) }} XOF</b></td>
					  <td style="font-size: 12px !important;" align="right" ><b>{{ number_format(($prof->tva_produit + $mont ), 0) }} XOF</b></td>
					</tr>
					<?php $t = $t + ($mont + $prof->tva_produit);   $b =$b + $mont;   $ip = $ip + $prof->tva_produit; ?> 
					@endforeach
					
                  </tbody>
                </table>
				
				
				
				 <table class="table"  width="100%" cellspacing="0" style="font-size: 12px; ">
                  
                  <tbody>
				    
				    <tr>
                      <td style="font-size: 14px !important; font-weight: 900; text-transform: uppercase; color: black"> 
					 					  
					  </td>  
					 <td align="right">
					    <span style="font-size: 14px !important; text-transform: capitalize; color: #4e73df">Montant de base : {{ $b }} </span> </br>
                        <span style="font-size: 12px !important; color: #4e73df">(+) Impôt : {{ $ip }}	</span>					
						 
					 </td>
					</tr>
					
					<tr>
                      <td style="font-size: 14px !important; font-weight: 900; text-transform: uppercase; color: black"> 
					 	  <span style="font-size: 12px !important; text-transform: capitalize; color: #4e73df">Veuillez consulter le relevé d'achat ci-joint. </span>				  
					  </td>  
					 <td align="right">
					   <span style="font-size: 14px !important; color: #4e73df">Sous-Total : XOF {{ $ip + $b }}	</span>					
					 </td>
					</tr>
					
					<tr>
                      <td style="font-size: 14px !important; font-weight: 900; text-transform: capitalize; color: black"> 
					 			  
					  </td>  
					 <td style="font-size: 14px !important; background-color: #c0cbea !important; font-weight: bold; color: black" align="right"  ><b>Somme finale : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($t, 0) }} XOF</b></td>
					</tr>
					
					<tr>
                      <td style="font-size: 14px !important; font-weight: 900; text-transform: capitalize; color: black"> 
					 	 Le montant en mots :			  
					  </td>  
					 <td ></td>
					</tr>
					
					<tr>
					 <td style="font-size: 12px !important; font-weight: 500; text-transform: uppercase; color: black" align="right" colspan="2">  <br><br>The Financial Team <br> Visa </td> 
					</tr>
					</tbody>
                </table>
				
				
				
				<table class="table"  width="100%" cellspacing="0" style="font-size: 12px; ">
                  <thead>
				     <tr>
					   <th><span style="font-size: 12px !important; font-weight: bold; color: black;">
                          Payable à <br>
							BOASON CROWD CAPITAL SAS <br><br>
							Comptes Mobile Money <br>
							Orange : +225 89 22 82 74 <br>
							MTN : +225 74 59 62 12 <br>

					  </span> 
					  </th>
					  <th><span style="font-size: 12px !important; font-weight: bold; color: black;">
                          Informations Bancaires  <br>
							ECOBANK CÔTE D'IVOIRE  <br>
							BOA KOUAME ROMEO PROSPER  <br>
							IBAN :  <br>
							CI93 CI05 9010 0481 1233 9236 0166  <br>

					  </span> 
					  </th>
					   <th align="center"><span style="font-size: 12px !important; font-weight: bold; color: black;">
                          Autres détails <br>
							- Code Banque : CI059 <br>
							- Code Swift : ECOCCIAB <br>
							- Code Guichet : 01004 <br>
							- Numéro : 811 233 923 601 <br>
							- Clé RIB : 66 <br>

					  </span> 
					  </th>
					  
					  </tr>
				     </thead>
                   
                  <tbody>
				    <tr>
                      <td  style="font-size: 12px !important; font-weight: 900; text-transform: uppercase; color: black" colspan="2">
					   Tous droits réservés à :<br>
						BOASON CROWD CAPITAL,<br>
						Fintech de Droit Ivoirien au capital de $200 000 (120 Millions XOF),<br>
						Spécialisée dans le développement de solutions technologiques innovantes visant à démocratiser les marchés<br>
						financiers alternatifs (Forex, Crypto-monnaies, Immobilier, Crowdfunding)<br>
						Propulseur Africain de l'Education et de la Finance Alternative.<br>
					  </td>
					</tr>
				    
					
                  </tbody>
                </table>
				
				
				
              </div>
            </div>
          </div>
		  
		  
		  
		  
		  
		  
       <div id="editor"></div>


        </div>
		
		
		
		
		
		

		
		
@endsection

