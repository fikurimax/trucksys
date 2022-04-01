<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTruckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'numeric',
            'id_vendor' => 'required|numeric',
            'nomor_pmku' => 'required',
            'nomor_npwp' => 'required',
            'nomor_polisi' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'tipe_kendaraan' => 'required',
            'jenis_kendaraan' => 'required',
            'isi_silinder' => 'required',
            'kapasitas' => 'required',
            'tahun_pembuatan' => 'required|numeric',
            'nomor_rangka' => 'required',
            'nomor_mesin' => 'required',
            'warna_tnkb' => 'required',
            'bahan_bakar' => 'required',
            'tahun_registrasi' => 'required',
            'nama_pemilik' => 'required',
            'alamat_pemilik' => 'required',
            'nomor_stnk' => 'required',
            'masa_berlaku_pajak_kendaraan' => 'required',
            'kode_lokasi_pada_stnk' => 'required',
            'masa_berlaku_stnk' => 'required',
            'kepala_kir' => 'required',
            'nomor_kir' => 'required',
            'masa_berlaku_kir' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id_vendor.required' => 'ID Vendor tidak ditemukan',
            'id_vendor.numeric' => 'ID Vendor tidak valid',
            'nomor_pmku.required' => 'Silakan Isi Nomor Pmku',
            'nomor_npwp.required' => 'Silakan Isi Nomor Npwp',
            'nomor_polisi.required' => 'Silakan Isi Nomor Polisi',
            'merk.required' => 'Silakan Isi Merk',
            'model.required' => 'Silakan Isi Model',
            'tipe_kendaraan.required' => 'Silakan Isi Tipe Kendaraan',
            'jenis_kendaraan.required' => 'Silakan Isi Jenis Kendaraan',
            'isi_silinder.required' => 'Silakan Isi Isi Silinder',
            'kapasitas.required' => 'Silakan Isi Kapasitas',
            'tahun_pembuatan.required' => 'Silakan Isi Tahun Pembuatan',
            'nomor_rangka.required' => 'Silakan Isi Nomor Rangka',
            'nomor_mesin.required' => 'Silakan Isi Nomor Mesin',
            'warna_tnkb.required' => 'Silakan Isi Warna Tnkb',
            'bahan_bakar.required' => 'Silakan Isi Bahan Bakar',
            'tahun_registrasi.required' => 'Silakan Isi Tahun Registrasi',
            'nama_pemilik.required' => 'Silakan Isi Nama Pemilik',
            'alamat_pemilik.required' => 'Silakan Isi Alamat Pemilik',
            'nomor_stnk.required' => 'Silakan Isi Nomor Stnk',
            'masa_berlaku_pajak_kendaraan.required' => 'Silakan Isi Masa Berlaku Pajak Kendaraan',
            'kode_lokasi_pada_stnk.required' => 'Silakan Isi Kode Lokasi Pada Stnk',
            'masa_berlaku_stnk.required' => 'Silakan Isi Masa Berlaku Stnk',
            'kepala_kir.required' => 'Silakan Isi Kepala Kir',
            'nomor_kir.required' => 'Silakan Isi Nomor Kir',
            'masa_berlaku_kir.required' => 'Silakan Isi Masa Berlaku Kir',

            'nomor_pmku.numeric' => 'Kolom Nomor Pmku harus berupa numerik',
            'nomor_npwp.numeric' => 'Kolom Nomor Npwp harus berupa numerik',
            'tahun_pembuatan.numeric' => 'Kolom Tahun Pembuatan harus berupa numerik',
            'tahun_registrasi.numeric' => 'Kolom Tahun Registrasi harus berupa numerik',
        ];
    }
}
