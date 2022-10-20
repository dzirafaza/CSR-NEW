@extends('adminlte::page')

@section('title', 'Edit Data Permohonan')

@section('content_header')
<h1 class="m-0 text-dark">Edit Data Permohonan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- END OPEN DIV -->

                <form action="{{ url('update_pemohon/' . $rows->id_master.'/update_pemohon') }}" method="post"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tr>
                                <td><b><label for="exampleInputName">Nomor Surat E-Doc</label></b></td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control @error('no_surat_edoc') is-invalid @enderror"
                                            id="exampleInputName" placeholder="Nomor Surat Edoc" name="no_surat_edoc"
                                            value="{{$rows->no_surat_edoc}}" required>
                                        @error('no_surat_edoc') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                            </tr>

                            <tr>
                                <td><b><label for="exampleInputName">Unit Kantor</label></b></td>
                                <td>:</td>
                                <td>
                                    <select class="form-control select2" style="width: 100%;"
                                        aria-label="Default select example" id="unit" name="id_unit_master">
                                        <option value="{{$rows1->id_unit}}"> {{$rows1->nama_unit}}</option>>
                                        @foreach ($row as $d)
                                        <option value="{{  $d->id_unit }}">{{ $d->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Alokasi / PEMKO</b></td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" value="" id="pemda" readonly>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" value="Rp.0,-" id="alokasi" readonly>
                                </td>
                            </tr>
                </form>
                <tr>
                    <td><b>Nama Kegiatan</b></td>
                    <td>:</td>
                    <td>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="Nama Kegiatan" name="nama_kegiatan"
                            value="{{$rows->nama_kegiatan}}" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Lokasi Kegiatan</b></td>
                    <td>:</td>
                    <td>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="Lokasi Kegiatan" name="lokasi_kegiatan"
                            value="{{$rows->lokasi_kegiatan}}" required>
                    </td>
                </tr>
                <tr>
                    <td><b>Nominal</b></td>
                    <td>:</td>
                    <td>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                placeholder="Nominal" aria-label="Username" aria-describedby="basic-addon1" id="nominal"
                                name="nominal" value="{{$rows->nominal}}" required>
                        </div>
                        @error('nominal')
                        <span class="text-danger">{{'awdww'}}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><b>Ruang Lingkup Program Kemitraan</b></td>
                    <td>:</td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Ekonomi"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Ekonomi' ? 'checked' : ''}}
                                    {{$rows->ruang_lingkup[0] == 'Ekonomi' ? 'checked' : ''}}> Ekonomi
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Pendidikan"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Pendidikan' ? 'checked' : ''}}> Pendidikan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Sosial"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Sosial' ? 'checked' : ''}}> Sosial
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="checkbox" value="Lingkungan"
                                    aria-label="Checkbox for following text input" name="ruang_lingkup[]"
                                    {{$rows->ruang_lingkup[0] == 'Lingkungan' ? 'checked' : ''}}> Lingkungan
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Peruntukan</b></td>
                    <td>:</td>
                    <td>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="Peruntukan" name="peruntukan"
                            value="{{ $rows->peruntukan }}" required>
                    </td>
                </tr>

                <tr>
                    <td> </td>
                    <td></td>

                    <td>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </td>
                </tr>
                </table>
                </form>


                <!-- CLOSE DIV -->
            </div>
        </div>
    </div>
</div>
@stop

@push('js')

<script src="/jquery/src/jquery.mask.js"></script>
<script src="/vendor/moment/moment.min.js"></script>
<script>
$(document).ready(function() {
    $('#nominal').mask('000.000.000.000.000.000', {
        reverse: true
    });
    $('.select2').select2();
    var unitID = $(this).find(":selected").val();
    if (unitID != null) {
        $.ajax({
            type: 'GET',
            url: '/getAlok',
            data: {
                unitID: unitID
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res);
                if (res) {
                    // alert(res);
                    $('#pemda').val(res[1]);
                    $('#alokasi').val(res[0]);
                } else {
                    $("#alokasi").empty();
                    $("#pemda").empty();
                }
            }
        });
    }
});
$('#unit').change(function() {

    var unitID = $(this).find(":selected").val();
    if (unitID != null) {
        $.ajax({
            type: 'GET',
            url: '/getAlok',
            data: {
                unitID: unitID
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res);
                if (res) {
                    // alert(res);
                    $('#pemda').val(res[1]);
                    $('#alokasi').val(res[0]);
                } else {
                    $("#alokasi").empty();
                    $("#pemda").empty();
                }
            }
        });
    }
});
</script>
@endpush