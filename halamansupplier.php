<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventaris- Supplier</title>
    <!-- Asset Setup -->
    <!-- Panggil CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- FontAwesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <script src="https://kit.fontawesome.com/cf0577f10a.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" type="text/css" href="assets/fontawesome-free/css/all.min.css">
</head>
<body>
    <?php 
        session_start();
        require('koneksi.php');
	    // cek apakah yang mengakses halaman ini sudah login
	    if($_SESSION['privelege']!="Supplier"){
            if($_SESSION['privelege']=="Admin"){
                header("location:halamanadmin.php");
            }elseif ($_SESSION['privelege']=="Operator") {
                header("location:halamanoperator.php");
            }else {
                header("location:index.php?pesan=gagal");
            }
	    }

	?>
    <div class="container">
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
                            Inventaris
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="?url=barang">Lihat Barang<i class="fa-solid fa-box fa-sm ml-1"></i></a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
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
                            <a class="dropdown-item" href="?url=profile"><i class="fa fa-user-circle mr-1"></i>
                                <?php
                                        echo $namaAkun;
                                        }
                                    }
                                ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?url=history">History<i class="fa-solid fa-clock ml-1"></i></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?url=logout" onclick="return confirm('Anda yakin mau keluar dari akun ?')">Logout<i class="fa-solid fa-power-off ml-1" style="color: #fd0808;"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
            </nav>
        </div>
        <!-- End Navbar -->
        <!-- Dynamic Navigator -->
        <div class="content">
            <?php
                if (isset($_GET['url'])) {
                    //Navigator Management
                    if ($_GET['url']=="home"){
                        include 'supplier/home.php';
                    }
                    elseif ($_GET['url']=="barang") {
                        include 'supplier/barang.php';
                    }
                    // Navigator Management: Akun
                    elseif ($_GET['url']=="profile") {
                        include 'supplier/profilsupplier.php';
                    }elseif ($_GET['url']=="history") {
                        include 'supplier/history.php';
                    }
                    elseif ($_GET['url']=="logout") {
                        include 'logout.php';
                    }
                }else{
                    include 'supplier/home.php';
                }
                
            ?>
        </div>
        <div class="footer">
            <p><center>Copyright &copy; 2023 Daniel Rahardja </center></p>
        </div>
    </div>
    
    
    <!-- Closing Style -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>