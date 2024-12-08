<?php
include ("../config/koneksi.php");
$idk= $_GET['id'];
// $idp = $_GET['idp'];

$delete = mysqli_query($konek,"DELETE FROM tbl_kriteria WHERE id_kriteria = '$idk'");
$delete = mysqli_query($konek,"DELETE FROM tbl_subkriteria WHERE id_kriteria = '$idk'");
if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='data_kriteria.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='data_kriteria.php';
	</script>";
}

?>