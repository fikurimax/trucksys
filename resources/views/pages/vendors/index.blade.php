@extends('adminlte::page')

@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Vendor') }}
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
                                    colspan="1" aria-sort="ascending">
                                    #
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama Perusahaan
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Nama Pemilik
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Alamat
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Kontak
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    NPWP
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Jumlah Unit Truk
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dashboard-rows" rowspan="1" colspan="1">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($vendors); $i++)
                                <tr class="{{ $i % 2 == 0 ? 'even' : 'odd' }}">
                                    <td class="dtr-control sorting_1" tabindex="0">{{$i+1}}</td>
                                    <td>{{ $vendors[$i]->nama_perusahaan }}</td>
                                    <td>{{ $vendors[$i]->nama_pemilik }}</td>
                                    <td class="address">
                                        {{ substr($vendors[$i]->alamat, 0, 25) }}<span class="address-dot-more">...</span><span class="address-see-more">{{ substr($vendors[$i]->alamat,26) }}</span>
                                    </td>
                                    <td>{{ $vendors[$i]->kontak }}</td>
                                    <td>{{ $vendors[$i]->npwp }}</td>
                                    <td>{{ count($vendors[$i]->trucks) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('vehicle.index', ['vid' => $vendors[$i]->id ]) }}" class="btn btn-success" role="button">
                                            Data Truk
                                        </a>
                                        <a href="{{ route('vendor.update', ['vid' => $vendors[$i]->id ]) }}" class="btn btn-info" role="button">
                                            Edit
                                        </a>
                                        <form action="{{ route('vendor.delete', ['id' => $vendors[$i]->id]) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger" onclick="deleteVendor(event)">Hapus</button>
                                        </form>
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
    <style>
        .address-see-more { 
            display: none;
        }

        .address:hover .address-dot-more {
            display: none;
        }

        .address:hover .address-see-more {
            display: inline-block;
        }
    </style>
@endsection

@section('plugins.Datatables', true)
@section('js')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            processing: true
        });
    });

    function deleteVendor(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        if(!confirm('Apakah anda yakin ingin menghapus vendor ini?' )) {
            e.preventDefault();
        }
    }

</script>
@endsection
