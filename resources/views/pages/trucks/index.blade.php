<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Truk') . " " .$vendor['name'] }}
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
                            href="{{ route('vendor.truck.register', ['vid' => request()->vid]) }}">
                            Daftarkan Truk Baru
                        </a>
                    </div>
                    <div class="clear-both relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Nomor Polisi') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Tahun Pembuatan') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Berat Kosong') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Tipe') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Supir') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($trucks) > 0)
                                    @foreach ($trucks as $truck)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $truck['plate_number'] }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $truck['year_made'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $truck['weight_empty'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $truck['type'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#">{{ $truck['driver_name'] }}</a>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                                    <a href="{{ route('vendor.truck.update', ['vid' => request()->vid, 'id' => $truck['id']]) }}" 
                                                        type="button" 
                                                        class="py-2 px-4 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('vendor.truck.delete', ['vid' => request()->vid, 'id' => $truck['id']]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit" 
                                                            class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-red-500 dark:focus:text-white">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Tidak ada vendor
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
