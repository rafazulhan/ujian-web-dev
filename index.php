<?php
// memanggil file luat
require "koneksi.php";
require "simpan-edit-data.php";

if (isset($_GET['hal'])) {
    //Pengujian jika edit Data
    if ($_GET['hal'] == "edit") {
        //Tampilkan Data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM mhs WHERE id = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //Jika data ditemukan, maka data ditampung ke dalam variabel
            $vnim = $data['nim'];
            $vnama = $data['nama'];
            $vemail = $data['email'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Praktikum 1</title>
    <!-- memanggil bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center">CRUD Data Mahasiswa</h1>
        <h2 class="text-center">Rafa Indriya Zulhan (A12.2020.06490)</h2>

        <!-- Menampilkan tampilan header sebagai wadah input data mahasiswa menggunakan bootstrap -->
        <!-- Awal card form Bootstrap -->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Form Input Data Mahasiswa
            </div>
            <div class="card-body">
                <!-- Menampilkan form input -->
                <form method="post" enctype="multipart/form-data" action="simpan-edit-data.php">
                    <!-- form input NIM -->
                    <div class="form-group">
                        <label for="">NIM</label>
                        <input type="text" name="tnim" class="form-control" value="<?= @$vnim ?>" placeholder="Masukkan NIM anda disini" required>
                    </div>
                    <!-- form input Nama -->
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="tnama" class="form-control" value="<?= @$vnama ?>" placeholder="Masukkan Nama anda disini" required>
                    </div>
                    <!-- form input Email -->
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="text" name="temail" class="form-control" value="<?= @$vemail ?>" placeholder="Masukkan E-Mail anda disini" required>
                    </div>
                    <!-- form input Foto -->
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" name="foto" class="form-control" placeholder="Masukkan Foto anda disini"required>
                    </div>
                    <!-- menampilkan tombol simpan -->
                    <button type="submit" class="btn btn-success mt-3" name="bsimpan">Simpan</button>
                    <!-- menampilkan tombol kosongkan -->
                    <?php
                    if (isset($_GET['hal'])) {
                        echo '<a href="index.php" class="btn btn-danger mt-3">Kosongkan</a>';
                    } else {
                        echo '<button type="reset" class="btn btn-danger mt-3" name="breset">Kosongkan</button>';
                    }
                    ?>

                </form>
            </div>
        </div>
        <!-- Akhir card form Bootstrap -->

        <!-- Menampilkan tabel data mahasiswa menggunakan bootstrap -->
        <!-- Awal card tabel Bootstrap -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                Daftar Mahasiswa
            </div>
            <div class="card-body">
                <!-- membuat kerangka tabel -->
                <table class="table table-bordered table-striped">
                    <tr>
                        <!-- tabel heading -->
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>E-Mail</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;
                    $tampil = selectAllMahasiswa();
                    while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                        <tr>
                            <!-- menampilkan tabel data berdasarkan tabel database mhs -->
                            <td><?= $no++; ?></td>
                            <td><?= $data['nim'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><img class="img-thumbnail rounded-2" width="200px" src="foto/<?= $data['foto'] ?>"></td>
                            <td>
                                <!-- program untuk pindah ke halaman index.php untuk edit berdasarkan data id -->
                                <a href="index.php?hal=edit&id=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                                <!-- program untuk pindah ke halaman hapus.php untuk menghapus data berdasarkan data id dan foto -->
                                <a href="hapus.php?id=<?= $data['id'] ?>&foto=<?= $data['foto'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                            </td>
                        </tr>
                    <?php endwhile; //penutup perulangan while 
                    ?>
                </table>
            </div>
        </div>
        <!-- Akhir card tabel Bootstrap -->
    </div>
    <!-- memanggil bootstrap js -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>