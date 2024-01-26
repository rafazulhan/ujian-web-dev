<?php
require "koneksi.php";

// function untuk mengambil seluruh data mahasiswa dari database
function selectAllMahasiswa()
{
    global $koneksi;
    $query = "SELECT * FROM mhs ORDER BY id DESC";
    $result = mysqli_query($koneksi, $query);

    return $result;
}

function insertMahasiswa($value)
{
    // memanggil variable koneksi
    global $koneksi;

    var_dump($value);

    // untuk menampung data
    $nim = $value["nim"];
    $nama = $value["nama"];
    $email = $value["email"];
    $foto = $value["foto"];

    // untuk menginputkan/memasukan/insert data ke dalam database pada tabel mhs
    $query = "INSERT INTO mhs (nim, nama, email, foto) VALUE ('$nim','$nama','$email','$foto')";
    mysqli_query($koneksi, $query);

    // untuk mengecek apakah ada baris (row) yang terpengaruh (affected) saat query ke database
    return mysqli_affected_rows($koneksi);
}

// program untuk menghapus data mahasiswa
function deleteMahasiswa($id)
{
    global $koneksi;
    // query update data pada tabel mhs
    mysqli_query($koneksi, "DELETE FROM mhs WHERE id = '$id'");

    return mysqli_affected_rows($koneksi);;
}

// program untuk mengupdate data mahasiswa
function updateMahasiswa($value)
{
    global $koneksi;
    // untuk menampung data
    $id = $value["id"];
    $nim = $value["nim"];
    $nama = $value["nama"];
    $email = $value["email"];
    $foto =  $value["foto"];

    // query update data pada tabel mhs
    $query = "UPDATE mhs SET nim = '$nim', nama = '$nama', email = '$email',foto = '$foto' WHERE id = '$id'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}




// variabel & function = camelCase
// class = EeachCapitalLater
// const = CAPTIAL
// nama file php = kebab-case (sate-case)
// nama database & tabel & coloumn = under_score
