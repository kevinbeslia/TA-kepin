<?php 
	include ("style/header.php");
	include ("style/sidebarawal.php");
	include ("../config/koneksi.php");
	$idk = $_GET['id'];
?>
<?php 
include ('../config/koneksi.php');
if (isset($_POST['edit'])) {
	$idk = $_POST['idk'];
	$username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $nama_lengkap = $_POST['nama_lengkap'];
 
    

    // Cek apakah kombinasi nama sub kriteria dan nilai level sudah ada
    $checkDuplicateQuery = "SELECT * FROM tbl_user WHERE id = '$idk'";
    
    $checkDuplicateResult = mysqli_query($konek, $checkDuplicateQuery);
    $array = mysqli_fetch_array($checkDuplicateResult);

    $checkDuplicateQuery1 = "SELECT * FROM tbl_user WHERE username = '$username'";
    $checkDuplicateResult1 = mysqli_query($konek, $checkDuplicateQuery1);
    
    if (($array['username']!= $username) && (mysqli_num_rows($checkDuplicateResult1) > 0)) {
    	    
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
 $update = mysqli_query($konek, "UPDATE tbl_user SET username = '$username', password = '$password', level = '$level', nama_lengkap = '$nama_lengkap', id_blok = '$id_blok' WHERE id = '$idk'");
            
 }
 else {$id_blok=null;
 		$update = mysqli_query($konek, "UPDATE tbl_user SET username = '$username', password = '$password', level = '$level', nama_lengkap = '$nama_lengkap', id_blok = NULL WHERE id = '$idk'");
        
 }

        if ($update) {
            echo "<script language=javascript>
                window.location='data_user.php?edit_success=true';
              </script>";
        } else {
            echo "<script language=javascript>
                window.location='data_user.php?edit_success=false';
              </script>";
        }
    }
   
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<!-- Basic Card Example -->
		<div class="card shadow mt-3 mb-3">
			<div class="card-header d-flex justify-content-between">
				<h6 class="m-0 font-weight-bold" style="color: #355E3B; vertical-align: middle;">Edit Data User</h6>
				<a href="data_user.php" class="btn btn-sm btn-danger"> < Kembali</a>
			</div>
			<div class="card-body">
				<?php 
					include ("../config/koneksi.php");					
					$qq = mysqli_query($konek, "SELECT * FROM tbl_user WHERE id = '$idk'");
					$dd = mysqli_fetch_assoc($qq);
				?>
				<form action="" method="POST">
					<input type="hidden" class="form-control" name="idk" value="<?php echo $dd['id']; ?>" readonly="">
					  <div class="form-group">
            <!-- <input type="hidden" class="form-control mb-2" name="id" value="<?php echo $_SESSION['id']; ?>"> -->
                <label for="sub kriteria">Username</label>
                 <input type="text" class="form-control mb-2" name="username" placeholder="Username" required="" autocomplete="off"value="<?php echo $dd['username']; ?>">

                  <label for="sub kriteria">Password</label>
                 <input type="text" class="form-control mb-2" name="password" placeholder="Password" required="" autocomplete="off"value="<?php echo $dd['password']; ?>">
                 <label for="sub kriteria">Level</label>
                <select name="level" id="selectBlok" class="form-control mb-2" required="" onchange="getFormValues()">
                   
                     <option value="Pimpinan" <?php if ($dd['level']=='Pimpinan') {echo "selected";} ?>>Pimpinan</option>
                      <option value="Admin" <?php if ($dd['level']=='Admin') {echo "selected";} ?>>Admin</option>
                      <option value="Admin Blok" <?php if ($dd['level']=='Admin Blok') {echo "selected";} ?>>Admin Blok</option>
                    </select>
                     <div id="inputContainer">
                     	<?php if ($dd['level']=='Admin Blok') {?>
                     		<select name="id_blok" id="idBlok" class="form-control mb-2" required="" >
                     			<option value="1" <?php if ($dd['id_blok']=='1') {echo "selected";} ?>>A</option>
                     			<option value="2" <?php if ($dd['id_blok']=='2') {echo "selected";} ?>>B</option>
                     			<option value="3" <?php if ($dd['id_blok']=='3') {echo "selected";} ?>>C</option>
                     		</select>
                     	<?php } ?>
         
        </div>

                    <label for="sub kriteria">Nama Lengkap</label>
                 <input type="text" class="form-control mb-2" name="nama_lengkap" placeholder="Nama Lengkap" required="" autocomplete="off"value="<?php echo $dd['nama_lengkap']; ?>">
                    
          </div>
      </div>
      <div class="modal-footer">
        
      </div>
					<div class="form-group text-right">
						<button type="reset" name="reset" class="btn btn-md btn-secondary">Reset</button>
						<button type="submit" name="edit" class="btn btn-md btn-success">Edit</button>
					</div>
				</form>
			</div>
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
             var newInput = '<select name="id_blok" id="idBlok" class="form-control mb-2" required="" ><option value="" disabled selected>--Pilih Blok--</option><option value="1" >A</option><option value="2" >B</option><option value="3" >C</option></select>';
                $('#inputContainer').append(newInput);   
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