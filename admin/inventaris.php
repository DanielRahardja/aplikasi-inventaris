<div class="container">
   <div class="content">
   <h1>Data Inventaris</h1>
    <!-- Row -->
    <div class="row">
      <div class="col-8 mr-5">
        <!-- Button -->
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary mb-5 mt-2" data-toggle="modal" data-target="#pinjam">
            <i class="fa fa-share-from-square mr-2"></i>Peminjaman Baru
          </button>
        </div>
      </div>
      <div class="col mb-2">
        <form action="" method="post" class="form-inline">
          <div class="form-group mx-sm-3 mb-2">
            <input type="text" name="searchtxt" placeholder="Cari Data">
            <button type="submit" name="search" class="bg-primary ml-1"><i class="fa-solid fa-magnifying-glass" style="color: white;"></i></button>
          </div>
        </form>
      </div>
      
    </div>
    
    
    <div class="table-responsive-sm">
      <!-- Tables -->
    <table class="table table-bordered">
    <!-- Table Header -->
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Ruang</th>
            <th scope="col">Keperluan</th>
            <th scope="col">Petugas</th>
            <th scope="col">Status Peminjaman</th>
            <th scope="col">Waktu Update</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    
    <?php 
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }else{
            $keyword= '';
          }
          $fetchdata=mysqli_query($koneksi,"Select * from inventaris where peminjam like '%$keyword%' or petugas like '%$keyword%' or statuspeminjaman like '%$keyword%'");
          //Pagination Config
          $jumlahdata=5;
          $totaldata= mysqli_num_rows($fetchdata);
          $jumlahpagination= ceil($totaldata/$jumlahdata); 

          if (isset($_GET['page'])){
            $active= $_GET['page'];
          }else{
            $active= 1;
          }

          $awalan= ($active*$jumlahdata)-$jumlahdata;
          $link= 3;
          // Link Start
          if ($active > $link) {
            $start= $active - $link;
          }else{
            $start= 1;
          }
          // Link End
          if ($active < ($jumlahpagination-$link)) {
            $end= $active + $link;
          }else{
            $end= $jumlahpagination;
          }
          //End Config
          $fetchdata_limit= mysqli_query($koneksi,"Select * from inventaris where peminjam like '%$keyword%' or petugas like '%$keyword%' or statuspeminjaman like '%$keyword%' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

          ?>
    <!-- Table Content -->
    <tbody>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['peminjam']; ?></td>
            <td><?php echo $data['tanggalpinjam']; ?></td>
            <td><?php echo $data['tanggalkembali']; ?></td>
            <td><?php echo $data['barang']; ?></td>
            <td><?php echo $data['jumlahPinjam']; ?></td>
            <td><?php echo $data['ruangan']; ?></td>
            <td><?php echo $data['keperluan']; ?></td>
            <td><?php echo $data['petugas']; ?></td>
            <td>
              <?php 
                if ($data['statuspeminjaman']== 'Sedang Dipinjam') {
              ?>
                  <label class='bg-warning text-light'><?php echo $data['statuspeminjaman']; ?></label>
              <?php
                }elseif ($data['statuspeminjaman']== 'Selesai') { ?>
                  <label class='bg-success text-light'><?php echo $data['statuspeminjaman']; ?></label>
              <?php 
                }elseif ($data['statuspeminjaman']== 'Terlambat') {
                  # code...
              ?>
              <label class='bg-danger text-light'><?php echo $data['statuspeminjaman']; ?></label>
              <?php } ?>
            </td>
            <td><?php echo $data['waktuUpdate']; ?></td>
            <td>
              <?php 
                if ($data['statuspeminjaman']== 'Sedang Dipinjam') {
              ?>
                  <button class="btn btn-success" data-toggle="modal" data-target="#kembali<?php echo $data['no']; ?>" title="Kembali">
                    <i class="fa-solid fa-people-carry-box"></i>
                  </button>
              <?php
                }
              ?>
                
            </td>
            <!-- Modal Kembali -->
            <div class="modal fade" id="kembali<?php echo $data['no']; ?>" tabindex="-1" role="dialog" aria-labelledby="kembaliLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="kembaliLabel">Pengembalian Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="kembali.php" method="post">
                    <input type="hidden" id="nomor" name="no" value="<?php echo $data['no']; ?>">
                    <div class="form-group">
                      <label for="petugas">Nama Petugas</label>
                      <input type="text" class="form-control" id="petugas" name="petugas" value="<?php echo $data['petugas']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="peminjam">Peminjam</label>
                      <input type="text" class="form-control" id="peminjam" name="peminjam" value="<?php echo $data['peminjam']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="ruangan">Ruang</label>
                      <input type="text" class="form-control" id="ruangan" name="ruangan" value="<?php echo $data['ruangan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Proses peminjaman pada tanggal: <?php echo $data['tanggalpinjam']; ?> </label>
                    </div>
                    <div class="form-group">
                      <label>Batas tanggal pengembalian: <?php echo $data['tanggalkembali']; ?> </label>
                      <input type="hidden" class="form-control" id="tglBatas" name="tglBatas" value="<?php echo $data['tanggalkembali']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="tglKembali">Tanggal Pengembalian</label>
                      <input type="text" class="form-control" id="tglKembali" name="tglKembali" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Barang yang dipinjam:
                      <input type="text" class="form-control" id="barang" name="barang" value="<?php echo $data['barang']; ?>" readonly> 
                      <br>dengan jumlah barang yang dipinjam:  </label><input type="text" class="form-control" id="jPinjam" name="jPinjam" value="<?php echo $data['jumlahPinjam']; ?>" style="width: 80px;" readonly>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <label for="jKembali">Jumlah kembali</label>
                        <input type="number" class="form-control" id="jKembali" name="jKembali" placeholder="Kembali" value="0" min="0" max="<?php echo $data['jumlahPinjam']; ?>" style="width: 80px;" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <label for="jKembali">Kondisi Barang</label>
                        <select class="form-control" name="kondisi" id="kondisi" required>
                          <option value="">----Pilih Kondisi----</option>
                          <!-- <option value="Lantai 1">Lantai 1</option>
                          <option value="Lantai 2">Lantai 2</option> -->
                          <!-- Koneksi Database untuk pengambilan data kategori -->
                          <option value="Baik">Baik</option>
                          <option value="Rusak">Rusak</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Keterangan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Tulis keterangannya jika diperlukan">
                      </div>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Pengembalian</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
        </tr>
    </tbody>
    </table>
    <!-- End Table -->
    <!-- Row -->
    <div class="row">
          <div class="col-9">
            <caption>
              <strong>Keterangan Indikator</strong><br>
              <label class="bg-warning text-light">Sedang Dipinjam</label>: Barang sedang dipinjam oleh peminjam. <br>
              <label class="bg-success text-light">Selesai</label>: Peminjam telah menyelesaikan proses peminjaman tepat waktu.
            </caption>
          </div>
          <div class="col">
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <?php if ($active > 1) {?>
                  <li class="page-item"><a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $active-1; ?>">&laquo;</a></li>
                <?php } ?>  
                <!-- Generate page from data -->
                <?php for ($i= $start; $i <= $end; $i++) { ?>
                <?php if ($active == $i) : ?>
                  <a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $i; ?>" style="color:white;background:blue;"><?php echo $i; ?></a></li>
                <?php else : ?>
                  <a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endif; ?>
                <?php } ?>
                <?php if ($active < $jumlahpagination) {?>
                  <li class="page-item"><a class="page-link" href="?url=<?php echo $_GET['url']; ?>&page=<?php echo $active + 1; ?>">&raquo;</a></li>
                <?php } ?>
              </ul>
            </nav>
          </div>
        </div>
    </div>
    </div>
   </div>
</div>
<!-- Modals -->
<!-- Modal Insert -->
<div class="modal fade" id="pinjam" tabindex="-1" role="dialog" aria-labelledby="pinjamLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pinjamLabel">Peminjaman baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="pinjam.php" method="POST">
        <div class="form-group">
          <label for="petugas">Nama Petugas</label>
          <input type="text" class="form-control" id="petugas" name="petugas" value="<?php echo $_SESSION['namaAkun'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="tglPinjam">Tanggal Peminjaman</label>
          <input type="date" class="form-control" id="tglPinjam" name="tglPinjam" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
          <label for="tglKembali">Tanggal Pengembalian</label>
          <input type="date" class="form-control" id="tglKembali" name="tglKembali" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
          <label for="peminjam">Nama Peminjam</label>
          <input type="text" class="form-control" id="peminjam" name="peminjam" placeholder= "Masukkan nama peminjam" required>
        </div>
        <div class="form-group">
          <label for="barang">Barang</label><br/>
          <select class="form-control" name="barang" id="barang" required>
            <option value="">----Pilih Kategori----</option>
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchBarang= mysqli_query($koneksi,"Select * from barang where stok > 0");
              
              while ($data2= mysqli_fetch_assoc($fetchBarang)){
            ?>
            <option value="<?php echo $data2['namaBarang']; ?>"><?php echo $data2['namaBarang']; ?>(<?php echo $data2['stok']; ?>)</option>
            <?php } ?>
          </select>
          
        </div>
        <div class="form-group">
          <label for="jumlahPinjam">Jumlah barang yang dipinjam</label>
          <input type="number" class="form-control" id="jumlahPinjam" name="jumlahPinjam" value="0" min="1" required>
        </div>
        <div class="form-group">
          <label for="ruang">Ruangan</label>
          <select class="form-control" name="ruang" id="ruang" required>
            <option value="">----Pilih Ruangan----</option>
            <!-- <option value="Ruangan Kelas">Ruangan Kelas</option>
            <option value="Ruangan Kantor">Ruangan Kantor</option>
            <option value="Ruangan Lab Komputer">Ruangan Lab Komputer</option> -->
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchRuang= mysqli_query($koneksi,"Select * from ruangan");
              
              while ($data2= mysqli_fetch_assoc($fetchRuang)){
            ?>
            <option value="<?php echo $data2['namaRuang']; ?>"><?php echo $data2['namaRuang']; ?>(<?php echo $data2['lokasiGedung']; ?> <?php echo $data2['lantai']; ?>)</option>

            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="keperluan">Keperluan</label>
          <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder= "Masukkan keperluan" required>
        </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Tambah peminjaman baru</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal -->