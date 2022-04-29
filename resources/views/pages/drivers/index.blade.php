@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Pengemudi') }}
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="driver-table" 
                        class="table table-bordered table-hover dataTable dtr-inline" 
                        role="grid" >
                        <thead>
                            <tr role="row">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dashboard-rows" rowspan="1"
                                    colspan="1" aria-sort="ascending">
                                    No. Reg
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama Driver/Kondektur
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    ID Driver
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Tgl. Lahir
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    No. SIM
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Masa Berlaku SIM
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($drivers); $i++)
                                <tr class="{{ $i % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="dtr-control sorting_1" tabindex="0">{{$drivers[$i]->nomor_registrasi}}</td>
                                    <td>{{ $drivers[$i]->nama }}</td>
                                    <td>{{ $drivers[$i]->id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($drivers[$i]->tanggal_lahir)) }}</td>
                                    <td>{{ $drivers[$i]->no_sim }}</td>
                                    <td>{{ date('d-m-Y', strtotime($drivers[$i]->masa_berlaku_sim)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('driver.detail', ['id' => $drivers[$i]->id ]) }}" class="btn btn-success" role="button">Detail</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#driver-table').DataTable({
            processing: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Download CSV',
                    action: function ( e, dt, node, config ) {
                        window.open('{{ route("driver.exportAll", ["fileType" => "csv"]) }}', '_blank');
                    }
                }
            ]
        });
    });

</script>
@endsection
