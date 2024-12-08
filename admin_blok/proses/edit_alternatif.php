<?php 
    include ('style/header.php');
    include ('style/sidebar.php');
	include("../../config/koneksi.php");
	$id_alternatif = $_GET['id'];
	$idp = $_GET['idp'];
?> 
<?php
include ("../../config/koneksi.php");
if(isset($_POST['edit'])) {
	$currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);
	$id_alternatif          = $_POST['id_alternatif'];
    $nama                   = $_POST['nama'];
    $tanggal_lahir          = $_POST['tanggal_lahir'];
    $jenis_kelamin          = $_POST['jenis_kelamin'];
    $jenis_kejahatan        = $_POST['jenis_kejahatan'];
    $tanggal_mulai_ditahan  = $_POST['tanggal_mulai_ditahan'];
    $id_blok  = $_SESSION['id_blok'];
    $id_periode  = $idp;


	// Proses pengeditan jika melewati validasi
	$sql3 = mysqli_query($konek,"UPDATE tbl_alternatif SET nama = '$nama', tanggal_lahir ='$tanggal_lahir', jenis_kelamin ='$jenis_kelamin' , jenis_kejahatan='$jenis_kejahatan', tanggal_mulai_ditahan ='$tanggal_mulai_ditahan' WHERE id_alternatif ='$id_alternatif'"); // Eksekusi/ Jalankan 

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
           
                <input type="hidden" class="form-control mb-2" name="id_alternatif" placeholder="No Registrasi Instansi" required="" autocomplete="off" value="<?php echo $data['id_alternatif'];?>">

            <label>Nama Narapidana</label>
      			<input type="text" class="form-control mb-2" name="nama" placeholder="Nama Narapidana" required="" autocomplete="off"value="<?php echo $data['nama'];?>"> 

           	<label>Tanggal Lahir</label>
            <input type="date" class="form-control mb-2" name="tanggal_lahir"  required="" autocomplete="off"value="<?php echo $data['tanggal_lahir'];?>">

            <label>Jenis Kelamin</label>
            <select class="form-control mb-2" name="jenis_kelamin" required="">
              <option value="Laki-Laki" <?php if ($data['jenis_kelamin']=='Laki-Laki') {echo "selected";}?> >Laki-Laki</option>
              <option value="Perempuan"<?php if ($data['jenis_kelamin']=='Perempuan') {echo "selected";}?>>Perempuan</option>
            </select>

           <label>Jenis Kejahatan</label>
            <select class="form-control mb-2" name="jenis_kejahatan" required="">
              <option value="" disabled selected>--- Jenis Kejahatan ---</option>
              <option value="Kekerasan dalam Rumah Tangga"<?php if ($data['jenis_kejahatan']=='Kekerasan dalam Rumah Tangga') {echo "selected";}?>>Kekerasan dalam Rumah Tangga</option>

              <option value="Kesusilaan"<?php if ($data['jenis_kejahatan']=='Kesusilaan') {echo "selected";}?>>Kesusilaan</option>
              <option value="Korupsi"<?php if ($data['jenis_kejahatan']=='Korupsi') {echo "selected";}?>>Korupsi</option>

              <option value="Memeras/Mengancam"<?php if ($data['jenis_kejahatan']=='Memeras/Mengancam') {echo "selected";}?>>Memeras/Mengancam</option>

              <option value="Pelanggaran Lalu Lintas"<?php if ($data['jenis_kejahatan']=='Pelanggaran Lalu Lintas') {echo "selected";}?>>Pelanggaran Lalu Lintas</option>

              <option value="Pencurian"<?php if ($data['jenis_kejahatan']=='Pencurian') {echo "selected";}?>>Pencurian</option>

              <option value="Penggelapan"<?php if ($data['jenis_kejahatan']=='Penggelapan') {echo "selected";}?>>Penggelapan</option>
              <option value="Penipuan"<?php if ($data['jenis_kejahatan']=='Penipuan') {echo "selected";}?>>Penipuan</option>

              <option value="Perampokan"<?php if ($data['jenis_kejahatan']=='Perampokan') {echo "selected";}?>>Perampokan</option>
              <option value="Perlindungan Anak"<?php if ($data['jenis_kejahatan']=='Perlindungan Anak') {echo "selected";}?>>Perlindungan Anak</option>
            </select>

            <label>Tanggal Mulai Ditahan</label>
            <input type="date" class="form-control mb-2" name="tanggal_mulai_ditahan"  required="" autocomplete="off"value="<?php echo $data['tanggal_mulai_ditahan'];?>">
            
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
    include ('style/footer.php');
?>