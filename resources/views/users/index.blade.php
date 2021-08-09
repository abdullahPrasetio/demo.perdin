@extends('layouts.backend')

@section('content')
    <div class="bg-white">
        <div class="flex flex-row items-center justify-between px-5">
            <select
                name="limit"
                id="limit"
                class="border border-gray-400 rounded px-2 focus:outline-none"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <input
                type="text"
                name="q"
                class="w-3/3 border px-2 focus:outline-none rounded focus:ring-1"
                id="search"
                placeholder="search data"
            />
        </div>
        
        <div id="table_data"></div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            

            let limit=$('#limit').val();
            let search=$('#search').val();
            let tbody=$('#tbody');

            fetchData(limit,search);
            $('#limit').on('change', function(){
                fetchData($(this).val());
            })
            $('#search').on('change keydown paste input',function(){
                if($(this).val().length>3||$(this).val().length===0){
                    fetchData(limit,$(this).val());
                    
                }
            })
            function fetchData(limit,search,page){
                $.ajax({
                type: 'GET',
                data: {limit,search,page},
                url: "{{ route('user.table') }}",
                success: function (data) {
                    $('#table_data').html(data);
                }
            });
            }
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault(); 
                var page = $(this).attr('href').split('page=')[1];
                fetchData(limit,search,page);
            });
        });
    </script>
@endpush