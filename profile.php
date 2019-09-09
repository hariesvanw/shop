<?php 
include('front/core/header.php');

$msg = null;
if(isset($_SESSION['message'])){
    $msg = $_SESSION['message'];
}

if($guest){
    header("Location: ../login.php");
}else{
    $id_pel = $pel['id'];
    $sql = "SELECT * FROM pelanggan_profile WHERE id_pelanggan='$id_pel'";
    $pelanggan = $conn->query($sql);

    $row = null;
    if($pelanggan){
        $row = mysqli_fetch_assoc($pelanggan);
    }
}

?>
    <main role="main">
        <div class="container-fluid py-5 bg-light" style="height:100vh">
            <div class="row justify-content-center align-center ">
                <div class="col-5">
                    <?php 
                        if($msg === 'simpan'){
                    ?>
                        <div class="alert alert-success" role="alert">
                            Profile berhasil disimpan !
                        </div>
                    <?php } else if($msg === 'update') { ?>
                        <div class="alert alert-info" role="alert">
                            Profile berhasil diupdate !
                        </div>
                    <?php }?>
                    <div class="card">
                        <div class="card-header">
                            PROFILE ANDA
                        </div>
                        <div class="card-body">
                            <form action="front/simpan_profile.php" method="post">
                                <input type="hidden" name="id_pelanggan" value="<?php echo $id_pel ?>">
                                <input type="hidden" name="id_profile" value="<?php echo $row['id'] ?>">
                                <div class="form-group">
                                    <label for="nama-pelanggan">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama-pelanggan" placeholder="Nama Pelanggan...."
                                    value="<?php echo $row['nama_pelanggan'] ? $row['nama_pelanggan'] : '' ?>"
                                    required
                                    name="nama_pelanggan"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="no-telpon">No. Telpon</label>
                                    <input type="text" class="form-control" id="no-telpon" placeholder="No Telpon...."
                                    value="<?php echo $row['no_telpon'] ? $row['no_telpon'] : '' ?>"
                                    required
                                    name="no_telpon"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="3" required
                                    name="alamat"
                                    ><?php echo $row['alamat'] ? $row['alamat'] : '' ?></textarea>
                                </div>
                                <button name="profile" value="profile" type="submit" class="btn btn-primary btn-block">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
include('front/core/footer.php');
unset($_SESSION["message"])
?>