$('#example1').DataTable({
});

var id_cart = '';
$('.m-checkout').click(function(){
    id_cart = this.id;
    var str = "" + id_cart
    var pad = "0000"
    var ans = pad.substring(0, pad.length - str.length) + str
    $("#cart-nya").text('FK'+ans);
})

$('#btn-checkout').click(function(){
    $('#form-checkout').submit();
})

var id_p,produk = '';
$('.hapus-cart-item').click(function(){
    id_p = this.id;
    produk=$(this).attr('produk');
    $("#produk-nya").text(produk);
})

$('#keluarkan').click(function(){
    $('#form-hapus'+ id_p).submit();
})

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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
  
$("#customFile").change(function() {
    readURL(this);
});
