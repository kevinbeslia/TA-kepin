<?php 
include "../../config/koneksi.php";

 $currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

$ids=$_GET['id'];
$idp = $_GET['idp'];
$delete = mysqli_query($konek,"DELETE From tbl_penilaian Where id_alternatif ='$ids'");
$delete2 = mysqli_query($konek,"DELETE FROM tbl_normalisasi WHERE id_alternatif = '$ids'");
$delete3 = mysqli_query($konek,"DELETE FROM tbl_penilaian WHERE id_alternatif = '$ids'");
$delete4 = mysqli_query($konek,"DELETE FROM tbl_hasil WHERE id_alternatif = '$ids'");

if($delete) {
	echo "<script language=javascript>
	window.location='data_penilaian.php?idp=$idp&page=$currentPage&delete_success=true';
	</script>";
}else{
	echo "<script language=javascript>
	window.location='data_penilaian.php?idp=$idp&page=$currentPage&delete_success=true';
	</script>";
}
?>

