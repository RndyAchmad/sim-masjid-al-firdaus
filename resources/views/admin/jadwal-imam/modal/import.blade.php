<div id="importModal"
    class="fixed inset-0 z-50 {{ $errors->has('file') ? 'flex' : 'hidden' }} items-center justify-center bg-black/50 p-4">

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

        <form id="importForm" action="{{ route('admin.jadwal-imam.import') }}" method="POST"
            enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="file_import" class="mb-2 block text-sm font-medium text-gray-700">
                    File Excel atau CSV
                </label>

                {{-- Nama file muncul tepat di bawah label --}}
                <p id="selectedFileName"
                    class="mb-3 hidden break-all rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-sm font-medium text-emerald-700">
                </p>

                {{-- Area drag-and-drop tetap dipertahankan --}}
                <div id="dropZone" role="button" tabindex="0"
                    class="cursor-pointer rounded-lg border-2 border-dashed border-gray-300 p-6 text-center transition hover:border-[#c49c4d] hover:bg-amber-50">

                    <p class="text-sm font-medium text-gray-700">
                        Tarik dan letakkan file di sini
                    </p>

                    <p class="mt-1 text-xs text-gray-500">
                        atau klik untuk memilih file
                    </p>

                    <icon name="upload" size="24" />
                </div>

                <input type="file" name="file" id="file_import" accept=".xlsx,.xls,.csv" required class="hidden">

                <div id="clientFileError"
                    class="mt-2 hidden rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-600">
                </div>

                @error('file')
                    <div id="file-error-message"
                        class="mt-2 whitespace-pre-line rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-600">
                        {{ $message }}
                    </div>
                @enderror

                <p class="mt-2 text-xs text-gray-500">
                    Format file: XLSX, XLS, atau CSV. Maksimal 5 MB.
                </p>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeImportModal()"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </button>

                <button type="submit" id="importSubmit"
                    class="rounded-lg bg-[#c49c4d] px-4 py-2 text-sm font-semibold text-white hover:bg-[#a8833e] disabled:cursor-not-allowed disabled:opacity-50">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.openImportModal = function () {
        const modal = document.getElementById('importModal');

        if (!modal) return;

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
        const input = document.getElementById('file_import');
        const dropZone = document.getElementById('dropZone');
        const fileName = document.getElementById('selectedFileName');
        const error = document.getElementById('clientFileError');
        const form = document.getElementById('importForm');

        if (!input || !dropZone || !form) return;

        const maxSize = 5 * 1024 * 1024;
        const allowedExtensions = ['xlsx', 'xls', 'csv'];

        function showError(message) {
            error.textContent = message;
            error.classList.remove('hidden');
        }

        function clearError() {
            error.textContent = '';
            error.classList.add('hidden');
        }

        function validateFile(file) {
            clearError();

            if (!file) return false;

            const extension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(extension)) {
                showError('Format file harus XLSX, XLS, atau CSV.');
                return false;
            }

            if (file.size > maxSize) {
                showError('Ukuran file maksimal 5 MB.');
                return false;
            }

            return true;
        }

        function displayFile(file) {
            if (!validateFile(file)) {
                input.value = '';
                fileName.textContent = '';
                fileName.classList.add('hidden');
                return;
            }

            fileName.textContent = 'File dipilih: ' + file.name;
            fileName.classList.remove('hidden');
        }

        // Klik area untuk memilih file
        dropZone.addEventListener('click', function () {
            input.click();
        });

        // Aksesibilitas keyboard
        dropZone.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                input.click();
            }
        });

        // File dipilih melalui dialog
        input.addEventListener('change', function () {
            displayFile(input.files[0]);
        });

        // Mencegah browser membuka file yang di-drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function (event) {
                event.preventDefault();
                event.stopPropagation();
            });
        });

        // Efek ketika file berada di atas area
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, function () {
                dropZone.classList.add('border-[#c49c4d]', 'bg-amber-50');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function () {
                dropZone.classList.remove('border-[#c49c4d]', 'bg-amber-50');
            });
        });

        // File dijatuhkan ke area upload
        dropZone.addEventListener('drop', function (event) {
            const files = event.dataTransfer.files;

            if (!files.length) return;

            try {
                input.files = files;
                displayFile(input.files[0]);
            } catch (e) {
                showError('File gagal dipilih. Silakan gunakan tombol pilih file.');
            }
        });

        // Validasi sebelum submit
        form.addEventListener('submit', function (event) {
            if (!input.files.length) {
                event.preventDefault();
                showError('Silakan pilih file yang akan diimport.');
                return;
            }

            if (!validateFile(input.files[0])) {
                event.preventDefault();
            }
        });

        // Tutup modal jika klik area luar
        if (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    window.closeImportModal();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                window.closeImportModal();
            }
        });

        // Hilangkan pesan validasi Laravel setelah 10 detik
        const serverError = document.getElementById('file-error-message');

        if (serverError) {
            setTimeout(() => {
                serverError.classList.add('opacity-0');

                setTimeout(() => serverError.remove(), 500);
            }, 10000);
        }
    });
</script>