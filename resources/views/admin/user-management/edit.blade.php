@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-6">Edit Data Pengguna: {{ $user->name }}</h2>

    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="username" class="block font-medium">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="number_phone" class="block font-medium">No. HP</label>
            <input type="text" name="number_phone" id="number_phone" value="{{ old('number_phone', $user->number_phone) }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="role" class="block font-medium">Role</label>
            <select name="role" id="role" class="w-full border px-3 py-2 rounded" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        {{-- <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" class="w-full border px-3 py-2 rounded" required>
                <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div> --}}

        <div class="flex items-center gap-2">
            <input type="checkbox" name="confirm_update" id="confirm_update" {{ old('confirm_update') ? 'checked' : '' }}>
            <label for="confirm_update" class="text-sm text-gray-700">Saya yakin ingin memperbarui data ini</label>
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
