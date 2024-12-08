<?php
include("style/header.php");
include("style/sidebar.php");
include '../../config/koneksi.php';
$idp = $_GET['idp'];
?>
<div class="container-fluid">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header py-3">

				<h6 class="m-0 font-weight-bold text-olive" style="color: #0510a8"><b>Data Hasil Perhitungan Normalisasi</b></h6>

			</div>
			<div class="card-body">
				<h6 style="font-weight: bold; color: #0510a8">Data Nilai Bobot (W)</h6>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr style="background-color: #529dff; color: #ffff" align="center">
								<!-- Tampil Data Kriteria -->
								<?php
								$sqltr = mysqli_query($konek, "SELECT * FROM tbl_kriteria");
								while ($rowtr = $sqltr->fetch_array()) {
								?>
									<th><?= $rowtr['nama_kriteria']; ?></th>
								<?php
								}

								?>

							</tr>
							<tr align="center" style="color: #355E3B">
								<!-- Tampil data Jenis Kriteria -->
								<?php
								$sqltr = mysqli_query($konek, "SELECT * FROM tbl_kriteria");
								while ($rowtr = $sqltr->fetch_array()) {
								?>
									<th><?= $rowtr['jenis_kriteria']; ?></th>
								<?php
								}

								?>

							</tr>
						</thead>
						<tbody>

							<tr align="center"  style="color: #355E3B">
								<!-- Tampil Data Nilai Bobot -->
								<?php
								$sqltr = mysqli_query($konek, "SELECT * FROM tbl_kriteria");
								while ($rowtr = $sqltr->fetch_array()) {
								?>
									<td><?= $rowtr['bobot']; ?></td>
								<?php
								}

								?>

							</tr>
						</tbody>
					</table>
				</div>
				<h6 style="font-weight: bold; color: #0510a8">Data Normalisasi Matriks Keputusan</h6>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr style="background-color: #529dff; color: #ffff" align="center">
								<th style="font-size: 16px;">No</th>
								<th style="font-size: 16px;">Nama Alternatif</th>
								
								<?php
								$sqlth = $konek->query("SELECT * FROM tbl_kriteria");
								while ($rowth = $sqlth->fetch_array()) {
								?>
									<th><?= $rowth['nama_kriteria']; ?></th>
								<?php
								}
								?>
						</thead>

						<tbody>
						<?php 
							include ('../../config/koneksi.php');
						
							$no = 1;
							$sqlp1 = $konek->query("SELECT DISTINCT * FROM tbl_penilaian WHERE id_periode = '$idp' GROUP BY id_alternatif");
							while ($rowp1 = $sqlp1->fetch_array()) {
								$idalt = $rowp1['id_alternatif'];
								$nama_alt = $konek->query("SELECT * FROM tbl_alternatif WHERE id_alternatif = '$idalt'");
								$row_nama_alt = $nama_alt->fetch_array();
						?>
							<tr align="center" style="color: #355E3B">
								<td align="center"><?php echo $no++; ?></td>
								<td><?php echo $row_nama_alt['nama']; ?></td>

						<?php
$sqlcek = mysqli_query($konek, "SELECT * FROM tbl_hasil WHERE id_periode = '$idp' AND id_alternatif = '$idalt'");
$ceksql2 = mysqli_num_rows($sqlcek);
$nc_SAW = 0; // Nilai hasil metode SAW
$nc_WP = 1; // Nilai hasil metode WP

// Jika belum ada data hasil, maka melakukan perhitungan
if ($ceksql2 === 0) {
    // Menyimpan nilai awal pada tabel hasil
    $simpanakhir = $konek->query("INSERT INTO tbl_hasil VALUES ('','$idalt','$idp','$nc_SAW')");

    $sqlkrt = $konek->query("SELECT * FROM tbl_kriteria");

    // Iterasi untuk setiap kriteria
    while ($rowkrt = $sqlkrt->fetch_array()) {
        $idkrt = $rowkrt['id_kriteria'];
        $jnkrt = $rowkrt['jenis_kriteria'];
        $bobot = $rowkrt['bobot'];

        // Mengambil data penilaian untuk setiap subkriteria dan kriteria tertentu
        $sqlp2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b on a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE a.id_alternatif = '$idalt' AND a.id_periode = '$idp' AND c.id_kriteria = '$idkrt' ");

        // Iterasi untuk setiap baris hasil penilaian subkriteria dan kriteria tertentu
        while ($rowp2 = $sqlp2->fetch_array()) {
            // Melakukan normalisasi matriks keputusan
            if ($jnkrt == "Benefit") {
                $sqlceknilai = $konek->query("SELECT MAX(nbobot) as n FROM tbl_penilaian a join tbl_subkriteria b on a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE a.id_periode = '$idp' AND c.id_kriteria = '$idkrt' ");
                $rown = $sqlceknilai->fetch_array();
                $n = $rown['n'];
                $c = $rowp2['nbobot'];
                $c = $c / $n;
            } else {
                $sqlceknilai = $konek->query("SELECT MIN(nbobot) as n FROM tbl_penilaian a JOIN tbl_subkriteria b on a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE a.id_periode = '$idp' AND c.id_kriteria = '$idkrt' ");
                $rown = $sqlceknilai->fetch_array();
                $n = $rown['n'];
                $c = $rowp2['nbobot'];
                $c = $n / $c;
            }
            // Menampilkan hasil normalisasi
            echo "<td align='center'>" . $c . "</td>";

            // Menghitung nilai preferensi (V) untuk metode SAW
            $nc_SAW += ($c * $bobot);

            // Menghitung nilai preferensi (V) untuk metode WP
            $nc_WP *= pow($c, $bobot);
        }
    }

    echo "</tr>";

// Menghitung nilai akhir WASPAS
$nc_WASPAS = 0.5 * $nc_SAW + 0.5 * $nc_WP;

// Membulatkan hasil dengan dua digit desimal
$nc_WASPAS_rounded = round($nc_WASPAS, 9);

// Mengupdate nilai hasil pada tabel hasil
$updatenilai = $konek->query("UPDATE tbl_hasil SET hasil = '$nc_WASPAS_rounded' WHERE id_alternatif = '$idalt'");
} else {
    // Jika sudah ada data hasil, maka melakukan perhitungan seperti sebelumnya

    $sqlkrt = $konek->query("SELECT * FROM tbl_kriteria");

    while ($rowkrt = $sqlkrt->fetch_array()) {
        $idkrt = $rowkrt['id_kriteria'];
        $jnkrt = $rowkrt['jenis_kriteria'];
        $bobot = $rowkrt['bobot'];

        $sqlp2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b on a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE a.id_alternatif = '$idalt' AND a.id_periode = '$idp' AND c.id_kriteria = '$idkrt' ");

        while ($rowp2 = $sqlp2->fetch_array()) {
            if ($jnkrt == "Benefit") {
                $sqlceknilai = $konek->query("SELECT MAX(nbobot) as n FROM tbl_penilaian a join tbl_subkriteria b on a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE a.id_periode = '$idp' AND c.id_kriteria = '$idkrt' ");
                $rown = $sqlceknilai->fetch_array();
                $n = $rown['n'];
                $c = $rowp2['nbobot'];
                $c = $c / $n;
            } else {
                $sqlceknilai = $konek->query("SELECT MIN(nbobot) as n FROM tbl_penilaian a JOIN tbl_subkriteria b on a.id_subkriteria = b.id_subkriteria JOIN tbl_kriteria c ON b.id_kriteria = c.id_kriteria WHERE a.id_periode = '$idp' AND c.id_kriteria = '$idkrt' ");
                $rown = $sqlceknilai->fetch_array();
                $n = $rown['n'];
                $c = $rowp2['nbobot'];
                $c = $n / $c;
            }
            echo "<td align='center'>" . $c . "</td>";
            $nc_SAW += ($c * $bobot);
            $nc_WP *= pow($c, $bobot);
        }
    }

    echo "</tr>";

// Menghitung nilai akhir WASPAS
$nc_WASPAS = 0.5 * $nc_SAW + 0.5 * $nc_WP;

// Membulatkan hasil dengan dua digit desimal
$nc_WASPAS_rounded = round($nc_WASPAS, 9);

// Mengupdate nilai hasil pada tabel hasil
$updatenilai = $konek->query("UPDATE tbl_hasil SET hasil = '$nc_WASPAS_rounded' WHERE id_alternatif = '$idalt'");
}
}
?>

					</tbody>
					</table>
			</div>
				<div align="right">
					<a href="data_penilaian.php?&idp=<?php echo $idp; ?>" class="btn btn-danger">Penilaian</a>
					<a href="hasil_keputusan.php?&idp=<?php echo $idp; ?>" class="btn btn-primary">Hasil</a>
				</div>
			</div>
		</div>
				

	</div>
</div>

