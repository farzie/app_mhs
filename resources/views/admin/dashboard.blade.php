<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal { transition: opacity 0.25s ease; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <header class="bg-indigo-700 text-white p-4 shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">Dashboard SIMUNS</h1>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white hover:bg-indigo-100 text-indigo-700 font-bold py-2 px-4 rounded-full shadow-md transition duration-200 text-base">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto mt-8 p-4">
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <p class="font-bold">Gagal menyimpan data!</p>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="create-section" class="bg-white shadow-xl rounded-lg p-6 mb-8 border-t-4 border-indigo-600">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                Tambah Data Mahasiswa Baru
            </h3>
            
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Jenjang - Prodi</label>
                    <input type="text" name="jenjang_prodi" value="{{ old('jenjang_prodi') }}" placeholder="Cth: Sarjana - Informatika" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status Saat Ini</label>
                    <input type="text" name="status_saat_ini" value="{{ old('status_saat_ini') }}" placeholder="Cth: Aktif, Lulus, Cuti" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Semester Awal</label>
                    <input type="text" name="semester_awal" value="{{ old('semester_awal') }}" placeholder="Cth: Ganjil 2023/2024" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status Awal Mahasiswa</label>
                    <input type="text" name="status_awal_mhs" value="{{ old('status_awal_mhs') }}" placeholder="Cth: Peserta Didik Baru" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md shadow-lg transition duration-150">
                        Simpan Data Mahasiswa
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-xl rounded-lg p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                Daftar Seluruh Data Mahasiswa UNS
            </h3>

            <div class="mb-4">
                <input type="text" id="search-input" onkeyup="filterTable()" placeholder="Cari berdasarkan Nama, NIM, atau Prodi..." class="w-full md:w-1/3 border border-gray-300 p-2 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="data-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(0)">NIM ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(1)">Nama ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(2)">Jenis Kelamin ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(3)">Jenjang Program Studi ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(4)">Tgl Masuk ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(5)">Semester Awal ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(6)">Status Awal ↓</th>
                            <th class="cursor-pointer px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" onclick="sortTable(7)">Status Saat Ini ↓</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    {{-- TAMBAHKAN ID UNTUK BODY TABEL --}}
                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                        @foreach ($mahasiswa as $mhs)
                            <tr data-mhs="{{ json_encode($mhs) }}">
                                <td class="px-3 py-4 whitespace-nowrap">{{ $mhs->nim }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">{{ $mhs->nama }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">{{ $mhs->jenis_kelamin }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">{{ $mhs->jenjang_prodi }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">{{ date('Y-m-d', strtotime($mhs->tanggal_masuk)) }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">{{ $mhs->semester_awal }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">{{ $mhs->status_awal_mhs }}</td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $mhs->status_saat_ini == 'Aktif' ? 'bg-green-100 text-green-800' : 
                                        ($mhs->status_saat_ini == 'Lulus' ? 'bg-indigo-100 text-indigo-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $mhs->status_saat_ini }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="openEditModal({{ $mhs->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        Edit
                                    </button>
                                    
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data {{ $mhs->nama }} ({{ $mhs->nim }})?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- KONTROL PAGINATION BARU --}}
            <div id="pagination-controls" class="mt-4 flex justify-between items-center border-t pt-4">
                <div class="text-sm text-gray-700">
                    Menampilkan <span id="start-index">1</span> hingga <span id="end-index">5</span> dari <span id="total-rows">0</span> data
                </div>
                <button onclick="changePage('first')" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                    &lt;&lt;
                </button>
                <button onclick="changePage(currentPage - 1)" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                    &lt;
                </button>
                <span id="page-info" class="px-3 py-1 text-sm font-medium text-gray-700">
                    Halaman 1
                </span>
                <button onclick="changePage(currentPage + 1)" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                    &gt;
                </button>
                <button onclick="changePage('last')" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300">
                    &gt;&gt;
                </button>
                </div>
            </div>
        </div>

    </main>
    
    <div id="edit-modal" class="modal fixed inset-0 bg-gray-600 bg-opacity-75 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-2xl">
            <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">
                Edit Data Mahasiswa
            </h3>
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" id="edit_nim" name="nim" required readonly class="w-full border border-gray-300 p-2 mt-1 rounded-md bg-gray-100">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="edit_nama" name="nama" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="edit_jenis_kelamin" name="jenis_kelamin" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700">Jenjang - Prodi</label>
                        <input type="text" id="edit_jenjang_prodi" name="jenjang_prodi" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                        <input type="date" id="edit_tanggal_masuk" name="tanggal_masuk" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Semester Awal</label>
                        <input type="text" id="edit_semester_awal" name="semester_awal" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Awal Mahasiswa</label>
                        <input type="text" id="edit_status_awal_mhs" name="status_awal_mhs" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Saat Ini</label>
                        <input type="text" id="edit_status_saat_ini" name="status_saat_ini" required class="w-full border border-gray-300 p-2 mt-1 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="md:col-span-4 flex justify-end space-x-3 mt-4">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md">
                            Batal
                        </button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // --- VARIABEL GLOBAL DAN INISIALISASI ---
        let sortDirection = {}; 
        const rowsPerPage = 5;
        let currentPage = 1;
        let totalPages = 1;
        
        // Ambil elemen tabel
        const table = document.getElementById('data-table');
        const headers = table.getElementsByTagName('TH');
        const tableBody = document.getElementById('table-body');
        const allRows = Array.from(tableBody.querySelectorAll('tr')); // Semua data dari Blade
        let filteredRows = [...allRows]; // Baris yang akan diproses (difilter/disort)

        // --- FUNGSI UTAMA RENDERING DAN PAGINATION ---
        
        function getCellValue(row, index) {
            // Mengambil nilai sel, menangani <span> di kolom Status Saat Ini (index 7)
            const cell = row.children[index];
            if (index === 7) {
                const span = cell.querySelector('span');
                return span ? span.textContent.trim() : cell.textContent.trim();
            }
            return cell.textContent.trim();
        }

        function renderTable() {
            const totalRowsCount = filteredRows.length;
            totalPages = Math.ceil(totalRowsCount / rowsPerPage);
            
            // Pastikan currentPage valid
            if (currentPage < 1) currentPage = 1;
            if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
            if (totalRowsCount === 0) currentPage = 1; 

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const pageRows = filteredRows.slice(start, end);

            // Membersihkan tabel body
            while (tableBody.firstChild) {
                tableBody.removeChild(tableBody.firstChild);
            }

            // Menambahkan baris atau pesan 'Data tidak ditemukan'
            if (totalRowsCount === 0) {
                const noDataRow = document.createElement('tr');
                noDataRow.innerHTML = `<td colspan="9" class="px-3 py-4 text-center text-gray-500">Data tidak ditemukan.</td>`;
                tableBody.appendChild(noDataRow);
            } else {
                pageRows.forEach(row => tableBody.appendChild(row));
            }
            
            updatePaginationInfo(totalRowsCount, totalPages);
        }

        function updatePaginationInfo(totalRowsCount, totalPages) {
            const startIndex = totalRowsCount === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
            const endIndex = Math.min(startIndex + rowsPerPage - 1, totalRowsCount);
            
            document.getElementById('start-index').textContent = startIndex;
            document.getElementById('end-index').textContent = endIndex;
            document.getElementById('total-rows').textContent = totalRowsCount;
            document.getElementById('page-info').textContent = `Halaman ${currentPage} dari ${totalPages}`;

            const isFirstPage = currentPage === 1;
            const isLastPage = currentPage === totalPages || totalPages === 0;
            
            // Mengatur disabled pada tombol navigasi
            document.querySelectorAll('.pagination-btn')[0].disabled = isFirstPage; // <<
            document.querySelectorAll('.pagination-btn')[1].disabled = isFirstPage; // <
            document.querySelectorAll('.pagination-btn')[2].disabled = isLastPage;  // >
            document.querySelectorAll('.pagination-btn')[3].disabled = isLastPage; // >>
        }

        function changePage(newPage) {
            let targetPage = newPage;

            // Logika untuk tombol First dan Last
            if (newPage === 'first') {
                targetPage = 1;
            } else if (newPage === 'last') {
                targetPage = totalPages;
            }

            // Memastikan halaman target berada dalam batas yang valid
            if (targetPage >= 1 && targetPage <= totalPages) {
                currentPage = targetPage;
                renderTable();
            } 
        }

        // --- FUNGSI SORTING ---
        
        function sortTable(columnIndex) {
            const currentDirection = sortDirection[columnIndex] === 'asc' ? 'desc' : 'asc';
            sortDirection[columnIndex] = currentDirection;

            // Atur ikon panah
            for (let i = 0; i < headers.length - 1; i++) {
                let text = headers[i].innerText.replace(' ↓', '').replace(' ↑', '');
                headers[i].innerHTML = text + (i === columnIndex ? (currentDirection === 'asc' ? ' ↑' : ' ↓') : ' ↓');
            }

            // Proses sorting
            filteredRows.sort((a, b) => {
                let aVal = getCellValue(a, columnIndex);
                let bVal = getCellValue(b, columnIndex);

                // Konversi tipe data untuk perbandingan yang tepat
                if (columnIndex === 4) { // Kolom Tanggal Masuk
                    aVal = new Date(aVal);
                    bVal = new Date(bVal);
                } else if (!isNaN(Number(aVal)) && !isNaN(Number(bVal))) { // Kolom Numerik
                    aVal = Number(aVal);
                    bVal = Number(bVal);
                } else { // Kolom String
                    aVal = String(aVal).toLowerCase();
                    bVal = String(bVal).toLowerCase();
                }

                let comparison = 0;
                if (aVal > bVal) { comparison = 1; } 
                else if (aVal < bVal) { comparison = -1; }
                
                return currentDirection === 'asc' ? comparison : comparison * -1;
            });

            currentPage = 1;
            renderTable();
        }

        // --- FUNGSI SEARCHING ---
        
        function filterTable() {
            const input = document.getElementById('search-input');
            const filter = input.value.toUpperCase();
            
            filteredRows = allRows.filter(row => {
                // Kolom yang dicari: NIM (0), Nama (1), Prodi (3)
                const nimText = getCellValue(row, 0).toUpperCase();
                const namaText = getCellValue(row, 1).toUpperCase();
                const prodiText = getCellValue(row, 3).toUpperCase();

                return (nimText.includes(filter) || 
                        namaText.includes(filter) || 
                        prodiText.includes(filter));
            });

            currentPage = 1;
            renderTable();
        }

        // --- FUNGSI MODAL (EDIT) ---
        
        function openEditModal(mahasiswaId) {
            const row = document.querySelector(`tr[data-mhs*='"id":${mahasiswaId}']`);
            if (!row) return;

            const mhsData = JSON.parse(row.getAttribute('data-mhs'));
            
            document.getElementById('edit_nim').value = mhsData.nim;
            document.getElementById('edit_nama').value = mhsData.nama;
            document.getElementById('edit_jenis_kelamin').value = mhsData.jenis_kelamin;
            document.getElementById('edit_jenjang_prodi').value = mhsData.jenjang_prodi;
            
            document.getElementById('edit_tanggal_masuk').value = mhsData.tanggal_masuk ? mhsData.tanggal_masuk.split(' ')[0] : '';
            
            document.getElementById('edit_semester_awal').value = mhsData.semester_awal;
            document.getElementById('edit_status_awal_mhs').value = mhsData.status_awal_mhs;
            document.getElementById('edit_status_saat_ini').value = mhsData.status_saat_ini;
            
            const form = document.getElementById('edit-form');
            form.action = `/admin/mahasiswa/${mahasiswaId}`;

            document.getElementById('edit-modal').classList.remove('hidden');
            document.getElementById('edit-modal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
            document.getElementById('edit-modal').classList.remove('flex');
        }

        // --- INISIALISASI AWAL ---
        document.addEventListener('DOMContentLoaded', () => {
            renderTable();
        });
    </script>
</body>
</html>