<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permohonan, Unit, Validasi, Bapi, Dalok, Wilayah};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use PDF;
use DB;
use Illuminate\Support\Facades\Storage;

class PemohonController extends Controller
{
     public function index()
     {
          $rows = Permohonan::all();
          // $value = Session()->get('user');
          //   $value1 = Session()->get('status_login');
          // var_dump($value);
          // echo '<br><br>';
          // exit();
          return view('pemohon.index', [
               'rows' => $rows
          ]);
     }
     public function proses($id)
     {
          $rows = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $rows->id_unit_master)->first();
          return view('pemohon.proses', [
               'rows' => $rows, 'unit' => $unit
          ]);
     }
     public function getAlok(Request $request)
     {
          $pemda = Unit::where("id_unit", $_GET['unitID'])->pluck('pemda')->first();
          $alokasi = Dalok::where([["id_unit", $_GET['unitID']], ["tahun", date('Y')]])->pluck('dana_alokasi')->first();
          if (!empty($alokasi)) {
               $alo = number_format($alokasi, 2, ',', '.');
               $data = [
                    "Rp. $alo",
                    $pemda
               ];
               return response()->json($data);
          } else {
               $data = [
                    "Kosong!",
                    $pemda
               ];
               return response()->json($data);
          }
     }
     public function create()
     {
          $rows = Unit::all();
          $wilayah = Wilayah::all();
          return view('pemohon.create', [
               'rows' => $rows, 'wilayah' => $wilayah
          ]);
     }
     public function store(Request $request)
     {
          $request->validate(
               [
                    'id_unit_master' => 'required',
                    'no_surat_edoc' => 'bail|required',
                    'nama_kegiatan' => 'required|min:4|max:220',
                    'lokasi_kegiatan' => 'required|min:4|max:255',
                    'ruang_lingkup' => 'required',
                    'nominal' => 'required',
                    'peruntukan' => 'required|min:7|max:255'
               ],
               [
                    'id_unit_master.required' => 'Mohon Pilih Unit Kantor!',
                    'no_surat_edoc.required' => 'Mohon Isi Nomor Surat!',
                    'nama_kegiatan.required' => 'Mohon isi Nama Kegiatan!',
                    'nama_kegiatan.min' => 'Nama Kegiatan minimum 4 Karakter!',
                    'nama_kegiatan.max' => 'Nama Kegiatan maximal 255 Karakter!',
                    'lokasi_kegiatan.required' => 'Mohon Isi Lokasi Kegiatan!',
                    'lokasi_kegiatan.min' => 'Lokasi Kegiatan minimum 4 Karakter!',
                    'lokasi_kegiatan.max' => 'Lokasi Kegiatan maximal 255 Karakter!',
                    'ruang_lingkup.required' => 'Mohon Ceklis Ruang Lingkup Kemitraan!',
                    'peruntukan.required' => 'Mohon Isi Peruntukan!',
                    'peruntukan.min' => 'Peruntukan minimum 7 Karakter!',
                    'peruntukan.max' => 'Peruntukan maximal 255 Karakter!',
               ]
          );
          $data = $request->all();
          $data['nominal'] = str_replace('.', '', $request->nominal);
          $ff = $data['nominal'];
          $data['nominal'] = str_replace(',00', '', $ff);
          $a = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
          if (empty($a)) {
               return redirect()->back()->with('error_message', 'Dana alokasi Cabang ini Kosong!')->withInput($request->all());
          }
          $aa = $a['dana_alokasi'];
          $b = $aa - $data['nominal'];
          if ($data['nominal'] > $a->dana_alokasi) {
               return redirect()->back()->with('error_message', 'Nominal harus kurang dari dana alokasi unit cabang!')->withInput($request->all());
          } else {
               $data['ruang_lingkup'] = implode(",", $request->ruang_lingkup);
               $data['status'] = "NEW";
               $data['nominal'] = str_replace('.', '', $request->nominal);
               $a = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
               $a->update(['dana_alokasi' => $b]);
               $pendaftar = Permohonan::create($data);
               return redirect()->route('pemohon.index')
                    ->with('success_message', 'Berhasil menambah Data Permohonan baru!');
          }
     }
     public function proses_validasi($id)
     {

          $rows = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $rows->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $rows->id_unit_master], ["tahun", date('Y')]])->first();
          $thn = Permohonan::where([['id_unit_master', $rows->id_unit_master], ['status', "SELESAI"]])->whereYear('created_at', '2022')->get();
          $c = Permohonan::where('id_master', $rows->id_master)->first();
          $tot =  $thn->sum('nominal');
          $row = Unit::all();
          return view('pemohon.proses_validasi', ['rows' => $rows, 'thn' => $thn, 'tot' => $tot, 'row' => $row, 'c' => $c, 'unit' => $unit, 'dalok' => $dalok]);
     }
     public function proses_bapi($id)
     {
          $rows = Permohonan::findOrFail($id);
          $a = Permohonan::where('id_master', $rows->id_master)->first();
          $row = Unit::all();
          return view('pemohon.proses_bapi', [
               'rows' => $rows, 'row' => $row, 'a' => $a
          ]);
     }
     public function valid(Request $request)
     {
          $validator = Validator::make($request->all(), [
               'check_judul' => 'required',
               'check_jumlah' => 'required',
               'check_norek' => 'required',
               'check_data_diri' => 'required',
               'sasaran_prog' => 'required|min:5',
               'tujuan_prog' => 'required|min:5',
               'kesimpulan[]' => 'min|2',
               'nama' => 'required|min:5|max:150',
               'jabatan' => 'required|max:75',
               'alamat' => 'required|min:7',
               'nama_bank' => 'required|min:2|max:150',
               'jabatan_bank' => 'required|min:2|max:90',
               'alamat_bank' => 'required|min:7',
               'id_bapi_unit' => 'required',
               'jenis_bantuan' => 'required',
               'saksi' => 'required',
          ], [
               'check_judul.required' => 'Mohon Ceklis Nama/Judul Program Kemitraan!',
               'check_norek.required' => 'Mohon Ceklis Nomor Rekening!',
               'check_jumlah.required' => 'Mohon Ceklis Jumlah Permohonan!',
               'check_data_diri.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'sasaran_prog.required' => 'Mohon Isi Sasaran Progam Kemitraan!',
               'tujuan_prog.required' => 'Mohon Isi Tujuan Program Kemitraan!',
               'kesimpulan[].min' => 'Form Kesimpulan Minimal 2 Karakter!',
               'nama.required' => 'Mohon Isi Nama Penerima Manfaat',
               'nama.min' => 'Nama Penerima Manfaat minimal 5 Karakter!',
               'nama.max' => 'Nama Penerima Manfaat maximal 150 Karakter!',
               'jabatan.required' => 'Mohon Isi Jabatan Penerima Manfaat!',
               'jabatan.max' => 'Jabatan Penerima Manfaat maximal 75 Karakter!',
               'alamat.required' => 'Mohon Isi Alamat Penerima Manfaat!',
               'alamat.min' => 'Alamat Penerima Manfaat minimal 7 Karakter!',
               'nama_bank.required' => 'Mohon Isi Nama Bank Sumut Terkait',
               'nama_bank.min' => 'Nama Bank Sumut Terkait minimal 5 Karakter!',
               'nama_bank.max' => 'Nama Bank Sumut Terkait maximal 150 Karakter!',
               'jabatan_bank.required' => 'Mohon Isi Jabatan Bank Sumut Terkait!',
               'jabatan_bank.max' => 'Jabatan Bank Sumut Terkait maximal 75 Karakter!',
               'alamat_bank.required' => 'Mohon Isi Alamat Bank Sumut Terkait!',
               'alamat_bank.min' => 'Alamat Bank Sumut Terkait minimal 7 Karakter!',
               'id_bapi_unit.required' => 'Mohon Pilih Cabang!',
               'jenis_bantuan.required' => 'Mohon Pilih Jenis Bantuan!',
               'saksi.required' => 'Mohon Isi Saksi!',
          ]);
          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());
          }
          $valid = Validasi::create([
               'check_judul' => $request->check_judul ? 'Ya' : 'No',
               'check_jumlah' => $request->check_jumlah ? 'Ya' : 'No',
               'check_norek' => $request->check_norek ? 'Ya' : 'No',
               'check_data_diri' => implode(",", $request->check_data_diri) ? implode(",", $request->check_data_diri)  : implode(",", ['No', 'No']),
               'sasaran_prog' => $request->sasaran_prog,
               'prop_rencana' => implode(",", $request->prop_rencana) ? implode(",", $request->prop_rencana)  : implode(",", ['No', 'No']),
               'surat_pernyataan' => implode(",", $request->surat_pernyataan) ? implode(",", $request->surat_pernyataan)  : implode(",", ['No', 'No']),
               'surat_permohonan' => implode(",", $request->surat_permohonan) ? implode(",", $request->surat_permohonan)  : implode(",", ['No', 'No']),
               'surat_ket' => implode(",", $request->surat_ket) ? implode(",", $request->surat_ket)  : implode(",", ['No', 'No']),
               'tujuan_prog' => $request->tujuan_prog,
               'id_val_master' => $request->id_val_master,
               'kesimpulan' => implode(",", $request->kesimpulan),
          ]);
          $bapi = Bapi::create([
               'nama' => $request->nama,
               'jabatan' => $request->jabatan,
               'alamat' => $request->alamat,
               'nama_bank' => $request->nama_bank,
               'jabatan_bank' => $request->jabatan_bank,
               'alamat_bank' => $request->alamat_bank,
               'id_bapi_unit' => $request->id_bapi_unit,
               'jenis_bantuan' => $request->jenis_bantuan,
               'id_val_master' => $request->id_val_master,
               'saksi' => implode(',', $request->saksi),
          ]);
          $row = Permohonan::findOrFail($request->id_val_master);
          $row->update([
               'status' => 'DOKUMENTASI'
          ]);
          return Redirect::to("http://127.0.0.1:8000/proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil Input Form Evaluasi!');
     }
     public function bapi(Request $request)
     {
          $data = $request->all();
          $data['saksi'] = implode(",", $request->saksi);
          $bapi = Bapi::create($data);
          $rows = Permohonan::where('id_master', $data['id_val_master'])->first();
          $rows->update(['status' => 'BA & PI']);
          return Redirect::to("http://127.0.0.1:8000/proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil Input Form Evaluasi!');
     }

     public function upload_validasi(Request $request, $id)
     {
          $row = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $row->id_master)->first();

          if ($request->file('evaluasi_file')) {
               $file = $request->file('evaluasi_file');
               $filename = $file->getClientOriginalName();
               $evaluasi_file = $request->file('evaluasi_file')->store('evaluasi_file');
               $a = $evaluasi_file;
          }
          $rows->update(['file_val' => $a]);
          return redirect()->back()->with('success_message', 'Berhasil Upload File Evaluasi!');
     }
     public function upload_bapi(Request $request, $id)
     {
          $row = Permohonan::findOrFail($id);
          $rows = Bapi::where('id_val_master', $row->id_master)->first();
          if ($request->file('file_bapi')) {
               $file = $request->file('file_bapi');
               $filename = $file->getClientOriginalName();
               $bapi_file = $request->file('file_bapi')->store('file_bapi');
               $a = $bapi_file;
          }
          $rows->update(['file_ba' => $a]);
          return redirect()->back()->with('success_message', 'Berhasil Upload File BA & PI!');
     }
     public function edit_evaluasi($id)
     {

          $rows1 = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $rows1->id_unit_master], ["tahun", date('Y')]])->first();

          $row = Unit::all();
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $c = Permohonan::where('id_master', $rows1->id_master)->first();
          $bapi = Bapi::where('id_val_master', $id)->first();
          $bapi['saksi'] = explode(",", $bapi->saksi);

          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);

          $thn = Permohonan::where([['id_unit_master', $rows1->id_unit_master], ['status', "SELESAI"]])->whereYear('created_at', '2022')->get();
          $tot =  $thn->sum('nominal');

          return view('pemohon.edit_evaluasi', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn, 'unit' => $unit, 'tot' => $tot, 'c' => $c, 'bapi' => $bapi, 'dalok' => $dalok, 'row' => $row]);
     }
     public function edit_bapi($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Bapi::where('id_val_master', $id)->first();
          $row = Unit::all();
          $rows['saksi'] = explode(",", $rows->saksi);
          return view('pemohon.edit_bapi', ['rows' => $rows, 'row' => $row]);
     }
     public function edit($id)
     {
          $rows = Permohonan::findOrFail($id);
          $rows1 = Unit::where('id_unit', $rows->id_unit_master)->first();
          $wilayah = Wilayah::where('id_wilayah', $rows->id_wilayah)->first();
          $row = Unit::all();
          $wilayah_all = Wilayah::all();
          $rows['ruang_lingkup'] = explode(",", $rows->ruang_lingkup);
          return view('pemohon.edit', ['rows' => $rows, 'row' => $row, 'rows1' => $rows1, 'wilayah' => $wilayah, 'wilayah_all' => $wilayah_all]);
     }
     public function update_pemohon(Request $request, $id)
     {
          $request->validate(
               [
                    'id_unit_master' => 'required',
                    'no_surat_edoc' => 'bail|required',
                    'nama_kegiatan' => 'required|min:4|max:220',
                    'lokasi_kegiatan' => 'required|min:4|max:255',
                    'ruang_lingkup' => 'required',
                    'nominal' => 'required',
                    'peruntukan' => 'required|min:7|max:255'
               ],
               [
                    'id_unit_master.required' => 'Mohon Pilih Unit Kantor!',
                    'no_surat_edoc.required' => 'Mohon Isi Nomor Surat!',
                    'nama_kegiatan.required' => 'Mohon isi Nama Kegiatan!',
                    'nama_kegiatan.min' => 'Nama Kegiatan minimum 4 Karakter!',
                    'nama_kegiatan.max' => 'Nama Kegiatan maximal 255 Karakter!',
                    'lokasi_kegiatan.required' => 'Mohon Isi Lokasi Kegiatan!',
                    'lokasi_kegiatan.min' => 'Lokasi Kegiatan minimum 4 Karakter!',
                    'lokasi_kegiatan.max' => 'Lokasi Kegiatan maximal 255 Karakter!',
                    'ruang_lingkup.required' => 'Mohon Ceklis Ruang Lingkup Kemitraan!',
                    'peruntukan.required' => 'Mohon Isi Peruntukan!',
                    'peruntukan.min' => 'Peruntukan minimum 7 Karakter!',
                    'peruntukan.max' => 'Peruntukan maximal 255 Karakter!',
               ]
          );
          $data = $request->all();
          $rows = Permohonan::findOrFail($id);
          $data['ruang_lingkup'] = implode(",", $request->ruang_lingkup);
          $data['nominal'] = str_replace('.', '', $request->nominal);
          $dalok = Dalok::where([["id_unit", $request->id_unit_master], ["tahun", date('Y')]])->first();
          if (empty($dalok)) {
               return redirect()->back()->with('error_message', 'Dana alokasi Cabang ini Kosong!')->withInput($request->all());
          }
          $tot = $rows->nominal + $dalok->dana_alokasi;
          $total = $tot - $data['nominal'];
          $dalok->update(['dana_alokasi' => $total]);
          $rows->update($data);
          return redirect('pemohon')->with('success_message', 'Berhasil Edit Permohonan!');
     }
     public function update(Request $request)
     {


          $valid = Validasi::where('id_val_master', $request->id_val_master)->first();
          $bapi = Bapi::where('id_val_master', $request->id_val_master)->first();
          $validator = Validator::make($request->all(), [
               'check_judul' => 'required',
               'check_jumlah' => 'required',
               'check_data_diri' => 'required',
               'sasaran_prog' => 'required|min:5',
               'tujuan_prog' => 'required|min:5',
               'kesimpulan[2]' => 'min|2',
               'nama' => 'required|min:5|max:150',
               'jabatan' => 'required|max:75',
               'alamat' => 'required|min:7',
               'nama_bank' => 'required|min:2|max:150',
               'jabatan_bank' => 'required|min:2|max:90',
               'alamat_bank' => 'required|min:7',
               'id_bapi_unit' => 'required',
               'jenis_bantuan' => 'required',
               'saksi' => 'required',
          ], [
               'check_judul.required' => 'Mohon Ceklis Nama/Judul Program Kemitraan!',
               'check_jumlah.required' => 'Mohon Ceklis Jumlah Permohonan!',
               'check_data_diri.required' => 'Mohon Ceklis Ketersediaan Identitas Diri!',
               'sasaran_prog.required' => 'Mohon Isi Sasaran Progam Kemitraan!',
               'tujuan_prog.required' => 'Mohon Isi Tujuan Program Kemitraan!',
               'kesimpulan[2].min' => 'Mohon Isi Kesimpulan!',
               'nama.required' => 'Mohon Isi Nama Penerima Manfaat',
               'nama.min' => 'Nama Penerima Manfaat minimal 5 Karakter!',
               'nama.max' => 'Nama Penerima Manfaat maximal 150 Karakter!',
               'jabatan.required' => 'Mohon Isi Jabatan Penerima Manfaat!',
               'jabatan.max' => 'Jabatan Penerima Manfaat maximal 75 Karakter!',
               'alamat.required' => 'Mohon Isi Alamat Penerima Manfaat!',
               'alamat.min' => 'Alamat Penerima Manfaat minimal 7 Karakter!',
               'nama_bank.required' => 'Mohon Isi Nama Bank Sumut Terkait',
               'nama_bank.min' => 'Nama Bank Sumut Terkait minimal 5 Karakter!',
               'nama_bank.max' => 'Nama Bank Sumut Terkait maximal 150 Karakter!',
               'jabatan_bank.required' => 'Mohon Isi Jabatan Bank Sumut Terkait!',
               'jabatan_bank.max' => 'Jabatan Bank Sumut Terkait maximal 75 Karakter!',
               'alamat_bank.required' => 'Mohon Isi Alamat Bank Sumut Terkait!',
               'alamat_bank.min' => 'Alamat Bank Sumut Terkait minimal 7 Karakter!',
               'id_bapi_unit.required' => 'Mohon Pilih Cabang!',
               'jenis_bantuan.required' => 'Mohon Pilih Jenis Bantuan!',
               'saksi.required' => 'Mohon Isi Saksi!',
          ]);
          if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput($request->all());
          }


          $valid->update([

               'check_judul' => $request->check_judul ? 'Ya' : 'No',
               'check_jumlah' => $request->check_jumlah ? 'Ya' : 'No',
               'check_norek' => $request->check_norek ? 'Ya' : 'No',
               'check_data_diri' => implode(",", $request->check_data_diri) ? implode(",", $request->check_data_diri)  : implode(",", ['No', 'No']),
               'sasaran_prog' => $request->sasaran_prog,
               'prop_rencana' => implode(",", $request->prop_rencana) ? implode(",", $request->prop_rencana)  : implode(",", ['No', 'No']),
               'surat_pernyataan' => implode(",", $request->surat_pernyataan) ? implode(",", $request->surat_pernyataan)  : implode(",", ['No', 'No']),
               'surat_permohonan' => implode(",", $request->surat_permohonan) ? implode(",", $request->surat_permohonan)  : implode(",", ['No', 'No']),
               'surat_ket' => implode(",", $request->surat_ket) ? implode(",", $request->surat_ket)  : implode(",", ['No', 'No']),
               'tujuan_prog' => $request->tujuan_prog,
               'id_val_master' => $request->id_val_master,
               'kesimpulan' => implode(",", $request->kesimpulan),
          ]);

          $bapi->update([

               'nama' => $request->nama,
               'jabatan' => $request->jabatan,
               'alamat' => $request->alamat,
               'nama_bank' => $request->nama_bank,
               'jabatan_bank' => $request->jabatan_bank,
               'alamat_bank' => $request->alamat_bank,
               'id_bapi_unit' => $request->id_bapi_unit,
               'jenis_bantuan' => $request->jenis_bantuan,
               'id_val_master' => $request->id_val_master,
               'saksi' => implode(',', $request->saksi),

          ]);

          return Redirect::to("http://127.0.0.1:8000/proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil edit Evaluasi!');
     }

     public function update_bapi(Request $request)
     {
          $data = $request->all();
          $data['saksi'] = implode(",", $request->saksi);
          $up = Bapi::where('id_val_master', $request->id_val_master)->first();
          $up->update($data);
          return Redirect::to("http://127.0.0.1:8000/proses/" . $request->id_val_master . "/proses")->with('success_message', 'Berhasil edit Pakta Integitas!');
     }

     public function destroy($id)
     {
          $row = Permohonan::findOrFail($id);
          $row->delete();
          return redirect('pemohon')->with('success_message', 'Berhasil Hapus Permohonan!');
     }


     public function cetak($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $unit = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $dalok = Dalok::where([["id_unit", $rows1->id_unit_master], ["tahun", date('Y')]])->first();
          $thn = Permohonan::where([['id_unit_master', $rows1->id_unit_master], ['status', "SELESAI"]])->whereYear('created_at', '2022')->get();
          $tot =  $thn->sum('nominal');
          if ($rows1->nominal < 50000000) {
               $pdf = PDF::loadview('pemohon.validasi_pdf', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn, 'unit' => $unit, 'dalok' => $dalok, 'tot' => $tot]);
               $content = $pdf->download()->getOriginalContent();
               $storePath = '' . $unit->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Kelengkapan Usulan' . '.pdf';
               Storage::put($storePath, $content);
               return $pdf->stream();
               // return $pdf->download('Evaluasi.pdf');
          } elseif ($rows1->nominal < 100000000) {
               $pdf = PDF::loadview('pemohon.validasi50-100_pdf', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn, 'unit' => $unit, 'dalok' => $dalok, 'tot' => $tot]);
               $content = $pdf->download()->getOriginalContent();
               $storePath = '' . $unit->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Kelengkapan Usulan' . '.pdf';
               Storage::put($storePath, $content);
               return $pdf->stream();
               // return $pdf->download('Evaluasi.pdf');
          } else {
               $pdf = PDF::loadview('pemohon.validasi100_pdf', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn, 'unit' => $unit, 'dalok' => $dalok, 'tot' => $tot]);
               $content = $pdf->download()->getOriginalContent();
               $storePath = '' . $unit->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Kelengkapan Usulan' . '.pdf';
               Storage::put($storePath, $content);
               return $pdf->download('Evaluasi.pdf');
               // return $pdf->stream();
          }
     }
     public function cetak_bapi($id)
     {
          $master = Permohonan::findOrFail($id);
          $validasi = Validasi::where('id_val_master', $id)->first();
          $unit = Unit::where('id_unit', $master->id_unit_master)->first();
          $bapi = Bapi::where('id_val_master', $id)->first();
          $validasi['prop_rencana'] = explode(",", $validasi->prop_rencana);
          $validasi['check_data_diri'] = explode(",", $validasi->check_data_diri);
          $validasi['surat_pernyataan'] = explode(",", $validasi->surat_pernyataan);
          $validasi['surat_permohonan'] = explode(",", $validasi->surat_permohonan);
          $validasi['surat_ket'] = explode(",", $validasi->surat_ket);
          $validasi['kesimpulan'] = explode(",", $validasi->kesimpulan);
          $bapi['saksi'] = explode(",", $bapi->saksi);
          $wilayah = Wilayah::where('id_wilayah', $master->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $master->id_unit_master)->whereYear('updated_at', '2022')->get();
          if ($bapi->jenis_bantuan == 'barang') {
               $pdf = PDF::loadview('pemohon.bapibarang_pdf', ['master' => $master, 'validasi' => $validasi, 'unit' => $unit, 'bapi' => $bapi]);
               $content = $pdf->download()->getOriginalContent();
               $storePath = '' . $unit->pemda . '/' . $master->nama_kegiatan . $master->id_master . '/' . 'Backup File PDF' . '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               Storage::put($storePath, $content);
               // return $pdf->download('Berita Acara & Pakta Integritas.pdf');
               return $pdf->stream();
          } else {
               $pdf = PDF::loadview('pemohon.bapi_pdf', ['master' => $master, 'validasi' => $validasi, 'unit' => $unit, 'bapi' => $bapi]);
               $content = $pdf->download()->getOriginalContent();
               $storePath = '' . $unit->pemda . '/' . $master->nama_kegiatan . $master->id_master . '/' . 'Backup File PDF' . '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               Storage::put($storePath, $content);
               // return $pdf->download('Berita Acara & Pakta Integritas.pdf');
               return $pdf->stream();
          }
     }

     public function cetak_sk($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $wilayah = Wilayah::where('id_wilayah', $rows1->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $rows1->id_unit_master)->whereYear('updated_at', '2022')->get();

          $pdf = PDF::loadview('pemohon.surat_keputusan_pdf', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn, 'wilayah' => $wilayah]);
          $content = $pdf->download()->getOriginalContent();
          $storePath = '' . $rows2->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Surat Keputusan' . '.pdf';
          Storage::put($storePath, $content);
          // return $pdf->download('Surat Keputusan Diterima.pdf');
          return $pdf->stream();
     }

     public function cetak_skr($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $wilayah = Wilayah::where('id_wilayah', $rows1->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $rows1->id_unit_master)->whereYear('updated_at', '2022')->get();

          $pdf = PDF::loadview('pemohon.surat_keputusan_ditolak', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn, 'wilayah' => $wilayah]);
          $content = $pdf->download()->getOriginalContent();
          $storePath = '' . $rows2->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Surat Keputusan_Ditolak' . '.pdf';
          Storage::put($storePath, $content);
          // return $pdf->download('Surat Keputusan Ditolak.pdf');
          return $pdf->stream();
     }


     public function cetak_k($id)
     {
          $rows1 = Permohonan::findOrFail($id);
          $rows = Validasi::where('id_val_master', $id)->first();
          $rows2 = Unit::where('id_unit', $rows1->id_unit_master)->first();
          $rows['prop_rencana'] = explode(",", $rows->prop_rencana);
          $rows['check_data_diri'] = explode(",", $rows->check_data_diri);
          $rows['surat_pernyataan'] = explode(",", $rows->surat_pernyataan);
          $rows['surat_permohonan'] = explode(",", $rows->surat_permohonan);
          $rows['surat_ket'] = explode(",", $rows->surat_ket);
          $rows['kesimpulan'] = explode(",", $rows->kesimpulan);
          $wilayah = Wilayah::where('id_wilayah', $rows1->id_wilayah)->first();
          $thn = Permohonan::where('id_unit_master', $rows1->id_unit_master)->whereYear('updated_at', '2022')->get();

          $pdf = PDF::loadview('pemohon.kwitansi', ['rows' => $rows, 'rows1' => $rows1, 'rows2' => $rows2, 'thn' => $thn]);
          $content = $pdf->download()->getOriginalContent();
          $storePath = '' . $rows2->pemda . '/' . $rows1->nama_kegiatan . $rows1->id_master . '/' . 'Backup File PDF' . '/' . 'Kwitansi' . '.pdf';
          Storage::put($storePath, $content);
          // return $pdf->download('Kwitansi.pdf');
          return $pdf->stream();
     }

     public function upload_file(Request $request, $id)
     {
          $row = Permohonan::findOrFail($id);
          $unit = Unit::where('id_unit', $row->id_unit_master)->first();
          if ($request->file('file_val')) {
               $file = $request->file('file_val');
               $filename = "anu_" . $file->getClientOriginalExtension();
               $storePath = '' . $unit->pemda . '/' . $row->nama_kegiatan . $row->id_master . '/' . 'Kelengkapan Usulan' . '.pdf';
               $a = Storage::put($storePath, file_get_contents($file));

               $file1 = $request->file('file_bapi');
               $filename1 = "anu_" . $file1->getClientOriginalExtension();
               $storePath1 = '' . $unit->pemda . '/' . $row->nama_kegiatan . $row->id_master . '/' . 'Berita Acara & Pakta Integritas' . '.pdf';
               $b = Storage::put($storePath1, file_get_contents($file1));


               $file2 = $request->file('file_sk');
               $filename2 = "anu_" . $file2->getClientOriginalExtension();
               $storePath2 = '' . $unit->pemda . '/' . $row->nama_kegiatan . $row->id_master . '/' . 'Surat Keputusan' . '.pdf';
               $c = Storage::put($storePath2, file_get_contents($file2));
          }

          $row->update([
               'file_val' => $storePath,
               'file_bapi' => $storePath1,
               'file_sk' => $storePath2,
               'status' => 'SELESAI'
          ]);
          return redirect()->back()->with('success_message', 'Berhasil Upload File Evaluasi!');
     }
}