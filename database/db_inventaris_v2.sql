-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Okt 2023 pada 09.42
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris_v2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `no` int(11) NOT NULL,
  `namaBarang` varchar(200) NOT NULL,
  `spesifikasi` text NOT NULL,
  `kategori` varchar(200) NOT NULL,
  `stok` int(20) NOT NULL,
  `jumlahRusak` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`no`, `namaBarang`, `spesifikasi`, `kategori`, `stok`, `jumlahRusak`) VALUES
(33, 'Realme 10', 'RAM 8 GB Storage 256 GB, Processor Helio G99', 'Alat Komunikasi', 99, 0),
(35, 'Infocus IN114XV', 'Resolusi Native : XGA (1024 x 768)\r\nResolusi Maksimum : WUXGA (1920 x 1200)\r\n3800 ansi lumens.\r\nContras Ratio 15000 : 1.\r\nHDMI.\r\nSpeaker MONO 2W x 1.\r\ninput : 3.5mm stereo audio, RS232, HDMI 1.4', 'Alat Presentasi', 134, 3),
(36, 'Flashdisk Toshiba', 'Storage 16 GB', 'Alat Penyimpanan Data', 85, 0),
(37, 'Oppo A37', 'RAM 2 GB', 'Alat Komunikasi', 20, 0),
(40, 'Harddisk Toshiba', 'Storage 1 TB', 'Alat Penyimpanan Data', 20, 0),
(41, 'Kabel Rol', 'Slot: 8 Slot', 'Alat Elektronik', 10, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedung`
--

CREATE TABLE `gedung` (
  `idGedung` int(11) NOT NULL,
  `namaGedung` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gedung`
--

INSERT INTO `gedung` (`idGedung`, `namaGedung`) VALUES
(1, 'Gedung A'),
(2, 'Gedung B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `no` int(11) NOT NULL,
  `tanggalpinjam` varchar(200) NOT NULL,
  `tanggalkembali` varchar(200) NOT NULL,
  `petugas` varchar(200) NOT NULL,
  `peminjam` varchar(200) NOT NULL,
  `barang` varchar(200) NOT NULL,
  `jumlahPinjam` int(11) NOT NULL,
  `ruangan` char(20) NOT NULL,
  `keperluan` varchar(100) NOT NULL,
  `statuspeminjaman` varchar(20) NOT NULL,
  `waktuUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`no`, `tanggalpinjam`, `tanggalkembali`, `petugas`, `peminjam`, `barang`, `jumlahPinjam`, `ruangan`, `keperluan`, `statuspeminjaman`, `waktuUpdate`) VALUES
(26, '2023-05-26', '2023-05-26', 'Alias', 'Ari Sutanto', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Selesai', '2023-05-26 04:52:19'),
(27, '2023-05-26', '2023-05-26', 'Alias', 'Kestrel', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Selesai', '2023-05-26 04:58:09'),
(28, '2023-05-26', '2023-05-26', 'Alias', 'Amelia Putri', 'Infocus IN114XV', 1, 'Ruang A02', 'Presentasi', 'Selesai', '2023-05-26 05:01:00'),
(29, '2023-05-26', '2023-05-26', 'Alias', 'Jahfal Lazuardi', 'Infocus IN114XV', 1, 'Ruang A02', 'Presentasi', 'Selesai', '2023-05-26 05:03:18'),
(30, '2023-05-26', '2023-05-26', 'Alias', 'Yoela', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Terlambat', '2023-05-27 05:32:55'),
(31, '2023-05-29', '2023-05-29', 'Alias', 'Daniel', 'Oppo A37', 1, 'Ruang A01', 'Telpon orang tua', 'Selesai', '2023-05-29 07:23:24'),
(32, '2023-06-05', '2023-06-05', 'Alias', 'Daniel Rahardja', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Penyimpanan Data', 'Terlambat', '2023-06-07 04:39:31'),
(33, '2023-06-12', '2023-06-12', 'Alias', 'Ari abdillah', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Selesai', '2023-06-12 07:00:38'),
(34, '2023-06-17', '2023-06-17', 'Alias', 'Karyono', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Sedang Dipinjam', '2023-06-17 04:26:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoribarang`
--

CREATE TABLE `kategoribarang` (
  `idKategori` int(11) NOT NULL,
  `namaKategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategoribarang`
--

INSERT INTO `kategoribarang` (`idKategori`, `namaKategori`) VALUES
(1, 'Alat Presentasi'),
(4, 'Alat Komunikasi'),
(5, 'Alat Penyimpanan Data'),
(6, 'Alat Elektronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoridevice`
--

CREATE TABLE `kategoridevice` (
  `no` int(11) NOT NULL,
  `namatipe` varchar(200) NOT NULL,
  `kodedevice` char(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoriruangan`
--

CREATE TABLE `kategoriruangan` (
  `idKategoriRuang` int(11) NOT NULL,
  `namaKategoriRuang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategoriruangan`
--

INSERT INTO `kategoriruangan` (`idKategoriRuang`, `namaKategoriRuang`) VALUES
(1, 'Ruang Kelas'),
(2, 'Ruang Lab Komputer'),
(7, 'Ruang Bahasa'),
(9, 'Ruang Seni'),
(10, 'Ruang Serbaguna'),
(11, 'Ruang Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kembali`
--

CREATE TABLE `kembali` (
  `no` int(11) NOT NULL,
  `tanggalKembali` date NOT NULL,
  `peminjam` varchar(200) NOT NULL,
  `barang` varchar(200) NOT NULL,
  `ruangan` varchar(100) NOT NULL,
  `petugas` varchar(200) NOT NULL,
  `jumlahKembali` int(11) NOT NULL,
  `kondisi` varchar(20) NOT NULL,
  `catatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kembali`
--

INSERT INTO `kembali` (`no`, `tanggalKembali`, `peminjam`, `barang`, `ruangan`, `petugas`, `jumlahKembali`, `kondisi`, `catatan`) VALUES
(14, '2023-05-26', 'Ari Sutanto', 'Flashdisk Toshiba', 'Ruang A01', 'Alias', 1, 'Baik', ''),
(15, '2023-05-26', 'Kestrel', 'Flashdisk Toshiba', 'Ruang A01', 'Alias', 1, 'Rusak', 'Alatnya tidak berfungsi'),
(16, '2023-05-22', 'Daniel', 'Infocus IN114XV', 'Ruang A01', 'Alias', 1, 'Rusak', 'Alatnya tidak berfungsi'),
(17, '2023-05-22', 'Daniel', 'Infocus IN114XV', 'Ruang A01', 'Alias', 1, 'Rusak', 'Alatnya tidak berfungsi'),
(18, '2023-05-26', 'Amelia Putri', 'Infocus IN114XV', 'Ruang A02', 'Alias', 1, 'Rusak', 'Alatnya tidak berfungsi'),
(19, '2023-05-26', 'Jahfal Lazuardi', 'Infocus IN114XV', 'Ruang A02', 'Alias', 1, 'Rusak', 'Alatnya tidak berfungsi'),
(20, '2023-05-27', 'Yoela', 'Flashdisk Toshiba', 'Ruang A01', 'Alias', 1, 'Baik', ''),
(21, '2023-05-29', 'Daniel', 'Oppo A37', 'Ruang A01', 'Alias', 1, 'Baik', ''),
(22, '2023-06-07', 'Daniel Rahardja', 'Flashdisk Toshiba', 'Ruang A01', 'Alias', 1, 'Baik', ''),
(23, '2023-06-12', 'Ari abdillah', 'Infocus IN114XV', 'Ruang A01', 'Alias', 1, 'Baik', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `no` int(11) NOT NULL,
  `namaKota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `pulau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`no`, `namaKota`, `provinsi`, `pulau`) VALUES
(1, 'Jakarta Barat', 'Jakarta', 'Jawa'),
(2, 'Jakarta Selatan', 'Jakarta', 'Jawa'),
(3, 'Jakarta Barat', 'Jakarta', 'Jawa'),
(4, 'Jakarta Timur', 'Jakarta', 'Jawa'),
(5, 'Tangerang', 'Banten', 'Jawa'),
(6, 'Tangerang Selatan', 'Banten', 'Jawa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lantai`
--

CREATE TABLE `lantai` (
  `idLantai` int(11) NOT NULL,
  `namaLantai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lantai`
--

INSERT INTO `lantai` (`idLantai`, `namaLantai`) VALUES
(1, 'Lantai 1'),
(2, 'Lantai 2'),
(4, 'Lantai 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masukbarang`
--

CREATE TABLE `masukbarang` (
  `idMasuk` int(11) NOT NULL,
  `namaBarang` varchar(200) NOT NULL,
  `jumlahMasuk` int(20) NOT NULL,
  `supplier` varchar(200) NOT NULL,
  `tanggalMasuk` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `masukbarang`
--

INSERT INTO `masukbarang` (`idMasuk`, `namaBarang`, `jumlahMasuk`, `supplier`, `tanggalMasuk`) VALUES
(4, 'Flashdisk Toshiba', 100, 'PT Sukses Jaya', '2023-05-04 10:47:38'),
(5, 'Infocus IN114XV', 50, 'PT Sukses Jaya', '2023-05-04 10:47:55'),
(6, 'Infocus IN114XV', 9, 'PT Sukses Jaya', '2023-05-04 12:10:52'),
(7, 'Realme 10', 30, 'PT Sukses Jaya', '2023-05-04 12:11:05'),
(8, 'Infocus IN114XV', 80, 'PT Sukses Jaya', '2023-05-04 12:13:17'),
(9, 'Oppo A37', 20, 'PT Sukses Jaya', '2023-05-22 16:09:10'),
(10, 'Realme 10', 99, 'PT Sukses Jaya', '2023-06-17 15:26:15'),
(11, 'Flashdisk Toshiba', 80, 'PT Sukses Jaya', '2023-06-17 15:26:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `judulNotif` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `url` varchar(200) NOT NULL,
  `waktuDibuat` varchar(200) NOT NULL,
  `waktuUpdate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `tujuan`, `judulNotif`, `message`, `status`, `url`, `waktuDibuat`, `waktuUpdate`) VALUES
(23, 'Admin', 'Barang', 'stok Infocus IN114XV sisa 4', 'read', '?url=barang', '2023-05-03 14:17:49', '2023-05-03 14:17:49'),
(24, 'Admin', 'Barang', 'stok Flashdisk Toshiba sudah habis', 'read', '?url=barang', '2023-05-03 14:20:54', '2023-05-03 14:20:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `no` int(11) NOT NULL,
  `namaPegawai` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `jenisKelamin` varchar(200) NOT NULL,
  `tanggalLahir` varchar(200) NOT NULL,
  `role` char(20) NOT NULL,
  `statusAkun` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`no`, `namaPegawai`, `alamat`, `jenisKelamin`, `tanggalLahir`, `role`, `statusAkun`) VALUES
(1, 'Daniel Rahardja', 'BSD Sektor 1.4 Blok G3 No 24', 'Laki-Laki', '2001-05-10', 'Admin', 'Aktif'),
(3, 'Alias', 'BSD Sektor 1.3', 'Laki-Laki', '2002-05-10', 'Operator', 'Aktif'),
(13, 'Mara', 'Venezuela', 'Perempuan', '2004-05-10', 'Operator', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `no` int(11) NOT NULL,
  `peminjam` varchar(200) NOT NULL,
  `tanggalPinjam` date NOT NULL,
  `barang` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ruang` char(20) NOT NULL,
  `keperluan` varchar(100) NOT NULL,
  `petugas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`no`, `peminjam`, `tanggalPinjam`, `barang`, `jumlah`, `ruang`, `keperluan`, `petugas`) VALUES
(1, 'Yoela', '2023-05-05', 'Infocus IN114XV', 1, 'Ruang A02', 'Presentasi', 'Alias'),
(2, 'Karyono', '2023-05-05', 'Realme 10', 2, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(3, 'Urban Tracker', '2023-05-05', 'Infocus IN114XV', 2, 'Ruang A01', 'Presentasi', 'Alias'),
(4, 'Roze', '2023-05-06', 'Infocus IN114XV', 1, 'Ruang A03', 'Presentasi', 'Alias'),
(5, 'John Price', '2023-05-06', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Alias'),
(6, 'Naomi Mizushima', '2023-05-06', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Alias'),
(7, 'Edouard Couteau', '2023-05-06', 'Flashdisk Toshiba', 1, 'Ruang A03', 'Kumpulkan tugas', 'Alias'),
(8, 'Stansfield', '2023-05-06', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Alias'),
(9, 'Daniel Rahardja', '2023-05-06', 'Realme 10', 1, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(10, 'Artery', '2023-05-06', 'Realme 10', 1, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(11, 'Russel Adler', '2023-05-06', 'Realme 10', 1, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(12, 'Soap MacTavish', '2023-05-06', 'Realme 10', 1, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(13, 'Karyono', '2023-05-21', 'Infocus IN114XV', 1, 'Ruang A04', 'Presentasi', 'Alias'),
(14, 'Sophia Couteau', '2023-05-21', 'Infocus IN114XV', 1, 'Ruang A06', 'Presentasi', 'Alias'),
(15, 'Cecilia Perrin', '2023-05-21', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Alias'),
(16, 'Intan Atsillah', '2023-05-21', 'Realme 10', 1, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(17, 'Vincent DJ', '2023-05-21', 'Realme 10', 1, 'Ruang A03', 'Darurat', 'Alias'),
(18, 'Daniel', '2023-05-22', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Alias'),
(19, 'Ari Sutanto', '2023-05-26', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Alias'),
(20, 'Kestrel', '2023-05-26', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Alias'),
(21, 'Amelia Putri', '2023-05-26', 'Infocus IN114XV', 1, 'Ruang A02', 'Presentasi', 'Alias'),
(22, 'Jahfal Lazuardi', '2023-05-26', 'Infocus IN114XV', 1, 'Ruang A02', 'Presentasi', 'Alias'),
(23, 'Yoela', '2023-05-26', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Kumpulkan tugas', 'Alias'),
(24, 'Daniel', '2023-05-29', 'Oppo A37', 1, 'Ruang A01', 'Telpon orang tua', 'Alias'),
(25, 'Daniel Rahardja', '2023-06-05', 'Flashdisk Toshiba', 1, 'Ruang A01', 'Penyimpanan Data', 'Alias'),
(26, 'Ari abdillah', '2023-06-12', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Alias'),
(27, 'Karyono', '2023-06-17', 'Infocus IN114XV', 1, 'Ruang A01', 'Presentasi', 'Alias');

-- --------------------------------------------------------

--
-- Struktur dari tabel `privelege`
--

CREATE TABLE `privelege` (
  `idPrivelege` int(11) NOT NULL,
  `namaPrivelege` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `privelege`
--

INSERT INTO `privelege` (`idPrivelege`, `namaPrivelege`) VALUES
(1, 'Admin'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `idRuang` int(11) NOT NULL,
  `namaRuang` varchar(200) NOT NULL,
  `kategoriRuangan` varchar(100) NOT NULL,
  `lokasiGedung` varchar(20) NOT NULL,
  `lantai` varchar(20) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`idRuang`, `namaRuang`, `kategoriRuangan`, `lokasiGedung`, `lantai`, `keterangan`) VALUES
(1, 'Ruang A01', 'Ruang Kelas', 'Gedung A', 'Lantai 1', ''),
(2, 'Ruang A02', 'Ruang Kelas', 'Gedung A', 'Lantai 1', ''),
(3, 'Ruang A03', 'Ruang Kelas', 'Gedung A', 'Lantai 1', ''),
(4, 'Ruang A04', 'Ruang Kelas', 'Gedung A', 'Lantai 2', ''),
(5, 'Ruang A05', 'Ruang Kelas', 'Gedung A', 'Lantai 2', ''),
(6, 'Ruang A06', 'Ruang Kelas', 'Gedung A', 'Lantai 2', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `no` int(11) NOT NULL,
  `namaSupplier` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nomorTelepon` varchar(20) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `perwakilan` varchar(250) NOT NULL,
  `statusAkun` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`no`, `namaSupplier`, `alamat`, `nomorTelepon`, `kota`, `perwakilan`, `statusAkun`) VALUES
(1, 'PT Sukses Jaya', 'BSD', '0812345678', 'Tangerang Selatan', 'Daniel Rahardja', 'Sudah terdaftar'),
(5, 'PT Garena Indonesia', 'Gama Tower, Jl. H. R. Rasuna Said No.2, RT.2/RW.5, Kuningan, Karet Kuningan, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12940', '08123456789', 'Jakarta Selatan', 'Maple', 'Sudah terdaftar'),
(6, 'PT BCD', 'Bagas', '0812345678', 'Tangerang Selatan', 'Bagas', 'Akun Tidak Aktif'),
(8, 'PT Inamart Sukses Jaya', 'Bintaro sektor 9', '08123456', 'Jakarta Selatan', 'Tanti', 'Belum terdaftar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `namaAkun` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `privelege` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userid`, `namaAkun`, `email`, `password`, `privelege`) VALUES
(3, 'Daniel Rahardja', 'danielrahardja4@gmail.com', '262031397020fd8df478ec13b4b096c5', 'Admin'),
(4, 'PT Sukses Jaya', 'danielr@suksesjaya.co.id', 'b82a0c72f4108a205c68d324a195bb73', 'Supplier'),
(10, 'Alias', 'alias@gmail.com', '1b487d16a8d0109b543cd0c07095f068', 'Operator'),
(11, 'PT Garena Indonesia', 'legal@garena.com', 'f42b8504fb000dc11c00020e0174aef1', 'Supplier'),
(24, 'Mara', 'mara@gmail.com', '06f520d2986bf283785d008e3ba81e8f', 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`idGedung`);

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `kategoribarang`
--
ALTER TABLE `kategoribarang`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indeks untuk tabel `kategoridevice`
--
ALTER TABLE `kategoridevice`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `kategoriruangan`
--
ALTER TABLE `kategoriruangan`
  ADD PRIMARY KEY (`idKategoriRuang`);

--
-- Indeks untuk tabel `kembali`
--
ALTER TABLE `kembali`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `lantai`
--
ALTER TABLE `lantai`
  ADD PRIMARY KEY (`idLantai`);

--
-- Indeks untuk tabel `masukbarang`
--
ALTER TABLE `masukbarang`
  ADD PRIMARY KEY (`idMasuk`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `privelege`
--
ALTER TABLE `privelege`
  ADD PRIMARY KEY (`idPrivelege`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`idRuang`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `gedung`
--
ALTER TABLE `gedung`
  MODIFY `idGedung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `kategoribarang`
--
ALTER TABLE `kategoribarang`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategoridevice`
--
ALTER TABLE `kategoridevice`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoriruangan`
--
ALTER TABLE `kategoriruangan`
  MODIFY `idKategoriRuang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kembali`
--
ALTER TABLE `kembali`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `lantai`
--
ALTER TABLE `lantai`
  MODIFY `idLantai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `masukbarang`
--
ALTER TABLE `masukbarang`
  MODIFY `idMasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `privelege`
--
ALTER TABLE `privelege`
  MODIFY `idPrivelege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `idRuang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
