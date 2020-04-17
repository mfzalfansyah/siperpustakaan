<?php

include 'koneksi.php';

$id=$_GET['id_anggota'];

$query = mysqli_query($connect, "DELETE FROM dataanggota WHERE dataanggota.id_anggota='$id' ");

if($query>0){
    echo "<script> alert('Data Berhasil Dihapus'); document.location.href='index.php';
          </script>";
}else{
    echo "<script> alert('Data Gagal Dihapus'); document.location.href='index.php';
          </script>";
}
    

?>