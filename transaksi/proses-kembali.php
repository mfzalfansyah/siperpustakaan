<?php 
include 'koneksi.php';
include 'fungsi-transaksi.php';

if(isset($_POST['simpan'])){
    $id_pinjam = $_POST['id_pinjam'];
    $id_buku = $_POST['id_buku'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $sql = "UPDATE datapeminjaman SET tgl_kembali = '$tgl_kembali',
            status = 'kembali' WHERE id_pinjam = $id_pinjam";
    $res = mysqli_query($connect,$sql);
    $count = mysqli_affected_rows($connect);
    
    $stok_update = ambilstok($id_buku) + 1;

    if($count = 1){
        updatestok($id_buku,$stok_update);
        $denda = hitungdenda($id_pinjam,$tgl_kembali);

        $sql = "UPDATE datapeminjaman SET denda = $denda WHERE id_pinjam = $id_pinjam";
        $res = mysqli_query($connect,$sql);

        header("Location: detail.php?id_pinjam=$id_pinjam");
    }

}else{
    header("Location: index.php");
}

?>