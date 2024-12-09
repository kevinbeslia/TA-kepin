<?php
$idp = $_GET['idp'];
session_start();
// include('../../config/koneksi.php');
if ($_SESSION['level'] == "") {
  echo "<script language=javascript>
          window.alert('Anda Harus Login Sebagai Admin!');
          window.location='../../index.php';
          </script>";
}
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?idp=<?php echo $idp; ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user" style="color: #ffff"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="color: #ffff"><?php echo $_SESSION['username']; ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <!-- Divider -->
      <hr class="sidebar-divider">
      <li class="nav-item active">
        <a class="nav-link" href="/pimpinan/proses/index.php?idp=<?php echo $idp; ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Heading -->
      <div class="sidebar-heading" style="color: #ffff">
        Data
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item">

        <a class="nav-link" href="/pimpinan/data_kriteria.php?idp=<?php echo $idp; ?>">
          <i class="fas fa-fw fa-database" style="color: #ffff"></i>
          <span style="color: #ffff">Kriteria</span></a>

        <a class="nav-link" href="/pimpinan/proses/data_alternatif.php?idp=<?php echo $idp; ?>">
          <i class="fas fa-fw fa-database" style="color: #ffff"></i>
          <span style="color: #ffff">Alternatif</span></a>

        <a class="nav-link" href="/pimpinan/proses/data_penilaian.php?idp=<?php echo $idp; ?>">
          <i class="fas fa-fw fa-database" style="color: #ffff"></i>
          <span style="color: #ffff">Penilaian</span></a>

        <a class="nav-link" href="/pimpinan/proses/hasil_keputusan.php?idp=<?php echo $idp; ?>">
          <i class="fas fa-fw fa-database" style="color: #ffff"></i>
          <span style="color: #ffff">Hasil Keputusan</span></a>

      </li>

      <div class="sidebar-heading" style="color: #ffff">
        Laporan
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-report"></i>
          <span style="color: #ffff">Laporan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--                   <a class="collapse-item" href="cetak_alt.php?idp=<?php echo $idp; ?>" target="_BLANK" style="color: #ffff">Data Alternatif</a>
                  <a class="collapse-item" href="cetak_nilai.php?idp=<?php echo $idp; ?>" target="_BLANK" style="color: #ffff">Hasil Penilaian</a> -->
            <a class="collapse-item" href="cetak_hasil.php?idp=<?php echo $idp; ?>" target="_BLANK" style="color: #000000">Hasil Keputusan</a>
          </div>
        </div>
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
        <nav class="navbar navbar-expand font-weight-bold topbar mb-4 static-top shadow" style="color: #0510a8; font-size: 17px">
          Penerimaan Remisi Narapidana (Rutan Klas IIB Padang)
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
              <a class="nav-link" href="/pimpinan/periodekeputusan.php">
                <i class="fas fa-chevron-circle-left" style="color: #0510a8"></i>
                <span style="color: #0510a8">Home</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/pimpinan/logout.php">
                <i class="fas fa-fw fa-sign-out-alt" style="color: #0510a8"></i>
                <span style="color:  #0510a8">Logout</span></a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->