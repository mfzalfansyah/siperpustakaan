<?php 

include 'koneksi.php';
include '../aset/header.php';

$ID = $_GET["id_anggota"];

$query = mysqli_query($connect, "SELECT * FROM dataanggota WHERE dataanggota.id_anggota = '$ID' ");

$query1 = mysqli_query($connect, "SELECT * FROM level");



include 'koneksi.php';

if(isset($_POST['simpan'])){

    $id = $_GET['id_anggota'];

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $telp = $_POST['telp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_level = 3;
    

    $sql = "UPDATE dataanggota SET
            nama = '$nama',
            kelas  = '$kelas',
            telp = '$telp',
            username = '$username',
            password = '$password',
            id_level = '$id_level'
            WHERE id_anggota = '$id'
            ";

    $res = mysqli_query($connect, $sql);

    $count = mysqli_affected_rows($connect);

    var_dump($count);
         
    if($count==1){
        echo "<script>
                alert('Data Berhasil Diubah'); 
                document.location.href='index.php';
              </script>";
        
    }
    else{
        echo "<script>
        alert('Data Gagal Diubah'); 
        document.location.href='edit.php';
      </script>";
    }
}
?>

<div class="container">
 <div class="row mt-4">
  <div class="col-md-9">
   <div class="card">
    <div class="card-header">
    <h2>Edit Data Anggota</h2>
    </div>
    <div class="card-body">
         <form method="post" action="">

         <?php while($edit = mysqli_fetch_assoc($query)): ?>
                <div class="form-group">
                 <label for="buku">Nama</label>
                 <input type="text" class="form-control" name="nama" id="nama"  value="<?= $edit['nama']?>">
                </div>

                <div class="form-group">
                 <label for="buku">Kelas</label>
                 <input type="text" class="form-control" name="kelas" id="kelas"   value="<?= $edit['kelas']?>">
                </div>  

                <div class="form-group">
                 <label for="buku">Telfon</label>
                 <input type="text" class="form-control" name="telp" id="telp"  value="<?= $edit['telp']?>">
                </div>

                <div class="form-group">
                 <label for="buku">Username</label>
                 <input type="text" name="username" id="username" class="form-control" value="<?= $edit['username']?>"></textarea>
                </div>

                <div class="form-group">
                 <label for="buku">Password</label>
                 <input type="password" class="form-control" name="password" id="password"  value="<?= $edit['password']?>"> 
                 </div>
                
                <?php
                     endwhile;
                ?>
                               
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
         </form>        
    </div>
   </div>
  </div>
 </div>
</div>    

<?php

include '../aset/footer.php';

?>