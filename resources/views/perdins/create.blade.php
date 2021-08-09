@extends('layouts.backend')

@section('content')
    <div class="bg-white">
        <form action="{{ route('perjalanan-dinas.store') }}" method="post" class="w-full flex flex-wrap lg:flex-row flex-col items-center">
            @csrf
            <div class="w-1/2 px-3 py-4 lg:border-r">
                <div class="mb-5">
                    <label class="block text-sm mb-1 capitalize" for="user_id">User Create</label>
                    <select name="user_id" id="" readonly="readonly" class="@error('user_id') border-red-500 @enderror px-3 py-2 w-full border border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300">
                        <option value="{{ $user->pegawaiid }}">{{ $user->nama }}</option>
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm mb-1 capitalize" for="lokasi_berangkat">Lokasi Berangkat</label></>
                    <select name="lokasi_berangkat" id="" readonly="readonly" class="@error('lokasi_berangkat') border-red-500 @enderror px-3 py-2 w-full border border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300 select-kota">
                        <option value="345" class="capitalize">KOTA BANDUNG</option>
                    </select>
                    @error('lokasi_berangkat')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm mb-1 capitalize" for="lokasi_tujuan">Lokasi Tujuan</label></>
                    <select name="lokasi_tujuan" id="" class="@error('lokasi_tujuan') border-red-500 @enderror px-3 py-2 w-full border border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300 select-kota">
                        @foreach ($locations as $item)
                            <option value="{{ isset($item['lokasiid']) ? $item['lokasiid'] : 0}}" class="capitalize">{{ isset($item['nama']) ? $item['nama'] : 0}}</option>
                        @endforeach
                    </select>
                    @error('lokasi_tujuan')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-1/2 px-3 py-4 lg:border-r">
                <div class="mb-5">
                    <label class="block text-sm mb-1 capitalize" for="tanggal_berangkat">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="@error('tanggal_berangkat') border-red-500 @enderror px-3 py-2 w-full border border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300"/>
                    @error('tanggal_berangkat')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-sm mb-1 capitalize" for="tanggal_pulang">Tanggal Pulang</label>
                    <input type="date" name="tanggal_pulang" id="tanggal_pulang" class="@error('tanggal_pulang') border-red-500 @enderror px-3 py-2 w-full border border-gray-300 rounded focus:border-gray-400 focus:ring-2 ring-gray-200 focus:outline-none transition-colors duration-300"/>
                    @error('tanggal_pulang')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="lg:w-full w-1/2 px-3 py-4">
                <div class="mb-5">
                    <label class="block text-sm mb-1 capitalize" for="tujuan_perdin">Tujuan Perjalanan Dinas</label>
                    <textarea name="tujuan_perdin"
                    id="tujuan_perdin"
                    placeholder="type full address site" rows="5" class="@error('tujuan_perdin') border-red-500 @enderror px-3 py-2 w-full rounded border focus:outline-none focus:ring-2 ring-gray-200 focus:border-gray-300"></textarea>
                    @error('tujuan_perdin')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="lg:w-full w-1/2 px-3 py-4">
                <div class="mb-5">
                    <button class="block w-full bg-blue-500 focus:ring-1 ring-blue-400 px-4 py-2 rounded text-white" type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-kota').select2()

        //     let limit=$('#limit').val();
        //     let search=$('#search').val();
        //     let tbody=$('#tbody');

        //     fetchData(limit,search);
        //     $('#limit').on('change', function(){
        //         fetchData($(this).val());
        //     })
        //     $('#search').on('change keydown paste input',function(){
        //         if($(this).val().length>3||$(this).val().length===0){
        //             fetchData(limit,$(this).val());
                    
        //         }
        //     })
        //     function fetchData(limit,search,page){
        //         $.ajax({
        //         type: 'GET',
        //         data: {limit,search,page},
        //         url: "{{ route('location.table') }}",
        //         success: function (data) {
        //             $('#table_data').html(data);
        //         }
        //     });
        //     }
        //     $(document).on('click', '.pagination a', function(event){
        //         event.preventDefault(); 
        //         var page = $(this).attr('href').split('page=')[1];
        //         fetchData(limit,search,page);
        //     });
        });
    </script>
@endpush