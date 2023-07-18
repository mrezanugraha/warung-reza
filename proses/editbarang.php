<?php

include '../config/koneksi.php';

$id = $_POST['id'];
$id_barang = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$kategori_barang = $_POST['kategori_barang'];
$harga_barang = $_POST['harga_barang'];

$query = "UPDATE barang SET 
            id_barang = '$id_barang',
            nama_barang = '$nama_barang',
            kategori_barang = '$kategori_barang',
            harga_barang = '$harga_barang'
            WHERE id = $id";

$result = mysqli_query($koneksi, $query);

if ($result) {
    header('location:../views/barang.php');
} else {
    echo "Data gagal diubah";
}
?>
