@extends('main')

@section('pagename','| USERS')

@section('content')

    <div class="container-fluid">

        
		<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-1 col-md-1 mb-1"></div>
			<!-- Earnings (Monthly) Card Example -->
			
			@foreach($forfait as $fof)
            <div class="col-xl-2 col-md-6 mb-4">
               <a href="Users_licence/{{ $fof->ID_forfait }}"><div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <center><div class="h4 mb-0 font-weight-bold " style="color: blue">{{ $fof->forfait_name }}</div></center>
                    </div>
                  </div>
                </div>
              </div></a>
            </div>
			@endforeach

        </div>

    </div>

		
		
@endsection