<?php
include 'koneksi.php';
include '../aset/header.php';

$query = mysqli_query($connect, "SELECT * FROM kategori")

?>
<div class="container">
 <div class="row mt-4">
  <div class="col-md-9">
   <div class="card">
    <div class="card-header">
    <h2>Tambah Data Buku</h2>
    </div>
    <div class="card-body">
         <form method="post" action="proses-tambah.php">

         
                <div class="form-group">
                 <label for="buku">Judul</label>
                 <input type="text" class="form-control" name="judul" id="judul">
                </div>

                <div class="form-group">
                 <label for="buku">Penerbit</label>
                 <input type="text" class="form-control" name="penerbit" id="penerbit">
                </div>  

                <div class="form-group">
                 <label for="buku">Pengarang</label>
                 <input type="text" class="form-control" name="pengarang" id="pengarang">
                </div>

                <div class="form-group">
                 <label for="buku">Ringkasan</label>
                 <textarea name="ringkasan" id="ringkasan" class="form-control"></textarea>
                </div>

                <div class="form-group">
                 <label for="buku">Cover:  </label>
                 <input type="file" name="cover" id="cover"  value="<?= $edit['cover']?>"> 
                 </div>
                
                <div class="form-group">
                 <label for="buku">Stok</label>
                 <input type="number" class="form-control" name="stok" id="stok">
                </div>
                
                <div class="form-group">
                 <label for="buku">Kategori</label>
                 <select name="id_kategori" class="form-control" id="id_kategori">
                     <option value="">-- Pilih Kategori --</option>

                        <?php while($kategori = mysqli_fetch_assoc($query)):?>
                      <option value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori["kategori"]; ?></option>
                        <?php endwhile; ?>
                 </select>
                </div>
                
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