@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Data kendaraan') }} di <b>{{ \Auth::user()->name }}</b>
</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatable" 
                        class="table table-bordered table-hover dataTable dtr-inline" 
                        role="grid" >
                        <thead>
                            <tr role="row">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dashboard-rows" rowspan="1"
                                    colspan="1" aria-sort="ascending">#</th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    No. Polisi
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Merek
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Tahun
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    STNK
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    KIR
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Foto Unit
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($vehicles); $i++)
                                <tr class="{{ $i % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="dtr-control sorting_1" tabindex="0">{{ $i+1 }}</td>
                                    <td>{{ $vehicles[$i]->nomor_polisi }}</td>
                                    <td>{{ $vehicles[$i]->merk }}</td>
                                    <td>{{ $vehicles[$i]->tahun_pembuatan }}</td>
                                    <td>{{ $vehicles[$i]->nomor_stnk }}</td>
                                    <td>{{ $vehicles[$i]->nomor_kir }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/trucks/' . $vehicles[$i]->photos[0]->filename) }}" 
                                            data-lightbox="{{ $vehicles[$i]->photos[0]->filename }}" 
                                            data-title="Foto Kendaraan">
                                            <img src="{{ asset('storage/trucks/'.$vehicles[$i]->photos[0]->filename) }}" 
                                                alt="Foto unit" 
                                                style="border-radius: 4px;"
                                                width="120">
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('vehicle.detail', ['id' => $vehicles[$i]->id]) }}" class="btn btn-success" role="button">Detail</a>
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
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@endsection

@section('plugins.Datatables', true)

@section('js')
<script src="{{ asset('js/lightbox.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js" defer></script>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

</script>
@endsection