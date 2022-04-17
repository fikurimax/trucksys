<table>
    <thead>
        <tr>
            <th>No. Reg</th>
            <th>ID Driver</th>
            <th>Nama Lengkap</th>
            <th>Tgl. Lahir</th>
            <th>Tmp. Lahir</th>
            <th>Alamat</th>
            <th>No. KTP</th>
            <th>No. SIM</th>
            <th>Masa Berlaku SIM</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
            <tr>
                <td>{{ $driver->nomor_registrasi }}</td>
                <td>{{ $driver->id }}</td>
                <td>{{ $driver->nama }}</td>
                <td>{{ date('d-m-Y', strtotime($driver->tanggal_lahir)) }}</td>
                <td>{{ $driver->tempat_lahir }}</td>
                <td>{{ $driver->alamat }}</td>
                <td>{{ $driver->no_ktp }}</td>
                <td>{{ $driver->no_sim }}</td>
                <td>{{ date('d-m-Y', strtotime($driver->masa_berlaku_sim)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>