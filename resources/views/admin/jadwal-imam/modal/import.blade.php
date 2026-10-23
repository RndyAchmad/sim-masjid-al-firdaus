<div id="importModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-xl">
        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">
                Import Jadwal Imam
            </h2>

            <button type="button" onclick="closeImportModal()"
                class="text-2xl leading-none text-gray-500 hover:text-gray-700" aria-label="Tutup modal">
                &times;
            </button>
        </div>

        <form action="{{ route('admin.jadwal-imam.import') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <div>
                <label for="file_import" class="mb-2 block text-sm font-medium text-gray-700">
                    File Excel atau CSV
                </label>

                <input type="file" name="file" id="file_import" accept=".xlsx,.xls,.csv" required class="block w-full rounded-lg border border-gray-300 text-sm
                           file:mr-4 file:border-0 file:bg-gray-100
                           file:px-4 file:py-2.5 file:font-medium
                           hover:file:bg-gray-200">

                @error('file')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                <p class="mt-2 text-xs text-gray-500">
                    Pilih file Excel atau CSV sesuai format import yang digunakan.
                </p>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeImportModal()" class="rounded-lg border border-gray-300 px-4 py-2
                           text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </button>

                <button type="submit" class="rounded-lg bg-[#c49c4d] px-4 py-2
                           text-sm font-semibold text-white hover:bg-[#a8833e]">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.openImportModal = function () {
        const modal = document.getElementById('importModal');

        if (!modal) {
            console.error('Elemen importModal tidak ditemukan.');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.closeImportModal = function () {
        const modal = document.getElementById('importModal');

        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('importModal');

        if (!modal) return;

        // Tutup modal jika area luar diklik.
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                window.closeImportModal();
            }
        });

        // Tutup modal dengan tombol Escape.
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                window.closeImportModal();
            }
        });
    });
</script>
