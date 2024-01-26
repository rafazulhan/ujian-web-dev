<?php
// memanggil file query.php
require "query.php";

//jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    // Program Simpan Foto
    // Set lokasi dan nama file foto
    $folderupload = "foto/";
    $fileupload = $folderupload . basename($_FILES['foto']['name']);
    $filefoto = basename($_FILES['foto']['name']);
    $uploadOk = true;

    //ambil jenis file
    $jenisfilefoto = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION));

    // Check jika file foto sudah ada
    if (file_exists($fileupload)) {
        echo "<script>
        		    alert('Maaf, file foto sudah ada');
        			document.location='index.php';
        	</script>";
        $uploadOk = false;
    }

    // Check ukuran file
    if ($_FILES["foto"]["size"] > 1000000) {
        echo "<script>
        		    alert('Maaf, ukuran file foto harus kurang dari 1 MB');
        			document.location='index.php';
        	</script>";
        $uploadOk = false;
    }

    // Hanya file tertentu yang dapat digunakan
    if (
        $jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg"
        && $jenisfilefoto != "gif"
    ) {
        echo "<script>
        		    alert('Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan');
        			document.location='index.php';
        	</script>";
        $uploadOk = false;
    }

    // Check jika terjadi kesalahan
    if ($uploadOk == false) {
        echo "<script>
        		    alert('Maaf, file tidak dapat terupload');
        			document.location='index.php';
        	</script>";
        // jika semua berjalan lancar
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
            //Pengujian Apakah data akan diedit atau disimpan baru
            if ($_GET['hal'] == "edit") {
                //Data akan di edit
                $value = [
                    'id' => $_GET['tid'],
                    'nim' => $_POST['tnim'],
                    'nama' => $_POST['tnama'],
                    'email' => $_POST['temail'],
                    'foto' => $_FILES['foto']['name']
                ];
                $edit = updateMahasiswa($value);
                if ($edit) //jika edit sukses
                {
                    // menampilkan pemberitahuan berhasil
                    echo "<script>
                        alert('Edit data suksess!');
                        document.location='index.php';
                        </script>";
                } else {
                    // menampilkan pemberitahuan gagal
                    echo "<script>
        				alert('Edit data GAGAL!!');
        				document.location='index.php';
        		     </script>";
                }
            } else {
                //Data akan disimpan Baru
                $value = [
                    'nim' => $_POST['tnim'],
                    'nama' => $_POST['tnama'],
                    'email' => $_POST['temail'],
                    'foto' => $_FILES['foto']['name']
                ];
                $simpan = insertMahasiswa($value);
                if ($simpan) //jika simpan sukses
                {
                    // menampilkan pemberitahuan berhasil
                    echo "<script>
        				alert('Simpan data suksess!');
        				document.location='index.php';
        		     </script>";
                } else {
                    // menampilkan pemberitahuan gagal
                    echo "<script>
        				alert('Simpan data GAGAL!!');
        				document.location='index.php';
        		     </script>";
                }
            }
        } else {
            echo "<script>
        				alert('Maaf, terjadi kesalahan saat mengupload file foto');
        				document.location='index.php';
        		     </script>";
        }
    }
}
