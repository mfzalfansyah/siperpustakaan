<?php
include 'koneksi.php';

$sql= "SELECT * FROM databuku ORDER BY judul";

$res = mysqli_query($connect, $sql);

$pinjam = array();

while($data = mysqli_fetch_assoc($res)){
    $pinjam[] = $data;
}

include '../aset/header.php';
?>

<div class="card">
  <div class="card-header">
    <h2 class="card-title"><i class="fas fa-book"></i> Data Buku</h2>
  </div>
  <br>
  <center>
  <a href="tambah.php" class="btn btn-secondary btn-lg active" role="buttonlmo" aria-pressed="true">Tambah Data</a>
  </center>
  <div class="card-body">
  <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Judul</th>
      <th scope="col">Pengarang</th>
      <th scope="col">Stock</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no=1;
        foreach($pinjam as $p){
    ?>
    <tr>
        <th scope="row"><?=$no?></th>
        <td><?=$p['judul']?></th>
        <td><?=$p['pengarang']?></th>
        <td><?=$p['stok']?></th>
        <td>
        <a href="detail.php?id_buku=<?= $p['id_buku'];?>" class="badge badge-success">Detail</a>
        <a href="edit.php?id_buku=<?= $p['id_buku'];?>" class="badge badge-danger">Edit</a>
        <a href="hapus.php?id_buku=<?= $p['id_buku'];?>" class="badge badge-warning">Hapus</a>
        </td>
    </tr>
    <?php
    $no++;
        }
    ?>
  </tbody>
</table>
  </div>
</div>

<?php
include '../aset/footer.php';
?>
