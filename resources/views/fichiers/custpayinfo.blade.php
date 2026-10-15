@extends('main')

@section('pagename','| CUSTOMER INFOS')

@section('content')

     <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Informations Client</h1>
          
          <!-- Content Row -->
          <div class="row">

            <!-- First Column -->
            <div class="col-lg-4">

              <!-- Custom Text Color Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">BIO</h6>
                </div>
                <div class="card-body">
                  <div class="p-3 bg-gray-100">{{ $inf->cname }}</div>
                  <div class="p-3 bg-gray-200">{{ $inf->cprename }}</div>
				  <div class="p-3 bg-gray-100">{{ $inf->cemail }}</div>
                  <div class="p-3 bg-gray-200">{{ $inf->cphone }}</div>
                </div>
              </div>

              <!-- Custom Font Size Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">MOBILE MONEY</h6>
                </div>
                <div class="card-body">
                  <div class="p-3 bg-gray-100">{{ $inf->mobilemoney }}</div>
                </div>
              </div>

            </div>

            <!-- Second Column -->
            <div class="col-lg-4">

              <!-- Background Gradient Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">BANK</h6>
                </div>
                <div class="card-body">
                  <div class="p-3 bg-gray-100">{{ $inf->bank_name }}</div>
                  <div class="p-3 bg-gray-200"> @if ($inf->bank != null) <a  style="font-size: 10px;" href="https://boasoncc.com/boasonprofilephotos/{{ $inf->bank }}" target="new">Consulter RIB Bancaire </a> @endif</div>
                </div>
              </div>

            </div>

            <!-- Third Column -->
            <div class="col-lg-4">

              <!-- Grayscale Utilities -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">BITCOIN</h6>
                </div>
                <div class="card-body">
                  <div class="p-3 bg-gray-100">{{ $inf->bitcoin }}</div>
                </div>
              </div>
            </div>

          </div>

        </div>

		
		
@endsection