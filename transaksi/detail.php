<?php
include '../aset/header.php';

include 'koneksi.php';
$id_pinjam = $_GET['id_pinjam'];

$sql = "SELECT * FROM datapeminjaman INNER JOIN databuku on datapeminjaman.id_buku = databuku.id_buku WHERE id_pinjam = $id_pinjam";
$res = mysqli_query($connect,$sql);
$detail = mysqli_fetch_assoc($res);
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-7">
            <h2>Detail Peminjaman</h2>
            <hr class="bg-light">
              <table class="table table-bordered">
                  <tr>
                      <td><strong>Buku</strong></td>
                      <td><?= $detail['judul']?></td>
                  </tr>
                  <tr>
                      <td><strong>Tanggal pinjam</strong></td>
                      <td><?= date('d F Y', strtotime($detail['tgl_pinjam'])) ?></td>
                  </tr>
                  <tr>
                      <td><strong>Tanggal Jatuh Tempo</strong></td>
                      <td><?= date('d F Y', strtotime($detail['tgl_jatuh_tempo'])) ?></td>
                  </tr>
                  <tr>
                      <td><strong>Tanggal Kembali</strong></td>
                      <td>
                          <?php
                          if($detail['tgl_kembali'] == '0000-00-00'){
                              echo '-';
                          }else{
                              echo date('d F Y',strtotime($detail['tgl_kembali']));
                          }
                          ?>
                      </td>
                  </tr>
                  <tr>
                      <td><strong>Status</strong></td>
                      <td><?= $detail['status']?></td>
                  </tr>
                  <?php
                    if($detail['denda'] > 0){?>
                  <tr>
                      <td class="table-danger" colspan="2"><strong>Denda yang harus dibayar:</strong>Rp <?=$detail['denda']?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  <tr>
                      <td class="text-right" colspan="2">
                          <a href="index.php" class="btn btn-succes"><i class="fa fa-angle-double-left"></i>Kembali</a>
                          <a class="btn btn-primary <?php if($detail['status'] == 'kembali'){echo "disabled";} ?>"
                          href="form-kembali.php?id_pinjam=<?= $detail['id_pinjam']?>&id_buku=<?= $detail['id_buku']?>"
                          role="button">Form Pengembalian</a>
                      </td>
                  </tr>    
              </table>
        </div>
    </div>
</div>

<?php
include '../aset/footer.php'
?>