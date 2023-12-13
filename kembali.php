<?php
// Call Database
include 'koneksi.php';

$id= $_POST['no'];
$petugas= $_POST['petugas'];
$peminjam= $_POST['peminjam'];
$ruangan= $_POST['ruangan'];
$tglBatas= $_POST['tglBatas'];
$tglKembali= $_POST['tglKembali'];
$catatan=$_POST['catatan'];
//Jumlah barang dipinjam
$jPinjam= $_POST['jPinjam'];
//Jumlah barang yang dikembalikan
$jKembali= $_POST['jKembali'];
//Digunakan untuk update stok di data barang
$barang= $_POST['barang'];
$kondisi=$_POST['kondisi'];
//Jika input data barang melebihi barang yang dipinjam
if ($jKembali > $jPinjam || $jKembali < $jPinjam) {
    echo "<script>window.location='halamanoperator.php?url=inventaris'; alert('Input jumlah kembalian melebihi jumlah barang yang dipinjam.');</script>";
} else {
    //Mulai Pengembalian barang
    if ($tglKembali > $tglBatas) {
        $terlambat="UPDATE inventaris SET statuspeminjaman='Terlambat' where no='$id'";
        $hasilTerlambat = mysqli_query($koneksi, $terlambat);
        if(!$hasilTerlambat){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                " - ".mysqli_error($koneksi));
        }
    }else {
        $selesai="UPDATE inventaris SET statuspeminjaman='Selesai' where no='$id'";
        $hasilSelesai = mysqli_query($koneksi, $selesai);
        if(!$hasilSelesai){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                " - ".mysqli_error($koneksi));
        }
    }
    // periska query apakah ada error
        $insertkembali= "INSERT into kembali values('','$tglKembali', '$peminjam','$barang','$ruangan','$petugas','$jKembali','$kondisi','$catatan')";
        $hasilKembali= mysqli_query($koneksi, $insertkembali);
        
        if ($kondisi=='Baik') {
            $tambahstok = "UPDATE barang SET stok= stok+'$jKembali' where namaBarang='$barang' ";
            $resultstok = mysqli_query($koneksi, $tambahstok);
            echo "<script>window.location='halamanoperator.php?url=inventaris'; alert('Proses peminjaman selesai.');</script>";
            
        }elseif ($kondisi=='Rusak') {
            $rusak = "UPDATE barang SET jumlahRusak= jumlahRusak+'$jKembali' where namaBarang='$barang'";
            $resultrusak = mysqli_query($koneksi, $rusak);
             echo "<script>window.location='halamanoperator.php?url=inventaris'; alert('Proses peminjaman selesai.');</script>";
        } 
    }   
?>