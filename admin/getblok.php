<?php
$server = "localhost";
  $user = "root";
  $pass = "";
  $db   = "spkamanah";

  $konek  = mysqli_connect($server, $user, $pass, $db);
  $sql = mysqli_query($konek, "SELECT * FROM tbl_blok ");
          $data='<select name="id_blok" id="idBlok" class="form-control mb-2" required="" ><option value="" disabled selected>--Pilih Blok--</option>';
            while($array = mysqli_fetch_assoc($sql)){
              $data= $data . '<option value="'.$array['id'].'" >'.$array['blok'].'</option>';
              

            }
            $data= $data .'</select>';
            echo $data;

?>