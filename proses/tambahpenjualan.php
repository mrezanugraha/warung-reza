<?php
include '../config/koneksi.php';

$id_penjualan = $_POST['id_penjualan'];
$id_barang = $_POST['id_barang'];
$jumlah_barang_terjual = $_POST['jumlah_barang_terjual'];
$tanggal_penjualan = $_POST['tanggal_penjualan'];

// Validasi apakah id_barang ada di tabel barang
$query = "SELECT COUNT(*) FROM barang WHERE id_barang = '$id_barang'";
$result = mysqli_query($koneksi, $query);
$count = mysqli_fetch_row($result)[0];

if ($count > 0) {
    // id_barang valid, lakukan operasi INSERT pada tabel penerimaan_barang
    $query_insert = "INSERT INTO penjualan (id_penjualan, id_barang, jumlah_barang_terjual, tanggal_penjualan) VALUES ('$id_penjualan', '$id_barang', '$jumlah_barang_terjual', '$tanggal_penjualan')";
    $result_insert = mysqli_query($koneksi, $query_insert);

    if ($result_insert) {
        header('location: ../views/penjualan.php');
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