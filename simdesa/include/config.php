<?php
// data desa
$desa["kode"] = "437.105.08";
$desa["nama"] = "walakpenduduknane";
$desa["alamat"] = "Jalan walakpenduduknane No. 27";
$desa["tlp"] = "33333333";
$desa["kades"] = "WMC kilungga TK ST";
$desa["kades_nip"] = "33399993333";
$desa["sekdes"] = "PakKilungga,S.Pbu";
$desa["sekdes_nip"] = "0009.009.34343";
$desa["tt_kades"] = "KEPALA DESA WALAKPENDUDUKNANE";
$desa["tt_sekdes"] = "An.KEPALA DESA WALAKPENDUDUKNANE<br />SEKRETARIS DESA";
// nama kecamatan
$desa["kecamatan"] = "SiloDogaKarno";
$desa["kabupaten"] = "Baliem";
// untuk pilihan
$agama = array("Pilih agama anda","Islam","Kristen_Katolik","Kristen_Protestan","Hindhu","Budha","Kong_Huchu","Lainnya");
$s_pernikahan = array("Pilih status anda","belum_nikah","nikah","janda/duda","lainnya");
$j_kelamin = array("Pilih jenis kelamin ","L" => "Laki - Laki","W" => "Wanita"); 
$gol_darah = array("Pilih golongan darah","A","AB","B","O","--");
// gunakan underscore(_) sebagai pengganti spasi antara 2 kata
$dusun = array("Pilih dusun anda","siliba","elarema","winerloma");
$rw = array("Pilih rw anda","01","02","03");
$rt = array("Pilih rw anda","01","02","03","04","05","06","07","08","09","10");
$ekonomi = array("Pilih ekonomi anda","Sangat_Kaya","Kaya","Cukup","Miskin","Sangat_Miskin","Nemen_pollll","Lainnya");
// untuk jenis surat, SK = surat keterangan SKP = surat keterangan pindah,SL = Surat lahir, SM = Surat kematian
// jangan dirubah untuk kode suratnya
$j_surat = array("SK" => "470","SKP" => "475","SKA" => "470","SL" =>"474.1","SM" =>"474.3");
// untuk set nomer awal surat, isi dengan nama index pada jenis surat
$awal_nomer_surat["SK"]=3;
$awal_nomer_surat["SKP"]=0;
$awal_nomer_surat["SKA"]=0;
$awal_nomer_surat["SL"]=0;
$awal_nomer_surat["SM"]=0;

$surat_ket = array("Pilih Jenis Keterangan","Adat - Istiadat","Usaha","Domisili");
// untuk paging
$limit = 2;
$paging_tampil = 4;
?>
