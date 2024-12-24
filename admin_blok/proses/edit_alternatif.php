<?php
include('style/header.php');
include('style/sidebar.php');
include("../../config/koneksi.php");
$id_alternatif = $_GET['id'];
$idp = $_GET['idp'];
?>
<?php
include("../../config/koneksi.php");
if (isset($_POST['edit'])) {
  $currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);
  $id_alternatif          = $_POST['id_alternatif'];
  $nama                   = $_POST['nama'];
  $tanggal_lahir          = $_POST['tanggal_lahir'];
  $jenis_kelamin          = $_POST['jenis_kelamin'];
  $jenis_kejahatan        = $_POST['jenis_kejahatan'];
  $tanggal_mulai_ditahan  = $_POST['tanggal_mulai_ditahan'];
  $id_blok  = $_SESSION['id_blok'];
  $id_periode  = $idp;

  if ($_POST['tahun'] == '0') {
    $lama_pidana = $_POST['bulan'] . ' bulan';
  } elseif ($_POST['bulan'] == '0') {
    $lama_pidana = $_POST['tahun'] . ' tahun';
  } else {
    $lama_pidana = $_POST['tahun'] . ' tahun ' . $_POST['bulan'] . ' bulan';
  }

  // Proses pengeditan jika melewati validasi
  $sql3 = mysqli_query($konek, "UPDATE tbl_alternatif SET nama = '$nama', tanggal_lahir ='$tanggal_lahir', jenis_kelamin ='$jenis_kelamin' , jenis_kejahatan='$jenis_kejahatan', tanggal_mulai_ditahan ='$tanggal_mulai_ditahan', lama_pidana ='$lama_pidana' WHERE id_alternatif ='$id_alternatif'"); // Eksekusi/ Jalankan 

  if ($sql3) {
    echo "<script language=javascript>
            window.location='data_alternatif.php?idp=$idp&page=$currentPage&edit_success=true';
            </script>";
  } else {
    echo "<script language=javascript>
            window.location='data_alternatif.php?idp=$idp&page=$currentPage&edit_success=false';
            </script>";
  }
}
?>
<script>
  function validateForm() {
    const years = document.getElementById('years').value;
    const months = document.getElementById('months').value;

    if (!years && !months) {
      alert('Anda harus mengisi salah satu dari Tahun atau Bulan Lama Pidana.');
      return false;
    }
    if ((years == 0) && (months == 0)) {
      alert('Anda harus mengisi salah satu dari Tahun atau Bulan Lama Pidana.');
      return false;
    }

    if (months && (months < 0 || months > 11)) {
      alert('Bulan harus di antara 0 hingga 11.');
      return false;
    }

    return true;
  }
