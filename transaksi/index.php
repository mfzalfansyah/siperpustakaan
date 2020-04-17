<?php
include 'koneksi.php';

$sql= "SELECT * FROM datapeminjaman INNER JOIN dataanggota
       ON datapeminjaman.id_anggota = dataanggota.id_anggota
       INNER JOIN datapetugas ON datapeminjaman.id_petugas = datapetugas.id_petugas
       ORDER BY datapeminjaman.tgl_pinjam";

$res = mysqli_query($connect, $sql);

$pinjam = array();

while($data = mysqli_fetch_assoc($res)){
    $pinjam[] = $data;
}

include '../aset/header.php';
?>

<div class="card">
  <div class="card-header">
    <h2 class="card-title"><i class="fas fa-hands-helping"></i> Data Peminjaman</h2>
  </div>
  <div class="card-body">
  <center>
  <a href="form-pinjam.php" class="btn btn-secondary btn-lg active" role="buttonlmo" aria-pressed="true">Tambah Peminjaman</a>
  </center>
  <br>
  <div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="inputGroupSelect01">Day</label>
						</div>
						<select class="custom-select " id="inputGroupSelect01">
							<option value="" selected>Choose</option>
							<option value="1">Yesterday</option>
							<option value="3">Three days ago</option>
							<option value="7">A week ago</option>
						</select>
						<form class="form-inline my-2 my-lg-0 ml-5">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="key">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</form>
					</div>
  <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Peminjam</th>
      <th scope="col">Tanggal Peminjam</th>
      <th scope="col">Tanggal Jatuh Tempo</th>
      <th scope="col">Petugas</th>
      <th scope="col">Status</th>
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
        <td><?=$p['nama']?></th>
        <td><?=date('d F Y', strtotime($p['tgl_pinjam']))?></th>
        <td><?=date('d F Y', strtotime($p['tgl_jatuh_tempo']))?></th>
        <td><?=$p['nama_petugas']?></th>
        <td>
        <?php
            if($p['status']=="dipinjam"){
                echo'<h5><span class="badge badge-info">Dipinjam</span><h5>';
            }else{
                echo'<h5><span class="badge badge-info">kembali</span><h5>';              
            }
        ?>
        </td>
        <td>
        <a href="detail.php?id_pinjam=<?= $p['id_pinjam'] ?>&nama=<?= $p['nama']?>" class="badge badge-success">Detail</a>
        <a href="form-edit.php?id_pinjam=<?= $p['id_pinjam']?>" class="badge badge-danger">Edit</a>
        <a href="hapus.php?id_pinjam=<?= $p['id_pinjam']?>" class="badge badge-warning">Hapus</a>
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
