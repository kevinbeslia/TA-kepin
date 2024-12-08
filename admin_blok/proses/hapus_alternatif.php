<?php
include ("../../config/koneksi.php");
$id_alternatif= $_GET['id'];
$idp = $_GET['idp'];

 $currentPage = isset($_GET['page']) ? $_GET['page'] : (isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 1);

$sql1 = mysqli_query($konek,"SELECT * FROM tbl_alternatif WHERE id_alternatif='$id_alternatif'");
$data1 = mysqli_fetch_array($sql1);
$delete = mysqli_query($konek,"DELETE FROM tbl_alternatif WHERE id_alternatif = '$id_alternatif'");
$delete2 = mysqli_query($konek,"DELETE FROM tbl_normalisasi WHERE id_alternatif = '$id_alternatif'");
$delete3 = mysqli_query($konek,"DELETE FROM tbl_penilaian WHERE id_alternatif = '$id_alternatif'");
$delete4 = mysqli_query($konek,"DELETE FROM tbl_hasil WHERE id_alternatif = '$id_alternatif'");

if($delete) {
			echo "<script language=javascript>
            window.location='data_alternatif.php?idp=$idp&page=$currentPage&delete_success=true';
            </script>";
}else{
			echo "<script language=javascript>
            window.location='data_alternatif.php?idp=$idp&page=$currentPage&delete_success=false';
            </script>";
}


?>