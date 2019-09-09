$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose:true,
    language: 'id'
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
  
$("#foto_produk").change(function() {
    readURL(this);
});

// var myImage = document.getElementById('#blah');

// Holder.run({
//   images: myImage
// });

$('#table-full').DataTable({
});

$('.selectpicker').selectpicker();

//tombol hapus produk
var id_p,produk = '';
$(".hapus-produk").click(function() {
    id_p = this.id;
    produk=$(this).attr('produk');
    $("#produk-nya").text(produk);
});

$("#yh-produk").click(function() {
    $("#fh-produk" + id_p).submit()
})

//tombol foto
var prod,path = '';
$(".tombol-foto").click(function() {
    prod=$(this).attr('prod');
    path=$(this).attr('path');
    $("#id-foto").text(prod);
    $("#path-nya").attr("src", path);
});

//tombol tambah
var p_id, stok = '';
$(".tombol-tambah").click(function() {
    p_id = this.id;
    pr=$(this).attr('pr');
    $("#stok-produknya").text(pr);
    $("#produk-id").val(p_id);
});



//tombol bayar
var id,no_fk,tgl,pel,utang,tempo,bukti = '';
$(".tombol-bayar").click(function() {
    id = this.id;
    no_fk = $(this).attr('no-fk');
    tgl=$(this).attr('tgl');
    pel=$(this).attr('pel');
    utang=$(this).attr('utang');
    tempo=$(this).attr('tempo');
    bukti=$(this).attr('bukti');
    $("#no-fak").text('Data Utang '+no_fk);
    $("#tgl-jual").text(tgl);
    $("#path-bukti").attr("src", bukti);
    $("#pelanggan").text(pel);
    $("#tot-utang").text(utang);
    $("#jatuh-tempo").text(tempo);
});

$("#yakin-lunas").click(function() {
    $("#fb-utang" + id).submit()
})

//tombol hapus kategori
var id_s,sales = '';
$(".hapus-sales").click(function() {
    id_s = this.id;
    sales=$(this).attr('sales');
    $("#sales-nya").text(sales);
});

$("#yh-sales").click(function() {
    $("#fh-sales" + id_s).submit()
})

//tombol hapus kategori
var id_s,kategori = '';
$(".hapus-kategori").click(function() {
    id_s = this.id;
    kategori=$(this).attr('kategori');
    $("#kategori-nya").text(kategori);
});

$("#yh-kategori").click(function() {
    $("#fh-kategori" + id_s).submit()
})

$('.datepicker-laporan').datepicker({
    format: 'yyyy-mm-dd',
    autoclose:true,
    language: 'id'
});

//tombol hapus pelanggan
var id_pel,pel = '';
$(".hapus-pelanggan").click(function() {
    id_pel = this.id;
    pel=$(this).attr('pel');
    $("#pel-nya").text(pel);
});

$("#yh-pel").click(function() {
    $("#fh-pel" + id_pel).submit()
})


// function bukajendela(url) {
//     window.open(url, "window_baru", "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=auto,height=auto");
// }

function bukajendela(url) {
    var w = 1000;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, "laporan", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  } 