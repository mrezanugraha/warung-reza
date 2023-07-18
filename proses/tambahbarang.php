<?php 

    include '../config/koneksi.php';

    $id_barang                = $_POST['id_barang'];
    $nama_barang             = $_POST['nama_barang'];
    $kategori_barang             = $_POST['kategori_barang'];
    $harga_barang             = $_POST['harga_barang'];
    
   if ($id_barang==''){
    echo '<script type ="text/JavaScript">';  
    echo 'alert("ID Barang Tidak Boleh Kosong")';  
    echo '</script>';
  }
        
      else{ 
        $query = "INSERT INTO barang (id_barang, nama_barang, kategori_barang, harga_barang) VALUES ('$id_barang', '$nama_barang', '$kategori_barang', '$harga_barang')";
      }

    $result = mysqli_query($koneksi,$query);

    if ($result) {
        header('location: ../views/barang.php');
    }

    else{
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Tambah Data Gagal")';  
        echo '</script>';   
    }
    
?>