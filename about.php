<?php 
$sql = "SELECT * FROM about WHERE id = '1'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$nama_cv = $row['nama'];
$alias = $row['alias'];
$alamat = $row['alamat'];
$telpon = $row['telpon'];
$email = $row['email'];
$tanda_tangan = $row['tanda_tangan'];
$nama_ttd = $row['nama_ttd'];
$no_peg = $row['no_peg'];
$moto = $row['moto'];
?>