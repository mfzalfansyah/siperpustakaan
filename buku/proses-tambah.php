<?php

include 'koneksi.php';

if(isset($_POST['simpan'])){
    $judul=$_POST['judul'];
    $penerbit=$_POST['penerbit'];
    $pengarang=$_POST['pengarang'];
    $ringkasan=$_POST['ringkasan'];
    $cover=$_POST['cover'];
    $stok=$_POST['stok'];
    $id_kategori=$_POST['id_kategori'];

    $sql = "INSERT INTO databuku VALUES ('','$judul','$penerbit','$pengarang','$ringkasan','$cover','$stok','$id_kategori')";

    $res = mysqli_query($connect, $sql);

    $count = mysqli_affected_rows($connect);
    var_dump($res);

    if($count==1){
        header("Location: index.php");
    }
    else{
        header("Location: tambah.php");
    }
}
?>