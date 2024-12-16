<?php
include("proses/style/header_kriteria.php");
include("proses/style/sidebar_kriteria.php");
$idp = $_GET['idp'];
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">

			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color: #0510a8">Data Kriteria</h6>
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
				<a href="sub_kriteria.php?idp=<?= $_GET['idp'] ?>" class="btn btn-sm btn-success mb-3"> > Sub Kriteria</a>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr align="center" style="background-color: #529dff; color: #ffff">
								<th>No</th>
								<th>Nama Kriteria</th>
								<th>Jenis Kriteria</th>
								<th>Bobot Preferensi</th>

							</tr>
						</thead>
						<?php
						include("../config/koneksi.php");
						$id_periode = $_GET['idp'];
						$no = 1;
						$sql = mysqli_query($konek, "SELECT * FROM tbl_kriteria WHERE id_periode = $idp");
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

<?php
include("style/footer.php");
?>