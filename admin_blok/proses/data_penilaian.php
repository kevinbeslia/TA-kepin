<?php
include('../../config/koneksi.php');
include('style/header.php');
include('style/sidebar.php');

?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold" style="color: #0510a8"><b>Data Penilaian</b></h6>
		</div>
		<div class="card-body">
		<?php
include("../../config/koneksi.php");
if (isset($_POST['tambah'])) {
	$idp = $_GET['idp'];
	$ids = $_POST['ids'];

	// Periksa apakah nama alternatif penilaian sudah ada dalam periode
	$sqlcek = mysqli_query($konek,"SELECT * FROM tbl_penilaian WHERE id_alternatif = '$ids' AND id_periode = '$idp'");
	$cekquery = mysqli_num_rows($sqlcek);
	if ($cekquery > 0) {
		 echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
              Data Penilaian Alternatif Sudah Ada!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
	}else{
		$query2 = mysqli_query($konek, "SELECT * FROM tbl_kriteria");
		$rq2 = $query2->num_rows;
		for ($i = 1; $i <= $rq2; $i++) {
			$n = $_POST["k$i"];
			$save = mysqli_query($konek, "INSERT INTO tbl_penilaian (id_alternatif, id_periode, id_subkriteria) VALUES('$ids','$idp','$n')");
		}
		if ($save) {
			 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              Berhasil Menambahkan Data Penilaian Alternatif!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
		} else {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gagal Menambahkan Data Penilaian Alternatif!
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
                    Berhasil Mengedit Data Penilaian Alternatif!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal Mengedit Data Penilaian Alternatif!
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
                    Berhasil Menghapus Data Penilaian Alternatif!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeDeleteSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal Menghapus Data Penilaian Alternatif!
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

// Menghitung jumlah total data penilaian
$totalData = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM tbl_penilaian a JOIN tbl_alternatif b ON a.id_alternatif = b.id_alternatif WHERE a.id_periode = '$idp' GROUP BY a.id_alternatif"));

// Menghitung jumlah total halaman
$totalPages = ceil($totalData / $itemsPerPage);

// Mengambil nomor halaman dari parameter URL
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Menghitung offset untuk query database
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = mysqli_query($konek, "SELECT * FROM tbl_penilaian a JOIN tbl_alternatif b ON a.id_alternatif = b.id_alternatif WHERE a.id_periode = '$idp' GROUP BY a.id_alternatif LIMIT $offset, $itemsPerPage");
$no = $offset + 1;
?>

			<button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#tambah_pelanggan"><i class="fas fa-plus fa-sm"></i> Tambah Penilaian</button>

			<div class="table-responsive">
				<table class="table table-bordered" width="100%">
					<thead>
						<tr style="background-color: #529dff; color: #ffff" align="center">
							<th style="vertical-align: middle;">No</th>
							<th style="vertical-align: middle;">Nama Alternatif</th>
							<?php
							$sqlth = $konek->query("SELECT * FROM tbl_kriteria");
							while ($rowth = $sqlth->fetch_array()) {
							?>
								<th style="vertical-align: middle;"><?= $rowth['nama_kriteria']; ?></th>
							<?php
							}
							?>
							<th colspan="2" style="vertical-align: middle;">Aksi</th>
						</tr>
					</thead>
					<?php
					while ($data = mysqli_fetch_assoc($sql)) {
						$idalt = $data['id_alternatif'];
						$nmalt = $data['nama'];
						$idsub = $data['id_subkriteria'];
					?>
						<tbody>
							<tr align="center" style="color: #355E3B">
								<td style="vertical-align: middle;"><?= $no; ?></td>
								<td style="vertical-align: middle;"><?= $nmalt; ?></td>
								<?php
								$query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_alternatif = '$idalt' AND a.id_periode = '$idp'");
								while ($rowq2 = $query2->fetch_array()) {
								?>
									<td style="vertical-align: middle;">
										<?= $rowq2['nbobot']; ?></td>
								<?php
								}
								?>
								<td style="vertical-align: middle;">
									<a href="edit_penilaian.php?id=<?php echo $data['id_alternatif']; ?>&idp=<?php echo $idp; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-info btn-sm"><span class="fas fa-edit"></span></i></a>
								</td>

								<td style="vertical-align: middle;">
									<a href="hapus_penilaian.php?id=<?php echo $data['id_alternatif']; ?>&idp=<?php echo $idp; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-danger btn-sm" onclick="return confirm('Apakah Data Penilaian Alternatif ini akan dihapus?')"><span class="fas fa-trash"></span></i></a>
								</td>
							</tr>
						</tbody>
					<?php
						$no++;
					}
					?>
				</table>
			</div>
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
				<a href="data_alternatif.php?&idp=<?php echo $idp; ?>" class="btn btn-danger">Alternatif</a>
				<a href="data_normalisasi.php?&idp=<?php echo $idp; ?>" class="btn btn-primary">Normalisasi</a>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_pelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Penilaian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<!-- ID -->
						<label>Alternatif</label>
						<select name="ids" class="form-control mb-2" required>
							<option value="" disabled selected>---Pilih Alternatif---</option>
							<?php
							$mysqli = mysqli_query($konek, "SELECT * FROM tbl_alternatif where id_periode = '$idp'");
							while ($fetch = mysqli_fetch_assoc($mysqli)) {
							?>
								<option value="<?php echo $fetch['id_alternatif']; ?>"><?php echo $fetch['nama']; ?></option>
							<?php
							}
							?>
						</select>
						<!-- Loop -->
						<?php
						$c = 1;
						$x = 1;
						$sqlnilai = $konek->query("SELECT * FROM tbl_kriteria");
						while ($rownilai = $sqlnilai->fetch_array()) {
						?>
							<label><?php echo $rownilai['nama_kriteria']; ?> (C<?= $c++; ?>)</label>
							<select name="k<?= $x; ?>" class="form-control mb-2" required>
								<option value="" disabled selected>---Pilih Nilai--- </option>
								<?php
								$sqlsubs = $konek->query("SELECT * FROM tbl_subkriteria WHERE id_kriteria = '$rownilai[id_kriteria]' ORDER BY nbobot DESC");
								while ($rowsubs = $sqlsubs->fetch_array()) {
								?>
									<option value="<?= $rowsubs['id_subkriteria']; ?>"><?= $rowsubs['ket']; ?></option>
								<?php
								}
								?>
							</select>
						<?php
							$x++;
						}
						?>

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
include('style/footer.php');
?>