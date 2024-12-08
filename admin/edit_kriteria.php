<?php 
	include ("style/header.php");
	include ("style/sidebarawal.php");
	include ("../config/koneksi.php");
	$idk = $_GET['id'];
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header d-flex justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #355E3B; vertical-align: middle;">Edit Data Kriteria</h6>
				<a href="data_kriteria.php" class="btn btn-sm btn-danger"> < Kembali</a>
			</div>
			<div class="card-body">
				<?php 
					include ("../config/koneksi.php");					
					$qq = mysqli_query($konek, "SELECT * FROM tbl_kriteria WHERE id_kriteria = '$idk'");
					$dd = mysqli_fetch_assoc($qq);
				?>
				<form action="" method="POST">
					<input type="hidden" class="form-control" name="idk" value="<?php echo $dd['id_kriteria']; ?>" readonly="">
					<div class="form-group">
						<label>Nama Kriteria</label>
						<input type="text" class="form-control" name="nmk" readonly value="<?php echo $dd['nama_kriteria']; ?>">
					</div>
					<div class="form-group">
						<label>Jenis Kriteria</label>
						  <select name="jenis" class="form-control mb-2" required="">
             					 <option value="<?php echo $dd['jenis_kriteria']; ?>"><?php echo $dd['jenis_kriteria']; ?></option>
              					 <option value="Benefit">Benefit</option>
              					 <option value="Cost">Cost</option>
            			  </select>
					</div>
					<div class="form-group">
						<label>Bobot Preferensi</label>
						<input type="number" class="form-control" name="bobot" value="<?php echo $dd['bobot']; ?>" step="0.01" min="0" max="1">
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
    $idk = $_POST['idk'];
    $nmk = $_POST['nmk'];
    $jns = $_POST['jenis'];
    $bobot = $_POST['bobot'];

    // Mendapatkan total bobot dari semua kriteria, kecuali kriteria yang sedang di-edit
    $totalBobotQuery = mysqli_query($konek, "SELECT SUM(bobot) as total_bobot FROM tbl_kriteria WHERE id_kriteria <> '$idk'");
    $totalBobotResult = mysqli_fetch_assoc($totalBobotQuery);
    $totalBobot = $totalBobotResult['total_bobot'] + $bobot;

    // Validasi: Jika jumlah bobot lebih dari 1, tampilkan notifikasi
    if ($totalBobot > 1) {
        echo "<script language=javascript>
                alert('Jumlah Bobot Kriteria Tidak Boleh Melebihi 1!');
                window.location='data_kriteria.php?edit_success=false';
              </script>";
        exit;
    }

    // Validasi: Jika jumlah bobot kurang dari 1, tampilkan notifikasi
    if ($totalBobot < 1) {
        echo "<script language=javascript>
                alert('Jumlah Bobot Kriteria Masih Kurang Dari 1!');
                window.location='data_kriteria.php?edit_success=true';
              </script>";
        $update = mysqli_query($konek, "UPDATE tbl_kriteria SET nama_kriteria = '$nmk', jenis_kriteria = '$jns', bobot = '$bobot' WHERE id_kriteria = '$idk'");
        exit;
    }

	// Validasi: Jika jumlah bobot kurang dari 1, tampilkan notifikasi
    if ($totalBobot == 1) {
        $update = mysqli_query($konek, "UPDATE tbl_kriteria SET nama_kriteria = '$nmk', jenis_kriteria = '$jns', bobot = '$bobot' WHERE id_kriteria = '$idk'");
    }
    // Update data jika validasi berhasil
    $update = mysqli_query($konek, "UPDATE tbl_kriteria SET nama_kriteria = '$nmk', jenis_kriteria = '$jns', bobot = '$bobot' WHERE id_kriteria = '$idk'");
    
    if ($update) {
        echo "<script language=javascript>
                window.location='data_kriteria.php?edit_success=true';
              </script>";
    } else {
        echo "<script language=javascript>
                window.location='data_kriteria.php?edit_success=false';
              </script>";
    }
}

?>

<?php 
	include ("style/footer.php");
?>