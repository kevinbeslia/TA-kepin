<?php
include("style/header.php");
include("style/sidebar.php");
include '../../config/koneksi.php';
$idp = $_GET['idp'];
if (isset($_GET['id_hasil'])) {
	$id_hasil = $_GET['id_hasil'];
	if ($_GET['persetujuan'] == '1') {
		$qqq1 = mysqli_query($konek, "UPDATE tbl_hasil SET persetujuan='1' WHERE id_hasil=$id_hasil");
	} elseif (($_GET['persetujuan'] == '2')) {
		$qqq2 = mysqli_query($konek, "UPDATE tbl_hasil SET persetujuan='2' WHERE id_hasil=$id_hasil");
	}
}
?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="col-lg-12">
			<!-- Basic Card Example -->
			<div class="card shadow mt-3 mb-3">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-olive" style="color: #0510a8"><b>Data Hasil Keputusan</b></h6>
				</div>

				<!-- Data 2 -->
				<div class="card-body">
					<h6 style="font-weight: bold; color: #0510a8">Data Hasil Nilai Preferensi</h6>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr align="center" style="background-color: #529dff; color: #ffff" align="center">
									<th style="font-size: 16px;">No</th>
									<th style="font-size: 16px;">Nama Alternatif</th>
									<th style="font-size: 16px;">Nilai Preferensi (V)</th>
								</tr>
							</thead>
							<tbody>
								<!-- Tampil Hasil -->
								<?php
								include('../../config/koneksi.php');
								$noo = 1;
								$qq = mysqli_query($konek, "SELECT * FROM tbl_hasil a LEFT JOIN tbl_alternatif b ON a.id_alternatif=b.id_alternatif WHERE a.id_periode = '$idp'");
								while ($dd = mysqli_fetch_assoc($qq)) {
								?>
									<tr style="color:  #355E3B">
										<td style="font-size: 15px;" align="center" valign="bottom"><?php echo $noo; ?></td>

										<td style="font-size: 15px; " align="center" valign="bottom"><?php echo $dd['nama']; ?></td>

										<td style="font-size: 15px; " align="center" valign="bottom"><?php echo $dd['hasil']; ?></td>

									</tr>
								<?php
									$noo++;
								}
								?>
							</tbody>
						</table>
					</div>


					<?php
					$sqlrank = mysqli_query($konek, "SELECT *  FROM tbl_hasil a LEFT JOIN tbl_alternatif b on a.id_alternatif = b.id_alternatif WHERE a.id_periode = '$idp' ORDER BY a.hasil DESC LIMIT 1");
					$rank = mysqli_fetch_array($sqlrank);
					?>
					<hr>
					<h6 style="font-weight: bold; color: #0510a8">Data Hasil Kesimpulan</h6>
					<hr>
					<?php
					if (isset($qqq1)) {
						echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Hasil Keputusan Telah Disetujui!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
					}
					if (isset($qqq2)) {
						echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                    Data Hasil Keputusan Telah Ditolak!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
					}
					?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th colspan="11"><label style="font-size: 15px;"><i style="color : #355E3B;">* Nilai Standar Rekomendasi Kelayakan Narapidana dalam Penerimaan Remisi adalah > 0.70</i></th>
								</tr>
								<tr align="center" style="background-color: #529dff; color: #ffff" align="center">
									<th style="font-size: 15px; vertical-align: middle;">No</th>
									<th style="font-size: 15px;vertical-align: middle;">No Registrasi Instansi</th>
									<th style="font-size: 15px;vertical-align: middle;">Nama Alternatif</th>
									<th style="font-size: 15px;vertical-align: middle; width: 120px;">Tanggal Lahir</th>
									<th style="font-size: 15px;vertical-align: middle;">Jenis Kelamin</th>
									<th style="font-size: 15px;vertical-align: middle;">Jenis Kejahatan</th>
									<th style="font-size: 15px;vertical-align: middle;">Tanggal Mulai Ditahan</th>
									<th style="font-size: 15px;vertical-align: middle;">Nilai Preferensi</th>
									<th style="font-size: 15px;vertical-align: middle;">Rekomendasi Kelayakan</th>
									<th style="font-size: 15px;vertical-align: middle;">Persetujuan</th>
									<th style="font-size: 15px;vertical-align: middle;">Aksi</th>

								</tr>
							</thead>
							<tbody>
								<?php
								include('../../config/koneksi.php');
								$noo1 = 1;
								$qq = mysqli_query($konek, "SELECT * FROM tbl_hasil a LEFT JOIN tbl_alternatif b ON a.id_alternatif=b.id_alternatif WHERE a.id_periode = '$idp'ORDER BY hasil DESC");
								while ($dd = mysqli_fetch_assoc($qq)) {
								?>
									<tr style="color: #355E3B">
										<td align="right" style="font-size: 15px; text-align: center; vertical-align: middle;"><?php echo $noo1++; ?></td>
										<td style="font-size: 15px; text-align: center; vertical-align: middle;"><?php echo $dd['id_alternatif']; ?></td>
										<td style="font-size: 15px; text-align: center; vertical-align: middle;"><?php echo $dd['nama']; ?></td>
										<td style="font-size: 15px; vertical-align: middle;"><?php
																								$tanggal_lahir = new DateTime($dd['tanggal_lahir']);
																								echo $tanggal_lahir->format('d-m-Y '); // Output: 2024-07-16 12:34:56
																								?></td>
										<td style="font-size: 15px; text-align: center; vertical-align: middle;"><?php echo $dd['jenis_kelamin']; ?></td>
										<td style="font-size: 15px; vertical-align: middle;"><?php echo $dd['jenis_kejahatan']; ?></td>
										<td style="font-size: 15px; text-align: center; vertical-align: middle;"><?php
																													$tanggal_lahir = new DateTime($dd['tanggal_mulai_ditahan']);
																													echo $tanggal_lahir->format('d-m-Y '); // Output: 2024-07-16 12:34:56
																													?></td>
										<td style="font-size: 15px; text-align: center ; vertical-align: middle;"><?php echo $dd['hasil']; ?></td>

										<td style="font-size: 15px;  font-weight: bold; vertical-align: middle;" align="center" valign="bottom">
											<?php
											$range = $dd['hasil'];
											if ($range > 0.70) {
												echo "<font color='green'>Rekomendasi</font>";
											} else {
												echo "<font color='red'>Tidak Rekomendasi</font>";
											}
											?>

										</td>
										<td style="font-size: 15px; text-align: center ; vertical-align: middle;"><?php
																													if ($dd['persetujuan'] == '0') {
																														echo '<a class="btn btn-primary btn-sm" href="hasil_keputusan.php?idp=' . $dd['id_periode'] . '&id_hasil=' . $dd['id_hasil'] . '&persetujuan=1">Setuju</a><a class="btn btn-danger btn-sm mt-1" href="hasil_keputusan.php?idp=' . $dd['id_periode'] . '&id_hasil=' . $dd['id_hasil'] . '&persetujuan=2">Tidak Setuju</a>';
																													} else if ($dd['persetujuan'] == '1') {
																														echo "Disetujui";
																													} else {
																														echo "Tidak Disetujui";
																													}
																													?>



										</td>
										<td align="center" style="vertical-align: middle;">
											<a target="_blank" href="cetak_alt.php?id=<?php echo $dd['id_alternatif']; ?>&idp=<?php echo $idp; ?>"><i class="btn btn-primary btn-sm"><span class="fas fa-print"></span></i></a>
										</td>

									</tr>
								<?php
								}
								?>
							</tbody>
						</table>

					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php
include("style/footer.php");
?>