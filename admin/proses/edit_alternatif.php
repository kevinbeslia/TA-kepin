<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
	include("../../config/koneksi.php");
	$id_alternatif = $_GET['id'];
	$idp = $_GET['idp'];
?>
<div class="container-fluid">
	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold " style="color: #355E3B">Edit Data Alternatif</h6>
		</div>
		<div class="card-body">
		<?php 
			$query = mysqli_query($konek,"SELECT * FROM tbl_alternatif where id_alternatif='$id_alternatif'")or die(mysqli_error());
			while($data = mysqli_fetch_array($query)){
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
			
				<label>Nama Nasabah</label>
      			<input type="text" class="form-control mb-2" name="nama" required="" value="<?php echo $data['nama']; ?>">

      			<label>Alamat</label>
      			<textarea class="form-control mb-2" name="alamat" required=""><?php echo $data['alamat'] ?></textarea>


	            <label>Status Kendaraan Diajukan</label>
            	<select class="form-control mb-2" name="status_kendaraan" required="">
    				<option value="Baru" <?php if($data['status_kendaraan'] == 'Baru'){echo 'selected="selected"';}?>>Baru</option>
    				<option value="Bekas" <?php if($data['status_kendaraan'] == 'Bekas'){echo 'selected="selected"';}?>>Bekas</option> 
	            </select>

	            <label>Nama Kendaraan Diajukan</label>
	            <input type="text" class="form-control mb-2" name="nama_kendaraan" required="" value="<?php echo $data['nama_kendaraan']; ?>">
	            
	           <label>Tenor</label>
            	<select class="form-control mb-2" name="tenor" required="">
    				<option value="12" <?php if($data['tenor'] == '12'){echo 'selected="selected"';}?>>12 Bulan</option>
    				<option value="18" <?php if($data['tenor'] == '18'){echo 'selected="selected"';}?>>18 Bulan</option> 
    				<option value="24" <?php if($data['tenor'] == '24'){echo 'selected="selected"';}?>>24 Bulan</option>
    				<option value="36" <?php if($data['tenor'] == '36'){echo 'selected="selected"';}?>>36 Bulan</option> 
    				<option value="48" <?php if($data['tenor'] == '48'){echo 'selected="selected"';}?>>48 Bulan</option>
    				<option value="60" <?php if($data['tenor'] == '60'){echo 'selected="selected"';}?>>60 Bulan</option> 
	            </select>
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
include ("../../config/koneksi.php");
if(isset($_POST['edit'])) {

	 $currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

	$nama 					= $_POST['nama'];
	$alamat 				= $_POST['alamat'];
	$status_kendaraan				= $_POST['status_kendaraan'];
	$nama_kendaraan 				= $_POST['nama_kendaraan'];
	$tenor			= $_POST['tenor'];


// Pengecekan jika nama alternatif baru edit sudah ada pada periode tersebut
    $checkDuplicate = mysqli_query($konek, "SELECT id_alternatif FROM tbl_alternatif WHERE nama = '$nama' AND id_periode = '$idp' AND id_alternatif <> '$id_alternatif'");
    
    if (mysqli_num_rows($checkDuplicate) > 0) {
        // Jika nama alternatif sudah ada, tampilkan pesan error
        echo "<script language=javascript>
                alert('Nama Alternatif Yang Di Edit Sudah Ada Pada Periode Ini.');
				window.location='data_alternatif.php?idp=$idp&page=$currentPage&edit_success=false';
              </script>";
        exit;
    }

	// Proses pengeditan jika melewati validasi
	$sql3 = mysqli_query($konek,"UPDATE tbl_alternatif SET nama = '$nama', alamat ='$alamat', status_kendaraan ='$status_kendaraan' , nama_kendaraan='$nama_kendaraan', tenor ='$tenor' WHERE id_alternatif ='$id_alternatif' AND id_periode = '$idp'"); // Eksekusi/ Jalankan 

	if($sql3) {
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

<?php 
    include ('style/footer.php');
?>