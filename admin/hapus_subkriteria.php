<?php
include("../config/koneksi.php");
$idk = $_GET['id'];
$id_periode = $_GET['idp'];
// $idp = $_GET['idp'];

$currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

$delete = mysqli_query($konek, "DELETE FROM tbl_subkriteria WHERE id_subkriteria = '$idk'");
if ($delete) {
	echo "<script language=javascript>
	window.location='sub_kriteria.php?idp=$id_periode&page=$currentPage&delete_success=true';
	</script>";
} else {
	echo "<script language=javascript>
	window.location='sub_kriteria.php?idp=$id_periode&page=$currentPage&delete_success=false';
	</script>";
}
