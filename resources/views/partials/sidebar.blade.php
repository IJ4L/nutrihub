<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-5 transition-transform bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="flex items-center justify-center font-bold text-lg px-7 mb-10">
        Nutrihub <span class="text-red-400 text-md font-light italic"> Makassar</span>
    </div>
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('admin.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white  dark:hover:bg-gray-700 group {{ request()->is('admin') ? 'bg-blue-400 text-white  hover:bg-primary' : 'hover:bg-gray-100' }}">
                    <svg class="w-4 h-4 transition duration-75 dark:text-gray-400 text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3 font-semibold">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.events') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white  dark:hover:bg-gray-700 group {{ request()->is('admin/events') ? 'bg-blue-400 text-white hover:bg-primary' : 'hover:bg-gray-100' }}">
                    <svg class="w-4 h-4 transition duration-75 dark:text-gray-400 text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="flex-1 ms-3 font-semibold">Events</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white  dark:hover:bg-gray-700 group {{ request()->is('admin/testimonials') ? 'bg-blue-400 text-white  hover:bg-primary' : 'hover:bg-gray-100' }}">
                    <svg class="w-4 h-4 transition duration-75 dark:text-gray-400 text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 font-semibold">Testimonials</span>
                </a>
            </li>
        </ul>
    </div>
    <img class="absolute bottom-0 size-48 -rotate-90" src="{{ asset('images/utils/daun.png') }}" alt="daun">
</aside>
