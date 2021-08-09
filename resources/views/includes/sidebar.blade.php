<div class="bg-gray-800 lg:h-screen fixed w-full lg:w-1/5 flex flex-col justify-between z-20">
    <div class="flex justify-between p-4 border-b border-gray-700">
        <div class="text-lg text-white font-medium">
            Bangun Candi
        </div>
        <button
            id="button_sidebar"
            class="focus:outline-none block lg:hidden"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M4 6h16M4 12h8m-8 6h16"
                    class="opened"
                />
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M6 18L18 6M6 6l12 12"
                    class="closed"
                />
            </svg>
        </button>
    </div>
    <div
        class='lg:block lg:h-full h-screen overflow-y-auto p-4 leading-relaxed sidebar'
    >
        <a
            href="/home"
            class=
                "nav-link py-2 px-4 rounded block cursor-pointer hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center {{ request()->routeIs('home') ? 'active text-white bg-gray-700' : 'text-gray-400' }}"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 mr-3"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            Home
        </a>

        @if ($user->unitkerja=="SDM")
            <a
                href="{{ route('location') }}"
                class=
                    "nav-link py-2 px-4 rounded block cursor-pointer hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center {{ request()->routeIs('location') ? 'active text-white bg-gray-700' : 'text-gray-400' }}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
                Location
            </a>

            <a
                href="{{ route('user') }}"
                class=
                    "nav-link py-2 px-4 rounded block cursor-pointer hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center {{ request()->routeIs('user') ? 'active text-white bg-gray-700' : 'text-gray-400' }}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
            </svg>
                User
            </a>
        @endif
        <a
            href="{{ route('perjalanan-dinas.index') }}"
            class=
                "nav-link py-2 px-4 rounded block cursor-pointer hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center {{ request()->routeIs('perjalanan-dinas.index') ? 'active text-white bg-gray-700' : 'text-gray-400' }}"
        >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd" />
          </svg>
            Perjalanan Dinas
        </a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button
                type="submit"
                class="py-2 px-4 rounded hover:text-white active:text-white hover:bg-gray-700 my-1 flex items-center text-gray-400 w-full"
                >
                Logout
            </button>
        </form>
    </div>
</div>