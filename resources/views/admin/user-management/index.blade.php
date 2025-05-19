@extends('admin.layouts.app')

@section('content')
<!-- resources/views/users/index.blade.php -->

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between">

  <h1 class="text-2xl font-semibold text-gray-900 mb-6">Daftar Pengguna</h1>
        <form method="GET" action="{{ route('admin.pengguna.index') }}" class="mb-4 flex flex-wrap gap-3 items-center">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Cari nama..." 
                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
            <select 
                name="role" 
                class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                <option value="">-- Semua Role --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="operator" {{ request('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            <button 
                type="submit" 
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition"
            >
                Cari
            </button>
            <a href="{{ route('admin.pengguna.index') }}" class="text-gray-500 hover:underline ml-2">Reset</a>
        </form>
    </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach ($users as $user)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->username }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 capitalize">{{ $user->role }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              @if ($user->status === 'aktif')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
              @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
              <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
              <button onclick="openModal({{ $user->id }})"
                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition">
                    Hapus
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Pagination jika perlu -->
  <div class="mt-6">
    {{ $users->links() }}
  </div>
</div>

@include('admin.user-management.delete-modal')

<script>
    function openModal(userId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const routeTemplate = `{{ route('admin.pengguna.destroy', ':id') }}`;

        form.action = routeTemplate.replace(':id', userId);
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('confirm_delete').checked = false;
    }
</script>

@endsection
