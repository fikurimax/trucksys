@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    @if (isset($driver))
        {{ __('Ubah data Pengemudi') }}
    @else
        {{ __('Daftarkan Pengemudi') }}
    @endif
</h2>
@endsection

@section('css')
<style>
    #mediaFile {
        position: absolute;
        top: -1000px;
    }

    #profile {
        border-radius: 2%;
        width: 200px;
        height: 200px;
        margin: 0 auto;
        position: relative;
        cursor: pointer;
        background: #f4f4f4;
        display: table;
        background-size: cover;
        background-position: center center;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.35);
    }

    #profile .dashes {
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 2%;
        width: 100%;
        height: 100%;
        border: 4px dashed #ddd;
        opacity: 1;
    }

    #profile label {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        padding: 0 30px;
        color: grey;
        opacity: 1;
    }

    #profile.hasImage label {
        opacity: 0;
        pointer-events: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('driver.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($driver))
                <input type="hidden" name="id" id="driver-id" value="{{ $driver->id }}">
            @endif
            <div class="row mb-4">
                <div class="col-sm-6 col-md-11">
                    <b>BIODATA</b>
                </div>
                <div class="col-sm-6 col-md-1">
                    @if (!isset($driver))
                        <input type="text" placeholder="Reg" value="{{ ($last_id != null) ? $last_id + 1 : '1' }}" class="form-control" name="register_number" id="register_number" readonly>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div id="profile">
                                    <div class="dashes"></div>
                                    <label>Klik disini untuk mengunggah foto</label>
                                </div>
                                <input type="file" accept="image/*" name="profile" id="mediaFile">
                            </div>
                            <div class="col-sm-12 col-md-7" style="position: relative">
                                <div style="position: absolute; bottom: 0; left: 0;">
                                    <b>Upload foto pengemudi</b>
                                    <br>
                                    <small class="text-muted">Format file harus berupa gambar (.jpg, .jpeg, .png, .svg,
                                        dan .gif) <br> Maximal 2Mb</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">Nama Driver/Kondektur</label>
                        <input type="text" class="form-control" name="nama" id="driver_name"
                            value="{{ (isset($driver)) ? $driver->nama : old('nama') }}"
                            placeholder="Nama lengkap driver/kondektur" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_phone">Nomor Telepon/Handphone Driver</label>
                        <input type="text" class="form-control" name="nomor_telepon" id="driver_phone"
                            value="{{ (isset($driver)) ? $driver->nomor_telepon : old('nomor_telepon') }}"
                            placeholder="Nomor Telepon" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="registration_number">Nomor Registrasi <small>(Digenerate otomatis)</small></label>
                        <input type="text" class="form-control" name="nomor_registrasi" id="registration_number"
                            value="{{ (isset($driver)) ? $driver->nomor_registrasi : $last_registration_number }}"
                            placeholder="Nomor Registrasi" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="driver_address">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="driver_address"
                            value="{{ (isset($driver)) ? $driver->alamat : old('alamat') }}"
                            placeholder="Alamat pengemudi" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_date_of_birth">Tanggal Lahir</label>
                        <div class="input-group date" id="driver_date_of_birth" data-target-input="nearest">
                            <input type="text" name="tanggal_lahir" class="form-control datetimepicker-input"
                                value="{{ (isset($driver)) ? date('d/m/Y', strtotime($driver->tanggal_lahir)) : old('tanggal_lahir') }}"
                                data-target="#driver_date_of_birth" placeholder="Tanggal Lahir pengemudi" required>
                            <div class="input-group-append" data-target="#driver_date_of_birth"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="driver_place_of_birth">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir"
                            value="{{ (isset($driver)) ? $driver->tempat_lahir : old('tempat_lahir') }}"
                            id="driver_place_of_birth" placeholder="Tempat Lahir pengemudi" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col my-4">
                    <b>INFORMASI LEGALITAS PENGEMUDI</b>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="driver_identity_number">Nomor KTP</label>
                        <input type="text" class="form-control" name="no_ktp"
                            value="{{ (isset($driver)) ? $driver->no_ktp : old('no_ktp') }}"
                            id="driver_identity_number" placeholder="Nomor KTP" maxlength="16" minlength="16" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_license_number">Nomor SIM</label>
                        <input type="text" class="form-control" name="no_sim"
                            value="{{ (isset($driver)) ? $driver->no_sim : old('no_sim') }}"
                            id="driver_license_number" placeholder="Nomor SIM" maxlength="16" minlength="16" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_license_ttl">Masa berlaku SIM</label>
                        <div class="input-group date" id="driver_license_ttl" data-target-input="nearest">
                            <input type="text" name="masa_berlaku_sim" class="form-control datetimepicker-input"
                                value="{{ (isset($driver)) ? date('d/m/Y', strtotime($driver->masa_berlaku_sim)) : old('masa_berlaku_sim') }}"
                                data-target="#driver_license_ttl" placeholder="Masa Berlaku SIM" required>
                            <div class="input-group-append" data-target="#driver_license_ttl"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="driver_picture_id_card">Foto KTP*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="driver_picture_id_card"
                                    id="driver_picture_id_card" accept="image/*" @if (!isset($driver)) required @endif>
                                <label class="custom-file-label" id="driver_picture_id_card_desc" for="driver_picture_id_card">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                    <div class="form-group">
                        <label for="driver_license_picture">Foto SIM*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="driver_license_picture"
                                    id="driver_license_picture" accept="image/*" @if (!isset($driver)) required @endif>
                                <label class="custom-file-label" id="driver_license_picture_desc" for="driver_license_picture">Pilih file</label>
                            </div>
                        </div>
                        <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                            2Mb</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-10"></div>
                <div class="col-sm-12 col-md-2">
                    <a href="{{ route('driver.index') }}" class="btn btn-danger" role="button">Batal</a>
                    <button type="submit" id="submit-btn" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@section('plugins.TempusDominus', true)

@section('js')
<script>
    $(function () {
        $('#driver_date_of_birth').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#driver_license_ttl').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('#submit-btn').on('click', function (e) {
            if (!document.body.contains(document.getElementById('driver-id'))) {
                let profileState = $('#mediaFile').val();
                if (profileState == '') {
                    alert('Silakan uppload foto diri anda');
                    e.preventDefault();
                    return;
                }
            }
        });

        $('#profile').on('click', function (e) {
            $('#mediaFile').click();
        });

        $('#mediaFile').change(function (e) {

            var input = e.target;
            if (input.files && input.files[0]) {
                var file = input.files[0];

                var reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = function (e) {
                    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass(
                        'hasImage');
                }
            }
        });

        $('#driver_picture_id_card').change(function () {
            let input = this;
            let url = $(this).val();
            let filename = url.split("\\");

            $('#driver_picture_id_card_desc').text(filename[filename.length - 1]);
        });

        $('#driver_license_picture').change(function () {
            let input = this;
            let url = $(this).val();
            let filename = url.split("\\");

            $('#driver_license_picture_desc').text(filename[filename.length - 1]);
        });
    });

</script>
@endsection
