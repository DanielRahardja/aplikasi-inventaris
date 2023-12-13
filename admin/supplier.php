<div class="container">
  <div class="content">
    <h1><i class="fa-solid fa-truck fa-sm mr-2"></i>Input Data Supplier</h1>
    <!-- Row -->
    <div class="row">
      <div class="col-8 mr-5">
          <!-- Button -->
          <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary mb-5 mt-2 mr-2" data-toggle="modal" data-target="#tambahSupplier">
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
                <th scope="col">Nama Supplier</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Kota</th>
                <th scope="col">Pimpinan atau Perwakilan</th>
                <th scope="col">Status Akun</th>
                <th scope="col" colspan="3">Action</th>
            </tr>
        </thead>
        
        <?php 
              
              //Pencarian Data
              if (isset($_POST['search'])) {
                $keyword= $_POST['searchtxt'];
              }else{
                $keyword= '';
              }
              $fetchdata=mysqli_query($koneksi,"Select * from supplier where namaSupplier like '%$keyword%'");
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
              $fetchdata_limit= mysqli_query($koneksi,"Select * from supplier where namaSupplier like '%$keyword%' limit $awalan,$jumlahdata");

              //Generate Number
              $nomor=1 + $awalan; 
              // Koneksi Database untuk pengambilan data barang secara keseluruhan 
                    while ($data= mysqli_fetch_assoc($fetchdata_limit)){

              ?>
        <!-- Table Content -->
        <tbody>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['namaSupplier']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['nomorTelepon']; ?></td>
                <td><?php echo $data['kota']; ?></td>
                <td><?php echo $data['perwakilan']; ?></td>
                <td>
                  <!-- Cek Kondisi -->
                  <?php 
                    if ($data['statusAkun']== 'Belum terdaftar' ||$data['statusAkun']== 'Akun Tidak Aktif') {
                  ?>
                    <label class='text-danger'><?php echo $data['statusAkun']; ?></label>
                    <?php }else { ?>
                      <label class='text-success'><?php echo $data['statusAkun']; ?></label>
                  <?php } ?>
                </td>
                <td>
                    <!-- Cek Kondisi -->
                    <?php 
                        if ($data['statusAkun']== 'Belum terdaftar' ||$data['statusAkun']== 'Akun Tidak Aktif') {
                    ?>
                        <a class="btn btn-danger" href="hapussupplier.php?no=<?php echo $data['no'];?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" title="Hapus Data" >
                            <i class="fa fa-trash"></i>
                        </a>
                    <?php }else{?>
                      <button type="button" class="btn btn-danger" title="Akun harus dicabut terlebih dahulu!" disabled>
                        <i class="fa fa-trash"></i>
                      </button>
                    <?php } ?>
                </td>
                <td>
                    <button class="btn btn-success" data-toggle="modal" data-target="#updateSupplier<?php echo $data['no']; ?>" title="Ubah Data">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <!-- Modal Update -->
                    <div class="modal fade" id="updateSupplier<?php echo $data['no']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateSupplierLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateSupplierLabel">Ubah Data Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="updatesupplier.php" method="POST">
                                <input type="hidden" class="form-control" id="nomor" name="no" value="<?php echo $data['no']; ?>">
                                <div class="form-group">
                                    <label for="namaSupplier">Nama Supplier <small>(wajib)</small></label>
                                    <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" placeholder="Masukkan nama supplier" value="<?php echo $data['namaSupplier']; ?>" required>

                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat <small>(wajib)</small></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Sebutkan detail spesifikasinya..."required><?php echo $data['alamat']; ?></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="nomorTelepon">Nomor Telepon <small>(wajib)</small></label>
                                    <input type="tel" class="form-control" id="nomorTelepon" name="nomorTelepon" placeholder="Contoh: 08xxxxxxxxxxx" value="<?php echo $data['nomorTelepon']; ?>" required>
      
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota <small>(wajib)</small></label>
                                    <select class="form-control" name="kota" id="kota" required>
                                        <option value="">----Pilih Kota----</option>
                                        <!-- Koneksi Database untuk pengambilan data kategori -->
                                        <?php
                                        $fetchKategori1= mysqli_query($koneksi,"Select * from kota");
                                        while ($data2= mysqli_fetch_assoc($fetchKategori1)){
                                        if ($data['kota']== $data2['namaKota']) {
                      
                                        ?>
                                        <option value="<?php echo $data2['namaKota']; ?>" selected><?php echo $data2['namaKota']; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                        <option value="<?php echo $data2['namaKota']; ?>"><?php echo $data2['namaKota']; ?></option>
                                        <?php
                                        }?>
                

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="perwakilan">Pimpinan/Perwakilan <small>(wajib)</small></label>
                                    <input type="text" class="form-control" id="perwakilan" name="perwakilan" placeholder="Masukkan nama pimpinan atau perwakilan" value="<?php echo $data['perwakilan']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="statusAkun">Status Akun<small>(tidak bisa diedit)</small></label>
                                    <input type="text" class="form-control" id="statusAkun" name="statusAkun" value="<?php echo $data['statusAkun']; ?>" readonly>
                                </div>
            
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- End Modal Update -->
                </td>
                <td>
                    <!-- Cek Kondisi -->
                    <?php 
                    if ($data['statusAkun']== 'Belum terdaftar'||$data['statusAkun']== 'Akun Tidak Aktif') {
                    ?>
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#tambahAkun<?php echo $data['namaSupplier']; ?>" title="Daftarkan Akun">
                        <i class="fa-solid fa-address-card"></i>
                      </button>
                      <!-- Modal Daftar Akun -->
                    <div class="modal fade" id="tambahAkun<?php echo $data['namaSupplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahAkunLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="tambahAkunLabel">Daftar Akun Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="tambahakunsupplier.php" method="POST">
                            <div class="form-group">
                              <label for="username">Nama Supplier</label>
                              <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['namaSupplier']; ?>" readonly>
                            </div>
                            <div class="form-group">
                              <label for="email">Email Perusahaan <small>(wajib)</small></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email perusahaan" required>
                            </div>
                            <div class="form-group">
                              <label for="password">Password <small>(wajib)</small></label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                            </div>
                          <div class="modal-footer">
                          <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal Daftar Akun -->
                    <?php
                    }else{
                    ?>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#viewAkun<?php echo $data['namaSupplier']; ?>" title="Lihat Akun">
                        <i class="fa-solid fa-address-card"></i>
                    </button>
                    <!-- Modal View Akun -->
                    <div class="modal fade" id="viewAkun<?php echo $data['namaSupplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewAkunLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="viewAkunLabel">Informasi Akun</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                <form action="hapusakunsupplier.php" method="get">
                                <div class="form-group">
                                    <label for="namaAkun">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="namaAkun" name="namaAkun" value="<?php echo $data['namaSupplier']; ?>" readonly>
                                </div>
                                <!-- Setup Query -->
                                <?php 
                                    $selectUser= mysqli_query($koneksi,"Select * from users where namaAkun='" . $data['namaSupplier'] . "'");
                                    while ($data3= mysqli_fetch_assoc($selectUser)){
                                ?>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $data3['email']; ?>" readonly>
                                </div>
                                <?php } ?>
                                
                          </div>
                          <div class="modal-footer">
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin mau menonaktifkan akun ini?')" >Cabut Akun</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                          </div>
                        </div>
                    </div>
                    <?php
                    }
                  ?>
                    <!-- End If -->
                </td>
            </tr>
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

<!-- Modal Insert -->
<div class="modal fade" id="tambahSupplier" tabindex="-1" role="dialog" aria-labelledby="tambahSupplierLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahSupplierLabel">Tambah Data Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="tambahsupplier.php" method="POST">
        <div class="form-group">
          <label for="namaSupplier">Nama Supplier <small>(wajib)</small></label>
          <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" placeholder="Masukkan nama supplier" required>

        </div>
        <div class="form-group">
          <label for="alamat">Alamat <small>(wajib)</small></label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Sebutkan detail spesifikasinya..."required></textarea>

        </div>
        <div class="form-group">
          <label for="nomorTelepon">Nomor Telepon <small>(wajib)</small></label>
          <input type="tel" class="form-control" id="nomorTelepon" name="nomorTelepon" placeholder="Contoh: 08xxxxxxxxxxx" required>

        </div>
        <div class="form-group">
          <label for="kota">Kota <small>(wajib)</small></label>
          <select class="form-control" name="kota" id="kota" required>
            <option value="">----Pilih Kota----</option>
            <!-- Koneksi Database untuk pengambilan data kategori -->
            <?php
              $fetchKota= mysqli_query($koneksi,"Select * from kota");
              
              while ($data2= mysqli_fetch_assoc($fetchKota)){
            ?>
            <option value="<?php echo $data2['namaKota']; ?>"><?php echo $data2['namaKota']; ?></option>

            <?php } ?>
          </select>

        </div>
        <div class="form-group">
          <label for="perwakilan">Pimpinan/Perwakilan <small>(wajib)</small></label>
          <input type="text" class="form-control" id="perwakilan" name="perwakilan" placeholder="Masukkan nama pimpinan atau perwakilan" required>

        </div>
        
      <div class="modal-footer">
      <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Insert -->