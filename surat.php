<?php

/* template untuk surat keterangan */
include_once "include/koneksi.php";
include_once "include/config.php";


$jenis_surat = $_GET['kode_surat'];
// ambil nomer surat terakhir
$sql_nomer_surat = "select count(*) from surat where jenis_surat = '".$jenis_surat."'";
$tmp_surat = mysqli_query($conn,$sql_nomer_surat);
$jml = mysqli_fetch_row($tmp_surat);
$nomer_terakhir = $awal_nomer_surat[$jenis_surat] + ($jml[0] + 1);
if(isset($_GET['nama'])){
	$nama_surat = $_GET['nama'];
	}
else{
	$nama_surat = "";
	}
$tahun = date("Y");
$nomer_surat = $j_surat[$jenis_surat]."/".$nomer_terakhir."/".$desa["kode"]."/".$tahun;
// handle tanda tangan yang bersangkutan
if($jenis_surat == "SK"){
	$ybs = "style='display:block'";
	}
else {
	$ybs = "style='display:none'";
	}	
// field tambahan untuk surat selain surat keterangan biasa
// SKA = adat istiadat, SKP = keterangan pindah, SK = keterangan
if($jenis_surat == "SKA"){
	$field_tambahan ='<label>Tujuan
					<span class="small">Ditujukan kepada</span>
					</label>
					<input name="tujuan" id="tujuan" class="manual tampil" />
					<span class="ket"></span>
					<label>Untuk Persayaratan
					<span class="small">Surat diperlukan untuk</span>
					</label>
					<input name="u_persyaratan" id="u_persyaratan" class="manual tampil" />
					<span class="ket"></span>
					<label>Keterangan
					<span class="small">Keterangan surat</span></label>
					<textarea name="ket" id="ket" class="manual tampil" rows="5"/></textarea>
					<span class="ket"></span>
					'; 
	$mengetahui  = "<div style='text-align:center;clear:both'>Mengetahui</div>";			
	$mengetahui .= "<div class='tanda_tangan'>";
	$mengetahui .="<div style='text-transform:uppercase'>CAMAT ".$desa["kecamatan"]."</div><div class='kosong'></div>";
	$mengetahui .="<div>_______________________</div></div>";	
	$mengetahui .= "<div class='tanda_tangan'>";
	$mengetahui .="<div style='text-transform:uppercase'>DANRAMIL ".$desa["kecamatan"]."</div><div class='kosong'></div>";
	$mengetahui .="<div>_______________________</div></div>";	
	}
else if($jenis_surat == "SKP"){
	$field_tambahan ='<label>Pindah ke
					<span class="small">Alamat yang baru</span>
					</label>
					<input name="pindah_ke" id="pindah_ke" class="manual tampil" />
					<span class="ket"></span>
					<label>Alasan Pindah
					<span class="small">Alasan kepindahan</span>
					</label>
					<input name="alasan" id="alasan" class="manual tampil" />
					<span class="ket"></span>
					<label>Tanggal Pindah
					<span class="small">Tanggal mulai pindah</span>
					</label>
					<input name="tgl_pindah" id="tgl_pindah" class="manual tampil" />
					<span class="ket"></span>
					<label>Pengikut
					<span class="small">Jumlah yang ikut</span>
					</label>
					<input type="hidden" name="jum_pengikut" id="jum_pengikut" class="manual tampil" value="0"/>
					<span class="input-link" onclick="tambah_pengikut(this)"><img src="img/edit_add.png"/><span style="vertical-align:middle;padding:3px;margin-left:3px;font-size:70%;font-weight:bold">( Tambahkan pengikut )</span></span>
					<div class="table" style="clear:both;position:relative;margin-left:170px;background:none">
					<table class="listing" id="tab_pengikut" cellpadding="0" cellspacing="0">
					<tr><th>No</th><th style="width:90px" >Nama</th><th style="width:90px">L/P</th><th style="width:40px">Umur</th><th style="width:70px">Hubungan</th><th style="width:80px">Status</th></tr>
					</table>
					</div>
					'; 
	$mengetahui="";
	}
