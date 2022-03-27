<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supir') }}
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
                            href="{{ route('driver.register') }}">
                            Daftarkan Supir Baru
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
                                        {{ __('No. KTP') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('No. SIM') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Truk') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($drivers) > 0)
                                    @foreach ($drivers as $driver)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $driver['name'] }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $driver['address'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $driver['contact'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $driver['identity_number'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $driver['driver_license_number'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ ($driver['truck'] != null) ? $driver['truck'] : 'Belum ada truk' }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{ route('driver.update', ['id' => $driver['id']]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    Edit
                                                </a>
                                                <form action="{{ route('driver.delete', ['id' => $driver['id']]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                        type="submit">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Tidak ada supir
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
