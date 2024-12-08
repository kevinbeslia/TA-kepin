<?php 
	include ("style/header.php");
	include ("style/sidebarawal.php");
	  // $idp = $_GET['idp'];
	$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
?>
<?php 
  include ("../config/koneksi.php");
  if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $nama_lengkap = $_POST['nama_lengkap'];
 
    

    // Cek apakah kombinasi nama sub kriteria dan nilai level sudah ada
    $checkDuplicateQuery = "SELECT * FROM tbl_user WHERE username = '$username'";
    $checkDuplicateResult = mysqli_query($konek, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        // Jika sudah ada, tampilkan pesan kesalahan
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
               Username sudah digunakan
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    
    } else {
        if (isset($_POST['id_blok'])) {
 $id_blok = $_POST['id_blok'];
            // Jika belum ada, lanjutkan dengan penyimpanan
        $save = mysqli_query($konek, "INSERT INTO tbl_user  (`id`, `username`, `password`, `level`, `nama_lengkap`, `id_blok`) VALUES ('', '$username', '$password', '$level','$nama_lengkap', $id_blok)");

 }
 else {$id_blok=null;

        // Jika belum ada, lanjutkan dengan penyimpanan
        $save = mysqli_query($konek, "INSERT INTO tbl_user  (`id`, `username`, `password`, `level`, `nama_lengkap`, `id_blok`) VALUES ('', '$username', '$password', '$level','$nama_lengkap',NULL)");

 }

        if ($save) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data User Berhasil Ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data User Gagal Ditambahkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
}
?>

<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
 
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold" style="color: #0510a8"><b>Data User</b>
			</div>
			<div class="card-body">
<?php
       if (isset($_GET['edit_success'])) {
        if ($_GET['edit_success'] == 'true') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data User Berhasil Diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                  
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data User Gagal Diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeEditSuccess()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
    ?>

<script>
function removeEditSuccess() {
    // Mendapatkan URL saat ini
    var currentUrl = window.location.href;
    
    // Menghapus parameter edit_success dari URL
    var newUrl = currentUrl.replace(/(\?|&)edit_success=(true|false)/, '');

    // Mengarahkan pengguna kembali ke URL baru tanpa parameter edit_success
    window.location.href = newUrl;
}
</script>
		<button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#tambah_bank"><i class="fas fa-plus fa-sm"></i> Tambah User</button>
        <div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr align="center" style="background-color: #529dff; color: #ffff">
							<th>No</th>
							<th>Username</th>
							<th>Level</th>
							<th>Nama Lengkap</th>
                            <th>Blok</th>
              <th colspan="2">Aksi</th>
							
						</tr>
					</thead>
					<?php 
						include("../config/koneksi.php");
						$no=1;
						$sql = mysqli_query($konek, "SELECT tbl_user.id as user_id, tbl_user.username, tbl_user.password, tbl_user.level, tbl_user.nama_lengkap, tbl_blok.blok FROM tbl_user left join tbl_blok on tbl_user.id_blok=tbl_blok.id");
		
						while($array = mysqli_fetch_assoc($sql)){
                    ?>

					<tbody>
						<tr style="color: #355E3B" align="center">
							<td><?php echo $no++; ?></td>
							<td><?php echo $array['username']; ?></td>
							<td><?php echo $array['level']; ?></td>
							<td><?php echo $array['nama_lengkap']; ?></td>
                            <td><?php echo $array['blok']; ?></td>
              <td>
                <a href="edit_user.php?id=<?php echo $array['user_id']; ?>"><i class="btn btn-info btn-sm"><span class="fas fa-edit"></span></i></a>
              </td>
					<td align="center">
                <a href="hapus_user.php?id=<?php echo $array['user_id']; ?>&page=<?php echo $currentPage; ?>"><i class="btn btn-danger btn-sm" onclick="return confirm('Apakah Data User ini akan dihapus?')"><span class="fas fa-trash"></span></i></a></td>		
						</tr>
					</tbody>
					<?php 
					} 
					
					?>
				</table>
      </div>
			<!-- <div align="right">
	<a href="data_alternatif.php?&idp=<?php echo $idp; ?>" class="btn btn-danger">Back</a>
	<a href="data_penilaian.php?&idp=<?php echo $idp; ?>" class="btn btn-primary">Next</a>
</div> -->
			</div>
</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambah_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <!-- <input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>"> -->
                <label for="sub kriteria">Username</label>
                 <input type="text" class="form-control mb-2" name="username" placeholder="Username" required="" autocomplete="off">

                  <label for="sub kriteria">Password</label>
                 <input type="text" class="form-control mb-2" name="password" placeholder="Password" required="" autocomplete="off">
                 <label for="sub kriteria">Level</label>
                <select name="level" id="selectBlok" class="form-control mb-2" required="" onchange="getFormValues()">
                    <option value="" disabled selected>--Pilih Level--</option>

                     <option value="Pimpinan" >Pimpinan</option>
                      <option value="Admin" >Admin</option>
                      <option value="Admin Blok" >Admin Blok</option>
                    </select>
                     <div id="inputContainer">
         
        </div>

                    <label for="sub kriteria">Nama Lengkap</label>
                 <input type="text" class="form-control mb-2" name="nama_lengkap" placeholder="Nama Lengkap" required="" autocomplete="off">
                    
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah" class="btn btn-primary btn-sm">Tambah</button>
      </div>
        </form>
    </div>
  </div>
</div>
        <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Script -->
    <script>

        function getFormValues() {
            

            // Get the value of the select input
            var selectInputValue = $('#selectBlok').val();

            if (selectInputValue ==='Admin Blok') {

             // var newInput = '<select name="id_blok" id="idBlok" class="form-control mb-2" required="" ><option value="" disabled selected>--Pilih Blok--</option><option value="1" >A</option><option value="2" >B</option><option value="3" >C</option></select>';
             //    $('#inputContainer').append(newInput); 
                
             const xhttp = new XMLHttpRequest();
              xhttp.onload = function() {
                document.getElementById("inputContainer").innerHTML = this.responseText;
              }
              xhttp.open("GET", "getblok.php");
              xhttp.send();  
                        }
            else{
                $('#idBlok').remove();
            }
            
            console.log('Select Input Value: ' + selectInputValue);

        }
    </script>
<?php 

	include ("style/footer.php");
?>