else {
	$field_tambahan ='<label>Keterangan
					<span class="small">Keterangan surat</span></label>
					<textarea name="ket" id="ket" class="manual tampil" rows="5"/></textarea>
					<span class="ket"></span>
					';
	$mengetahui="";
	}		
?>

<div class="top-bar">
    <h1>Surat Keterangan Kelakuan Baik</h1>
        <div class="breadcrumbs">Nomor : </div>
</div>
<div id="stylized" class="select-bar">
<div class="info proses"></div>		

<form id="form" name="form" method="post" action="simpan_surat.php">
<label>Nama
<span class="small">Pemohon surat</span>
</label>
<input type="text" name="nama" id="nama" class="isian tampil"/>
<span class="ket"></span>
<label>Tempat Lahir
    <span class="small">Tempat lahir</span>
</label>
<input type="text" name="tempat_lahir" id="tempat_lahir" class="isian tampil"/>
<span class="ket"></span>
<label>Tanggal Lahir
    <span class="small">Tanggal lahir</span>
</label>
<input type="date" name="tgl_lahir" id="tgl_lahir" class="isian tampil"/>
<span class="ket"></span>
<label>Jenis Kelamin
<span class="small">L = laki - laki, P = Perempuan</span>
</label>
<select name="j_kel" id="j_kel" class="isian tampil">
		<option value=""></option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
<span class="ket"></span>
<label>NIK
<span class="small">No. KTP / NIK</span>
</label>
<input type="text" name="no_ktp" id="no_ktp" class="isian tampil" />
<span class="ket"></span>
<label>Pekerjaan
<span class="small">Pekerjaan yang ditekuni</span>
</label>
<input type="text" name="pekerjaan" id="pekerjaan" class="isian tampil" />
<span class="ket"></span>
<label>Agama
<span class="small">Agama yang dianut</span>
</label>
<select name="agama" id="agama" class="isian tampil">
		<option value=""></option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Katolik">Katolik</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
        <option value="Konghucu">Konghucu</option>
        <option value="Lainnya">Lainnya</option>
    </select>
<span class="ket"></span>
<label>Status Perkawinan
<span class="small">Status pernikahan</span>
</label>
<select name="s_nikah" id="s_nikah" class="isian tampil">
		<option value=""></option>
        <option value="Belum Menikah">Belum Menikah</option>
        <option value="Menikah">Menikah</option>
        <option value="Cerai">Cerai</option>
        <option value="Lainnya">Lainnya</option>
    </select>
<span class="ket"></span>
<label>Alamat Tempat Tinggal
<span class="small">Alamat rumah</span>
</label>
<textarea name="alamat" id="alamat" class="isian tampil" ></textarea>
<span class="ket"></span>
<label>Yang Tanda Tangan
<span class="small">Pihak yang mengeluarkan surat</span>
</label>
<select onchange="isi_nip(this)">
<option value="kades">Kades</option>
<option value="sekdes">Sekdes</option>
</select>
<input type="hidden" id="tanda_tangan" value="<?php echo $desa['kades'] ?>" />
<input type="hidden" id="nip" value="" />
<button type="submit" class="isian">Simpan</button>
</form>
</div>

<!-- print preview surat -->
<div id="cetak" style="display:none;position:absolute;" onclick="cetak(this)"><img src="img/print.png" /></div>
<div id="surat_tampil" style="display:none;">
<!-- awal kepala surat -->

<div id="kepala_surat"><img src="logo.jpg" width="80px" height="80px" id="logo_surat" valign="baseline"/>
<strong>PEMERINTAHAN KABUPATEN <?php echo strtoupper($desa['kabupaten']) ?><br/>
KECAMATAN  <?php echo strtoupper($desa['kecamatan']) ?><br/>
KANTOR KEPALA DESA  <?php echo strtoupper($desa['nama']) ?><br/></strong>
<!-- <?php echo ucwords($desa['alamat']) ?> Telp. <?php echo $desa['tlp'] ?> -->
</div>
<!-- akhir kepala surat -->

