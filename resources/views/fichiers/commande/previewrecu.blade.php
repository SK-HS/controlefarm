@extends('mainsales')

@section('pagename','| Proforma')

@section('content')

    <div class="container-fluid">

		     <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table"  width="100%" cellspacing="0" style="font-size: 12px; ">
                  <thead>
				     <tr>
					  <th ><img class="img-profile" width="30%" src="{{asset('images/new_logo.png')}}"></th>
					   
					
					  <th ><span style="font-size: 10px !important; font-weight: bold; color: black;">
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
					  <th><span style="font-size: 14px !important; font-weight: bold; color: black;">
                          REÇU &nbsp;&nbsp;&nbsp;&nbsp;<br>
							N° REÇU :  {{$versement->no_recu}}<br>
							Date :  {{$versement->date_versement}}<br>

					  </span>
					  </th>
					  </tr>
				     </thead>
                   
                  <tbody>
				    <tr>
                      <td align="left" style="font-size: 18px !important; font-weight: 900; text-transform: uppercase; color: black">
					    reçu <br>
					  @if($versement->ID_customer == null)  {{ $versement->pname }}  @else {{ $custo->cname }} {{ $custo->cprename }}  @endif
					  </td>
					  <td align="center" style="font-size: 28px !important; font-weight: 900; text-transform: uppercase; color: black">
					  </td>
					  <td align="center" style="font-size: 28px !important; font-weight: 900; text-transform: uppercase; color: black">
					   XOF {{ $versement->montant_versement }}
					  </td>
					</tr>
					
					 <tr>
                      <td align="left" style="font-size: 15px !important; font-weight: 600;  color: black">
					    Nous vous remercions de votre paiement contre le <br>
						 {{ $versement->no_commande }}
						 <br>
						
					 
					  </td>
					  <td align="center" style="font-size: 28px !important; font-weight: 900; text-transform: uppercase; color: black">
					  </td>
					  <td align="center" style="font-size: 14px !important; font-weight: 900; text-transform: uppercase; color: black">
					   The Financial Team <br>
						Visa <br><br><br><br>
					  </td>
					</tr>
					
					
                  </tbody>
                </table>
				
				
				
				 
				
				
              </div>
            </div>
          </div>
		  
		  
		  
		  
		  
		  



        </div>
		
		
		
		

		
		
@endsection