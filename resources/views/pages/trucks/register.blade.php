@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ (isset($vehicle)) ? __('Update Kendaraan ' . $vehicle['merk']) : __('Daftarkan Kendaraan') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <option>{{ $error }}</option>
            @endforeach
        @endif
        <form action="{{ route('vehicle.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_vendor" value="{{ $vendor->id }}">
            @if (isset($vehicle))
                <input type="hidden" name="id" value="{{ $vehicle->id }}" @if (!isset($vehicle)) disabled @endif>
            @endif
            <div class="row p-4">
                <div class="col-12">
                    <h5>
                        <b>Isi Data Kelengkapan Kendaraan</b>
                    </h5>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="vehicle_pmku">Nomor PMKU*</label>
                        <input type="text" class="form-control" name="nomor_pmku"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_pmku'] : old('nomor_pmku', '') }}"
                            id="vehicle_pmku" placeholder="C01234">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_npwp">Nomor NPWP*</label>
                        <input type="text" class="form-control" name="nomor_npwp"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_npwp'] : old('nomor_npwp', '') }}"
                            id="vehicle_npwp" placeholder="12345-678.90">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_plate_number">Nomor Polisi*</label>
                        <input type="text" class="form-control" name="nomor_polisi"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_polisi'] : old('nomor_polisi', '') }}"
                            id="vehicle_plate_number" placeholder="B 4212 TWM">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_brand">Merk*</label>
                        <input type="text" class="form-control" name="merk"
                            value="{{ (isset($vehicle)) ? $vehicle['merk'] : old('merk', '') }}" id="vehicle_brand"
                            placeholder="HINO">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_model">Model*</label>
                        <input type="text" class="form-control" name="model"
                            value="{{ (isset($vehicle)) ? $vehicle['model'] : old('model', '') }}" id="vehicle_model"
                            placeholder="Truk">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_type">Tipe Kendaraan*</label>
                        <input type="text" class="form-control" name="tipe_kendaraan"
                            value="{{ (isset($vehicle)) ? $vehicle['tipe_kendaraan'] : old('tipe_kendaraan', '') }}"
                            id="vehicle_type" placeholder="ST150">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_kind">Jenis Kendaraan*</label>
                        <input type="text" class="form-control" name="jenis_kendaraan"
                            value="{{ (isset($vehicle)) ? $vehicle['jenis_kendaraan'] : old('jenis_kendaraan', '') }}"
                            id="vehicle_kind" placeholder="ST150">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_cylinder">Isi Silinder*</label>
                        <input type="text" class="form-control" name="isi_silinder"
                            value="{{ (isset($vehicle)) ? $vehicle['isi_silinder'] : old('isi_silinder', '') }}"
                            id="vehicle_cylinder" placeholder="1493">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_capacity">Kapasitas*</label>
                        <input type="text" class="form-control" name="kapasitas"
                            value="{{ (isset($vehicle)) ? $vehicle['kapasitas'] : old('kapasitas', '') }}"
                            id="vehicle_capacity" placeholder="7500">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_year_made">Tahun Pembuatan*</label>
                        <select class="form-control" name="tahun_pembuatan"
                            id="vehicle_year_made">
                            @for ($i = date('Y'); $i >= 2000; $i--)
                            @if (old('tahun_pembuatan') == $i)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @elseif (isset($vehicle))
                                @if ($vehicle['tahun_pembuatan'] == $i)
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_structure_number">Nomor Rangka*</label>
                        <input type="text" class="form-control" name="nomor_rangka"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_rangka'] : old('nomor_rangka', '') }}"
                            id="vehicle_structure_number" placeholder="AB33432FSKJ9">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_machine_number">Nomor Mesin*</label>
                        <input type="text" class="form-control" name="nomor_mesin"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_mesin'] : old('nomor_mesin', '') }}"
                            id="vehicle_machine_number" placeholder="AB33432FSKJ9">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_tnkb_color">Warna TNKB*</label>
                        <input type="text" class="form-control" name="warna_tnkb"
                            value="{{ (isset($vehicle)) ? $vehicle['warna_tnkb'] : old('warna_tnkb', '') }}"
                            id="vehicle_tnkb_color" placeholder="PUTIH">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_fuel_type">Bahan Bakar*</label>
                        <input type="text" class="form-control" name="bahan_bakar"
                            value="{{ (isset($vehicle)) ? $vehicle['bahan_bakar'] : old('bahan_bakar', '') }}"
                            id="vehicle_fuel_type" placeholder="BENSIN">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_registered">Tahun Registrasi*</label>
                        <select class="form-control" name="tahun_registrasi"
                            value="{{ (isset($vehicle)) ? $vehicle['tahun_registrasi'] : old('tahun_registrasi', '') }}"
                            id="vehicle_registered">
                            @for ($i = date('Y'); $i >= 2000; $i--)
                            @if (old('tahun_registrasi') == $i)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @elseif (isset($vehicle))
                                @if ($vehicle['tahun_registrasi'] == $i)
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_owner_name">Nama Pemilik*</label>
                        <input type="text" class="form-control" name="nama_pemilik"
                            value="{{ (isset($vehicle)) ? $vehicle['nama_pemilik'] : old('nama_pemilik', '') }}"
                            id="vehicle_owner_name" placeholder="Nama Pemilik">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_vehicle_address">Alamat Pemilik*</label>
                        <input type="text" class="form-control" name="alamat_pemilik"
                            value="{{ (isset($vehicle)) ? $vehicle['alamat_pemilik'] : old('alamat_pemilik', '') }}"
                            id="vehicle_vehicle_address" placeholder="Alamat Pemilik">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="vehicle_license_number">Nomor STNK*</label>
                        <input type="text" class="form-control" name="nomor_stnk"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_stnk'] : old('nomor_stnk', '') }}"
                            id="vehicle_license_number" placeholder="Nomor STNK Pemilik">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_tax_ttl">Masa Berlaku Pajak Kendaraan* (Tgl/Bln/Tahun)</label>
                        <div class="input-group date" id="vehicle_tax_ttl" data-target-input="nearest">
                            <input type="text" name="masa_berlaku_pajak_kendaraan"
                                value="{{ (isset($vehicle)) ? date('d/m/Y', strtotime($vehicle['masa_berlaku_pajak_kendaraan'])) : old('masa_berlaku_pajak_kendaraan') }}"
                                class="form-control datetimepicker-input" data-target="#vehicle_tax_ttl"
                                placeholder="Masa Berlaku Pajak Kendaraan">
                            <div class="input-group-append" data-target="#vehicle_tax_ttl" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_license_location_code">Kode Lokasi Pada STNK*</label>
                        <input type="text" class="form-control" name="kode_lokasi_pada_stnk"
                            value="{{ (isset($vehicle)) ? $vehicle['kode_lokasi_pada_stnk'] : old('kode_lokasi_pada_stnk', '') }}"
                            id="vehicle_license_location_code" placeholder="Kode Lokasi Pada STNK">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_license_ttl">Masa Berlaku STNK* (Tgl/Bln/Tahun)</label>
                        <div class="input-group date" id="vehicle_license_ttl" data-target-input="nearest">
                            <input type="text" name="masa_berlaku_stnk"
                                value="{{ (isset($vehicle)) ? date('d/m/Y', strtotime($vehicle['masa_berlaku_stnk'])) : old('masa_berlaku_stnk') }}"
                                class="form-control datetimepicker-input" data-target="#vehicle_license_ttl"
                                placeholder="Masa Berlaku STNK">
                            <div class="input-group-append" data-target="#vehicle_license_ttl" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_head_of_kir">Kepala KIR*</label>
                        <input type="text" class="form-control" name="kepala_kir"
                            value="{{ (isset($vehicle)) ? $vehicle['kepala_kir'] : old('kepala_kir', '') }}"
                            id="vehicle_head_of_kir" placeholder="Nama Kepala KIR">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_number_of_kir">Nomor KIR*</label>
                        <input type="text" class="form-control" name="nomor_kir"
                            value="{{ (isset($vehicle)) ? $vehicle['nomor_kir'] : old('nomor_kir', '') }}"
                            id="vehicle_number_of_kir" placeholder="K81957192">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_kir_ttl">Masa Berlaku KIR* (Tgl/Bln/Tahun)</label>
                        <div class="input-group date" id="vehicle_kir_ttl" data-target-input="nearest">
                            <input type="text" name="masa_berlaku_kir"
                                value="{{ (isset($vehicle)) ? date('d/m/Y', strtotime($vehicle['masa_berlaku_kir'])) : old('masa_berlaku_kir') }}"
                                class="form-control datetimepicker-input" data-target="#vehicle_kir_ttl"
                                placeholder="Masa Berlaku KIR">
                            <div class="input-group-append" data-target="#vehicle_kir_ttl" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-4">
                <div class="col-12">
                    <h5>
                        <b>Upload Foto Kelengkapan Kendaraan</b>
                    </h5>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="vehicle_picture">Foto Kendaraan*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_picture_desc" name="descriptions[]" value="Foto truk" disabled>
                                <input type="file" class="custom-file-input" name="photos[]" id="vehicle_picture"
                                    accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_picture_label')">
                                <label id="vehicle_picture_label" class="custom-file-label" for="vehicle_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_stnk_picture">Foto STNK*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_stnk_picture_desc" name="descriptions[]" value="Foto STNK" disabled>
                                <input type="file" class="custom-file-input" name="photos[]" id="vehicle_stnk_picture"
                                    accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_stnk_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_stnk_picture_label')">
                                <label id="vehicle_stnk_picture_label" class="custom-file-label" for="vehicle_stnk_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_kir_picture">Foto KIR*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_kir_picture_desc" name="descriptions[]" value="Foto KIR" disabled>
                                <input type="file" class="custom-file-input" name="photos[]" id="vehicle_kir_picture"
                                    accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_kir_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_kir_picture_label')">
                                <label id="vehicle_kir_picture_label" class="custom-file-label" for="vehicle_kir_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_emergency_tool_picture">Foto Alat Tanggap Darurat Pada Kendaraan*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_emergency_tool_picture_desc" name="descriptions[]"
                                    value="Foto Alat Tanggap Darurat Pada Kendaraan" disabled>
                                <input type="file" class="custom-file-input" name="photos[]"
                                    id="vehicle_emergency_tool_picture" accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_emergency_tool_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_emergency_tool_picture_label')">
                                <label id="vehicle_emergency_tool_picture_label" class="custom-file-label" for="vehicle_emergency_tool_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="vehicle_bpkb_picture">Foto BPKB*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_bpkb_picture_desc" name="descriptions[]" value="Foto BPKB" disabled>
                                <input type="file" class="custom-file-input" name="photos[]" id="vehicle_bpkb_picture"
                                    accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_bpkb_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_bpkb_picture_label')">
                                <label id="vehicle_bpkb_picture_label" class="custom-file-label" for="vehicle_bpkb_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_bottom_shield_picture">Foto Perisai Kolong Bagian Belakang*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_bottom_shield_picture_desc" name="descriptions[]"
                                    value="Foto Perisai Kolong Bagian Belakang" disabled>
                                <input type="file" class="custom-file-input" name="photos[]"
                                    id="vehicle_bottom_shield_picture" accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_bottom_shield_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_bottom_shield_picture_label')">
                                <label id="vehicle_bottom_shield_picture_label" class="custom-file-label" for="vehicle_bottom_shield_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_firstaid_box_picture">Foto Kotak Obat*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_firstaid_box_picture_desc" name="descriptions[]"
                                    value="Foto Kotak Obat" disabled>
                                <input type="file" class="custom-file-input" name="photos[]"
                                    id="vehicle_firstaid_box_picture" accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_firstaid_box_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_firstaid_box_picture_label')">
                                <label id="vehicle_firstaid_box_picture_label" class="custom-file-label" for="vehicle_firstaid_box_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="vehicle_reflector_stiker_picture">Foto Stiker Reflektor Pada Bagian Depan
                            Kendaraan*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" id="vehicle_reflector_stiker_picture_desc" name="descriptions[]"
                                    value="Foto Stiker Reflektor Pada Bagian Depan Kendaraan" disabled>
                                <input type="file" class="custom-file-input" name="photos[]"
                                    id="vehicle_reflector_stiker_picture" accept="image/*" @if(!isset($vehicle)) required @endif
                                    onchange="document.getElementById('vehicle_reflector_stiker_picture_desc').removeAttribute('disabled'); previewName(this, 'vehicle_reflector_stiker_picture_label')">
                                <label id="vehicle_reflector_stiker_picture_label" class="custom-file-label" for="vehicle_reflector_stiker_picture">Pilih
                                    file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-9"></div>
                <div class="col-sm-12 col-md-3">
                    @if (!isset($vehicle))
                        <div class="row">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="add_another" value="{{ old('add_another') }}">
                                    <label class="form-check-label">Simpan dan tambah baru</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <a href="{{ route('vehicle.index', ['vid' => $vendor->id]) }}" class="col-5 btn btn-danger" role="button">Batal</a>
                        <div class="col-1"></div>
                        <button type="submit" class="col-5 btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@section('plugins.TempusDominus', true)
{{-- @section('plugins.InputMask', true) --}}

@section('js')
<script>
    $(function () {
        $('#vehicle_tax_ttl').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#vehicle_license_ttl').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        
        $('#vehicle_kir_ttl').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    });

    function previewName(evt, labelId) {
        let url = $(evt).val();
        let filename = url.split("\\");

        $('#' + labelId).text(filename[filename.length - 1]);
    }

</script>
@endsection
