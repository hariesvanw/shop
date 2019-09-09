<?php 

$produks = $conn->query("SELECT * FROM produk");
$c_produks = mysqli_num_rows($produks);

$pelanggan = $conn->query("SELECT * FROM pelanggan");
$c_pelanggan = mysqli_num_rows($pelanggan);

$sales = $conn->query("SELECT * FROM sales");
$c_sales = mysqli_num_rows($sales);

$lunas = $conn->query("SELECT * FROM penjualan WHERE status='lunas'");
$c_lunas = mysqli_num_rows($lunas);

$arr_transaksi=[];
for($i=1;$i<=12;$i++){
    $thn = date('Y');
    $tgl = $thn.'-'.str_pad($i,2,"0",STR_PAD_LEFT);
    $transaksi = $conn->query("SELECT * FROM penjualan WHERE tanggal_penjualan LIKE '%$tgl%' AND status='lunas'");
    $c_transaksi = mysqli_num_rows($transaksi);
    array_push($arr_transaksi, $c_transaksi);
}

$terlaris = $conn->query("SELECT p.id, p.nama_produk, p.harga_produk, SUM(pr.jumlah) as tot
                        FROM produk p 
                        LEFT JOIN kategori_produk kp on p.id = kp.id_produk
                        LEFT JOIN produk_record pr
                        on p.id = pr.id_produk
                        GROUP BY p.id ORDER BY tot DESC LIMIT 5");

?>