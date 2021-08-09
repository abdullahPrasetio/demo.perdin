<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
    <thead class="text-white ">
        <tr class="bg-gray-700 flex lg:flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 hidden">
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Provinsi</th>
            <th class="p-3 text-left">Negara</th>
            <th class="p-3 text-left">Kota</th>
            <th class="p-3 text-left">Pulau</th>
            <th class="p-3 text-left">Longitude</th>
            <th class="p-3 text-left">Latitude</th>
            <th class="p-3 text-left">ISLN</th>
        </tr>
    </thead>
    <tbody class="flex-1 sm:flex-none" id="tbody">
        @foreach ($data as $item)
            <tr
                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 hover:bg-gray-100 "
            >
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['lokasiid']}}
                </td>
                <td class="border-grey-light border p-3">
                    {{$item['nama']}}
                </td>
                <td class="border-grey-light border p-3">
                    {{$item['provinsi']}}
                </td>
                <td class="border-grey-light border p-3 truncate">
                    {{$item['negara']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['kabkota']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['pulau']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['lon']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['isln']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['lat']}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links() !!}

