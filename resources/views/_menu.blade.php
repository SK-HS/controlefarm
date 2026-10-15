 @if((Session::get('loglevel') == "FULL")	|| (Session::get('loglevel') == "FIN") || (Session::get('loglevel') == "SAL") || (Session::get('loglevel') == "TRA") || (Session::get('loglevel') == "REL"))
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion @if((Session::get('loglevel') == "FIN") || (Session::get('loglevel') == "SAL"))toggled @endif" id="accordionSidebar">

      <!-- Sidebar - Brand -->
 
 <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        
        <div class="sidebar-brand-text mx-3">
					 <img class="logo_dark" src="/images/logo.png" alt="logo" width="100%" /> <sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard 
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Espace Client</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider">
    
	
     
    <!-- Heading -->
      <div class="sidebar-heading">
        TABEAU DE BORD
      </div>
	 
	 @if(Session::get('loglevel') == "FULL")  
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/admindashboard">
          <i class="fas fa-fw fa-building"></i>
          <span>ACCUEIL</span>
        </a>
      </li>  
	 @endif
	 
	  
	  
	 @if((Session::get('loglevel') == "FULL") || ((Session::get('loglevel') == "FIN") &&  (Session::get('deplevel') == "1")) ) 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers" href="#">
          <i class="fas fa-fw fa-users"></i>
          <span>CLIENTS</span>
        </a>
		 <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">OPERATION CLIENT :</h6>
            <a class="collapse-item" href="/Customers">Tout</a>
            <a class="collapse-item" href="/By_licence">Par Licence</a>
          </div>
        </div>
      </li>
	 @endif
	  
	  
	 @if((Session::get('loglevel') == "FULL") || ((Session::get('loglevel') == "FIN") &&  (Session::get('deplevel') == "1")) ) 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" href="#">
          <i class="fas fa-fw fa-credit-card"></i>
          <span>RECHARGES</span>
        </a>
		 <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">OPERATION RECHARGES:</h6>
            <a class="collapse-item" href="Payments">En Attente</a>
            <a class="collapse-item" href="/validation_history">Historique</a>
          </div>
        </div>
      </li>
	 @endif
	 @if((Session::get('loglevel') == "FULL") || ((Session::get('loglevel') == "FIN") &&  (Session::get('deplevel') == "1")) ) 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseimmmo" aria-expanded="true" aria-controls="collapseOne" href="#">
          <i class="fas fa-fw fa-home"></i>
          <span>IMMOBILIER</span>
        </a>
		 <div id="collapseimmmo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Compte Immobilier:</h6> 
            <a class="collapse-item" href="/Clients-Immo">Investisseurs</a>
            <a class="collapse-item" href="/Historique-Immo">Historique</a>
          </div>
        </div>
      </li>
	 @endif
	 
	  @if((Session::get('loglevel') == "FULL") || (Session::get('loglevel') == "TRA")) 
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" href="#">
          <i class="fas fa-fw fa-download"></i>
          <span>RETRAIT</span>
        </a>
		 <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">OPERATION RETRAIT:</h6>
            <a class="collapse-item" href="/withdrawal">En attente</a>
            <a class="collapse-item" href="/treatment">En Cours</a>
            <a class="collapse-item" href="/withdrawalstatement">Validée</a>
            <a class="collapse-item" href="/withdrawal-annuler">Demande Annulée</a>
          </div>
        </div>
      </li>
	 @endif
	 
	 
	 @if((Session::get('loglevel') == "FULL") || ((Session::get('loglevel') == "FIN") &&  (Session::get('deplevel') == "1"))) 
	  <li class="nav-item">
        <a class="nav-link" href="/transferts">
          <i class="fas fa-fw fa-globe"></i>
          <span>TRANSFERT</span>
        </a>
      </li>
	  
	  
	   <li class="nav-item">
        <a class="nav-link" href="/fees">
          <i class="fas fa-fw fa-percent"></i>
          <span>FRAIS</span>
        </a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" href="/fees_entretien">
          <i class="fas fa-fw fa-percent"></i>
          <span>FRAIS ENTRETIEN</span>
        </a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="/tva">
          <i class="fas fa-fw fa-balance-scale"></i>
          <span>TVA + FORFAITS</span>
        </a>
      </li>
	@endif

	@if((Session::get('loglevel') == "FULL") || (Session::get('loglevel') == "TRA")) 
	   <li class="nav-item">
        <a class="nav-link" href="/capitalisation">
          <i class="fas fa-fw fa-hourglass"></i>
          <span>CAPITALISATION</span>
        </a>
      </li>
	
	
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSc" aria-expanded="true" aria-controls="collapseTwo" href="#">
          <i class="fas fa-fw fa-calendar"></i>
          <span>HORAIRES FOREXTRIP</span>
        </a>
		 <div id="collapseSc" class="collapse" aria-labelledby="collapseSc" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Horaires Forextrip:</h6>
            <a class="collapse-item" href="/forexecheancier">Actif</a>
            <a class="collapse-item" href="/forexecheancierp">Fermée</a>
          </div>
        </div>
      </li>
	  
	@endif
	
    @if((Session::get('loglevel') == "FULL") || ((Session::get('loglevel') == "FIN") &&  (Session::get('deplevel') == "1")))	
	   <li class="nav-item">
        <a class="nav-link" href="/activationcodes">
          <i class="fas fa-fw fa-download"></i>
          <span>ACTIVATION CODE</span>
        </a>
      </li>
    @endif
	
	@if((Session::get('loglevel') == "FULL") || ((Session::get('loglevel') == "FIN") &&  (Session::get('deplevel') == "1"))) 
	 
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSu" aria-expanded="true" aria-controls="collapseTwo" href="#">
          <i class="fas fa-fw fa-cogs"></i>
          <span>SUPPORT</span>
        </a>
		 <div id="collapseSu" class="collapse" aria-labelledby="collapseSu" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">SUPPORT CLIENTS:</h6>
            <a class="collapse-item" href="/support">Réponses en Attente</a>
            <a class="collapse-item" href="/all_support">Tout</a>
          </div>
        </div>
      </li>
	 @endif
    
    @if(Session::get('loglevel') == "FULL") 	
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
       Website
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-envelope-open"></i>
          <span>MESSAGERIE</span></a>
      </li>

      <!-- Nav Item - Charts -->
    @endif 
	
    
	
	@if(Session::get('loglevel') == "FULL")
	  <!-- Divider -->
      <hr class="sidebar-divider">
    
      <!-- Heading -->
      <div class="sidebar-heading">
       Gestion des utilisateurs
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/liste_utilisateurs">
          <i class="fas fa-fw fa-unlock"></i>
          <span>UTILISATEURS</span></a>
      </li>
	  
    @endif  
	
	
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
	
	@endif