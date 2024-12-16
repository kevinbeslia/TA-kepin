<?php
include('style/header.php');
include('style/sidebar.php');
include("../../config/koneksi.php");
$ids = $_GET['id'];
$idp = $_GET['idp'];
$sqlcek = mysqli_query($konek, "SELECT * FROM tbl_alternatif a WHERE id_alternatif = '$ids'");
$data = mysqli_fetch_array($sqlcek);

?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold" style="color: #355E3B">Edit Data Penilaian <?php echo $data['nama']; ?></h6>
		</div>
		<div class="card-body">
			<?php
			$query = mysqli_query($konek, "SELECT * FROM tbl_penilaian WHERE id_alternatif='$ids'");
			// while($data = mysqli_fetch_array($query)){
			?>
			<form action="" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="ids" value="<?php echo $ids; ?>">
				<div class="form-group">
					<input type="hidden" name="ids" value="<?php echo $ids; ?>">

					<!-- Loop -->
					<?php
					$c = 1;
					$x = 1;
					$sqlnilai = $konek->query("SELECT * FROM tbl_kriteria WHERE id_periode = $idp");
					while ($rownilai = $sqlnilai->fetch_array()) {
					?>
						<label><?php echo $rownilai['nama_kriteria']; ?> (C<?= $c++; ?>)</label>
						<?php
						$sqlp = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE b.id_kriteria = '$rownilai[id_kriteria]' AND a.id_alternatif = '$ids'");
						while ($rowp = $sqlp->fetch_array()) {
						?>
							<select name="k<?= $x; ?>" class="form-control mb-2" required>
								<option value="<?= $rowp['id_subkriteria'] ?>">-- <?= $rowp['ket'] ?> --</option>
							<?php
						}
							?>
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
			<button type="submit" name="edit" class="btn btn-success btn-sm">Edit</button>
		</div>
		</form>
	</div>
	<?php
	// }
	?>
</div>
</div>


<?php
include("../../config/koneksi.php");

if (isset($_POST['edit'])) {



	$currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

	$query2 = mysqli_query($konek, "SELECT * FROM tbl_kriteria WHERE id_periode = $idp");
	$rq2 = $query2->num_rows;
	for ($i = 1; $i <= $rq2; $i++) {
		$sqlceknilai = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE b.id_kriteria = '$i' AND a.id_alternatif = '$ids'");
		$rowceknilai = $sqlceknilai->fetch_array();
		$id_sub = $rowceknilai['id_subkriteria'];

		$n = $_POST["k$i"];
		$sqledit = mysqli_query($konek, "UPDATE tbl_penilaian SET id_subkriteria = '$n' WHERE id_subkriteria ='$id_sub' AND id_alternatif = '$ids' AND id_periode = '$idp'");

		// Eksekusi/ Jalankan query dari variabel $query
		echo "<script>
		 window.location='data_penilaian.php?idp=$idp&page=$currentPage&edit_success=true';
		 </script>";
	}
}


?>

<?php
include('style/footer.php');
?>