</script>
<div class="container-fluid">
  <!-- Basic Card Example -->
  <div class="card shadow mt-3 mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold " style="color: #355E3B">Edit Data Alternatif</h6>
    </div>
    <div class="card-body">
      <?php
      $query = mysqli_query($konek, "SELECT * FROM tbl_alternatif where id_alternatif='$id_alternatif'") or die(mysqli_error());
      while ($data = mysqli_fetch_array($query)) {
      ?>
        <form action="" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
          <div class="form-group">

            <input type="hidden" class="form-control mb-2" name="id_alternatif" placeholder="No Registrasi Instansi" required="" autocomplete="off" value="<?php echo $data['id_alternatif']; ?>">

            <label>Nama Narapidana</label>
            <input type="text" class="form-control mb-2" name="nama" placeholder="Nama Narapidana" required="" autocomplete="off" value="<?php echo $data['nama']; ?>">

            <label>Tanggal Lahir</label>
            <input type="date" class="form-control mb-2" name="tanggal_lahir" required="" autocomplete="off" value="<?php echo $data['tanggal_lahir']; ?>">

            <label>Jenis Kelamin</label>
            <select class="form-control mb-2" name="jenis_kelamin" required="">
              <option value="Laki-Laki" <?php if ($data['jenis_kelamin'] == 'Laki-Laki') {
                                          echo "selected";
                                        } ?>>Laki-Laki</option>
              <option value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') {
                                          echo "selected";
                                        } ?>>Perempuan</option>
            </select>

            <label>Jenis Kejahatan</label>
            <select class="form-control mb-2" name="jenis_kejahatan" required="">
              <option value="" disabled selected>--- Jenis Kejahatan ---</option>
              <option value="Kekerasan dalam Rumah Tangga" <?php if ($data['jenis_kejahatan'] == 'Kekerasan dalam Rumah Tangga') {
                                                              echo "selected";
                                                            } ?>>Kekerasan dalam Rumah Tangga</option>

              <option value="Kesusilaan" <?php if ($data['jenis_kejahatan'] == 'Kesusilaan') {
                                            echo "selected";
                                          } ?>>Kesusilaan</option>
              <option value="Korupsi" <?php if ($data['jenis_kejahatan'] == 'Korupsi') {
                                        echo "selected";
                                      } ?>>Korupsi</option>

              <option value="Memeras/Mengancam" <?php if ($data['jenis_kejahatan'] == 'Memeras/Mengancam') {
                                                  echo "selected";
                                                } ?>>Memeras/Mengancam</option>

              <option value="Pelanggaran Lalu Lintas" <?php if ($data['jenis_kejahatan'] == 'Pelanggaran Lalu Lintas') {
                                                        echo "selected";
                                                      } ?>>Pelanggaran Lalu Lintas</option>

              <option value="Pencurian" <?php if ($data['jenis_kejahatan'] == 'Pencurian') {
                                          echo "selected";
                                        } ?>>Pencurian</option>

              <option value="Penggelapan" <?php if ($data['jenis_kejahatan'] == 'Penggelapan') {
                                            echo "selected";
                                          } ?>>Penggelapan</option>
              <option value="Penipuan" <?php if ($data['jenis_kejahatan'] == 'Penipuan') {
                                          echo "selected";
                                        } ?>>Penipuan</option>
              <option value="Narkotika" <?php if ($data['jenis_kejahatan'] == 'Narkotika') {
                                          echo "selected";
                                        } ?>>Narkotika</option>

              <option value="Perampokan" <?php if ($data['jenis_kejahatan'] == 'Perampokan') {
                                            echo "selected";
                                          } ?>>Perampokan</option>
              <option value="Perlindungan Anak" <?php if ($data['jenis_kejahatan'] == 'Perlindungan Anak') {
                                                  echo "selected";
                                                } ?>>Perlindungan Anak</option>
            </select>

            <label>Tanggal Mulai Ditahan</label>
            <input type="date" class="form-control mb-2" name="tanggal_mulai_ditahan" required="" autocomplete="off" value="<?php echo $data['tanggal_mulai_ditahan']; ?>">
            <?php
            $years = 0;
            $months = 0;

            if (preg_match('/(\d+)\s*tahun/i', $data['lama_pidana'], $matches)) {
              $years = (int)$matches[1];
            }

            if (preg_match('/(\d+)\s*bulan/i', $data['lama_pidana'], $matches)) {
              $months = (int)$matches[1];
            }
            ?>
            <label>Lama Pidana</label>
            <div class="row g-3 align-items-center">
              <div class="col-md-3">
                <div class="input-group">
                  <input type="number" id="years" name="tahun" min="0" class="form-control" placeholder="0" value="<?= ($years != 0) ? $years : '0' ?>">
                  <span class="input-group-text">Tahun</span>
                </div>
              </div>
              <div class="col-md-3">
                <div class="input-group">
                  <input type="number" id="months" name="bulan" min="0" max="11" class="form-control" placeholder="0" value="<?= ($months != 0) ? $months : '0' ?>">
                  <span class="input-group-text">Bulan</span>
                </div>
              </div>
            </div>
          </div>
    </div>

    <div class="modal-footer">
      <button type="submit" name="edit" class="btn btn-success btn-sm">Edit</button>
    </div>
    </form>
  <?php
      }
  ?>
  </div>
</div>



<?php
include('style/footer.php');
?>