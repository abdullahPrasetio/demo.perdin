<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ $title ?? env('APP_NAME')  }}</title>
</head>
<body class="font-sans antialiased">
    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/5">
            {{-- <Sidebar /> --}}
            @include('includes.sidebar')
        </div>
        <div class="w-full lg:w-4/5 mt-16 lg:mt-0">
            <div class="px-4 py-5">
                <h3 class="text-2xl font-medium">{{ $title }}</h3>
                <p class="text-sm text-gray-400">{{ $subtitle }}</p>
            </div>
            <div class="bg-gray-200 py-3 px-4 w-full flex flex-row">
                @yield('breadcrumb')
            </div>
            <div class="p-4">
                @include('includes.alert')
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script> --}}
    
    <script>
        $(document).ready(function(){
            let toggle=false;
            let opened=$('.opened');
            let closed=$('.closed');
            let sidebar=$('.sidebar');
            toggleSidebar(toggle)
            
            $('#button_sidebar').on('click', function(){
                toggle=!toggle;
                toggleSidebar(toggle)
            })

            function toggleSidebar(toggle){
                if(toggle){
                    opened.addClass('hidden')
                    closed.removeClass('hidden')
                    sidebar.removeClass('hidden')
                }else{
                    opened.removeClass('hidden')
                    closed.addClass('hidden')
                    sidebar.addClass('hidden')
                }
            }

            $('#close_alert').on('click', function(){
                $('.alert_custom').addClass('hidden');
            })

            $(document).on('click', '.dropdown-button', function(e){ 
                let element = e.target
                console.log("Test");
                let svg = element.getElementsByTagName('svg')[0]
                svg.classList.add('rotate-90')
                let nextSibling = element.nextSibling.nextSibling
                let containsHidden = nextSibling.classList.contains('hidden')
                if (!containsHidden) {
                    nextSibling.classList.add('hidden')
                    svg.classList.remove('rotate-90')
                } else {
                    nextSibling.classList.remove('hidden')
                }

            });
        })
    </script>
    @stack('scripts')
</body>
</html>