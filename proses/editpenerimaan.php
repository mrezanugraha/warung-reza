<?php

include '../config/koneksi.php';

$id = $_POST['id'];
$id_penerimaan = $_POST['id_penerimaan'];
$id_barang = $_POST['id_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$tanggal_penerimaan = $_POST['tanggal_penerimaan'];

$query = "UPDATE penerimaan_barang SET 
            id_penerimaan = '$id_penerimaan',
            id_barang = '$id_barang',
            jumlah_barang = '$jumlah_barang',
            tanggal_penerimaan = '$tanggal_penerimaan'
            WHERE id = $id";

$result = mysqli_query($koneksi, $query);

if ($result) {
    header('location:../views/penerimaan.php');
} else {
    echo "Data gagal diubah";
}
?>