<div class="garis"></div>
<div id="nomer_surat">
<!-- <div style="text-transform:uppercase;text-decoration:underline;font-weight:bolder">Surat Keterangan <?php echo $nama_surat;?></div> -->
<div style="text-transform:uppercase;text-decoration:underline;font-weight:bolder">Surat Keterangan Kelakuan Baik</div>
        <div>Nomor : ..............................</div>
</div>				 
<div id="par_pembuka">
Yang bertanda tangan dibawah ini : <br><br>
<span style="display: inline-block; width: 100px; text-align: left; margin-left: 15px;  vertical-align: top;">Nama</span><span style="margin-left: 100px; margin-right: 5px;">:</span>
    <span><?php echo $desa["kades"] ?></span>
    <br>
    <span style="display: inline-block; width: 100px; text-align: left; margin-left: 15px; vertical-align: top;">Jabatan</span><span style="margin-left: 100px; margin-right: 5px;">:</span>
    <span style="vertical-align: top;"><?php echo $desa["tt_kades"] ?></span><br>
    <span style="vertical-align: top; margin-left: 229px;"> KECAMATAN <?php echo $desa["kecamatan"] ?></span>
    <span style="vertical-align: top;"> KABUPATEN <?php echo $desa["kabupaten"] ?></span><br><br>
Dengan ini menerangkan
</div>
<div id="content_surat"></div>
<br>
<div id="par_penutup">Benar bahwa nama tersebut diatas Berkelakuan Baik dan terdaftar sebagai penduduk yang syah dalam BIP ( Buku Induk Kependudukan ) Desa Kutarayat Kecamatan Naman Teran Kabupaten Karo. <br><br>                                                                 
Adapun Surat Keterangan ini diperbuat untuk menerangkan bahwa an.tersebut diatas berkelakuan baik dan dibuktikan bahwa tidak pernah dihukum sesuai dengan Hukum yang berlaku di Negara Kesatuan Republik Indonesia. <br><br>
Demikian kami perbuat Surat Keterangan ini untuk dipergunakan sebagaimana mestinya.
</div>
<br>
<!-- <div class="tanda_tangan" id="ybs" <?php echo $ybs ?> >
	<div>&nbsp;</div>
	<div class="kosong">Yang Bersangkutan</div>
	<div id="nama_pemohon"></div>
</div>	 -->
<?php
function bulanIndo($bulanInggris) {
    $bulanInggris = array(
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    );
    
    return $bulanInggris[date('F')];
}
?>

<div class="tanda_tangan" style="float:right">
<div>Kutarayat, <?php echo date("d ") . bulanIndo(date("F")) . date(" Y"); ?></div>
	<div class="kosong" id="pejabat"><?php echo $desa["tt_kades"]; ?></div>
	<div id="nama_pejabat"><?php echo "<span style='text-transform:uppercase;text-decoration:underline'>".$desa["kades"]."</span>"; ?></div>
</div>
<?php echo $mengetahui; ?>
</div>

<script type="text/javascript" >
var sekdes_nip = "<?php echo $desa['sekdes_nip'] ?>";
var kades_nip = "<?php echo $desa['kades_nip'] ?>";	
var kades = "<?php echo $desa['kades'] ?>";
var sekdes = "<?php echo $desa['sekdes'] ?>";
var tt_kades = "<?php echo $desa['tt_kades'] ?>";
var tt_sekdes = "<?php echo $desa['tt_sekdes'] ?>";
var jenis_surat = "<?php echo $jenis_surat ?>";
function isi_nip(elm){
	if($(elm).val() == "kades"){
		$("#tanda_tangan").val(kades);
		$("#nip").val(kades_nip);
		$("#pejabat").html(tt_kades);
		$("#nama_pejabat").html("<span style='text-transform:uppercase;text-decoration:underline'>"+kades+"</span>");
		}
	else {
		$("#tanda_tangan").val(sekdes);
		$("#nip").val(sekdes_nip);
		$("#pejabat").html(tt_sekdes);
		$("#nama_pejabat").html("<span style='text-transform:uppercase;text-decoration:underline'>"+sekdes+"</span><br />"+sekdes_nip);
		}	
	}

