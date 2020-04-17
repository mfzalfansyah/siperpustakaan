<?php

session_start();

include 'koneksi.php';

include 'fungsi-transaksi.php';

if(isset($_POST['submit'])){


    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_jatuh_tempo = date('Y-m-d',strtotime($tgl_pinjam.'+7 days'));
    $id_petugas = $_POST['id_petugas'];

    $sql = "INSERT INTO datapeminjaman VALUES('','$id_anggota','$tgl_pinjam','$tgl_jatuh_tempo','$id_buku','dipinjam','0','0000-00-00','$id_petugas')";

    $stok = ambilstok($id_buku);

    if(cekpinjam($id_anggota) && $stok > 0){
        $res = mysqli_query($connect,$sql);

        $count = mysqli_affected_rows($connect);

        $stok_update = $stok - 1;
        if($count == 1){
            updatestok($id_buku,$stok_update);
            header("Location: index.php");
        }else{
            header("Location: form-pinjam.php");
    }
}
}

?>