<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Aplikasi Inventaris- Admin</title>
    <!-- Asset Setup -->
    <!-- Panggil CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="assets/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
    <?php 
        session_start();
        require('koneksi.php');
	    // cek apakah yang mengakses halaman ini sudah login
	    if($_SESSION['privelege']!="Admin"){
            if($_SESSION['privelege']=="Supplier"){
                header("location:halamansupplier.php");
            }elseif ($_SESSION['privelege']=="Operator") {
                header("location:halamanoperator.php");
            }else {
                header("location:index.php?pesan=gagal");
            }
	    }

	?>
    <!-- Dynamic Navigator -->
    <div class="container">
        <div>
            <div class="header">
                <!-- Navigation Bar -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <a class="navbar-brand" href="?url=home">Aplikasi Inventaris</a>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <!-- Dropdown for Data Input -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Data Master
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?url=barang">Data Barang<i class="fa-solid fa-box fa-sm ml-1"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=lantai">Data Lantai<i class="fa-solid fa-elevator ml-2"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=gedung">Data Gedung<i class="fa-solid fa-building fa-sm ml-1"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Kategori
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="?url=kategoriruang">Kategori Ruangan<i class="fa fa-list ml-2"></i></a>
                            <a class="dropdown-item" href="?url=kategoribarang">Kategori Barang<i class="fa fa-list ml-2"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manajemen
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?url=pegawai">Pegawai<i class="fa-solid fa-clipboard-user ml-1"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=ruang">Ruangan<i class="fa-solid fa-door-open fa-sm ml-1"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Inventaris
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?url=inventaris">Inventaris<i class="fa-solid fa-truck-arrow-right fa-sm ml-1"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Rekap Data
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="?url=barangmasuk">Barang Masuk<i class="fa-solid fa-book ml-1"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=rekap-inventaris">Data Inventaris<i class="fa-solid fa-book ml-1"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=rekap-peminjaman">Data Peminjaman<i class="fa-solid fa-book ml-1"></i></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=rekap-pengembalian">Data Pengembalian<i class="fa-solid fa-book ml-1"></i></a>
                            </div>
                        </li>
                        
                    </ul>
                    <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="margin-left: -200px;">
                                <table>
                                    <tr><strong>Notifikasi Barang</strong></tr>
                                    <div class="dropdown-divider"></div>
                                    <?php
                                        $resultBarang= mysqli_query($koneksi,"Select * from barang");
                                        while ($dataStok= mysqli_fetch_assoc($resultBarang)){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                if ($dataStok['stok']== 0) {
                                                ?>
                                                <label class=" bg-danger text-white">Stok <?php echo $dataStok['namaBarang']; ?> habis</label>
                                                <?php
                                                }elseif ($dataStok['stok']<= 5) { ?>
                                                <label class="bg-warning text-white">Stok <?php echo $dataStok['namaBarang']; ?> sisa <?php echo $dataStok['jumlah']; ?></label>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Informasi Akun -->
                                    
                                    <?php
                                        //Fetch User
                                        $namaAkun= $_SESSION['namaAkun'];
                
                                        $result= mysqli_query($koneksi,"Select * from users where namaAkun='".$namaAkun."'");
                                        if (mysqli_num_rows($result) >0) {
                                            while ($data= mysqli_fetch_assoc($result)){
                                            echo $namaAkun;
                                    ?>

                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <h6 class="dropdown-header">Profile</h6>
                                <a class="dropdown-item" href="?url=profile"><i class="fa fa-user-circle"></i>
                                    <?php
                                            echo $namaAkun;
                                            }
                                        }
                                    ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?url=logout" onclick="return confirm('Anda yakin mau keluar dari akun ?')">Logout<i class="fa-solid fa-power-off ml-1" style="color: #fd0808;"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
                </nav>
            </div>
            <!-- End Navbar -->
            <div class="content">
                <?php
                    if (isset($_GET['url'])) {
                        //Navigator Management
                        if ($_GET['url']=="home"){
                            include 'admin/home.php';
                        }
                        // Navigator Management= Input Data
                        elseif($_GET['url']=="barang") {
                            include 'admin/barang.php';
                        }
                        // Navigator Management= Kategori
                        elseif($_GET['url']=="kategoribarang"){
                            include 'admin/kategoribarang.php';
                        }
                        elseif($_GET['url']=="kategoriruang"){
                            include 'admin/kategoriruang.php';
                        }
                        elseif($_GET['url']=="kategoridevice"){
                            include 'admin/kategoridevice.php';
                        }
                        // Navigator Management= Input Data Ruang & Supplier
                        elseif ($_GET['url']=="ruang") {
                            include 'admin/ruang.php';
                        }elseif ($_GET['url']=="supplier") {
                            include 'admin/supplier.php';
                        }elseif ($_GET['url']=="lantai") {
                            include 'admin/lantai.php';
                        }elseif ($_GET['url']=="gedung") {
                            include 'admin/gedung.php';
                        }
                        // Inventaris
                        elseif ($_GET['url']=="inventaris") {
                            include 'admin/inventaris.php';
                        }
                        //Navigator Management: Karyawan
                        elseif ($_GET['url']=="pegawai") {
                            include 'admin/pegawai.php';
                        }
                        //Navigator Management: Rekap Data
                        elseif ($_GET['url']=="barangmasuk") {
                            include 'admin/rekap/barangmasuk.php';
                        }elseif ($_GET['url']=="rekap-inventaris") {
                            include 'admin/rekap/inventaris.php';
                        }elseif ($_GET['url']=="rekap-peminjaman") {
                            include 'admin/rekap/peminjaman.php';
                        }elseif ($_GET['url']=="rekap-pengembalian") {
                            include 'admin/rekap/pengembalian.php';
                        }
                        // Export
                        elseif ($_GET['url']=="export-inventaris") {
                            include 'admin/rekap/export/export-inventaris.php';
                        }
                        elseif ($_GET['url']=="export-barangmasuk") {
                            include 'admin/rekap/export/export-barangmasuk.php';
                        }elseif ($_GET['url']=="export-peminjaman") {
                            include 'admin/rekap/export/export-peminjaman.php';
                        }
                        // Navigator Management: Akun
                        elseif ($_GET['url']=="profile") {
                            include 'public/profile.php';
                        }
                        elseif ($_GET['url']=="logout") {
                            include 'logout.php';
                        }
                    }else{
                        include 'admin/home.php';
                    } 
                ?>
            </div>
            <div class="footer">
                <p><center>Copyright &copy; 2023 Daniel Rahardja </center></p>
            </div>
        </div>
    </div>
    
    <!-- Closing Style -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Closing DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>