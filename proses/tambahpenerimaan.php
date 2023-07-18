<?php
include '../config/koneksi.php';

$id_penerimaan = $_POST['id_penerimaan'];
$id_barang = $_POST['id_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$tanggal_penerimaan = $_POST['tanggal_penerimaan'];

// Validasi apakah id_barang ada di tabel barang
$query = "SELECT COUNT(*) FROM barang WHERE id_barang = '$id_barang'";
$result = mysqli_query($koneksi, $query);
$count = mysqli_fetch_row($result)[0];

if ($count > 0) {
    // id_barang valid, lakukan operasi INSERT pada tabel penerimaan_barang
    $query_insert = "INSERT INTO penerimaan_barang (id_penerimaan, id_barang, jumlah_barang, tanggal_penerimaan) VALUES ('$id_penerimaan', '$id_barang', '$jumlah_barang', '$tanggal_penerimaan')";
    $result_insert = mysqli_query($koneksi, $query_insert);

    if ($result_insert) {
        header('location: ../views/penerimaan.php');
    } else {
        echo '<script type="text/JavaScript">';
        echo 'alert("Tambah Data Gagal")';
        echo '</script>';
    }
} else {
    // id_barang tidak valid, tampilkan pesan kesalahan atau lakukan tindakan sesuai kebutuhan
    echo '<script type="text/JavaScript">';
    echo 'alert("ID Barang tidak valid")';
    echo '</script>';
}
?>