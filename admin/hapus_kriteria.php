<?php
include("../config/koneksi.php");
$idk = $_GET['id'];
// $idp = $_GET['idp'];

$kriteria = mysqli_query($konek, "SELECT * FROM tbl_kriteria WHERE id_kriteria = $idk");
$kriteria = mysqli_fetch_assoc($kriteria);

$id_periode = $kriteria['id_periode'];

$delete = mysqli_query($konek, "DELETE FROM tbl_kriteria WHERE id_kriteria = '$idk'");
$delete = mysqli_query($konek, "DELETE FROM tbl_subkriteria WHERE id_kriteria = '$idk'");
if ($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='data_kriteria.php?idp=" . $id_periode . "';
	</script>";
} else {
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='data_kriteria.php?idp=" . $id_periode . "';
	</script>";
}
