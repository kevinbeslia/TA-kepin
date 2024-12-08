<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
      $idp = $_GET['idp'];



?>
<div class="container-fluid">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color: #0510a8"><b>Data Alternatif</b></h6>
			</div>
			<div class="card-body">
        <?php 
  include ("../../config/koneksi.php");
  if (isset($_POST['tambah'])) {
    $id_alternatif          = $_POST['id_alternatif'];
    $nama                   = $_POST['nama'];
    $tanggal_lahir          = $_POST['tanggal_lahir'];
    $jenis_kelamin          = $_POST['jenis_kelamin'];
    $jenis_kejahatan        = $_POST['jenis_kejahatan'];
    $tanggal_mulai_ditahan  = $_POST['tanggal_mulai_ditahan'];
    $id_blok  = $_SESSION['id_blok'];
    $id_periode  = $idp;

    // Periksa apakah nama alternatif sudah ada dalam periode
    $checkDuplicate = mysqli_query($konek, "SELECT * FROM tbl_alternatif WHERE id_alternatif='$id_alternatif' AND id_periode='$id_periode'");
    
    if (mysqli_num_rows($checkDuplicate) > 0) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                Nama Alternatif Yang Sama Sudah Ada Dalam Periode Ini!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
        // Lanjutkan dengan penambahan data
        $save = mysqli_query($konek, "INSERT INTO tbl_alternatif VALUES('$id_alternatif', '$nama', '$tanggal_lahir', '$jenis_kelamin', '$jenis_kejahatan', '$tanggal_mulai_ditahan', '$id_blok','$id_periode')");
        
        if ($save) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Alternatif Berhasil Ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Alternatif Gagal Ditambahkan!
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
                    Data Alternatif Berhasil Diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Alternatif Gagal Diedit!
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
                    Data Alternatif Berhasil Dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeDeleteSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Alternatif Gagal Dihapus!!
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
$itemsPerPage = 10;

// Menghitung jumlah total data alternatif
$totalData = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_alternatif WHERE id_periode = '$idp'"));

// Menghitung jumlah total halaman
$totalPages = ceil($totalData / $itemsPerPage);

// Mengambil nomor halaman dari parameter URL
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Menghitung offset untuk query database
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = mysqli_query($konek, "SELECT * FROM tbl_alternatif WHERE id_periode = '$idp' LIMIT $offset, $itemsPerPage");
$no = $offset + 1;

?>
				<button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#tambah_mobil"><i class="fas fa-plus fa-sm"></i> Tambah Data</button>
 
     	 		<div class="table-responsive">
				<table class="table table-bordered" width="100%">
					<thead>
						<tr style="background-color: #529dff; color: #ffff" align="center">
							<th>No</th>
                            <th>No Registrasi Instansi</th>
							<th>Nama Narapidana</th>
							<th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
							<th>Jenis Kejahatan</th>
                            <th>Tanggal Mulai Ditahan</th>
							<th colspan="2">Aksi</th>
						</tr>
					</thead>
					<?php 
						while($array = mysqli_fetch_assoc($sql)){
					?>
					<tbody>
						<tr align="center" style="color: #355E3B">
							<td><?php echo $no++; ?></td>
                            <td><?php echo $array['id_alternatif']; ?></td>
							<td><?php echo $array['nama']; ?></td>
							<td><?php 
                            $tanggal_lahir = new DateTime( $array['tanggal_lahir']);
                            echo $tanggal_lahir->format('d-m-Y '); // Output: 2024-07-16 12:34:56
                            ?></td>
                            <td><?php echo $array['jenis_kelamin']; ?></td>
							<td><?php echo $array['jenis_kejahatan']; ?></td>
                            <td><?php 
                            $tanggal_mulai_ditahan = new DateTime( $array['tanggal_mulai_ditahan']);
                            echo $tanggal_mulai_ditahan->format('d-m-Y ');
                             ?></td>
             

							<td>
								<a href="edit_alternatif.php?id=<?php echo $array['id_alternatif']; ?>&idp=<?php echo $idp; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-info btn-sm"><span class="fas fa-edit"></span></i></a>
							</td>
							<td>
								<a href="hapus_alternatif.php?id=<?php echo $array['id_alternatif']; ?>&idp=<?php echo $idp; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-danger btn-sm" onclick="return confirm('Apakah Data Alternatif ini akan dihapus?')"><span class="fas fa-trash"></span></i></a>
							</td>
						</tr>
					</tbody>
					<?php 
					} 
					?>
				</table>
      		</div>

         <!-- Pagination -->
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-end">
                    <?php
                    for ($page = 1; $page <= $totalPages; $page++) {
                        echo '<li class="page-item ' . ($page === $currentPage ? 'active' : '') . '">
                                <a class="page-link" href="?idp=' . $idp . '&page=' . $page . '">' . $page . '</a>
                            </li>';
                    }
                    ?>
                </ul>
            </nav>
			<div align="right">
	<a href="data_penilaian.php?&idp=<?php echo $idp; ?>" class="btn btn-primary">Penilaian</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Alternatif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
           
           <label>No Registrasi Instansi</label>
                <input type="text" class="form-control mb-2" name="id_alternatif" placeholder="No Registrasi Instansi" required="" autocomplete="off">

            <label>Nama Narapidana</label>
      			<input type="text" class="form-control mb-2" name="nama" placeholder="Nama Narapidana" required="" autocomplete="off">

           	<label>Tanggal Lahir</label>
            <input type="date" class="form-control mb-2" name="tanggal_lahir"  required="" autocomplete="off">

            <label>Jenis Kelamin</label>
            <select class="form-control mb-2" name="jenis_kelamin" required="">
              <option value="" disabled selected>--- Jenis Kelamin ---</option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>

           <label>Jenis Kejahatan</label>
            <select class="form-control mb-2" name="jenis_kejahatan" required="">
              <option value="" disabled selected>--- Jenis Kejahatan ---</option>
              <option value="Kekerasan dalam Rumah Tangga">Kekerasan dalam Rumah Tangga</option>
              <option value="Kesusilaan">Kesusilaan</option>
              <option value="Korupsi">Korupsi</option>
              <option value="Memeras/Mengancam">Memeras/Mengancam</option>
              <option value="Narkotika">Narkotika</option>
              <option value="Pelanggaran Lalu Lintas">Pelanggaran Lalu Lintas</option>
              <option value="Pencurian">Pencurian</option>
              <option value="Penggelapan">Penggelapan</option>
              <option value="Penipuan">Penipuan</option>
              <option value="Perampokan">Perampokan</option>
              <option value="Perlindungan Anak">Perlindungan Anak</option>
            </select>

            <label>Tanggal Mulai Ditahan</label>
            <input type="date" class="form-control mb-2" name="tanggal_mulai_ditahan"  required="" autocomplete="off">
            
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