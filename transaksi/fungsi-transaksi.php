<?php

$koneksi = mysqli_connect("localhost","root","","siperpustakaan");

function ambilbuku($id){
    global $connect;

    $sql = "SELECT * FROM databuku";
    $res = mysqli_query($connect,$sql);

    $data_buku = array();

    while ($data = mysqli_fetch_assoc($res)){
        $data_buku[] = $data;
    }
    return $data_buku;
}

function ambilanggota($id){
    global $connect;
    $sql = "SELECT * FROM dataanggota";
    $res = mysqli_query($connect,$sql);

    $data_anggota = array();

    while ($data = mysqli_fetch_assoc($res)){
        $data_anggota[] = $data;
    }
    return $data_anggota;
}

function ambilpeminjaman($id_pinjam){
    global $connect;
    $sql = "SELECT * FROM datapeminjaman INNER JOIN dataanggota
            ON datapeminjaman.id_anggota = dataanggota.id_anggota
            INNER JOIN databuku ON datapeminjaman.id_buku = databuku.id_buku
            WHERE id_pinjam = $id_pinjam";

    $res = mysqli_query($connect,$sql);
    $data = mysqli_fetch_assoc($res);
    
    return $data;
}

function ambilstok($id_buku){
    global $connect;
    $sql = "SELECT stok FROM databuku WHERE id_buku = $id_buku";
    $res = mysqli_query($connect,$sql);

    $data = mysqli_fetch_assoc($res);

    return $data['stok'];
}

function cekpinjam($id_anggota){
    global $connect;
    $sql = "SELECT * FROM datapeminjaman WHERE id_anggota = $id_anggota AND status='dipinjam'";
    $res = mysqli_query($connect,$sql);

    $pinjam = mysqli_affected_rows($connect);

    if($pinjam == 0){
        return true;
    }else{
        return false;
    }
}

function updatestok($id_buku,$stok_update){
    global $connect;
    $sql = "UPDATE databuku SET stok = $stok_update WHERE id_buku = $id_buku";
    $res = mysqli_query($connect,$sql);
}

function hitungdenda($id_pinjam,$tgl_kembali){
    global $connect;
    $denda = 0;

    $sql = "SELECT tgl_jatuh_tempo FROM datapeminjaman WHERE id_pinjam = $id_pinjam";
    $res = mysqli_query($connect,$sql);
    $data = mysqli_fetch_assoc($res);
    $tgl_jatuh_tempo = $data['tgl_jatuh_tempo'];

    $hari_denda = (strtotime($tgl_kembali) - strtotime($tgl_jatuh_tempo))/60/60/24;

    if($hari_denda > 0){
        $denda = $hari_denda*1000;
    }
    return $denda;
}

?>