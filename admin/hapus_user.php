<?php
include ("../config/koneksi.php");
$idk= $_GET['id'];
// $idp = $_GET['idp'];

$delete = mysqli_query($konek,"DELETE FROM tbl_user WHERE id = '$idk'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='data_user.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='data_user.php';
	</script>";
}

?>