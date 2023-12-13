<div class="container">
  <!-- Content -->
  <div class="content">
      <h1><i class="fa-solid fa-box fa-sm mr-2"></i>Data Device</h1>
      <!-- Row -->
      <div class="row">
          <div class="col-8 mr-5">
              <!-- Button -->
              <div class="btn-group" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-primary mb-5 mt-2 mr-2" data-toggle="modal" data-target="#tambahBarang">
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
      
      <?php 
      if (isset($_GET['no'])) {
        $id= $_GET['no'];
        $hasilpilih = mysqli_query($koneksi, "SELECT * FROM kategoridevice WHERE no = $id");

        while ($option= mysqli_fetch_assoc($hasilpilih)) { ?>
        
        <p>Data yang dipilih adalah: <input type="text" name="txtpilihan" value="<?php echo $option['namaTipe']; ?>" style="border: none;" readonly></p>
      <?php
          
        }
      }
      ?>
        
      <!-- Tables -->
      <div class="table-responsive-sm">
      <table class="table table-bordered">
      <!-- Table Header -->
      <thead class="thead-dark">
          <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Spesifikasi</th>
              <th scope="col">Kategori</th>
              <th scope="col">Stok</th>
              <th scope="col">Rusak</th>
              <th scope="col" colspan='2'>Action</th>
          </tr>
      </thead>
      
      <?php 
          
          //Pencarian Data
          if (isset($_POST['search'])) {
            $keyword= $_POST['searchtxt'];
          }
          else{
            $keyword= '';
          }
          if (isset($_GET['devicelist'])) {
            $list=trim($_GET['devicelist']);
            $fetchdata=mysqli_query($koneksi,"Select * from devices where tipedevice='$list'");
          
          
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
          $fetchdata_limit= mysqli_query($koneksi,"Select * from devices where tipedevice='$list' limit $awalan,$jumlahdata");

          //Generate Number
          $nomor=1 + $awalan; 
          // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                while ($data= mysqli_fetch_assoc($fetchdata_limit)){

          ?>
      <!-- Table Content -->
      <tbody>
          <tr>
              <td><?php echo $nomor++; ?></td>
              <td><?php echo $data['kodedevice']; ?></td>
              <td><?php echo $data['tipedevice']; ?></td>
              <td><?php echo $data['brand']; ?></td>
              <td><?php echo $data['warna']; ?></td>
              <td><?php echo $data['serialnumber']; ?></td>
              <td>
                <a class="btn btn-danger" href="hapusbarang.php?no=<?php echo $data['no'];?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" >
                  <i class="fa fa-trash"></i>
                </a>
              </td>
              <td>
                <button class="btn btn-success" data-toggle="modal" data-target="#updateBarang<?php echo $data['no']; ?>">
                  <i class="fa fa-pencil"></i>
                </button>
              </td>
          </tr>
            <!-- Modal Update -->
            <div class="modal fade" id="updateBarang<?php echo $data['no']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateBarangLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateBarangLabel">Update Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form action="updatebarang.php" method="POST"> 
                      <input type="hidden" class="form-control" id="nomor" name="no" value="<?php echo $data['no']; ?>" readonly=true>
                    <div class="form-group">
                      <label for="namaBarang">Nama Barang</label><br/>
                      <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Masukkan Nama Barang" value="<?php echo $data['namaBarang']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="spesifikasi">Spesifikasi</label>
                      <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Sebutkan detail spesifikasinya..." required><?php echo $data['spesifikasi']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="kategori">Kategori</label><br/>
                      <span>Opsi yang terpilih: <?php echo $data['kategori']; ?></span>
                      <select class="form-control" name="kategori" id="kategori">
                        <option value="">----Pilih Kategori----</option>
                        <!-- Koneksi Database untuk pengambilan data kategori -->
                        <?php
                          $fetchKategori1= mysqli_query($koneksi,"Select * from kategoribarang");
                          while ($data2= mysqli_fetch_assoc($fetchKategori1)){
                            if ($data['kategori']== $data2['namaKategori']) {
                              # code...
                            ?>
                            <option value="<?php echo $data2['namaKategori']; ?>" selected><?php echo $data2['namaKategori']; ?></option>
                            <?php
                            } else {
                            ?>
                            <option value="<?php echo $data2['namaKategori']; ?>"><?php echo $data2['namaKategori']; ?></option>
                            <?php
                            }?>
                        
  
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="stok">Stok <small>(Hanya bisa diedit oleh supplier)</small></label>
                      <input type="number" class="form-control" id="stok" name="stok" placeholder="0" value="<?php echo $data['stok']; ?>" readonly>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

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
  <?php } ?>
<!-- End Content -->
</div>


<!-- Modals -->
<!-- Modal Insert 1-->
<div class="modal fade" id="tambahBarang" tabindex="-1" role="dialog" aria-labelledby="tambahBarangLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="tambahbarang.php" method="POST">
        <div class="form-group">
          <label for="namaBarang">Nama Barang</label>
          <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Masukkan Nama Barang" required>
        </div>
        <div class="form-group">
          <label for="spesifikasi">Spesifikasi</label>
          <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Sebutkan detail spesifikasinya..."required></textarea>
        </div>
        <div class="form-group">
          <label for="kategori">Kategori</label>
          <select class="form-control" name="kategori" id="kategori">
            <option value="">----Pilih Kategori----</option>
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchKategori1= mysqli_query($koneksi,"Select * from kategoribarang");
              
              while ($data2= mysqli_fetch_assoc($fetchKategori1)){
            ?>
            <option value="<?php echo $data2['namaKategori']; ?>"><?php echo $data2['namaKategori']; ?></option>

            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="stok">Stok</label>
          <input type="number" class="form-control" id="stok" name="stok" value="0" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Data Barang</button>
      </div>
      </form>
    </div>
  </div>
</div>