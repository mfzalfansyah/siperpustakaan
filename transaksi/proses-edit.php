<?php

include 'koneksi.php';
include 'fungsi-transaksi.php';

$id_pinjam = $_POST['id_pinjam'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_jatuh_tempo = date('Y-m-d', strtotime($tgl_pinjam.'+7 days'));
$tgl_kembali = NULL;
$denda = NULL;

if(isset($_POST['tgl_kembali'])){
    $tgl_kembali = $_POST['tgl_kembali'];
    $sql = "UPDATE datapeminjaman SET tgl_pinjam = '$tgl_pinjam', 
                                      tgl_kembali = '$tgl_kembali',
                                      tgl_jatuh_tempo = '$tgl_jatuh_tempo'
                                WHERE id_pinjam = $id_pinjam";
}else{
    $sql = "UPDATE datapeminjaman SET tgl_pinjam = '$tgl_pinjam', 
                                      tgl_jatuh_tempo = '$tgl_jatuh_tempo'
                                  WHERE id_pinjam = $id_pinjam";

}

$res = mysqli_query($connect,$sql);

$count = mysqli_affected_rows($connect);

if($count = 1){
    $denda = hitungdenda($id_pinjam,$tgl_kembali);
    echo $denda;
    $sql = "UPDATE datapeminjaman SET denda = $denda WHERE id_pinjam = $id_pinjam";
    $res = mysqli_query($connect,$sql);
    header("Location: index.php");
}else{
    header("Location: index.php");
}
?>