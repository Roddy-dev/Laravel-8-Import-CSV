<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lebenslauf') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-alert.success></x-alert.success>

                    <x-validation-errors class="mb-4" :errors="$errors"/>

                    <form action="{{ route('import_parse') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-label for="csv_file" :value="__('CSV file to import')"/>

                            <x-input id="csv_file" class="block mt-1 w-full" type="file" name="csv_file" required/>
                        </div>

                        <div class="mt-4 flex items-center">
                            <x-label for="header" :value="__('File contains header row?')"/>

                            <x-input id="header" class="ml-1" type="checkbox" name="header" checked/>
                        </div>
                        
                        
                        {{-- <x-button class="mt-4">
                            {{ __('Submit') }}
                        </x-button> --}}
                        <x-submit-one-click></x-submit-one-click>
                        <input type="hidden" value="lebenslauf" name="modelname" for="modelname">
                    </form>

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Person</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tag</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Monat</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">jahr</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Beschreibung</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Dokument</span>
                                </th>             
                                
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($lebenslaufs as $lebenslauf)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $lebenslauf->person_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $lebenslauf->tag }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $lebenslauf->monat }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $lebenslauf->jahr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $lebenslauf->beschreibung }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $lebenslauf->dokument }}
                                    </td>
                                   

                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $lebenslaufs->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
