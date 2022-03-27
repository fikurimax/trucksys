<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor') }}
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
                            href="{{ route('vendor.register') }}">
                            Daftarkan Vendor Baru
                        </a>
                    </div>
                    <div class="clear-both relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Nama') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Alamat') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Kontak') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('NPWP') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Jumlah Truk') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($vendors) > 0)
                                    @foreach ($vendors as $vendor)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $vendor['name'] }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $vendor['address'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $vendor['contact'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $vendor['tin'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $vendor['truck_counts'] }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                                    <a href="#" type="button" class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-l-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                        Truk
                                                    </a>
                                                    <a href="{{ route('vendor.update', ['id' => $vendor['id']]) }}" 
                                                        type="button" 
                                                        class="py-2 px-4 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('vendor.delete', ['id' => $vendor['id']]) }}" method="POST">
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
