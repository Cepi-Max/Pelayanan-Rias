<!-- Modal Konfirmasi -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-red-600">Konfirmasi Penghapusan</h2>
        <p class="mb-4 text-gray-700">Apakah kamu yakin ingin menghapus pengguna ini? Tindakan ini tidak bisa dibatalkan.</p>

    {{-- action ada di script --}}
        <form id="deleteForm" action="" method="POST"> 
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <input type="checkbox" name="confirm_delete" id="confirm_delete" required>
                <label for="confirm_delete" class="text-sm text-gray-600">Saya yakin ingin menghapus pengguna ini</label>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                    Batal
                </button>
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Hapus Permanen
                </button>
            </div>
        </form>
    </div>
</div>
