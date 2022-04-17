@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Data vendor') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="dashboard-table" 
                        class="table table-bordered table-hover dataTable dtr-inline" 
                        role="grid" 
                        aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dashboard-rows" rowspan="1"
                                    colspan="1" aria-sort="ascending">#</th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Email
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    No. Telepon
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama Pemilik
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    NPWP
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Alamat
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($vendors); $i++)
                                <tr class="{{ $i % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="dtr-control sorting_1" tabindex="0">{{$i + 1}}</td>
                                    <td>{{ $vendors[$i]->name }}</td>
                                    <td>{{ $vendors[$i]->email }}</td>
                                    <td>{{ $vendors[$i]->phone_number }}</td>
                                    <td>{{ $vendors[$i]->owner_name ?? 'Belum diisi' }}</td>
                                    <td>{{ $vendors[$i]->npwp ?? 'Belum diisi' }}</td>
                                    <td>{{ $vendors[$i]->address ?? 'Belum diisi' }}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dashboard-table').DataTable({
            processing: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Download CSV',
                    action: function ( e, dt, node, config ) {
                        window.open('{{ route("vendor.exportAll", ["fileType" => "csv"]) }}', '_blank');
                    }
                }
            ]
        });
    });

</script>
@endsection
