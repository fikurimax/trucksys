<table>
    <thead>
        <tr>
            <th>Nomor PMKU</th>
            <th>Nomor NPWP</th>
            <th>Nomor Polisi</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Tipe Kendaraan</th>
            <th>Jenis Kendaraan</th>
            <th>Isi Silinder</th>
            <th>Kapasitas</th>
            <th>Tahun Pembuatan</th>
            <th>Nomor STNK</th>
            <th>Masa Berlaku STNK</th>
            <th>Masa Berlaku Pajak Kendaraan</th>
            <th>Nomor KIR</th>
            <th>Masa Berlaku KIR</th>
            <th>Vendor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trucks as $truck)
            <tr>
                <td>{{ $truck->nomor_pmku }}</td>
                <td>{{ $truck->nomor_npwp }}</td>
                <td>{{ $truck->nomor_polisi }}</td>
                <td>{{ $truck->merk }}</td>
                <td>{{ $truck->model }}</td>
                <td>{{ $truck->tipe_kendaraan }}</td>
                <td>{{ $truck->jenis_kendaraan }}</td>
                <td>{{ $truck->isi_silinder }}</td>
                <td>{{ $truck->kapasitas }}</td>
                <td>{{ $truck->tahun_pembuatan }}</td>
                <td>{{ $truck->nomor_stnk }}</td>
                <td>{{ $truck->masa_berlaku_stnk }}</td>
                <td>{{ $truck->masa_berlaku_pajak_kendaraan }}</td>
                <td>{{ $truck->nomor_kir }}</td>
                <td>{{ $truck->masa_berlaku_kir }}</td>
                <td>{{ $truck->vendor->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>