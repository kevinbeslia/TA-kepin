<?php 
  include ("style/header.php");
  include ("style/sidebarawal.php");
?>
<div class="container-fluid">
  <div class="col-lg-12">
    <!-- Basic Card Example -->
    <div class="card shadow mt-3 mb-3">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold" style="color: #0510a8">Periode Pengambilan Keputusan</h6>
      </div>
      <div class="card-body">
<?php 
  include ("../config/koneksi.php");
  if (isset($_POST['tambah'])) {
    $keterangan = $_POST['keterangan'];
    $tahun      = $_POST['tahun'];

    
    // Validasi 1: Menangani jika ada nama keterangan dan tanggal periode yang sama
    $checkDuplicateBoth = mysqli_query($konek, "SELECT * FROM tbl_periode WHERE keterangan = '$keterangan' AND periode = '$tahun'");
    if (mysqli_num_rows($checkDuplicateBoth) > 0) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
        Nama Keterangan dan Tanggal Periode Yang Sama Sudah Ada!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    // Validasi 2: Menangani jika ada nama keterangan Atau tanggal periode yang sama
    } elseif (mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_periode WHERE (keterangan = '$keterangan' OR periode = '$tahun')")) > 0) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
        Nama Keterangan Atau Tanggal Periode Yang Sama Sudah Ada!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
     } else {
        $save = mysqli_query($konek,"INSERT INTO tbl_periode VALUES('','$keterangan','$tahun')");
        if($save) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          Data Periode Pengambilan Keputusan Berhasil Ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Data Periode Pengambilan Keputusan Gagal Ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
      }
  }
?>

 <?php
       if (isset($_GET['delete_success'])) {
        if ($_GET['delete_success'] == 'true') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Periode Pengambilan Keputusan Berhasil Dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeDeleteSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Periode Pengambilan Keputusan Gagal Dihapus!!
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

// Menghitung jumlah total data periode
$totalData = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_periode"));

// Menghitung jumlah total halaman
$totalPages = ceil($totalData / $itemsPerPage);

// Mengambil nomor halaman dari parameter URL
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Menghitung offset untuk query database
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = mysqli_query($konek, "SELECT * FROM tbl_periode ORDER BY id_periode ASC LIMIT $offset, $itemsPerPage");
$no = $offset + 1;
?>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr align="center" style="background-color: #529dff; color: #ffff">
              <th>No</th>
              <th>Keterangan</th>
              <th colspan="3">Aksi</th>
            </tr>
          </thead>
          <?php 
            include("../config/koneksi.php");
            $no=1;
            $sql = mysqli_query($konek, "SELECT * FROM tbl_periode ORDER BY id_periode ASC");
            while($array = mysqli_fetch_assoc($sql)){
          ?>
          <tbody>
            <tr style="color: #355E3B" align="center">
              <td><?php echo $no++; ?></td>
              <td><?php echo $array['keterangan']; ?></td>
              <td><a href="proses/index.php?idp=<?php echo $array['id_periode'];?>"><i class="btn btn-info btn-sm"><span class="fas fa-search"></span></i></a></td>
            </tr>
          </tbody>
          <?php 
          } 
          ?>
        </table>

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
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control mb-2" name="keterangan" placeholder="Keterangan..." required="" autocomplete="off">
            <label>Tanggal Periode</label>
            <input type="date" class="form-control mb-2" name="tahun" placeholder="Tahun..." required="">
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
  include ("style/footer.php");
?>