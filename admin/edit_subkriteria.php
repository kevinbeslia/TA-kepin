<?php 
	include ("style/header.php");
	include ("style/sidebarawal.php");
	include ("../config/koneksi.php");
	$id_subkriteria = $_GET['id'];
	
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-4">
			<div class="col card-header d-flex justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #355E3B; vertical-align: middle;">Edit Data Sub Kriteria</h6>
				<a href="sub_kriteria.php" class="btn btn-sm btn-danger"> < Kembali</a>
			</div>
			<div class="card-body">
			
				<?php 
					include ("../config/koneksi.php");					
					$qq = mysqli_query($konek, "SELECT * FROM tbl_subkriteria a LEFT JOIN tbl_kriteria b ON a.id_kriteria = b.id_kriteria WHERE id_subkriteria = '$id_subkriteria'");
					$dd = mysqli_fetch_assoc($qq);
				?>
				<form action="" method="POST">
					<input type="hidden" class="form-control" name="idk" value="<?php echo $dd['id_subkriteria']; ?>" readonly="">
					<div class="form-group">
						<label>Nama Kriteria</label>
							<select name="id_kriteria" class="form-control" disabled="true" required>
                    		<option value="<?php echo $dd['id_kriteria']; ?>"><?php echo $dd['nama_kriteria']; ?></option>
               			 <?php 
                    		include("../config/koneksi.php");
                      		$sqlkriteria = mysqli_query($konek,"SELECT * FROM tbl_kriteria WHERE nama_kriteria");
                      		while ($row = mysqli_fetch_array($sqlkriteria)) {
                        ?>
                        	
                        <?php
                      }
                       ?>
                    </select>
						
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<input type="text" class="form-control" name="ket" value="<?php echo $dd['ket']; ?>">
					</div>
					<div class="form-group">
						<label>Bobot</label>
						<input type="number" class="form-control" name="nbobot" value="<?php echo $dd['nbobot']; ?>" step="0.01" min="0" max="1">
					</div>
					<div class="form-group text-right">
						<button type="reset" name="reset" class="btn btn-md btn-secondary">Reset</button>
						<button type="submit" name="edit" class="btn btn-md btn-success">Edit</button> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
include ('../config/koneksi.php');
if (isset($_POST['edit'])) {
		$currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

		$ket = $_POST['ket'];
		$nbobot = $_POST['nbobot'];

		// Validasi nama sub kriteria dan nilai bobot
		$checkQuery = mysqli_query($konek, "SELECT id_subkriteria FROM tbl_subkriteria WHERE id_kriteria = (SELECT id_kriteria FROM tbl_subkriteria WHERE id_subkriteria = '$id_subkriteria') AND ket = '$ket' AND nbobot = '$nbobot' AND id_subkriteria != '$id_subkriteria'");
		if (mysqli_num_rows($checkQuery) > 0) {
			echo "<script language=javascript>
            alert('Nama & Nilai Bobot Sub Kriteria Yang Di Edit Sudah Ada Pada Kriteria Ini!');
            window.location='sub_kriteria.php?page=$currentPage&edit_success=false';
            </script>";
            exit();
		}

		// Validasi nama sub kriteria atau nilai bobot
		$checkQuery = mysqli_query($konek, "SELECT id_subkriteria FROM tbl_subkriteria WHERE id_kriteria = (SELECT id_kriteria FROM tbl_subkriteria WHERE id_subkriteria = '$id_subkriteria') AND (ket = '$ket' OR nbobot = '$nbobot') AND id_subkriteria != '$id_subkriteria'");

		if (mysqli_num_rows($checkQuery) > 0) {
    		echo "<script language=javascript>
            alert('Nama Sub Kriteria atau Nilai Bobot Yang Di Edit Sudah Ada Pada Kriteria Ini!');
            window.location='sub_kriteria.php?page=$currentPage&edit_success=false';
          	</script>";
    		exit();
		}

		// Proses pengeditan jika melewati validasi
		$update = mysqli_query($konek, "UPDATE tbl_subkriteria SET ket = '$ket', nbobot = '$nbobot' WHERE id_subkriteria = '$id_subkriteria'");
		if ($update) {
			echo "<script language=javascript>
				window.location='sub_kriteria.php?page=$currentPage&edit_success=true';
				</script>";
		} else {
			echo "<script language=javascript>
				window.location='sub_kriteria.php?page=$currentPage&edit_success=false';
				</script>";
		}
	}
?>

<?php 
	include ("style/footer.php");
?>