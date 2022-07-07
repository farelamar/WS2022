<?php
require 'functions.php';
// require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><i class="fas fa-coffee" ></i> Halal Food</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="stok.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Stok barang
                            </a> <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Barang Masuk
                            </a> <a class="nav-link" href="Keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Barang Keluar
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang keluar</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"  > 
                            Barang Keluar
                        </button>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                                <i class="fas fa-table me-1"></i>
                                Tabel Data
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Penerima</th>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $ambilsemuadata = mysqli_query($sqlconnection,"select*from keluar k, stock s where s.idbarang = k.idbarang");
                                        while($data=mysqli_fetch_array($ambilsemuadata)){
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $penerima = $data['penerima'];

                                        
                                        ?>
                                        <tr>
                                            <td><?=$tanggal?></td>
                                            <td><?=$namabarang?></td>
                                            <td><?=$qty?></td>
                                            <td><?=$penerima?></td>
                                        </tr>
                                        <?php
                                        };
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
                    <!-- Modal -->
                    <form method="post">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <select name="barangnya" class="form-control">
                                <?php
                                $ambilsemuadata = mysqli_query($sqlconnection, "select * from stock");
                                while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                    $namabarang = $fetcharray['namabarang'];
                                    $idbarang = $fetcharray['idbarang'];
                                ?>

                                <option value="<?=$idbarang;?>"><?=$namabarang;?></option>
                                
                                <?php
                                }
                                ?>
                            </select>
                            <br>
                            <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                            <br>
                            <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
                        </div>
            </form>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
            </div>
            </div>
        </div>
        </div>
</html>
