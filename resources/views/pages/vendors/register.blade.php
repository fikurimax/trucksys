@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Daftarkan Vendor') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('vendor.save') }}" method="post">
            @csrf
            @if (isset($vendor))
            <input type="hidden" name="id" value="{{ $vendor->id }}">
            @endif
            <div class="container">
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="row">
                    <div class="col-sm-6 col-md-11">
                        <b>INFORMASI PERUSAHAAN</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="vendor_company_name">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="nama_perusahaan" id="vendor_company_name"
                                value="{{ (isset($vendor)) ? $vendor->nama_perusahaan : old('nama_perusahaan') }}"
                                placeholder="Nama Perusahaan" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="vendor_npwp">NPWP</label>
                            <input type="text" class="form-control" id="vendor_npwp" name="npwp" 
                                value="{{ (isset($vendor)) ? $vendor->npwp : old('npwp') }}" data-mask=""
                                inputmode="text">
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Alamat Perusahaan</label>
                            <input type="text" class="form-control" name="alamat" id="vendor_address"
                                value="{{ (isset($vendor)) ? $vendor->alamat : old('alamat') }}"
                                placeholder="Alamat perusahaan" required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_contact">Kontak</label>
                            <input type="text" class="form-control" name="kontak" id="vendor_contact"
                                value="{{ (isset($vendor)) ? $vendor->kontak : old('kontak') }}"
                                placeholder="Kontak perusahaan" required maxlength="15" minlength="11">
                        </div>
                        <div class="form-group">
                            <label for="vendor_owner">Nama Pemilik</label>
                            <input type="text" class="form-control" name="nama_pemilik" id="vendor_owner"
                                value="{{ (isset($vendor)) ? $vendor->nama_pemilik : old('nama_pemilik') }}"
                                placeholder="Nama pemilik perusahaan" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-12"></div>
                    <div class="col-md-2 col-sm-12">
                        <a href="{{ route('vendor.index') }}" class="btn btn-danger" role="button">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

@section('plugins.InputMask', true)

@section('js')
<script>
    $(function() {
        $('[data-mask]').inputmask('99.999.999.9-999.999', {
            placeholder: '__.___.___._-___.___'
        });
    });
</script>
@endsection
