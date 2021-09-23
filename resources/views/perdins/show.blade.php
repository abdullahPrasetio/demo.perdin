@extends('layouts.backend')

@section('content')
    <div class="bg-white flex flex-col">
        <div className="flex justify-between mb-4 px-5">
            @if ($user->unitkerja=="SDM")
                @if ($perdin->status == 'Pending')
                    <form action="{{ route('perjalanan-dinas.change-status',['id'=>$perdin->id,'status'=>'Approved']) }}" method="post" >
                        @csrf
                        <button
                            class="bg-blue-500 hover:bg-blue-700 focus:ring-1 ring-blue-300 px-4 py-2 rounded text-white float-right mx-2"
                            >
                            Approve
                        </button>
                    </form>
                    <button
                        href="{{ route('perjalanan-dinas.create') }}"
                        class="bg-red-500 hover:bg-red-700 focus:ring-1 ring-red-300 px-4 py-2 rounded text-white float-right mx-2" onclick="toggleModal('modal-id')"
                    >
                        Rejected
                    </button>
                    
                @endif
                @if ($perdin->status == 'Approved')
                    <form action="{{ route('perjalanan-dinas.change-status',['id'=>$perdin->id,'status'=>'Done']) }}" method="post" >
                        @csrf
                        <button
                            class="bg-green-500 hover:bg-green-700 focus:ring-1 ring-green-300 px-4 py-2 rounded text-white float-right mx-2"
                            >
                            Sudah Dibayar
                        </button>
                    </form>
                @endif
                
            @endif

            <a
                href="{{ route('perjalanan-dinas.print',$perdin->id) }}"
                target="_blank"
                class="bg-gray-500 hover:bg-gray-700 focus:ring-1 ring-gray-300 px-4 py-2 rounded text-white float-right mx-2"
            >
                Print
            </a>
        </div>
        <div class="flex flex-row flex-wrap items-center justify-between px-5 mt-7">
            <div class="w-1/2 my-2 capitalize">No</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->no_perdin }}</div>
            <div class="w-1/2 my-2 capitalize">Nama Pembuat</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->pembuat['nama'] }}</div>
            <div class="w-1/2 my-2 capitalize">Lokasi Berangkat</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->lokasi_berangkat_name }}</div>
            <div class="w-1/2 my-2 capitalize">Lokasi tujuan</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->lokasi_tujuan_name }}</div>
            <div class="w-1/2 my-2 capitalize">Tanggal Berangkat</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->tanggal_berangkat }}</div>
            <div class="w-1/2 my-2 capitalize">Tanggal Pulang</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->tanggal_pulang }}</div>
            <div class="w-1/2 my-2 capitalize">Durasi</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->durasi. " Hari" }}</div>
            <div class="w-1/2 my-2 capitalize">Jarak</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->jarak. " Km" }}</div>
            <div class="w-1/2 my-2 capitalize">Allowance (day)</div>
            <div class="w-1/2 my-2 capitalize">{{ formatRupiah($perdin->allowance)}}</div>
            <div class="w-1/2 my-2 capitalize">Total Allowance</div>
            <div class="w-1/2 my-2 capitalize">{{ formatRupiah($perdin->total_allowance)}}</div>
            <div class="w-1/2 my-2 capitalize">Terbilang</div>
            <div class="w-1/2 my-2 capitalize">{{ terbilang($perdin->total_allowance)}}</div>
            <div class="w-1/2 my-2 capitalize">Status</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->status }}</div>
            <div class="w-1/2 my-2 capitalize">Tujuan</div>
            <div class="w-1/2 my-2 capitalize">{{ $perdin->tujuan_perdin }}</div>
        </div>
        <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white ">
                <tr class="bg-gray-700 flex lg:flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 hidden">
                    <th class="p-3 text-left">No Perdin</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Nip</th>
                    <th class="p-3 text-left">Jabatan</th>
                    <th class="p-3 text-left">Activity</th>
                    <th class="p-3 text-left">Time</th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none" id="tbody">
                @foreach ($perdin->log as $item)
                    <tr
                        class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0 hover:bg-gray-100 "
                    >
                        <td class="border-grey-light border p-3 sm:overflow-clip">
                            {{$perdin->no_perdin}}
                        </td>
                        <td class="border-grey-light border p-3">
                            {{$item->name}}
                        </td>
                        <td class="border-grey-light border p-3 truncate">
                            {{$item->nip}}
                        </td>
                        <td class="border-grey-light border p-3 sm:overflow-clip">
                            {{$item->jabatan}}
                        </td>
                        <td class="border-grey-light border p-3 sm:overflow-clip">
                            {{$item->activity}}
                        </td>
                        <td class="border-grey-light border p-3 sm:overflow-clip">
                            {{$item->created_at->diffForHumans()}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
      <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
          <!--content-->
          <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
              <h3 class="text-3xl font-semibold">
                Rejected
              </h3>
              <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                  ×
                </span>
              </button>
            </div>
            <!--body-->
            <form action="{{ route('perjalanan-dinas.change-status',['id'=>$perdin->id,'status'=>'Rejected']) }}" method="post" >
                @csrf
                <div class="relative p-6 flex-auto">
                    <div class="mb-5">
                        <label class="block text-sm mb-1 capitalize" for="alasan">Alasan Penolakan</label>
                        <textarea name="alasan"
                        id="alasan"
                        placeholder="type alasan penolakan" rows="5" class="@error('alasan') border-red-500 @enderror px-3 py-2 w-full rounded border focus:outline-none focus:ring-2 ring-gray-200 focus:border-gray-300"></textarea>
                        @error('alasan')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                    Close
                </button>
                <button class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">
                    Save Changes
                </button>
                </div>

            </form>
          </div>
        </div>
      </div>
      <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
      
@endsection

@push('scripts')
<script type="text/javascript">
    function toggleModal(modalID){
      document.getElementById(modalID).classList.toggle("hidden");
      document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
      document.getElementById(modalID).classList.toggle("flex");
      document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
@endpush
