<html>
<head>
<title>BA & PI PDF</title>
<body>
	<font face="times new roman" size="2">

		<font size="1" style="position: relative;left: 85%;"><div style="border: 1px;border-style: solid;width: 130px;">Lampiran 4 <br>
SE No.&nbsp;&nbsp;&nbsp;&nbsp;/Dir/SP-CSR/SE/2022</font>
		</div>
<h1><font size="4">KOP SURAT BANK SUMUT</font></h1>
<hr><width="100" height="75"></hr></width="100">
<table border="1" style="position: relative;left: 7%;margin-top: 2%;border-collapse:collapse;width: 90%;">
	<tr align="center">
<td colspan="2"><b>BERITA ACARA <br>SERAH TERIMA BANTUAN PROGRAM KEMITRAAN BANK SUMUT</b>
</td>
</tr>		
<tr>
<td> Nama Bantuan : {{$master->nama_kegiatan}}<br> Lokasi : Kantor Cabang </td>
<td> Tanggal : <br> Lampiran : 1 (satu) set ---</td>
</tr>	


</table>

<p style="text-align: justify;margin-top: 20px">Pada hari ini &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; tanggal &nbsp;&nbsp;&nbsp;&nbsp; bulan &nbsp;&nbsp;&nbsp;&nbsp; tahun &nbsp;&nbsp;&nbsp;&nbsp;, bertempat di &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, kami yang bertandatangan di bawah ini :</p>
<table style="margin-top: -3%;">
<p>I. PIHAK PERTAMA</p>
<tr>
<td>Nama</td>
<td>:</td>
<td>{{$bapi->nama}}</td>
</tr>
<tr>
<td>Jabatan</td>
<td>:</td>
<td>{{$bapi->jabatan}}</td>
</tr>
<tr>
<td>Alamat</td>
<td>:</td>
<td>{{$bapi->alamat}}</td>
</tr>
</table>

<p style="text-align: justify;">Dalam hal ini bertindak dan untuk atas nama <b>PT Bank Sumut</b>, yang selanjutnya disebut <b>PIHAK PERTAMA.</b></p>
<table style="margin-top: -3%;">
<p>II. PIHAK KEDUA&nbsp;&nbsp;&nbsp;</p>
<tr>
<td>Nama</td>
<td>:</td>
<td>{{$bapi->nama_bank}}</td>
</tr>
<tr>
<td>Jabatan</td>
<td>:</td>
<td>{{$bapi->jabatan_bank}}</td>
</tr>
<tr>
<td>Alamat</td>
<td>:</td>
<td>{{$bapi->alamat_bank}}</td>
</tr>
</table>	
<p style="text-align: justify;" >Dalam hal ini bertindak dan untuk atas nama <b>{{$bapi->nama}}</b> , yang selanjutnya disebut <b>PIHAK KEDUA.</b></p>
<p style="text-align: justify;">Dengan ini <b>PIHAK PERTAMA</b> telah menyerahkan <b>BANTUAN PROGRAM KEMITRAAN BERUPA BARANG</b> kepada <b>PIHAK KEDUA</b> sebagai berikut :</p>
<table style="position: relative;top:-4%;">
<p style="opacity: 0;">I. PIHAK PERTAMA</p>
<tr>
	<td>Nama Bantuan</td>
	<td>:</td>
	<td>{{$master->nama_kegiatan}}</td>
</tr>
<tr>
	<td>Lokasi</td>
	<td>:</td>
	<td></td>
</tr>
<tr>
	<td>Nilai Bantuan</td>
	<td>:</td>
	<td>Rp.{{ number_format($master->nominal, 2, ',', '.'); }},-</td>
</tr>
<tr>
	<td>Jenis Barang</td>
	<td>:</td>
	<td>Rp.{{ number_format($master->nominal, 2, ',', '.'); }},-</td>
</tr>	
</table>
<p style="text-align: justify;margin-top: -5%;">Demikian Berita Acara ini dibuat dan ditandatangani di ------------------ oleh kedua pihak untuk dipergunakan sebagaimana mestinya.</p>
<table align="center" style="width: 100%;height: auto;">
<tr>
<td><p style="text-align: center;">PIHAK KEDUA<br>Yang menerima&nbsp;
</p></td>
<td><p style="text-align: center; ">PIHAK PERTAMA<br>Yang Menyerahkan&nbsp;</p></td>
</tr>
<tr>
<td><font size="1"><div style="border: 1px;border-style: solid;width: 70px;position: relative;left: 25%;">Materai 10.000</div></font></td>
</tr>
<tr>
<td><p style="text-align: center;margin-top: 20px;"><b>{{$bapi->nama}}<br>({{$bapi->jabatan}})</b>
</p></td>
<td><p style="text-align: center;margin-top: 20px; "><b>{{$bapi->nama_bank}}<br>({{$bapi->jabatan_bank}})</b>
</p></td>
</tr>
<tr align="center">
<td colspan="2"><p style="margin-top: 30px;"><b>Saksi-saksi&nbsp;</b></p></td>
</tr>
<tr>
<td><p style="text-align: center;margin-top: 30px;"><b>{{$bapi->saksi[0]}}</b><br>({{$bapi->saksi[1]}})</p></td>
 <td><p style="text-align: center;margin-top: 30px;"><b>{{$bapi->saksi[2]}}</b><br>({{$bapi->saksi[3]}})</p></td>
 </tr> 
