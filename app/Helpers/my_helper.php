<?php
function format_rupiah($a){
    if(!is_numeric($a)) return NULL;
    $jumlah_desimal="0";
    $pemisah_desimal="";
    $pemisah_ribuan=".";
    $angka="Rp. ".number_format($a, $jumlah_desimal, $pemisah_desimal,$pemisah_ribuan);
    return $angka;
}
?>