<?php 
    include ('style/header.php');
    include ('style/sidebarawal.php');
    include ('../config/koneksi.php');
?>
<div class="container-fluid">

	<!-- Basic Card Example -->
	<div class="card shadow mt-3 mb-3">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold" style="color: #0510a8">Dashboard</h6>
		</div>
		<div class="card-body" align="center">
			<h2 style="color: #000000; font-weight: bold;">Selamat Datang <?php echo $_SESSION['nama_lengkap']; ?></h2>
			<br>
			<h3 style="color: #000000">Sistem Pendukung Keputusan</h3>
           </h4>
           <h4 style="color: #000000">Rekomendasi Kelayakan Narapidana dalam Penerimaan Remisi pada Rumah Tahanan Negara Klas IIB Padang Jl. Anak Air, Batipuh Panjang, Kec. Koto Tangah, Kota Padang, Sumatera Barat 25586
           </h4>
            <h5 style="color: #000000; text-decoration: underline">Metode Weighted Aggregated Sum Product Assessment (WASPAS)
            </h5>
			<br>
				<hr>
             <div class="table-responsive">
				<table class="table" style="width: 700px">
					<thead align="center">
						<tr style="color: #000000;" >
							<th style="width: 350px"><span class="icon-box bg-color-green set-icon">
                    		<i class="fas fa-clipboard-list" style="color: #0510a8"></i>
                			</span>
                    				<b><?php
                  
                					$periode= mysqli_query($konek,"SELECT * FROM tbl_periode");
                  
                					$jumlah_periode = mysqli_num_rows($periode);
 
               						?>
               		 				<p style="font-size: 18px; color: #0510a8"><?php echo $jumlah_periode; ?> Periode Keputusan</p></b> 	
							</th>
							<th>
								<i class="fa fa-database" style="color: #0510a8"></i>
                    <b><?php
                  
                $kriteria= mysqli_query($konek,"SELECT * FROM tbl_kriteria");
                  
                $jumlah_kriteria = mysqli_num_rows($kriteria);
 
                ?>
                <p style="font-size: 18px; color: #0510a8"><?php echo $jumlah_kriteria; ?> Kriteria</p></b>
							</th>
						</tr>
					</thead>
					<tbody align="center">
						<tr style="color: #000000">
							<td><a href="periodekeputusan.php">
                    				<p class="text-muted" style="color: #0510a8">Lihat Detail</p>
                    			</a></td>
							<td><a href="data_kriteria.php">
                    		<p class="text-muted">Lihat Detail</p></a></td>
             	
						</tr>
					</tbody>
				</table>
      </div>
		</div>

	</div>
</div>
<?php 
    include ('style/footer.php');
?>