</table>	
</font>
<div style="page-break-after: always;"></div>
	<font face="times new roman" size="14px">
		<font size="1" style="position: relative;left: 85%;"><div style="border: 1px;border-style: solid;width: 130px;">Lampiran 4 <br>
SE No.&nbsp;&nbsp;&nbsp;&nbsp;/Dir/SP-CSR/SE/2022</font>
		</div>

<h1><font size="4">KOP SURAT BANK SUMUT</font></h1>
<hr><width="100" height="75"></hr></width="100">
<p style="text-align: center;"><b>PAKTA INTEGRITAS</b></p>
<p style="text-align: justify;">Yang bertanda tangan dibawah ini :<br>
{{$bapi->nama}} selaku ------------------- program ------------------- yang mewakili secara sah untuk dan atas nama pribadi dan <b>Penerima Manfaat</b>----------------- berdasarkan ----------------- dari ----------------- berjanji untuk menjunjung tinggi amanah yang diberikan oleh <b>Bank Sumut</b> maupun oleh Pemerintah Daerah atas Penyaluran Program Kemitraan PT Bank Sumut Tahun Buku ----------------- Propinsi/Kab/Kota -----------------, dan oleh karena itu akan selalu menjunjung tinggi integritas moral, objektivitas, akuntabilitas, keterbukaan dan kejujuran dalam menjalankan amanah berupa Dana/Barang Program Kemitraan <b>Bank Sumut</b> sehingga oleh karena itu menyatakan bahwa :
</p>
<ol style="text-align: justify;">
<li>Seluruh keputusan dalam penyaluran dan penggunaan dana/barang Program Kemitraan <b>Bank Sumut</b> telah dan akan dibuat dengan semata-mata bagi kepentingan --------------(penerima manfaat), serta tidak bertentangan dengan peraturan perundang-undangan yang berlaku ;</li><br>
<li>Baik secara langsung maupun tidak langsung, tidak akan mengambil keuntungan dari dana/barang yang akan disalurkan ;</li><br>
<li>Baik secara langsung maupun tidak langsung, tidak akan menempatkan diri pada situasi dan keadaan yang akan menimbulkan konflik kepentingan dalam penyaluran dan penggunaan dana/barang yang akan disalurkan ;</li><br>
<li>Akan melaksanakan tanggung jawab jabatan kami sepenuhnya baik secara administratif maupun secara materil akan pelaksanaan penyaluran, penggunaan dan dalam pertanggungjawaban dana/barang CSR <b>Bank Sumut</b> ;</li><br>
<li>Akan bertanggung jawab baik secara moril kepada --------------(penerima manfaat), maupun secara materil di hadapan hukum yang berlaku di Indonesia, apabila kami melanggar pernyataan yang telah kami buat ini ;</li><br>
<li>Tidak akan memberikan apapun, barang, uang, jasa atau lainnya kepada pihak Bank Sumut maupun kepada pihak lainnya ;</li><br>
<li>Kegiatan yang akan dibiayai oleh dana Program Kemitraan <b>Bank Sumut</b> bukan merupakan program yang telah dibiayai oleh Pemerintah Daerah, Pemerintah Pusat ataupun lembaga lainnya ;</li><br>
<li>Setelah Kami menerima dana/barang Program Kemitraan, maka Kami sepenuhnya bertanggung jawab atas seluruh pelaksanaan kegiatan dan melepaskan Pihak <b>Bank Sumut</b> dari segala tuntutan hukum atas pelaksanaan serta hasil kegiatan tersebut.</li>
	</ol>
<p style="text-align: justify;">Demikian pernyataan ini kami perbuat dengan sungguh-sungguh dan tanpa ada paksaan dari pihak manapun.</p>	
<p style="text-align: right;margin-top: 7%;position: relative; right: 25%;"> --------------,---------<br>
Pemberi Pernyataan
</p>
<p style="text-align: right;font-size: 1;"><div style="border: 1px;border-style: solid;width: 70px;position: relative; left: 58%;bottom: 12px;">Materai Rp.10.000</div></p>
<p style="text-align: right;position: relative; right: 25%;bottom: 20px;"> (--------------,---------)</p>
<p style="position: relative;bottom: 45px;">Mengetahui,<br><b>SAKSI-SAKSI :</b></p>
<table style="position: relative;bottom: 45px;">
<tr>
<td>1. Nama</td>
<td>:</td>
<td>{{$bapi->saksi[0]}}</td>
</tr>
<tr>
<td>Jabatan</td>
<td>:</td>
<td>{{$bapi->saksi[1]}}</td>
</tr>
<tr>
<td>2. Nama</td>
<td>:</td>
<td>{{$bapi->saksi[2]}}</td>
</tr>
<tr>
<td>Jabatan</td>
<td>:</td>
<td>{{$bapi->saksi[3]}}</td>
</tr>
</table>
</font>

</body>

</html>