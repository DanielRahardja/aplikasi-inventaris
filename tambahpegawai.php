<?php
// Call Database
include 'koneksi.php';
//Bagian Pegawai
$namaPegawai= $_POST['namaPegawai'];
$alamat= $_POST['alamat'];
$jenisKelamin= $_POST['jenisKelamin'];
$tglLahir= $_POST['tglLahir'];
$role= $_POST['role'];
//Bagian Akun
$email=$_POST['email'];
$password=$_POST['psw'];

     $query = "INSERT INTO pegawai VALUES ('','$namaPegawai','$alamat','$jenisKelamin','$tglLahir','$role','Aktif')";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              $tambahAkun= "INSERT INTO users VALUES ('','$namaPegawai','$email',MD5('$password'),'$role')";
              $result2 = mysqli_query($koneksi, $tambahAkun);
              if(!result2){
                die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
              }else{
                echo "<script>window.location='halamanadmin.php?url=pegawai'; alert('Data berhasil ditambahkan.'); </script>";
              }   
        }

?>