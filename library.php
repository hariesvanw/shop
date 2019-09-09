<?php
    function tgl_indo($date)
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $dt = explode("-", $date);
        $str = ltrim($dt[1], '0');
        return $dt[2] . ' ' . $bulan[$str - 1] . ' ' . $dt[0];
    }

    function tgl_indo_bulan_tahun($date)
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $dt = explode("-", $date);
        $str = ltrim($dt[1], '0');
        return $bulan[$str - 1] . ' ' . $dt[0];
    }

    function duit($duit){
        $rupiah = 'Rp. '.number_format($duit,2,',','.');
        return $rupiah;
    }

?>