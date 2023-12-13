<div class="container">
    <div class="content">
    <h1><i class="fa-solid fa-address-card fa-sm mr-2"></i>Info Supplier</h1>
    <form>
    <!-- Untuk Pegawai -->
    <?php
        $namaAkun= $_SESSION['namaAkun'];
        //Pegawai
        $supplier= mysqli_query($koneksi,"Select * from supplier where namaSupplier='".$namaAkun."'");
        if (mysqli_num_rows($supplier) == 1) {
            while ($data2= mysqli_fetch_assoc($supplier)){ //Begin while result user
        ?>
            <div class="form-group row">
                <label for="namaSupplier" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-3">
                    <input type="text" readonly class="form-control-plaintext" id="namaSupplier" value="<?php echo $data2['namaSupplier']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-3">
                    <input type="text" readonly class="form-control-plaintext" id="alamat" value="<?php echo $data2['alamat']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nomorTelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-3">
                    <input type="text" readonly class="form-control-plaintext" id="nomorTelepon" value="<?php echo $data2['nomorTelepon']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kota" class="col-sm-2 col-form-label">Asal Kota</label>
                <div class="col-sm-3">
                    <input type="text" readonly class="form-control-plaintext" id="kota" value="<?php echo $data2['kota']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kota" class="col-sm-2 col-form-label">Perwakilan/Pimpinan</label>
                <div class="col-sm-3">
                    <input type="text" readonly class="form-control-plaintext" id="kota" value="<?php echo $data2['perwakilan']; ?>">
                </div>
            </div>
        <?php
            }
        }
    ?>
    <!-- Untuk User -->
    <?php
        //User 
        $result= mysqli_query($koneksi,"Select * from users where namaAkun='".$namaAkun."'");
        if (mysqli_num_rows($result) == 1) {
            while ($data= mysqli_fetch_assoc($result)){ //Begin while result user
        ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email Perusahaan</label>
                <div class="col-sm-3">
                    <input type="text" readonly class="form-control-plaintext" id="email" value="<?php echo $data['email']; ?>">
                </div>
            </div>
        <?php         
            }
        }//End while result user
        
    ?>
    </form>
    </div>
</div>