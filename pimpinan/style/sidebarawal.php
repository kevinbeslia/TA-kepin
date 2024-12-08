<?php 
  session_start();
    include ('../config/koneksi.php');
    if($_SESSION['level']==""){
      echo "<script language=javascript>
          window.alert('Anda Harus Login Sebagai Admin!');
          window.location='../index.php';
          </script>";
    }
?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0510a8;">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
        <i class="fas fa-user" style="color: #ffffff"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="color: #ffffff"><?php echo $_SESSION['username']; ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt" style="color: #ffffff"></i>
          <span style="color: #ffffff">Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading" style="color: #ffffff">
          Data
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="periodekeputusan.php">
            <i class="fas fa-clipboard-list" style="color: #ffffff"></i>
            <span style="color: #ffffff">Periode Keputusan</span></a>
            
          <a class="nav-link" href="data_kriteria.php">
            <i class="fas fa-fw fa-database" style="color: #ffffff"></i>
            <span style="color: #ffffff">Kriteria</span></a>

<!--             <a class="nav-link" href="data_nasabah.php">
            <i class="fas fa-fw fa-users" style="color: #ffffff"></i>
            <span style="color: #ffffff">Nasabah</span></a> -->
            </li>                          
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

              </ul>
              <!-- End of Sidebar -->

              <!-- Content Wrapper -->
              <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                  <!-- Topbar -->
                  <nav class="navbar navbar-expand font-weight-bold topbar mb-4 static-top shadow" style="color: #0510a8; font-size: 17px" >
                  Penerimaan Remisi Narapidana (Rutan Klas IIB Padang)
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - Tables -->
                        <li class="nav-item">
                          <a class="nav-link" href="logout.php">
                            <i class="fas fa-fw fa-sign-out-alt" style="color: #0510a8"></i>
                            <span style="color: #0510a8">Logout</span></a>
                          </li>

                        </ul>

                      </nav>
        <!-- End of Topbar -->