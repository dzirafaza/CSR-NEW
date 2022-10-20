<html>

<head>
    <title>Surat Keputusan</title>

<body>
    <font face="times new roman" size="3">

        <font size="1" style="position: relative;left: 85%;">
            <div style="border: 1px;border-style: solid;width: 130px;">Lampiran 4 <br>
                SE No.&nbsp;&nbsp;&nbsp;&nbsp;/Dir/SP-CSR/SE/2022
        </font>
        </div>

        <h1>
            <font size="4">KOP SURAT BANK SUMUT</font>
        </h1>
        <hr>
        <width="100" height="75">
            </hr>
        </width="100">

        <table>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>.........</td>
                <td>.........</td>
            </tr>
            <tr>
                <td>Lamp</td>
                <td>:</td>
                <td>.........</td>
            </tr>
        </table>
        <p>Kepada Yth :<br> Pemerintah {{$rows2->pemda}} <br>di<br>&nbsp;&nbsp;&nbsp;&nbsp;Tempat</p>

        <p style="text-align: center;margin-top: 20px"><b>Hal : Keputusan Persetujuan Atas Usulan Program
                {{$rows1->nama_kegiatan}}<br>Propinsi/Kabupaten/Kota {{$rows2->pemda}}</b></p>

        <p>Dengan hormat,</p>

        <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan surat Pemerintah Daerah
            Propinsi/Kab/Kota {{$rows2->pemda}} Nomor :
            {{$rows->surat_permohonan[1] == "No" ? '........' :  $rows->surat_permohonan[1]}} tanggal
            ({{date('d-m-y')}}) Perihal Permohonan Bantuan {{$rows1->nama_kegiatan}}, sebesar
            Rp.{{ number_format($rows1->nominal, 2, ',', '.'); }},- dengan ini kami sampaikan bahwa permohonan tersebut
            <b><u>dapat disetujui</u></b>. Penerima Manfaat diharapkan dapat segera berkoordinasi dengan Sekretaris
            Perusahaan / Kantor Cabang dan menyampaikan surat <b>Permohonan Pencairan Dana</b> serta surat
            <b>Pemberitahuan Rekening.</b>
        </p>

        <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;Demikian kami sampaikan, atas perhatian dan kerjasama
            yang baik diucapkan terima kasih.</p>


        <p style="text-align: right; margin-right: 80px;"> Hormat kami,<br>
            Sekretaris Perusahaan
        </p>
        <p></p>
        <p></p>
        <p style="text-align: right;margin-right: 80px;"> (------------------------)
        </p>

        <p style="font-size: 11px">Tembusan :
            <br>- Kantor {{$rows2->nama_unit}}<br>- Pertinggal
        </p>

    </font>

</body>

</html>