@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Detail kendaraan') }}
</h2>
@endsection

@section('css')
<style>
    .photos-container {
        background-color: rgb(219, 219, 219);
        padding: 10px 10px;
        display: flex;
        gap: .2%;
        justify-content: center;
        overflow-x: auto;
        align-items: stretch;
        border-radius: 4px;
    }

    .photo-rounded {
        border-radius: 8px;
    }

</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <form action="{{ route('vehicle.delete', ['id' => $vehicle->id, 'vid' => $vendor->id]) }}" method="post">
                @csrf
                @method("DELETE")
                <a href="{{ route('vehicle.index', ['vid' => $vendor->id]) }}" class="btn btn-default"
                    role="button">Kembali</a>
                <a href="{{ route('vehicle.update', ['id' => $vehicle->id, 'vid' => $vendor->id]) }}"
                    class="btn btn-primary" role="button">Edit</a>
                <button type="submit" class="btn btn-danger" id="deleteVehicle">Hapus</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row photos-container">
            @foreach ($vehicle->photos as $photo)
            <div class="col">
                <a href="{{ asset('storage/trucks/'.$photo->filename) }}" 
                    class="photo-description"
                    target="_blank">
                    <img src="{{ asset('storage/trucks/'.$photo->filename) }}" alt="{{ $photo->description }}"
                        width="100" height="100" class="photo-rounded">
                    <br>
                    <span>{{ $photo->description }}</span>
                </a>
            </div>
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="vehicle_pmku">Nomor PMKU*</label>
                    <input type="string" class="form-control" name="nomor_pmku" value="{{ $vehicle->nomor_pmku }}"
                        id="vehicle_pmku" placeholder="C01234" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_npwp">Nomor NPWP*</label>
                    <input type="string" class="form-control" name="nomor_npwp" value="{{ $vehicle->nomor_npwp }}"
                        id="vehicle_npwp" placeholder="12345-678.90" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_plate_number">Nomor Polisi*</label>
                    <input type="string" class="form-control" name="nomor_polisi" value="{{ $vehicle->nomor_polisi }}"
                        id="vehicle_plate_number" placeholder="B 4212 TWM" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_owner_name">Nama Pemilik*</label>
                    <input type="string" class="form-control" name="nama_pemilik" value="{{ $vehicle->nama_pemilik }}"
                        id="vehicle_owner_name" placeholder="Nama Pemilik" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_vehicle_address">Alamat Pemilik*</label>
                    <input type="string" class="form-control" name="alamat_pemilik"
                        value="{{ $vehicle->alamat_pemilik }}" id="vehicle_vehicle_address" placeholder="Alamat Pemilik"
                        disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_kir_ttl">Masa Berlaku KIR*</label>
                    <div class="input-group date" id="vehicle_kir_ttl" data-target-input="nearest">
                        <input type="text" name="masa_berlaku_kir" value="{{ $vehicle->masa_berlaku_kir }}"
                            class="form-control datetimepicker-input" data-target="#vehicle_kir_ttl"
                            placeholder="Masa Berlaku KIR" disabled readonly>
                        <div class="input-group-append" data-target="#vehicle_kir_ttl" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicle_number_of_kir">Nomor KIR*</label>
                    <input type="string" class="form-control" name="nomor_kir" value="{{ $vehicle->nomor_kir }}"
                        id="vehicle_number_of_kir" placeholder="K81957192" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_head_of_kir">Kepala KIR*</label>
                    <input type="string" class="form-control" name="kepala_kir" value="{{ $vehicle->kepala_kir }}"
                        id="vehicle_head_of_kir" placeholder="Nama Kepala KIR" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_license_location_code">Kode Lokasi Pada STNK*</label>
                    <input type="string" class="form-control" name="kode_lokasi_pada_stnk"
                        value="{{ $vehicle->kode_lokasi_pada_stnk }}" id="vehicle_license_location_code"
                        placeholder="Kode Lokasi Pada STNK" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_tax_ttl">Masa Berlaku Pajak Kendaraan*</label>
                    <div class="input-group date" id="vehicle_tax_ttl" data-target-input="nearest">
                        <input type="text" name="masa_berlaku_pajak_kendaraan"
                            value="{{ $vehicle->masa_berlaku_pajak_kendaraan }}"
                            class="form-control datetimepicker-input" data-target="#vehicle_tax_ttl"
                            placeholder="Masa Berlaku Pajak Kendaraan" disabled readonly>
                        <div class="input-group-append" data-target="#vehicle_tax_ttl" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vehicle_structure_number">Nomor Rangka*</label>
                    <input type="string" class="form-control" name="nomor_rangka" value="{{ $vehicle->nomor_rangka }}"
                        id="vehicle_structure_number" placeholder="AB33432FSKJ9" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_machine_number">Nomor Mesin*</label>
                    <input type="string" class="form-control" name="nomor_mesin" value="{{ $vehicle->nomor_mesin }}"
                        id="vehicle_machine_number" placeholder="AB33432FSKJ9" disabled readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_tnkb_color">Warna TNKB*</label>
                    <input type="string" class="form-control" name="warna_tnkb" value="{{ $vehicle->warna_tnkb }}"
                        id="vehicle_tnkb_color" placeholder="PUTIH" disabled readonly>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="vehicle_brand">Merk*</label>
                    <input type="string" class="form-control" name="merk" value="{{ $vehicle->merk }}" disabled readonly
                        id="vehicle_brand" placeholder="HINO">
                </div>
                <div class="form-group">
                    <label for="vehicle_model">Model*</label>
                    <input type="string" class="form-control" name="model" value="{{ $vehicle->model }}" disabled readonly
                        id="vehicle_model" placeholder="Truk">
                </div>
                <div class="form-group">
                    <label for="vehicle_type">Tipe Kendaraan*</label>
                    <input type="string" class="form-control" name="tipe_kendaraan"
                        value="{{ $vehicle->tipe_kendaraan }}" disabled readonly id="vehicle_type" placeholder="ST150">
                </div>
                <div class="form-group">
                    <label for="vehicle_kind">Jenis Kendaraan*</label>
                    <input type="string" class="form-control" name="jenis_kendaraan"
                        value="{{ $vehicle->jenis_kendaraan }}" disabled readonly id="vehicle_kind" placeholder="ST150">
                </div>
                <div class="form-group">
                    <label for="vehicle_cylinder">Isi Silinder*</label>
                    <input type="string" class="form-control" name="isi_silinder" value="{{ $vehicle->isi_silinder }}"
                        disabled readonly id="vehicle_cylinder" placeholder="1493">
                </div>
                <div class="form-group">
                    <label for="vehicle_capacity">Kapasitas*</label>
                    <input type="string" class="form-control" name="kapasitas" value="{{ $vehicle->kapasitas }}"
                        disabled readonly id="vehicle_capacity" placeholder="7500">
                </div>
                <div class="form-group">
                    <label for="vehicle_year_made">Tahun Pembuatan*</label>
                    <select class="form-control" name="tahun_pembuatan" disabled readonly
                        id="vehicle_year_made">
                        <option value="{{ $vehicle->tahun_pembuatan }}" selected>{{ $vehicle->tahun_pembuatan }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vehicle_fuel_type">Bahan Bakar*</label>
                    <input type="string" class="form-control" name="bahan_bakar" value="{{ $vehicle->bahan_bakar }}"
                        disabled readonly id="vehicle_fuel_type" placeholder="BENSIN">
                </div>
                <div class="form-group">
                    <label for="vehicle_registered">Tahun Registrasi*</label>
                    <select class="form-control" name="tahun_registrasi"
                        disabled readonly id="vehicle_registered">
                        <option value="{{ $vehicle->tahun_registrasi }}">{{ $vehicle->tahun_registrasi }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    a.photo-description {
        text-decoration: none;
        color: black
    }
</style>
@endsection

@section('js')
<script>
    $(function () {
        $('#deleteVehicle').on('click', function (e) {
            if(!confirm('Apakah anda yakin ingin menghapus kendaraan ini?' )) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
