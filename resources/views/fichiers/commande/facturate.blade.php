@extends('mainsales')

@section('pagename','| Proforma')

@section('content')

    <div class="container-fluid">

            
		     <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px; ">
                  <thead>
                    FACTURE
                  </thead>
                   
                  <tbody>
				   <?php $i = 0; ?>
				    @foreach($facture as $wit)
                    <tr>
                      <td style="font-size: 8px !important;">{{ date('d-m-Y H:i',strtotime($wit->date_commande)) }}</td>
					  <td style="font-size: 10px !important; font-weight: bold; text-transform: uppercase;"><a style="color: black;"> @if($wit->ID_customer == null)  {{ substr($wit->pname, 0, 13) }}  @else {{ $custo[$i]->cname }} {{ substr($custo[$i]->cprename, 0, 7) }}  @endif <br> <span style="color: lightgray;"> {{ $wit->no_facture }} </span> </a></td>
                      <td style="font-size: 8px !important;"><b>{{ number_format($mtn[$i], 0) }} XOF</b></br>
					   @if($wit->facture_sent == 0) 
					   @if(Session::get('loglevel') == "FIN") <a href="envoyerfacture/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: red; border-color: red; width: 80px !important;">Envoyer la Facture</a>@endif
					  @else
						@if(Session::get('loglevel') == "FIN") <a href="envoyerfacture/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: #0ab90a; border-color: #0ab90a; width: 90px !important;">Renvoyer la Facture</a>@endif  
					  @endif
					  
					  </td>
                      <td>
					     <a href="previewfacture/{{ $wit->ID_commande}}" class="btn btn-info btn-user btn-xs" style="padding: 2px !important; font-size: 9px !important; background-color: purple; border-color: purple; width: 40px !important; color: white">aperçu</a>
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