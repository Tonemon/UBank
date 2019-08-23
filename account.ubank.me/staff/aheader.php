<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="home"><img src="../vendor/img/favicon.png" height="25px" width="25px" /> UBank Staff Dashboard</a>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
			<a class="dropdown-item" style="pointer-events: none; cursor: default;"><i class="fas fa-bell fa-fw"></i> Your Messages:</a>
            <a class="dropdown-item">*Message*</a>
            <a class="dropdown-item">*Message*</a>
            <a class="dropdown-item">*Message*</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="home"><i class="fas fa-bell fa-fw"></i> Show all</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i> <b><?php echo $_SESSION['name1']?></b>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
		    <!-- <a class="dropdown-item" href="home">Welcome <b><?php echo $_SESSION['name1']?></b>!</a> -->
			<h6 class="dropdown-header">Welcome <b><?php echo $_SESSION['name1']?></b>!</h6>
			<!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="home"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
			<a class="dropdown-item" href="requests"><i class="fas fa-clipboard-list"></i> Approval Requests</a>
			<a class="dropdown-item" href="questions"><i class="fas fa-clipboard-list"></i> Questions Review</a>
            <a class="dropdown-item" href="settings"><i class="fas fa-cogs"></i> Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
      </ul>
    </nav>
	
	
	<div id="wrapper">
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav toggled">
        <li class="nav-item active">
          <a class="nav-link" href="home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="requests">
            <i class="fas fa-clipboard-list"></i>
            <span>Requests</span>
          </a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="questions">
            <i class="fas fa-clipboard-list"></i>
            <span>Questions</span>
          </a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="settings">
            <i class="fas fa-cogs"></i>
            <span>Settings</span>
          </a>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="modal" data-target="#logoutModal" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
          </a>
        </li>
		
		<!-- sidebar toggle -->
		<li class="nav-item">
          <a class="nav-link" id="sidebarToggle" href="#">
            <i class="fas fa-fw fa-bars"></i>
          </a>
        </li>
      </ul>