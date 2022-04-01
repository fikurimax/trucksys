@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Daftarkan Pengemudi') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <form action="{{ route('driver.delete', ['id' => $driver->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <a href="{{ route('driver.index') }}" class="btn btn-light" role="button">
                    Kembali
                </a>
                <a href="{{ route('driver.update', ['id' => $driver->id]) }}" class="btn btn-info" role="button">
                    Edit
                </a>
                <button type="submit" id="deleteDriverButton" class="btn btn-danger">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="row mb-4">
                    <h5>Biodata</h5>
                </div>
                <div class="row">
                    <div class="col-4">
                        <a href="{{ asset('storage/drivers/' . $driver->photo) }}" data-lightbox="{{ $driver->photo }}" data-title="Foto diri {{ $driver->nama }}">
                            <img src="{{ asset('storage/drivers/' . $driver->photo) }}" 
                                alt="Foto profile" 
                                width="150" 
                                style="border-radius: 8px; box-shadow: 1px 1px 4px;">
                        </a>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input class="form-control" value="{{ $driver->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Driver ID</label>
                            <input class="form-control" value="{{ $driver->id }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" value="{{ $driver->alamat }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tgl Lahir</label>
                            <input class="form-control" value="{{ date('d-m-Y', strtotime($driver->tanggal_lahir)) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input class="form-control" value="{{ $driver->tempat_lahir }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="row mb-4">
                    <h5>Data Legalitas</h5>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>No. KTP</label>
                            <input class="form-control" value="{{ $driver->no_ktp }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>No. SIM</label>
                            <input class="form-control" value="{{ $driver->no_sim }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Masa berlaku SIM</label>
                            <input class="form-control" value="{{ date('d-m-Y', strtotime($driver->masa_berlaku_sim)) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Foto KTP</label>
                            <br>
                            <a href="{{ asset('storage/drivers/idcard/' . $driver->photo_ktp) }}" class="see-picture-container"
                                data-lightbox="{{ $driver->photo_ktp }}" data-title="Foto KTP {{ $driver->nama }}">
                                Lihat foto
                            </a>
                        </div>
                        <div class="form-group">
                            <label>Foto SIM</label>
                            <br>
                            <a href="{{ asset('storage/drivers/driver_licenses/' . $driver->photo_sim) }}" 
                                data-lightbox="{{ $driver->photo_sim }}" data-title="Foto SIM {{ $driver->nama }}" class="see-picture-container">
                                Lihat foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
    <style>
        .see-picture-container {
            width: 100%;
            padding: 10px 5px;
            background-color: aliceblue;
            text-decoration: none;
        }
    </style>
@endsection

@section('js')
<script src="{{ asset('js/lightbox.min.js') }}"></script>
<script>
    $(function () {
        $('#deleteDriverButton').on('click', function (e) {
            if(!confirm('Apakah anda yakin ingin menghapus driver {{ $driver->nama }}' )) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
