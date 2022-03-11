<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Familie') }}
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
                        
                        {{-- <div x-data="{ disableSubmit: false, text: 'Submit'}">
                            <x-button  @click="
                                text = 'Loading Table';
                                disableSubmit = true;
                            "
                                {{-- :class="[disableSubmit ? '' : 'cursor-not-allowed']"  --}}
                                {{-- class="mt-4"
                                x-text="text"
                                x-bind:disabled="disableSubmit"> --}}
                            {{-- </x-button>
                        </div> --}}
                        <x-submit-one-click></x-submit-one-click>
                        <input type="hidden" value="familie" name="modelname" for="modelname">
                    </form>

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Id</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nachname</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Vorname</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Geburtsdatum</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Geburtsjahr</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Geburtsort</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Heiratsdatum</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Heiratsjahr</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Heiratsort</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sterbedatum</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sterbejahr</span>
                                </th>             
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sterbeort</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Taufdatum</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Taufort</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($families as $familie)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->nachname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->vorname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->geburtsdatum }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->geburtsjahr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->geburtsort }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->heiratsdatum }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->heiratsjahr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->heiratsort }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->sterbedatum }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->sterbejahr }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->sterebort }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->taufdatum }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $familie->taufort }}
                                    </td>


                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $families->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
