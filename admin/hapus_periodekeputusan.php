<?php
include ("../config/koneksi.php");
$idp = $_GET['idp'];

$currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

$delete = mysqli_query($konek,"DELETE FROM tbl_alternatif WHERE id_periode = '$idp'");
$delete2 = mysqli_query($konek,"DELETE FROM tbl_normalisasi WHERE id_periode = '$idp'");
$delete3 = mysqli_query($konek,"DELETE FROM tbl_penilaian WHERE id_periode = '$idp'");
$delete3 = mysqli_query($konek,"DELETE FROM tbl_hasil WHERE id_periode = '$idp'");
$delete4 = mysqli_query($konek,"DELETE FROM tbl_periode WHERE id_periode = '$idp'");

if($delete) {
	echo "<script language=javascript>
	window.location='periodekeputusan.php?page=$currentPage&delete_success=true';
	</script>";
}else{
	echo "<script language=javascript>
	window.location='periodekeputusan.php?page=$currentPage&delete_success=false';
	</script>";
}

?>