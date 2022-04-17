<table>
    <thead>
        <tr>
            <th>Nama Perusahaan</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Nama Pemilik</th>
            <th>NPWP</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vendors as $vendor)
            <tr>
                <td>{{ $vendor->name }}</td>
                <td>{{ $vendor->owner_name }}</td>
                <td>{{ $vendor->npwp }}</td>
                <td>{{ $vendor->email }}</td>
                <td>{{ $vendor->phone_number }}</td>
                <td>{{ $vendor->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>