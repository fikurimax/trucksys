@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Detail akun') }}
</h2>
@endsection

@section('css')
<style>
    .photos-container {
        background-color: rgb(219, 219, 219);
        padding: 10px 10px;
        overflow-x: auto;
        border-radius: 4px;
    }

    .photo-rounded {
        border-radius: 8px;
    }

</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-11">
                    <b>INFORMASI PERUSAHAAN</b>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="vendor_company_name">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="vendor_company_name" value="{{ $account->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="vendor_email">Email Perusahaan</label>
                        <input type="text" class="form-control" id="vendor_email" value="{{ $account->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="vendor_phone">No. Telepon</label>
                        <input type="text" class="form-control" id="vendor_phone" value="{{ $account->phone_number }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="vendor_owner">Nama Pemilik</label>
                        <input type="text" class="form-control" id="vendor_owner" value="{{ $account->owner_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="vendor_npwp">NPWP</label>
                        <input type="text" class="form-control" id="vendor_npwp" value="{{ $account->npwp }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="vendor_address">Alamat Perusahaan</label>
                        <input type="text" class="form-control" id="vendor_address" value="{{ $account->address }}" disabled>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    @foreach ($account->documents as $document)
                        <div class="col-12">
                            <label>Foto {{ $document->description }}</label>
                            <br>
                            <a href="{{ asset('storage/vendors/'. \Str::kebab(strtolower($document->description)) . '/' . $document->filename) }}" 
                                target="_blank"
                                class="see-picture-container">
                                    <img src="{{ asset('storage/vendors/'. \Str::kebab(strtolower($document->description)) . '/'.$document->filename) }}" 
                                        alt="{{ $document->description }}"
                                        width="100" 
                                        height="100" 
                                        class="photo-rounded">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-12"></div>
                <div class="col-md-2 col-12">
                    <a href="{{ route('account.edit') }}" class="btn btn-info">Edit</a>
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
@endsection