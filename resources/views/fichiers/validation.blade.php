@extends('main')

@section('pagename','| VALIDATION')

@section('content')

    <div class="container-fluid">

        
		
		     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des TOP-UP à valider</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <!-- <th>Customer</th> -->
                      <th>Payment method</th>
                      <th>Payment Code</th>
                      <th>Payment Amount</th>
                      <th>Payment Date</th>
                      <th> </th>
					  <th> </th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  @foreach($pays as $pay)
                    <tr>
                    <!--   <td>{{ $pay->ID_customer }}</td> -->
                      <td>{{ $pay->paymentmethod_name }}</td>
                      <td>{{ $pay->payment_code }}</td>
                      <td>{{ $pay->paymentdone_amount }}</td>
                      <td>{{ date('Y-m-d',strtotime($pay->paymentdone_date)) }}</td>
                      <td> <a href="/validatedtopup/{{ $pay->ID_paymentdone }}" class="btn btn-success btn-xs btn-user btn-block"> Valider</a> </td>
					  <td> <a href="/refusedtopup/{{ $pay->ID_paymentdone }}" class="btn btn-danger btn-xs btn-user btn-block"> Refuser</a> </td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  
		  



        </div>

		
		
@endsection