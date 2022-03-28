<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambahkan Truk untuk ') . " " . $vendor['name'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full">
                        <a 
                            type="button" 
                            class="float-right py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            href="{{ route('vendor.truck.index', ['vid' => request()->vid]) }}">
                            Kembali
                        </a>
                    </div>
                    <div class="clear-both relative">
                        @if ($errors->any())
                            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                <span class="font-medium">Perhatian</span>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('vendor.truck.save', ['vid' => request()->vid]) }}">
                            @csrf
                            <input type="hidden" name="id_vendor" value="{{ $vendor['id'] }}">
                            @if (isset($truck))
                                <input type="text" name="id" id="id" value="{{ $truck['id'] }}" hidden>
                            @endif
                            <div class="mb-6">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Nomor Polisi
                                </label>
                                <input 
                                    type="text" 
                                    id="name"
                                    name="plate_number" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Nomor polisi" 
                                    required
                                    value="{{ (isset($truck)) ? $truck['plate_number'] : old('plate_number', '') }}">
                            </div>
                            <div class="mb-6">
                                <label for="year_made" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Tahun Pembuatan
                                </label>
                                <input 
                                    type="number" 
                                    id="year_made"
                                    name="year_made" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Tahun buat" 
                                    required
                                    maxlength="4"
                                    max="{{ date('Y') }}"
                                    value="{{ (isset($truck)) ? $truck['year_made'] : old('year_made', '') }}">
                            </div>
                            <div class="mb-6">
                                <label for="weight_empty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Berat Kosong
                                </label>
                                <input 
                                    type="text" 
                                    id="weight_empty"
                                    name="weight_empty" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Berat kosong" 
                                    required
                                    value="{{ (isset($truck)) ? $truck['weight_empty'] : old('weight_empty', '') }}">
                            </div>
                            <div class="mb-6">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Tipe
                                </label>
                                <input 
                                    type="text" 
                                    id="type"
                                    name="type" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Tipe" 
                                    required
                                    value="{{ (isset($truck)) ? $truck['type'] : old('type', '') }}">
                            </div>
                            <div class="mb-6">
                                <label for="driver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                    Supir
                                </label>
                                <select 
                                    id="driver" 
                                    name="id_driver" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Cari supir</option>
                                </select>
                            </div>
                            @if (!isset($truck))
                                <div class="flex items-center mb-4">
                                    <input 
                                        id="add-another" 
                                        name="add_another" 
                                        @if (old('add_another') !== null) checked @endif
                                        aria-describedby="add-another" 
                                        type="checkbox" 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" >
                                    <label for="add-another" class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Simpan dan tambah yang lain</label>
                                </div>
                            @endif
                            <button 
                                type="submit" 
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#driver').select2({
            ajax: {
                url: "{{ route('driver.search') }}",
                dataType: 'json',
                delay: 250,
                placeholder: 'Pilih supir',
                processResults: function (res) {
                    if (res.status == 'error') {
                        alert(res.message);
                    }

                    return res.data;
                }
            }
        });
    </script>
@endpush