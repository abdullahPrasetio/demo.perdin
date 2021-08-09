<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
    <thead class="text-white ">
        <tr class="bg-gray-700 flex lg:flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 hidden">
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Email</th>
            <th class="p-3 text-left">Username</th>
            <th class="p-3 text-left">Nip</th>
            <th class="p-3 text-left">Jabatan</th>
            <th class="p-3 text-left">Tanggal Lahir</th>
            <th class="p-3 text-left">Unit Kerja</th>
        </tr>
    </thead>
    <tbody class="flex-1 sm:flex-none" id="tbody">
        @foreach ($data as $item)
            <tr
                class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 hover:bg-gray-100 "
            >
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['pegawaiid']}}
                </td>
                <td class="border-grey-light border p-3">
                    {{$item['nama']}}
                </td>
                <td class="border-grey-light border p-3">
                    {{$item['email']}}
                </td>
                <td class="border-grey-light border p-3 truncate">
                    {{$item['username']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['nip']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['jabatan']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['tanggal_lahir']}}
                </td>
                <td class="border-grey-light border p-3 sm:overflow-clip">
                    {{$item['unitkerja']}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links() !!}

