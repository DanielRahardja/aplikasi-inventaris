<!-- Content -->
<div class="container">
<div class="content">
    <h1><i class="fa-solid fa-door-open fa-sm mr-2"></i>Manajemen Ruangan</h1>
    <!-- Row -->
    <div class="row">
      <div class="col-8 mr-5">
          <!-- Button -->
          <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary mb-5 mt-2 mr-2" data-toggle="modal" data-target="#tambahRuangan">
            <i class="fa fa-plus-circle mr-2"></i>Tambah Data
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
    <table class="table">
      <!-- Table Header -->
      <thead class="thead-dark">
          <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Ruangan</th>
              <th scope="col">Kategori</th>
              <th scope="col">Lokasi Gedung</th>
              <th scope="col">Letak Lantai</th>
              <th scope="col">Keterangan</th>
              <th scope="col" colspan='2'>Action</th>
          </tr>
      </thead>
      
      <?php 
            
            //Pencarian Data
            if (isset($_POST['search'])) {
              $keyword= $_POST['searchtxt'];
            }else{
              $keyword= '';
            }
            $fetchdata=mysqli_query($koneksi,"Select * from ruangan where namaRuang like '%$keyword%'");
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
            $fetchdata_limit= mysqli_query($koneksi,"Select * from ruangan where namaRuang like '%$keyword%' limit $awalan,$jumlahdata");

            //Generate Number
            $nomor=1 + $awalan; 
            // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                  while ($data= mysqli_fetch_assoc($fetchdata_limit)){

            ?>
      <!-- Table Content -->
      <tbody>
          <tr>
              <td><?php echo $nomor++; ?></td>
              <td><?php echo $data['namaRuang']; ?></td>
              <td><?php echo $data['kategoriRuangan']; ?></td>
              <td><?php echo $data['lokasiGedung']; ?></td>
              <td><?php echo $data['lantai']; ?></td>
              <td><?php echo $data['keterangan']; ?></td>
              <td>
                  <a class="btn btn-danger" href="hapusruang.php?idRuang=<?php echo $data['idRuang'];?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')"  >
                      <i class="fa fa-trash"></i>
                  </a>
              </td>
              <td>
                  <button class="btn btn-success" data-toggle="modal" data-target="#updateRuang<?php echo $data['idRuang']; ?>">
                      <i class="fa fa-pencil"></i>
                  </button>
              </td>
          </tr>
            <!-- Modal Update -->
            <div class="modal fade" id="updateRuang<?php echo $data['idRuang']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateRuangLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateRuangLabel">Ubah Data Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form action="updateruang.php" method="POST">
                    <input type="hidden" class="form-control" id="id" name="idRuang" value="<?php echo $data['idRuang']; ?>" readonly=true>
                    <div class="form-group">
                      <label for="namaRuang">Nama Ruangan</label>
                      <input type="text" class="form-control" id="namaRuang" name="namaRuang" placeholder="Masukkan Nama Kategori" value="<?php echo $data['namaRuang']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="kategoriRuangan">Jenis Ruangan</label><br/>
                      <select class="form-control" name="kategoriRuangan" id="kategoriRuangan" required>
                        <option value="">----Pilih Jenis Ruangan----</option>
                        <!-- Koneksi Database untuk pengambilan data kategori ruangan-->
                        <?php
                          $fetchKategori1= mysqli_query($koneksi,"Select * from kategoriruangan");
                          while ($data2= mysqli_fetch_assoc($fetchKategori1)){
                            if ($data['kategoriRuangan']== $data2['namaKategoriRuang']) {
                              # code...
                            ?>
                            <option value="<?php echo $data2['namaKategoriRuang']; ?>" selected><?php echo $data2['namaKategoriRuang']; ?></option>
                            <?php
                            } else {
                            ?>
                            <option value="<?php echo $data2['namaKategoriRuang']; ?>"><?php echo $data2['namaKategoriRuang']; ?></option>
                            <?php
                            }?>
                        

                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="lokasiGedung">Gedung</label><br/>
                      <select class="form-control" name="lokasiGedung" id="lokasiGedung" required>
                        <option value="">----Pilih Lokasi Gedung----</option>
                        <!-- Koneksi Database untuk pengambilan data gedung -->
                        <?php
                          $fetchKategori1= mysqli_query($koneksi,"Select * from gedung");
                          while ($data2= mysqli_fetch_assoc($fetchKategori1)){
                            if ($data['lokasiGedung']== $data2['namaGedung']) {
                              # code...
                            ?>
                            <option value="<?php echo $data2['namaGedung']; ?>" selected><?php echo $data2['namaGedung']; ?></option>
                            <?php
                            } else {
                            ?>
                            <option value="<?php echo $data2['namaGedung']; ?>"><?php echo $data2['namaGedung']; ?></option>
                            <?php
                            }?>
                        

                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="lantai">Lantai</label><br/>
                      <select class="form-control" name="lantai" id="lantai" required>
                        <option value="">----Pilih Lantai----</option>
                        <!-- Koneksi Database untuk pengambilan data lantai -->
                        <?php
                          $fetchKategori1= mysqli_query($koneksi,"Select * from lantai");
                          while ($data2= mysqli_fetch_assoc($fetchKategori1)){
                            if ($data['lantai']== $data2['namaLantai']) {
                              # code...
                            ?>
                            <option value="<?php echo $data2['namaLantai']; ?>" selected><?php echo $data2['namaLantai']; ?></option>
                            <?php
                            } else {
                            ?>
                            <option value="<?php echo $data2['namaLantai']; ?>"><?php echo $data2['namaLantai']; ?></option>
                            <?php
                            }?>
                        

                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan Keterangannya jika diperlukan.... " ><?php echo $data['keterangan']; ?></textarea>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Model -->
          <?php } ?>
      </tbody>
      </table>
    </div>
    <!-- Row -->
    <div class="row">
      <div class="col-9">
        
          
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

<!-- Modals -->
<!-- Modal Insert -->
<div class="modal fade" id="tambahRuangan" tabindex="-1" role="dialog" aria-labelledby="tambahRuanganLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahRuanganLabel">Input Data Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="tambahruang.php" method="POST">
        <div class="form-group">
          <label for="namaRuang">Nama Ruangan</label>
          <input type="text" class="form-control" id="namaRuang" name="namaRuang" placeholder="Masukkan Nama Kategori">
        </div>
        <div class="form-group">
          <label for="kategoriRuangan">Jenis Ruangan</label>
          <select class="form-control" name="kategoriRuangan" id="kategoriRuangan" required>
            <option value="">----Pilih Jenis Ruangan----</option>
            <!-- <option value="Ruangan Kelas">Ruangan Kelas</option>
            <option value="Ruangan Kantor">Ruangan Kantor</option>
            <option value="Ruangan Lab Komputer">Ruangan Lab Komputer</option> -->
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchKategori1= mysqli_query($koneksi,"Select * from kategoriruangan");
              
              while ($data2= mysqli_fetch_assoc($fetchKategori1)){
            ?>
            <option value="<?php echo $data2['namaKategoriRuang']; ?>"><?php echo $data2['namaKategoriRuang']; ?></option>

            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="lokasiGedung">Gedung</label>
          <select class="form-control" name="lokasiGedung" id="lokasiGedung" required>
            <option value="">----Pilih Lokasi Gedung----</option>
            <!-- <option value="Gedung A">Gedung A</option>
            <option value="Gedung B">Gedung B</option> -->
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchKategori1= mysqli_query($koneksi,"Select * from gedung");
              
              while ($data2= mysqli_fetch_assoc($fetchKategori1)){
            ?>
            <option value="<?php echo $data2['namaGedung']; ?>"><?php echo $data2['namaGedung']; ?></option>

            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="lantai">Lantai</label>
          <select class="form-control" name="lantai" id="lantai" required>
            <option value="">----Pilih Lantai----</option>
            <!-- <option value="Lantai 1">Lantai 1</option>
            <option value="Lantai 2">Lantai 2</option> -->
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchKategori1= mysqli_query($koneksi,"Select * from lantai");
              
              while ($data2= mysqli_fetch_assoc($fetchKategori1)){
            ?>
            <option value="<?php echo $data2['namaLantai']; ?>"><?php echo $data2['namaLantai']; ?></option>

            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="keterangan">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan Keterangannya jika diperlukan.... "></textarea>
        </div>
      <div class="modal-footer">
      <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Model -->