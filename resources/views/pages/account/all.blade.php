@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Data Semua Pengguna') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="user-table" 
                        class="table table-bordered table-hover dataTable dtr-inline" 
                        role="grid" >
                        <thead>
                            <tr role="row">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dashboard-rows" rowspan="1"
                                    colspan="1" aria-sort="ascending">
                                    No
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama Pengguna
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama Pemilik
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Email
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nomor telepon
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    NPWP
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Alamat
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Terdaftar pada
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Akun sudah dilengkapi
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($users); $i++)
                                <tr class="{{ $i % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="dtr-control sorting_1" tabindex="0">{{ $i+1 }}</td>
                                    <td>{{ $users[$i]->name }}</td>
                                    <td>{{ $users[$i]->owner_name }}</td>
                                    <td>{{ $users[$i]->email }}</td>
                                    <td>{{ $users[$i]->phone_number }}</td>
                                    <td>{{ $users[$i]->npwp }}</td>
                                    <td>{{ $users[$i]->address }}</td>
                                    <td>{{ Carbon\Carbon::parse($users[$i]->created_at)->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        @if ($users[$i]->is_updated)
                                        <span class="badge bg-success">Sudah</span>
                                        @else 
                                        <span class="badge bg-danger">Belum</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('account.detail', ['id' => $users[$i]->id ]) }}" class="btn btn-success" role="button">Detail</a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('plugins.Datatables', true)
@section('js')
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#user-table').DataTable({
            processing: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Download CSV',
                    action: function ( e, dt, node, config ) {
                        window.open('{{ route("account.all.export", ["fileType" => "csv"]) }}', '_blank');
                    }
                }
            ]
        });
    });

</script>
@endsection
