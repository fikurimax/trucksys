@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Update akun') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $account->id }}">
                <div class="row">
                    <x-form-validation-error error="{{ $errors }}" />
                </div>
                <div class="row">
                    <div class="col-6 col-md-11">
                        <b>INFORMASI PERUSAHAAN</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="vendor_company_name">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="name" id="vendor_company_name" value="{{ old('name', $account->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_email">Email</label>
                            <input type="text" class="form-control" name="email" id="vendor_email" value="{{ old('email', $account->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_phone">No. Telepon/Handphone</label>
                            <input type="text" class="form-control" name="phone_number" id="vendor_phone" value="{{ old('phone_number', $account->phone_number) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_owner">Nama Pemilik</label>
                            <input type="text" class="form-control" name="owner_name" id="vendor_owner" value="{{ old('owner_name', $account->owner_name) }}" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_npwp">NPWP</label>
                            <input type="text" class="form-control" name="npwp" id="vendor_npwp" value="{{ old('npwp', $account->npwp) }}" data-mask="" required>
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Alamat Perusahaan</label>
                            <input type="text" class="form-control" name="address" id="vendor_address" value="{{ old('address', $account->address) }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="document_siup">Foto SIUP*</label>
                            <div class="input-group">
                                <input type="hidden" id="document_siup_desc" name="descriptions[]" value="SIUP" disabled>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="documents[]"
                                        id="document_siup" accept="image/*" @if (!isset($account)) required @endif
                                        onchange="document.getElementById('document_siup_desc').removeAttribute('disabled'); previewName(this, 'document_siup_label')">
                                    <label class="custom-file-label" id="document_siup_label" for="document_siup">Pilih file</label>
                                </div>
                            </div>
                            <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                                2Mb</small>
                        </div>
                        <div class="form-group">
                            <label for="document_nib">Foto NIB*</label>
                            <div class="input-group">
                                <input type="hidden" id="document_nib_desc" name="descriptions[]" value="NIB" disabled>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="documents[]"
                                        id="document_nib" accept="image/*" @if (!isset($account)) required @endif
                                        onchange="document.getElementById('document_nib_desc').removeAttribute('disabled'); previewName(this, 'document_nib_label')">
                                    <label class="custom-file-label" id="document_nib_label" for="document_nib">Pilih file</label>
                                </div>
                            </div>
                            <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                                2Mb</small>
                        </div>
                        <div class="form-group">
                            <label for="document_legalitiy">Foto Lembar Pengesahan Urutan Pertama*</label>
                            <div class="input-group">
                                <input type="hidden" id="document_legalitiy_desc" name="descriptions[]" value="Lembar pengesahan urutan pertama" disabled>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="documents[]"
                                        id="document_legalitiy" accept="image/*" @if (!isset($account)) required @endif
                                        onchange="document.getElementById('document_legalitiy_desc').removeAttribute('disabled'); previewName(this, 'document_legalitiy_label')">
                                    <label class="custom-file-label" id="document_legalitiy_label" for="document_legalitiy">Pilih file</label>
                                </div>
                            </div>
                            <small>Format file harus berupa gambar (.jpg, .jpeg, .png, .svg, dan .gif) <br> Maximal
                                2Mb</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-12"></div>
                    <div class="col-md-2 col-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('plugins.InputMask', true)

@section('js')
<script src="{{ asset('js/lightbox.min.js') }}"></script>
<script>
    $(function() {
        $('[data-mask]').inputmask('99.999.999.9-999.999', {
            placeholder: '__.___.___._-___.___'
        });
    });

    function previewName(evt, labelId) {
        let url = $(evt).val();
        let filename = url.split("\\");

        $('#' + labelId).text(filename[filename.length - 1]);
    }
</script>
@endsection
