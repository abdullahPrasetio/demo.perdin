<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
    <thead class="text-white ">
        <tr class="bg-gray-700 flex lg:flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 hidden">
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">perdins</th>
            <th class="p-3 text-left">Lokasi Tujuan</th>
            <th class="p-3 text-left">Periode</th>
            <th class="p-3 text-left">Unit Kerja</th>
            <th class="p-3 text-left">Durasi</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left" width="110px">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="flex-1 sm:flex-none" id="tbody">
        @foreach ($data as $item)
            <tr
                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 hover:bg-gray-100 "
            >
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item->id}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item->no_perdin}}
                </td>
                <td class="border-grey-light border p-3">
                    {{$item->lokasi_tujuan_name}}
                </td>
                <td class="border-grey-light border p-3 truncate">
                    {{$item->tanggal_berangkat.' - '.$item->tanggal_pulang}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item->unit_kerja}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item->durasi.' Hari'}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item->status}}
                </td>
                <td class="border-grey-light border p-3 text-gray-700 hover:text-gray-600 hover:font-medium cursor-pointer">
                    <div>
                        <button
                            class='w-full nav-link py-2 px-4 rounded block focus:outline-none hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center justify-between dropdown-button'
                        >
                            Action
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 pointer-events-none transform transition-transform duration-200"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fillRule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clipRule="evenodd"
                                />
                            </svg>
                        </button>
                        <div class="ml-8 hidden overflow-hidden animate-accordion">
                            {{-- <a
                                href="#"
                                class="w-full nav-link py-2 px-4 rounded block focus:outline-none hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center justify-between"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                                </svg>
                                Log
                            </a> --}}
                            <a
                                href="{{ route('perjalanan-dinas.show',$item->id) }}"
                                class="w-full nav-link py-2 px-4 rounded block focus:outline-none hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center justify-between"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                Show
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links() !!}

