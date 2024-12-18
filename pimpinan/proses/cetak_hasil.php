<?php
include("../../config/koneksi.php");
$idp = $_GET['idp'];
$sql = mysqli_query($konek, "SELECT * FROM tbl_periode WHERE id_periode = '$idp'");
$row = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cetak Hasil Keputusan</title>
	<link href="style/logo2.png" rel="shortcut icon">
</head>

<body onload="window.print();">
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
	<center>
		<div class="container">
			<p><img src="style/logo2.png" width="130px" class="mt-3"></p>
			<p style="font-size:30px;padding:0px;margin-bottom:-15px;"><b>RUMAH TAHANAN NEGARA KLAS IIB PADANG</b></p>
			<p class="mt-3" style="font-size:23px;padding:0px;margin-bottom:-12px;"><b>REKOMENDASI KELAYAKAN NARAPIDANA DALAM PENERIMAAN REMISI</b></p>
			<br>
			<hr>
	</center>
	<?php
	$no = 1;
	$q = mysqli_query($konek, "SELECT * FROM  tbl_hasil a LEFT JOIN tbl_alternatif b on a.id_alternatif = b.id_alternatif WHERE a.id_periode = '$idp' ORDER BY a.hasil DESC");
	?>
	<div class="container-fluid">

		<p style="font-size:25px;padding:0px;margin-bottom:0px; color: #000000; font-weight: bold;" align="center">Data Hasil Keputusan <?php echo $row['keterangan']; ?></p>
		<hr>

		<table width="50%" style="text-align: left; border-collapse: collapse; " border="1" class="table table-bordered">
			<tr>
				<thead align="center" style="font-weight: bold; color: black; background-color: #529dff ">
					<th style="vertical-align: middle; border: 1px solid black;">No</th>
					<th style="width: 200px; vertical-align: middle; border: 1px solid black;">No Registrasi Instansi</th>
					<th style="width: 200px; vertical-align: middle; border: 1px solid black;">Nama</th>
					<th style="width: 250px; vertical-align: middle; border: 1px solid black;">Tanggal Lahir</th>
					<th style="width: 180px; vertical-align: middle; border: 1px solid black;">Jenis Kelamin</th>
					<th style="width: 220px; vertical-align: middle; border: 1px solid black;">Jenis Kejahatan</th>
					<th style="vertical-align: middle; border: 1px solid black;">Tanggal Mulai Ditahan</th>
					<th style="vertical-align: middle; border: 1px solid black;">Lama Ditahan</th>
					<th style="vertical-align: middle; border: 1px solid black;">Nilai Preferensi</th>
					<th style="vertical-align: middle; border: 1px solid black;">Rekomendasi Kelayakan</th>
					<th style="vertical-align: middle; border: 1px solid black;">Persetujuan</th>

				</thead>
			</tr>
			<?php
			$no = 1;
			while ($row = mysqli_fetch_array($q)) {
			?>
				<tr align="center">
					<td style="vertical-align: middle; border: 1px solid black;"><?php echo $no; ?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php echo $row['id_alternatif']; ?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php echo $row['nama']; ?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php
																					$tanggal_lahir = new DateTime($row['tanggal_lahir']);
																					echo $tanggal_lahir->format('d-m-Y '); // Output: 2024-07-16 12:34:56
																					?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php echo $row['jenis_kelamin']; ?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php echo $row['jenis_kejahatan']; ?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php
																					$tanggal_lahir = new DateTime($row['tanggal_mulai_ditahan']);
																					echo $tanggal_lahir->format('d-m-Y '); // Output: 2024-07-16 12:34:56
																					?></td>
					<td style="vertical-align: middle; border: 1px solid black;">
						<?php
						$tanggalMulaiDitahan = new DateTime($row['tanggal_mulai_ditahan']);

						$tanggalHariIni = new DateTime();

						$selisih = $tanggalMulaiDitahan->diff($tanggalHariIni);

						$lamaDitahan = '';
						if ($selisih->y > 0) {
							$lamaDitahan .= $selisih->y . ' tahun ';
						}
						if ($selisih->m > 0) {
							$lamaDitahan .= $selisih->m . ' bulan';
						}
						if (empty($lamaDitahan)) {
							$lamaDitahan = 'Kurang dari 1 bulan';
						}

						echo trim($lamaDitahan);
						?>
					</td>
					<td style="font-weight: bold; vertical-align: middle;border: 1px solid black;"><?php echo $row['hasil']; ?></td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php
																					$range = $row['hasil'];
																					if ($range > 0.70) {
																						echo "<font color='green'><b>Rekomendasi</b></font>";
																					} else {
																						echo "<font color='red'><b>Tidak Rekomendasi</b></font>";
																					}
																					?>

					</td>
					<td style="vertical-align: middle; border: 1px solid black;"><?php
																					if ($row['persetujuan'] == '0') {
																						echo 'Belum DIsetujui';
																					} elseif ($row['persetujuan'] == '1') {
																						echo "Disetujui";
																					} elseif ($row['persetujuan'] == '2') {
																						echo "Tidak Disetujui";
																					}
																					?>

					</td>
				</tr>
			<?php
				$no++;
			}
			?>
		</table>
	</div>

	</div>
	<br>
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
			<tr>
				<td height="80%"></td>
			</tr>
			<tr>
				<td align="center"><br><br><br></td>
			</tr>
			<tr>
				<td align="center"><u>Muhammad Ali Syeh Banna</u></td>
			</tr>
			<tr>
				<td align="center">NIP 19671219 199203 1 002</td>
			</tr>

		</table>

	</div>
	</center>

</body>