function cetak(elm){
	$(elm).css("display","none");
	window.print();
	}
$(function(){
	var nama_surat = "<?php echo $nama_surat ?>";
	if(nama_surat == "lainnya"){
		nama_surat = prompt("Surat keterangan untuk ........");
		$("#nama_surat").text(nama_surat);
		}
	awal();
	$(".manual").blur(function(){
		if($(this).val() == ""){
			$(this).focus();	
		}
		else {	
			$(this).nextAll(".manual").first().focus();
		}
		})
	$("#nama").autocomplete({
			source: function(request,response){
				// fungsi yang akan mengambil data dari file cari2.php dalam bentuk json
				var sql  = "SELECT no_ktp, nama, agama,t_lahir,tgl_lahir,j_kel, w_negara,";
				    sql += "pendidikan, pekerjaan, s_nikah, alamat,rt,rw,dusun FROM v_detail_warga ";
				    sql += " WHERE nama LIKE '";
				  $.post("data.php",{data:request.term,sql:sql},function(hasil){
					response($.map(hasil,function(item){
					return {
						// label untuk pilihan
						label:item.nama+" --no ktp -- "+item.no_ktp,
						value:item.nama,
						no_ktp:item.no_ktp,
						agama:item.agama,
						t_lahir:item.t_lahir,
						tgl_lahir:item.tgl_lahir,
						j_kel:item.j_kel,
						w_negara:item.w_negara,
						pendidikan:item.pendidikan,
						pekerjaan:item.pekerjaan,
						s_nikah:item.s_nikah,
						alamat:item.alamat,
						rt:item.rt,
						rw:item.rw,
						dusun:item.dusun
						}	
						}))
					},"json");
				},
			minLength: 2,
			select: function( event, ui ) {
					// isi otomatis field lainnya
					$("#no_ktp").val(ui.item.no_ktp);
					$("#agama").val(ui.item.agama);
					$("#t_lahir").val(ui.item.t_lahir+",  "+ui.item.tgl_lahir);
					$("#j_kel").val(ui.item.j_kel);
					$("#w_negara").val(ui.item.w_negara);
					$("#pendidikan").val(ui.item.pendidikan);
					$("#pekerjaan").val(ui.item.pekerjaan);
					$("#s_nikah").val(ui.item.s_nikah);
					$("#alamat").val(ui.item.alamat+" RT "+ui.item.rt+" RW "+ui.item.rw+" Dusun "+ui.item.dusun);
					$(".isian").attr("disabled",false);
					$(".isian:not(:first)").attr("readonly",true);
					$(".manual:first").focus();
					}
			})
	// event ketika form disubmit
	$("#form").submit(function(){
		// harus diisi semua
		var inputan = $(".tampil");	
		for(i = 0; i < inputan.length; i++){
				if($(inputan).eq(i).val() == ""){
					$(".ket").eq(i).html("harus diisi").css({"display":"block"});
					$(inputan).eq(i).focus();
					return false;
					}
				else {
					$(".ket").eq(i).empty().css({"display":"none"});
					}	
				}
		var ada_error = 0;
		// khusus untuk surat keterangan pindah
		$(".ikut").each(function(){
			if($(this).val() == ""){
				$("div.info").html("Harus diisi semua").addClass("gagal");
				ada_error++;
				}
			})	
		if(ada_error == 0){
		var nama_surat = $("#nama_surat").parent().text();
		var nomer_surat = "<?php echo $nomer_surat; ?>";	
		var input = $(this).serializeArray();
		var url = $(this).attr("action");
		var t_tangan = $("#tanda_tangan").val();
		var nip = $("#nip").val();
		var nama_warga = $("#nama").val();
		var id_warga = $("#no_ktp").val();
		 // cetak surat 
	//	 $.post("template_surat/surat_ket.php",{nama_surat:nama_surat,no_surat:nomer_surat,data:input,ttd:t_tangan,nip:nip,id_warga:id_warga},function(data){
		// hapus dulu isi dari content_surat
		$("#content_surat").empty();	
		$(this).find(".tampil").each(function(){
				var self = $(this);
				var label = self.prev("label").clone().children().remove().end().text();
				$("<label>"+label+"</label><span class='titik'>:</span><span class='s_kanan'>"+self.val()+"</span><br />").appendTo("#content_surat");
				})
		// hanya untuk surak keterangan pindah saja (SKP)
		if(jenis_surat == "SKP"){
		var jum_kolom_pengikut = 5;
		var baris ='';
		if($("#jum_pengikut").val() == 0){
			baris ='<tr><td>1</td><td>Nihil</td><td>==</td><td>==</td><td>==</td><td>==</td></tr>';
			}
		else{
			var jum_baris_pengikut = $(".ikut").length/jum_kolom_pengikut;
			for(var i = 0; i < jum_baris_pengikut; i++){
				var no_pengikut = parseInt(i)+ 1;	
				var index_ikut = i * jum_kolom_pengikut;
				var batas_ikut = parseInt(index_ikut) + parseInt(jum_kolom_pengikut);
				baris +='<tr><td>'+no_pengikut+'</td>';
				for(var j = index_ikut; j < batas_ikut; j++){
					baris +='<td>'+$(".ikut").eq(j).val()+'</td>'; 
					}
				baris +='</tr>';		
				}	
			}		
		var tabel_pengikut ='<div class="table" style="clear:both;position:relative;background:none">';
			tabel_pengikut +='<table class="data" cellpadding="0" cellspacing="0">';
			tabel_pengikut +='<tr><th>No</th><th>Nama</th><th>L/P</th><th>Umur</th><th>Hubungan</th><th>Status</th></tr>';
			tabel_pengikut +=baris;
			tabel_pengikut +='</table>';
			$(tabel_pengikut).appendTo("#content_surat");
			}		
		// tempat untuk tanda tangan pemohon surat
		$("#nama_pemohon").html("<span style='text-transform:uppercase;text-decoration:underline'>"+$("#nama").val()+"</span>");		
		
			var tampil_isi = $("#surat_tampil").html();	
			$("<div></div>").html(tampil_isi).dialog({
			title:'Cetak Surat',
			show: 'slide',
			hide: 'slide',
			dialogClass: 'dialog',
			width:'500px',
			buttons:{
			OK: function(){
				$(this).dialog('close');
				$("#stylized,.top-bar").hide();
				$("#surat_tampil").show();
				$("#cetak").show();
				$.post(url,{jenis_surat:jenis_surat,no_surat:nomer_surat,nama_surat:nama_surat,data:input,ttd:t_tangan,nip:nip,id_warga:id_warga,nama_warga:nama_warga},function(data){
					if(data == 1){
					//window.print();
				//	$("#cetak").click();
						}
					else {
						alert("belum disimpan");
						}	
					})
					
				
			},
			Batal: function(){
				$(this).dialog('close');
				}			
				}
		})	
	}	
	else {
			$("div.info").fadeIn();
		}
		// akhir cetak surat
		/*
			
		*/	
		return false;	
	})		
	
})
</script>
<style>
	.ui-autocomplete-loading { background: white url('img/loading.gif') right center no-repeat; }
	.ui-widget { font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif; font-size: 0.8em; }
	.ui-widget-content { border: 1px solid #dddddd; background: #ffffff url(images/ui-bg_highlight-soft_100_eeeeee_1x100.png) 50% top repeat-x; color: #333333; }
#cetak:hover{
	cursor:pointer;
	}	
</style>
