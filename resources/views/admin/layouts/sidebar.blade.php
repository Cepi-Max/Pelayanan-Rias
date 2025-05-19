<aside class="w-64 bg-white shadow-md min-h-screen fixed top-16 left-0 bottom-0 z-20">
      <nav class="mt-6">
        <ul>
          <li>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 14V9m0 0L5 12m14-2v8a2 2 0 01-2 2h-4m0-8h4" />
              </svg>
              Dashboard
            </a>
          </li>
          <li>
            <a href="{{ route('admin.pengguna.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6m-6 0a4 4 0 01-4-4v-1a4 4 0 014-4m6 0a4 4 0 014 4v1a4 4 0 01-4 4m-6 0v1" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
              </svg>
              User Management
            </a>
          </li>
          <li>
            <a href="{{ route('admin.jenis-surat.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6m-6 0a4 4 0 01-4-4v-1a4 4 0 014-4m6 0a4 4 0 014 4v1a4 4 0 01-4 4m-6 0v1" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
              </svg>
              Jenis Surat
            </a>
          </li>
          <li>
            <a href="{{ route('admin.antrian.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 transition mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6m-6 0a4 4 0 01-4-4v-1a4 4 0 014-4m6 0a4 4 0 014 4v1a4 4 0 01-4 4m-6 0v1" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />
              </svg>
              Antrian
            </a>
          </li>
        </ul>
      </nav>
    </aside>
