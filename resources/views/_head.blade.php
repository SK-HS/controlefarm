<head>
      <meta http-equiv="refresh" content="600;url=/logout" />
      <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="description" content="">
	  <meta name="eFarm" content="">

      <title>Control-eFarm @yield('pagename')</title>
    <link rel="icon" type="image/png" href="{{asset('images/icone.png')}}" />
    
	  <!-- Custom fonts for this template-->
	  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	  <!-- Custom styles for this template-->
	  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
	  
	  <link href="{{asset('css/adminlte.min.css')}}" rel="stylesheet">
	  
	  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
	  
	  <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet">
      <link href="{{asset('select2-bootstrap4-theme/select2-bootstrap4.min.css')}}" rel="stylesheet">	  
	  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
	  <script src="{{asset('js/plugins/excellentexport.js')}}"></script>
	   <script>
            function newApi(format) {
                return ExcellentExport.convert({
                    anchor: 'anchorNewApi-' + format,
                    filename: 'data_123.' + format,
                    format: format
                }, [{
                    name: 'remuneration',
                    from: {
                        table: 'datatable'
                    }
                }]);
            }
 </script>
  <!-- Font Awesome -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->

</head>