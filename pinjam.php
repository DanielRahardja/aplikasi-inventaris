<?php
// Call Database
include 'koneksi.php';

$petugas= $_POST['petugas'];
$tglPinjam= $_POST['tglPinjam'];
$tglKembali= $_POST['tglKembali'];
$peminjam= $_POST['peminjam'];
$barang= $_POST['barang'];
$jumlahPinjam= $_POST['jumlahPinjam'];
$ruang= $_POST['ruang'];
$keperluan= $_POST['keperluan'];

     $query = "INSERT INTO inventaris VALUES ('','$tglPinjam','$tglKembali','$petugas','$peminjam','$barang','$jumlahPinjam','$ruang','$keperluan','Sedang Dipinjam',NOW())";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //Input data pinjam
              $pinjam="INSERT INTO pinjam VALUES('','$peminjam','$tglPinjam','$barang','$jumlahPinjam','$ruang','$keperluan','$petugas')";
              $result2= mysqli_query($koneksi, $pinjam);
                if(!$result2){
                    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                      " - ".mysqli_error($koneksi));
                }else{
                    //Stok berkurang otomatis
                    $kurangiStok = "UPDATE barang SET stok= stok-'$jumlahPinjam' where namaBarang='$barang'";
                    $result3 = mysqli_query($koneksi, $kurangiStok);
                    //tampil alert dan akan redirect ke halaman index.php
                    echo "<script>window.location='halamanoperator.php?url=inventaris';alert('Data berhasil ditambahkan.'); </script>";
                }
              
        }

?>