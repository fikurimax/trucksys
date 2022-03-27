<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftarkan Supir') }}
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
                            href="{{ route('driver.index') }}">
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
                        <form method="POST" action="{{ route('driver.save') }}">
                            @csrf
                            @if (isset($driver))
                                <input type="text" name="id" id="id" value="{{ $driver['id'] }}" hidden>
                            @endif
                            <div class="mb-6">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama</label>
                                <input 
                                    type="text" 
                                    id="name"
                                    name="name" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Nama" 
                                    required
                                    value="{{ (isset($driver)) ? $driver['name'] : '' }}">
                            </div>
                            <div class="mb-6">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alamat</label>
                                <input 
                                    type="text" 
                                    id="address"
                                    name="address" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Alamat" 
                                    required
                                    value="{{ (isset($driver)) ? $driver['address'] : '' }}">
                            </div>
                            <div class="mb-6">
                                <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kontak</label>
                                <input 
                                    type="text" 
                                    id="contact"
                                    name="contact" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="Kontak" 
                                    required
                                    value="{{ (isset($driver)) ? $driver['contact'] : '' }}">
                            </div>
                            <div class="mb-6">
                                <label for="identity_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">No. KTP</label>
                                <input 
                                    type="text" 
                                    id="identity_number"
                                    name="identity_number" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="No. KTP" 
                                    required
                                    value="{{ (isset($driver)) ? $driver['identity_number'] : '' }}">
                            </div>
                            <div class="mb-6">
                                <label for="driver_license_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">No. SIM</label>
                                <input 
                                    type="text" 
                                    id="driver_license_number"
                                    name="driver_license_number" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    placeholder="No. SIM" 
                                    required
                                    value="{{ (isset($driver)) ? $driver['driver_license_number'] : '' }}">
                            </div>
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
