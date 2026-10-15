@extends('mainsales')

@section('pagename','| Proforma')

@section('content')

    <div class="container-fluid">

			   
              <h6 class="m-0 font-weight-bold text-primary" align="center"> 
			   DETAILS PROFORMA 
			  </h6>
		<br>
		<a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>
		     <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                
				
				   
						<table>
						<tr>
						<th>No</th>
						<th>Title</th>
						<th>Description</th>
						</tr>
						
						<tr>
						<td>a</td>
						<td>b</td>
						<td>c</td>
						</tr>
						
						</table>
										
				
				
				
				
				
				
				
				
				
              </div>
            </div>
          </div>
		  
		  



        </div>
		
		
		
		

		
		
@endsection