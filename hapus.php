<?php
//memanggil file koneksi
require "koneksi.php";

//memindahkan data kiriman dari form ke var biasa / penampung
$id = $_GET["id"];
$foto = $_GET["foto"];

//membuat query hapus data
$sql = "DELETE FROM mhs WHERE id=$id";
mysqli_query($koneksi, $sql);
unlink('foto/' . $foto);
header("location:index.php");
