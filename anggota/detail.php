<?php

include 'koneksi.php';

include '../aset/header.php';

$id = $_GET["id_anggota"];

$query = mysqli_query($connect, "SELECT * FROM dataanggota INNER JOIN level USING(id_level) WHERE dataanggota.id_anggota = '$id' ");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

        <div class="container">
            <div class="row mt-4">
                <div class="col-md">
                </div>
            </div>
        </div>

            <div class="card">
            <div class="card-header">
            <h2 class="card-title">Detail Anggota</h2>                
            </div>
            <div class="card-body">

                <table class="table">    
                <?php
                    while($buku = mysqli_fetch_assoc($query)):?>
                    
                    <tr>
                        <td width="150px">Nama</td>
                        <td><?= $buku['nama']?></td>
                    </tr>    
                    <tr>
                        <td>ID</td>
                        <td><?= $buku['id_anggota']?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td><?= $buku['kelas']?></td>
                    </tr>
                    <tr>
                        <td>telp</td>
                        <td><?= $buku['telp']?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?= $buku['username']?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><?= $buku['password']?></td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td><?= $buku['level']?></td>
                    </tr>
                        <td>Aksi</td>     
                        <td>
                           <a href="edit.php?id_anggota=<?= $buku["id_anggota"];?>  " class="badge badge-warning">Edit</a>
                           <a href="hapus.php?id_anggota=<?= $buku["id_anggota"];?> " onclick="return confirm('Yakin ingin menghapus data?')" class="badge badge-danger">Hapus</a>
                        </td>
                     </tr>
                 <?php
                   endwhile;
                 ?>            

                </table>
                            </div>
                            </div>

</body>
</html>

<?php

include '../aset/footer.php';

?>