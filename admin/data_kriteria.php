<?php
include("proses/style/header_kriteria.php");
include("proses/style/sidebar_kriteria.php");
// $idp = $_GET['idp'];
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$id_periode = $_GET['idp'];
?>
<?php
include("../config/koneksi.php");
if (isset($_POST['tambah'])) {
  $nama_kriteria = $_POST['nama_kriteria'];
  $jenis_kriteria = $_POST['jenis_kriteria'];
  $bobot = $_POST['bobot'];

  // Cek apakah kombinasi nama sub kriteria dan nilai bobot sudah ada
  $checkDuplicateQuery = "SELECT * FROM tbl_kriteria WHERE nama_kriteria = '$nama_kriteria' AND jenis_kriteria = '$jenis_kriteria' AND bobot = '$bobot'";
  $checkDuplicateResult = mysqli_query($konek, $checkDuplicateQuery);

  if (mysqli_num_rows($checkDuplicateResult) > 0) {
    // Jika sudah ada, tampilkan pesan kesalahan
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                Nama Kriteria dan Nilai Bobot Yang Sama Sudah Ada Pada Kriteria Tersebut!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
  } elseif (mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_kriteria WHERE nama_kriteria = '$nama_kriteria' AND (jenis_kriteria = '$jenis_kriteria' OR bobot = '$bobot')")) > 0) {
    // Jika nama sub kriteria sudah ada, tapi nilai bobot berbeda
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                Nama Kriteria atau Nilai Bobot Yang Sama Sudah Ada Pada Kriteria Tersebut!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
  } else {
    $totalBobotKriteria = mysqli_query($konek, "SELECT sum(bobot) AS total_bobot FROM tbl_kriteria WHERE id_periode = $id_periode");
    $totalBobotKriteria = mysqli_fetch_assoc($totalBobotKriteria);
    $sisabobot = 1 - $totalBobotKriteria['total_bobot'];
    if ($bobot > 1 - $sisabobot) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gagal menambahkan data kriteria! Bobot yang diinputkan melebihi batas, total bobot maksimal yaitu 1
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
      // Jika belum ada, lanjutkan dengan penyimpanan
      $save = mysqli_query($konek, "INSERT INTO tbl_kriteria (id_periode, nama_kriteria, jenis_kriteria, bobot) VALUES ($id_periode, '$nama_kriteria', '$jenis_kriteria', $bobot)");

      if ($save) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Data Kriteria Berhasil Ditambahkan!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Data Kriteria Gagal Ditambahkan!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
      }
    }
  }
}
?>

<div class="container-fluid">
  <div class="col-lg-12">
    <!-- Basic Card Example -->
    <div class="card shadow mt-3 mb-3">

      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color: #0510a8"><b>Data Kriteria</b>
      </div>
      <div class="card-body">
        <?php
        if (isset($_GET['edit_success'])) {
          if ($_GET['edit_success'] == 'true') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Kriteria Berhasil Diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Kriteria Gagal Diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          }
        }
        ?>

        <script>
          function removeEditSuccess() {
            // Mendapatkan URL saat ini
            var currentUrl = window.location.href;

            // Menghapus parameter edit_success dari URL
            var newUrl = currentUrl.replace(/(\?|&)edit_success=(true|false)/, '');

            // Mengarahkan pengguna kembali ke URL baru tanpa parameter edit_success
            window.location.href = newUrl;
          }
        </script>
        <button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#tambah_bank"><i class="fas fa-plus fa-sm"></i> Tambah Kriteria</button>
        <a href="sub_kriteria.php?idp=<?= $_GET['idp'] ?>" class="btn btn-sm btn-primary mb-3"> > Sub Kriteria</a>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr align="center" style="background-color: #529dff; color: #ffff">
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Jenis Kriteria</th>
                <th>Bobot Preferensi</th>
                <th colspan="2">Aksi</th>

              </tr>
            </thead>
            <?php
            include("../config/koneksi.php");
            $no = 1;
            $sql = mysqli_query($konek, "SELECT * FROM tbl_kriteria WHERE id_periode = $id_periode");
            $totalBobot = 0;

            while ($array = mysqli_fetch_assoc($sql)) {
              $totalBobot += $array['bobot'];
            ?>
              <tbody>
                <tr style="color: #355E3B" align="center">
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $array['nama_kriteria']; ?></td>
                  <td><?php echo $array['jenis_kriteria']; ?></td>
                  <td><?php echo $array['bobot']; ?></td>
                  <td>
                    <a href="edit_kriteria.php?idp=<?= $id_periode ?>&id=<?php echo $array['id_kriteria']; ?>"><i class="btn btn-info btn-sm"><span class="fas fa-edit"></span></i></a>
                  </td>
                  <td align="center">
                    <a href="hapus_kriteria.php?id=<?php echo $array['id_kriteria']; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-danger btn-sm" onclick="return confirm('Apakah Data Kriteria ini akan dihapus?')"><span class="fas fa-trash"></span></i></a>
                  </td>
                </tr>
              </tbody>
            <?php
            }
            if ($totalBobot < 1) {
              echo '<div class="alert alert-danger" role="alert">
						Jumlah Bobot Kriteria Kurang Dari 1. Silahkan Melengkapi Bobot Kriteria Lainnya Agar Berjumlah 1. Baru Melanjutkan Proses Penilaian !
			  			</div>';
            }
            ?>
          </table>
        </div>
        <!-- <div align="right">
	<a href="data_alternatif.php?&idp=<?php echo $idp; ?>" class="btn btn-danger">Back</a>
	<a href="data_penilaian.php?&idp=<?php echo $idp; ?>" class="btn btn-primary">Next</a>
</div> -->
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambah_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <input type="hidden" class="form-control mb-2" name="id_periode" value="<?= $_GET['idp'] ?>" required>
            <label for="sub kriteria">Nama Kriteria</label>
            <input type="text" class="form-control mb-2" name="nama_kriteria" placeholder="Kriteria" required="" autocomplete="off">
            <label for="sub kriteria">Jenis Kriteria</label>
            <select name="jenis_kriteria" id="" class="form-control mb-2" required="">
              <option value="" disabled selected>--Pilih Jenis Kriteria--</option>

              <option value="Benefit">Benefit</option>
              <option value="Cost">Cost</option>
            </select>
            <label for="sub kriteria">Bobot</label>
            <input type="number" class="form-control mb-2" name="bobot" step="0.01" min="0" max="1" required="" autocomplete="off">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
include("style/footer.php");
?>