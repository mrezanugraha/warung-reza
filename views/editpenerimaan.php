<?php 
    include '../config/koneksi.php';
        // Mulai sesi
        session_start();

        // Periksa status login pengguna
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Jika pengguna belum login, alihkan ke halaman login
            header("Location: ../index.php");
            exit();
        }
    
        // Set header-cache untuk mencegah caching halaman
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    
        // Konten halaman yang memerlukan autentikasi
        // ...
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php 
    session_start();
    ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-warning">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Warung Reza</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-secondary bg-warning" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link text-white" href="./home.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Tabel</div>
                    <a class="nav-link text-white" href="./barang.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                        Barang
                    </a>
                    <a class="nav-link text-black active" href="./penerimaan.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                        Penerimaan Barang
                    </a>
                    <a class="nav-link text-white" href="./penjualan.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                        Penjualan
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
            <a class="btn btn-danger ms-auto me-2" href="../proses/logout.php">Logout</a>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
        <?php
            include '../config/koneksi.php';
            $id = $_GET['id'];
            $query = "SELECT * FROM penerimaan_barang WHERE id = '$id'";
            $result = mysqli_query($koneksi, $query);
            $data = mysqli_fetch_assoc($result);
        ?>
        <div class="container-fluid px-4">
                <h1 class="my-4 text-center">Edit Penerimaan Barang</h1>
                <div class="col-md-8 m-auto card p-5 shadow -3 mb-5 bg-body rounded">
                        <form enctype="multipart/form-data" action="../proses/editpenerimaan.php" method="post">	
                            <input type="hidden" name="id" value="<?= $id ?>">				
                           <div class="mb-3">
                             <label for="exampleFormControlInput1" class="form-label">ID Penerimaan</label>
                               <input name="id_penerimaan" type="text" class="form-control id=exampleFormControlInput1" value="<?= $data['id_penerimaan'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">ID Barang</label>
                                <select name="id_barang" class="form-control" id="exampleFormControlSelect1">
                                    <?php
                                    // Mengambil daftar ID Barang dari tabel barang
                                    $query_barang = "SELECT id_barang FROM barang";
                                    $result_barang = mysqli_query($koneksi, $query_barang);

                                    // Menampilkan setiap ID Barang sebagai pilihan dropdown
                                    while ($row_barang = mysqli_fetch_assoc($result_barang)) {
                                        $id_barang = $row_barang['id_barang'];
                                        $selected = ($id_barang == $data['id_barang']) ? 'selected' : '';
                                        echo "<option value=\"$id_barang\" $selected>$id_barang</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jumlah Barang</label>
                                <input name="jumlah_barang" type="text" class="form-control id=exampleFormControlInput1" value="<?= $data['jumlah_barang'] ?>">
                            </div>
                            <div class="mb-3">
                             <label for="birthday">Tanggal Penerimaan</label>
                                <br>
                                <input type="date" id="tanggal" name="tanggal_penerimaan" value="<?= $data['tanggal_penerimaan']?>">
                            </div>
                            <div class="d-flex justify-content-around">
                                <button name="submit" class="btn btn-md btn-success px-5 mt-2">Edit</button>
                                <a href="./penerimaan.php" class="btn btn-md btn-danger px-5 mt-2">Cancel</a>
                            </div>
                    </form>
                </div> 
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Muhammad Reza Nugraha 2023</div>
                </div>
            </div>
        </footer>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="../js/script.js"></script>
    </body>
</html>
