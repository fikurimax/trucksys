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
            'nama_pemilik' => 'required',
            'alamat_pemilik' => 'required',
            'nomor_polisi' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'jenis_kendaraan' => 'required',
            'isi_silinder' => 'required',
            'kapasitas' => 'required',
            'tahun_pembuatan' => 'required|numeric',
            'nomor_stnk' => 'required',
            'masa_berlaku_pajak_kendaraan' => 'required',
            'masa_berlaku_stnk' => 'required',
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
            'nama_pemilik.required' => 'Silakan Isi Nama Pemilik',
            'alamat_pemilik.required' => 'Silakan Isi Alamat Pemilik',
            'nomor_polisi.required' => 'Silakan Isi Nomor Polisi',
            'merk.required' => 'Silakan Isi Merk',
            'model.required' => 'Silakan Isi Model',
            'jenis_kendaraan.required' => 'Silakan Isi Jenis Kendaraan',
            'isi_silinder.required' => 'Silakan Isi Isi Silinder',
            'kapasitas.required' => 'Silakan Isi Kapasitas',
            'tahun_pembuatan.required' => 'Silakan Isi Tahun Pembuatan',
            'nomor_stnk.required' => 'Silakan Isi Nomor Stnk',
            'masa_berlaku_pajak_kendaraan.required' => 'Silakan Isi Masa Berlaku Pajak Kendaraan',
            'masa_berlaku_stnk.required' => 'Silakan Isi Masa Berlaku Stnk',
            'nomor_kir.required' => 'Silakan Isi Nomor Kir',
            'masa_berlaku_kir.required' => 'Silakan Isi Masa Berlaku Kir',

            'tahun_pembuatan.numeric' => 'Kolom Tahun Pembuatan harus berupa numerik',
            'tahun_registrasi.numeric' => 'Kolom Tahun Registrasi harus berupa numerik',
        ];
    }
}
