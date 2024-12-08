<?php
include("../../config/koneksi.php");
$id_alternatif = $_GET['id'];
$idp = $_GET['idp'];
$sql = mysqli_query($konek,"SELECT * FROM tbl_periode WHERE id_periode = '$idp'");
$row = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cetak Hasil Penilaian Alternatif</title>
	<link href="style/logo2.png" rel="shortcut icon">
</head>

<body onload="window.print();">
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
	<center>
		<div class="container">
			<p><img src="style/logo2.png" width="130px" class="mt-3"></p>
			<p style="font-size:30px;padding:0px;margin-bottom:-15px;"><b>RUMAH TAHANAN NEGARA KLAS IIB PADANG</b></p>
			<p class="mt-3" style="font-size:24px;padding:0px;margin-bottom:-12px;"><b>REKOMENDASI KELAYAKAN NARAPIDANA DALAM PENERIMAAN REMISI</b></p>
			<br>
			<hr>
	</center>
	<div class="container-fluid">
<hr>
		<?php
		$alt = mysqli_query($konek, "SELECT * FROM  tbl_alternatif WHERE id_alternatif = '$id_alternatif'");
		$halt = mysqli_fetch_array($alt);
		?>
		<p style="font-size:24px;padding:0px;margin-bottom:0px; color: #000000; font-weight: bold;">Data Narapidana</p>
		<table>
  			<tbody style="font-size: 18px">
  				<tr >
      				<th width="160px">No Registrasi Instansi</th>
      				<td width="20px">:</td>
      				<td><?php echo $halt['id_alternatif']; ?></td>
    			</tr>
    			<tr >
      				<th width="160px">Nama</th>
      				<td width="20px">:</td>
      				<td><?php echo $halt['nama']; ?></td>
    			</tr>
    			
    			<tr>
      				<th width="150px">Jenis Kelamin</th>
      				<td width="20px">:</td>
      				<td><?php echo $halt['jenis_kelamin']; ?></td>
    			</tr>
    			<tr>
      				<th width="150px">Jenis Kejahatan</th>
      				<td width="20px">:</td>
      				<td><?php echo $halt['jenis_kejahatan']; ?></td>
    			</tr>
    			<tr>
      				<th width="150px">Tanggal Mulai Ditahan</th>
      				<td width="20px">:</td>
      				<td><?php $tanggal_mulai_ditahan = new DateTime( $halt['tanggal_mulai_ditahan']);
                            echo $tanggal_mulai_ditahan->format('d-m-Y '); ?></td>
    			</tr>
    			<tr>
      				<th width="150px">Periode</th>
      				<td width="20px">:</td>
      				<td><?php echo $row['keterangan']; ?></td>
    			</tr>
  			</tbody>
		</table>
	
		<hr>
		<p style="font-size:20px;padding:0px;margin-bottom:10px; color: #000000; font-weight: bold; ">Hasil Analisa Kelayakan Narapidana</p>

		<?php
		$no = 1;
		$q = mysqli_query($konek, "SELECT * FROM  tbl_hasil a LEFT JOIN tbl_alternatif b on a.id_alternatif = b.id_alternatif WHERE a.id_periode = '$idp' ORDER BY a.hasil DESC");
		?>					
		<table width="50%" style="text-align: left; border-collapse: collapse; " border="1" class="table table-bordered">
			<tr>
				<thead>
						<tr style="background-color: #529dff; color: #000000; border: 2px ;border-color: green" align="center">
							<th colspan="5" style="border: 1px solid black;">Kriteria</th>
							<th rowspan="2" style="vertical-align: middle; border: 1px solid black;">Hasil Nilai Preferensi </th>
							<th rowspan="2" style="vertical-align: middle; border: 1px solid black;">Rekomendasi Kelayakan </th>
						</tr>
						<tr style="background-color: #529dff; color: #000000" align="center"><?php
							$sqlth = $konek->query("SELECT * FROM tbl_kriteria");
							while ($rowth = $sqlth->fetch_array()) {
							?>
								<th style="vertical-align: middle; border: 1px solid black;"><?= $rowth['nama_kriteria']; ?></th>
							<?php
							}
							?></tr>
					</thead>
			</tr>
			<?php
					$sql = mysqli_query($konek, "SELECT * FROM tbl_hasil a JOIN tbl_alternatif b ON a.id_alternatif = b.id_alternatif WHERE a.id_alternatif = '$id_alternatif' GROUP BY a.id_alternatif ");
					while ($data = mysqli_fetch_assoc($sql)) {
						$idalt = $data['id_alternatif'];
						$nmalt = $data['nama'];
						$hasil = $data['hasil'];
					?>
						<tbody>
							<tr align="center" >
								<?php
								$query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_alternatif = '$id_alternatif' AND a.id_periode = '$idp'");
								while ($rowq2 = $query2->fetch_array()) {
								?>
									<td style="vertical-align: middle; border: 1px solid black;"><?= $rowq2['ket']; ?>
									</td>

								<?php
								}
								?>
								<th style="vertical-align: middle; border: 1px solid black;" rowspan="2"><?= $hasil; ?></th>
								<th style="vertical-align: middle; border: 1px solid black;" rowspan="2">
								<?php
										$range = $hasil;
										if ($range > 0.70) {
											echo "<font color='green'>Rekomendasi</font>";
										} else {
											echo "<font color='red'>Tidak Rekomendasi</font>";
										}
										?>
								</th>
							</tr>
							<tr align="center">
								<?php
								$query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_alternatif = '$id_alternatif' AND a.id_periode = '$idp'");
								while ($rowq2 = $query2->fetch_array()) {
								?>
									<td style="vertical-align: middle; border: 1px solid black;"><?= $rowq2['nbobot']; ?>
									</td>

								<?php
								}
								?>
							</tr>
						</tbody>
					<?php
						
					}
					?>
		</table>
		<hr>
	</div>

	</div>
	<br><br><br>
	<div align="right">
		<table width="23%" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="100%" style="font-weight: bold; font-size: 20px">Padang, ........................</td>
			</tr>
			<tr>
				<td align="center">Mengetahui</td>
			</tr>
			<tr>
				<td align="center">Kepala Divisi Permasyarakatan</td>
			</tr>
			<tr><td height="80%"></td></tr>
			<tr>
				<td align="center"><br><br><br></td>
			</tr>
			<tr>
				<td align="center"><u>Muhammad Ali Syeh Banna</u></td>
			</tr>
			<tr>
				<td align="center">NIP. 19671219 199203 1 002</td>
			</tr>

		</table>
		
	</div>
	</center>

</body>