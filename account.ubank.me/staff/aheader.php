<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
  <a class="navbar-brand mr-1" href="dashboard"><img src="../vendor/img/favicon.png" height="25px" width="25px" /> UBank <?php if ($staffdat_id == "1"){echo "Owner";} elseif ($staffdat_account == "admin"){echo "Admin";} else { echo "Staff";} ?> Dashboard</a>

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
        <a class="dropdown-item" style="pointer-events: none; cursor: default;"><i class="fas fa-server"></i> Maintenance Messages</a>
        <div class="dropdown-divider"></div>
        <?php include '../_inc/dbconn.php';
          $sql = "SELECT * FROM UBankMAIN.security";
          $result = mysql_query($sql) or die(mysql_error());

          while($rws = mysql_fetch_array($result)){
            $message = $rws[2];
            echo "<a class='dropdown-item'>#".$rws[0].": <b>".$rws[1]."</b><br><small>".wordwrap($message, 50, '<br>', false)."<br><i>Fixed by: ".$rws[5]."</i></small></a>";
            echo "<div class='dropdown-divider'></div>";
        } ?>
        <a class="dropdown-item" href="dashboard"><i class="fas fa-bell fa-fw"></i> Show all</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-fw"></i> <b><?php echo $_SESSION['session_staff_name']?></b>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
		    <h6 class="dropdown-header">Welcome <b><?php echo $_SESSION['session_staff_name']?></b>!</h6>
        <a class="dropdown-item" href="dashboard"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
        <?php if ($staffdat_id == "1"){ ?>
        <a class="dropdown-item" href="edit/admin?overview"><i class="fas fa-fw fa-crown"></i> Edit Admins</a>
        <?php } if ($staffdat_account == "admin"){ ?>
        <a class="dropdown-item" href="edit/staff?overview"><i class="fas fa-fw fa-user-edit"></i> Edit Staff</a>
        <a class="dropdown-item" href="edit/users?overview"><i class="fas fa-fw fa-user-edit"></i> Edit Users</a>
        <?php } elseif ($staffdat_account == "staff"){ ?>
        <a class="dropdown-item" href="requests"><i class="fas fa-clipboard-list"></i> Card Requests</a>
        <a class="dropdown-item" href="questions"><i class="fas fa-clipboard-list"></i> Questions Review</a>
        <a class="dropdown-item" href="edit/users?overview"><i class="fas fa-fw fa-user-edit"></i> User accounts</a>
        <?php } ?>
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
      <a class="nav-link" href="dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <?php if ($staffdat_id == "1"){ ?>
    <li class="nav-item">
      <a class="nav-link" href="edit/admin?overview">
        <i class="fas fa-fw fa-crown"></i>
        <span>Admin</span>
      </a>
    </li>
    <?php } if ($staffdat_account == "admin"){ ?>
    <li class="nav-item">
      <a class="nav-link" href="edit/staff?overview">
        <i class="fas fa-fw fa-user-edit"></i>
        <span>Edit Staff</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="edit/users?overview">
        <i class="fas fa-fw fa-user-edit"></i>
        <span>Edit Users</span>
      </a>
    </li>
    <?php } elseif ($staffdat_account == "staff"){ ?>
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
      <a class="nav-link" href="edit/users?overview">
        <i class="fas fa-fw fa-users"></i>
        <span>Edit Users</span>
      </a>
    </li>
    <?php } ?>
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