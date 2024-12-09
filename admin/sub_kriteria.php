<?php
include("proses/style/header.php");
include("proses/style/sidebar.php");
?>

<div class="container-fluid">
  <div class="col-lg-12">
    <!-- Basic Card Example -->
    <div class="card shadow mt-3 mb-3">

      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color: #0510a8"><b>Data Sub Kriteria</b>
      </div>
      <div class="card-body">
        <?php
        include("../config/koneksi.php");
        if (isset($_POST['tambah'])) {
          $id_kriteria = $_POST['id_kriteria'];
          $ket = $_POST['ket'];
          $nbobot = $_POST['nbobot'];

          // Cek apakah kombinasi nama sub kriteria dan nilai bobot sudah ada
          $checkDuplicateQuery = "SELECT * FROM tbl_subkriteria WHERE id_kriteria = '$id_kriteria' AND ket = '$ket' AND nbobot = '$nbobot'";
          $checkDuplicateResult = mysqli_query($konek, $checkDuplicateQuery);

          if (mysqli_num_rows($checkDuplicateResult) > 0) {
            // Jika sudah ada, tampilkan pesan kesalahan
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                Nama Sub Kriteria dan Nilai Bobot Yang Sama Sudah Ada Pada Kriteria Tersebut!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
          } elseif (mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_subkriteria WHERE id_kriteria = '$id_kriteria' AND (ket = '$ket' OR nbobot = '$nbobot')")) > 0) {
            // Jika nama sub kriteria sudah ada, tapi nilai bobot berbeda
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                Nama Sub Kriteria atau Nilai Bobot Yang Sama Sudah Ada Pada Kriteria Tersebut!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
          } else {
            // Jika belum ada, lanjutkan dengan penyimpanan
            $save = mysqli_query($konek, "INSERT INTO tbl_subkriteria VALUES ('', '$id_kriteria', '$ket', '$nbobot')");

            if ($save) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Sub Kriteria Berhasil Ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            } else {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Sub Kriteria Gagal Ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            }
          }
        }
        ?>

        <?php
        if (isset($_GET['edit_success'])) {
          if ($_GET['edit_success'] == 'true') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Sub Kriteria Berhasil Diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Sub Kriteria Gagal Diedit!
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

        <?php
        if (isset($_GET['delete_success'])) {
          if ($_GET['delete_success'] == 'true') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Sub Kriteria Berhasil Dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeDeleteSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Sub Kriteria Gagal Dihapus!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeDeleteSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          }
        }
        ?>

        <script>
          function removeDeleteSuccess() {
            // Mendapatkan URL saat ini
            var currentUrl = window.location.href;

            // Menghapus parameter edit_success dari URL
            var newUrl = currentUrl.replace(/(\?|&)delete_success=(true|false)/, '');

            // Mengarahkan pengguna kembali ke URL baru tanpa parameter edit_success
            window.location.href = newUrl;
          }
        </script>

        <?php
        // Jumlah data per halaman
        $itemsPerPage = 8;

        // Menghitung jumlah total data sub kriteria
        $totalData = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_subkriteria"));

        // Menghitung jumlah total halaman
        $totalPages = ceil($totalData / $itemsPerPage);

        // Mengambil nomor halaman dari parameter URL
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Menghitung offset untuk query database
        $offset = ($currentPage - 1) * $itemsPerPage;

        $sql = mysqli_query($konek, "SELECT * FROM tbl_subkriteria a LEFT JOIN tbl_kriteria b ON a.id_kriteria = b.id_kriteria ORDER BY a.id_kriteria ASC, nbobot DESC LIMIT $offset, $itemsPerPage");
        $no = $offset + 1;
        ?>
        <button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#tambah_bank"><i class="fas fa-plus fa-sm"></i> Tambah Sub Kriteria</button>
        <a href="data_kriteria.php?idp=<?= $_GET['idp'] ?>" class="btn btn-sm btn-primary mb-3">
          < Kriteria</a>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr align="center" style="background-color: #529dff; color: #ffff">
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Sub Kriteria</th>
                    <th>Nilai Bobot</th>
                    <th colspan="2">Aksi</th>
                  </tr>
                </thead>
                <?php
                while ($array = mysqli_fetch_assoc($sql)) {
                ?>
                  <tbody>
                    <tr style="color: #355E3B">
                      <td align="center"><?php echo $no++; ?></td>
                      <td align="center"><?php echo $array['nama_kriteria']; ?></td>
                      <td><?php echo $array['ket']; ?></td>
                      <td align="center"><?php echo $array['nbobot']; ?></td>
                      <td align="center">
                        <a href="edit_subkriteria.php?id=<?php echo $array['id_subkriteria']; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-info btn-sm"><span class="fas fa-edit"></span></i></a>
                      </td>

                      <td align="center">
                        <a href="hapus_subkriteria.php?id=<?php echo $array['id_subkriteria']; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-danger btn-sm" onclick="return confirm('Apakah Data Sub Kriteria ini akan dihapus?')"><span class="fas fa-trash"></span></i></a>
                      </td>
                    </tr>
                  </tbody>
                <?php
                }
                ?>
              </table>
              <!-- Pagination Links -->
              <nav aria-label="Pagination">
                <ul class="pagination justify-content-end">
                  <?php
                  for ($page = 1; $page <= $totalPages; $page++) {
                    echo '<li class="page-item ' . ($page === $currentPage ? 'active' : '') . '">
            <a class="page-link" href="?page=' . $page . '">' . $page . '</a>
          </li>';
                  }
                  ?>
                </ul>
              </nav>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Sub Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <!-- <input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>"> -->
            <label for="sub kriteria">Nama Kriteria</label>
            <select name="id_kriteria" id="" class="form-control" required="">
              <option value="" disabled selected>--Pilih Kriteria--</option>
              <?php
              include("../config/koneksi.php");
              $sqlkriteria = mysqli_query($konek, "SELECT * FROM tbl_kriteria");
              while ($row = mysqli_fetch_array($sqlkriteria)) {
              ?>
                <option value="<?php echo $row['id_kriteria'] ?>"><?php echo $row['nama_kriteria']; ?></option>
              <?php
              }
              ?>
            </select>

            <label>Nama Sub Kriteria</label>
            <input type="text" class="form-control mb-2" name="ket" placeholder="Sub Kriteria" required="" autocomplete="off">

            <label>Nilai Bobot</label>
            <input type="number" name="nbobot" class="form-control mb-2" placeholder="Nilai Bobot" autocomplete="off" step="0.01" min="0" max="1" required="">
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