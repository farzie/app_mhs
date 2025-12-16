<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIMUNS</title>
    <meta name="theme-color" content="#4f46e5">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        .font-brand {
            font-family: 'Poppins', sans-serif;
        }
        .modal { transition: opacity 0.25s ease; }

        /* MENGATUR TAMPILAN KHUSUS MOBILE (di bawah 1024px) */
        .content-desktop {
            display: none;
        }
        .message-mobile {
            display: flex;
        }

        @media (min-width: 1024px) {
            .content-desktop {
                display: block;
            }
            .message-mobile {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-white min-h-screen font-brand antialiased">

    {{-- HEADER --}}
    <header class="bg-indigo-900 text-white p-4 shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-indigo-100 transition duration-300 ease-in-out flex items-center">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                <h1 class="text-3xl font-extrabold tracking-tight">
                    SIMUNS Admin
                </h1>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white hover:bg-indigo-100 text-indigo-700 font-extrabold py-2 px-6 rounded-full shadow-md transition duration-200 text-sm inline-flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </header>

    {{-- PESAN JIKA DIBUKA DI MOBILE (Tidak ada ** lagi) --}}
    <div class="message-mobile h-[calc(100vh-68px)] bg-white p-6 items-center justify-center text-center">
        <div class="max-w-md mx-auto">
            <svg class="w-20 h-20 mx-auto text-yellow-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9.25 21L14.25 21L13.75 17M12 4a8 8 0 100 16 8 8 0 000-16zM12 8v4m0 4h.01"></path></svg>
            <h2 class="text-3xl font-extrabold text-gray-800 mb-3">
                Mode Desktop Diperlukan
            </h2>
            <p class="text-gray-600 text-lg">
                Halaman <span class="font-bold text-gray-800">Dashboard Admin SIMUNS</span> hanya dapat diakses menggunakan <span class="font-bold text-gray-800">Desktop atau Laptop</span> untuk memastikan tampilan tabel data dan fitur pengelolaan dapat berfungsi optimal.
            </p>
            <p class="text-gray-600 mt-4 font-semibold">
                Silakan buka halaman ini di perangkat dengan resolusi layar yang lebih besar.
            </p>
        </div>
    </div>

    {{-- KONTEN UTAMA (HANYA TAMPIL DI DESKTOP/LAYAR LEBAR) --}}
    <main class="content-desktop max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 pb-12">

        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-6 tracking-wide">
            Dashboard Administrasi
        </h1>

        {{-- Alert Section (diganti SweetAlert) --}}
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: @json(session('success')),
                        confirmButtonColor: '#4f46e5'
                    });
                });
            </script>
        @endif

        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const errors = @json($errors->all());
                    const html = errors.map(e => `<li>${e}</li>`).join('');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menyimpan data!',
                        html: `<ul style="text-align:left;margin:0 0 0 1.2rem">${html}</ul>`,
                        confirmButtonColor: '#e11d48'
                    });
                });
            </script>
        @endif

        {{-- 1. TAMBAH DATA MAHASISWA (Dibuat lebih datar) --}}
        <div id="create-section" class="">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Data Mahasiswa Baru
            </h3>

            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @csrf

                {{-- Baris 1 --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Baris 2 --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenjang - Prodi</label>
                    <input type="text" name="jenjang_prodi" value="{{ old('jenjang_prodi') }}" placeholder="Cth: S1 - Informatika" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status Saat Ini</label>
                    <select name="status_saat_ini" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white">
                        <option value="">Pilih</option>
                        <option value="Aktif" {{ old('status_saat_ini') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Lulus" {{ old('status_saat_ini') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                        <option value="Cuti" {{ old('status_saat_ini') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="Mengundurkan Diri" {{ old('status_saat_ini') == 'Mengundurkan Diri' ? 'selected' : '' }}>Mengundurkan Diri</option>
                        <option value="Hilang" {{ old('status_saat_ini') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                </div>

                {{-- Baris 3 --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Semester Awal</label>
                    <input type="text" name="semester_awal" value="{{ old('semester_awal') }}" placeholder="Cth: Ganjil 2023/2024" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status Awal Mahasiswa</label>
                    <select name="status_awal_mhs" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white">
                        <option value="">Pilih</option>
                        <option value="Peserta Didik Baru" {{ old('status_awal_mhs') == 'Peserta Didik Baru' ? 'selected' : '' }}>Peserta Didik Baru</option>
                        <option value="Pindahan" {{ old('status_awal_mhs') == 'Pindahan' ? 'selected' : '' }}>Pindahan</option>
                    </select>
                </div>

                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-150 inline-flex items-center text-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-9-6a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>

        {{-- 2. DAFTAR DATA MAHASISWA (Dibuat lebih datar) --}}
        <div class="">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Daftar Seluruh Data Mahasiswa UNS
            </h3>

            <div class="mb-6 flex space-x-2">
                <input type="text" id="search-input" onkeyup="filterTable()" placeholder="Cari berdasarkan kata kunci (Nama, NIM, atau Prodi)..." class="w-[80%] lg:w-1/3 border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                <button onclick="exportToCSV()" class=" bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-3 rounded-lg shadow-md transition duration-150 inline-flex items-center text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2v-4a2 2 0 012-2h10a2 2 0 012 2v4a2 2 0 01-2 2z"></path></svg>
                    Export CSV (<span id="export-count">0</span>) Data
                </button>

                {{-- FORM IMPORT CSV --}}
                <form action="{{ route('admin.mahasiswa.import') }}" method="POST" enctype="multipart/form-data" class="inline-flex items-center space-x-2">
                    @csrf
                    <div class="flex items-center space-x-2">
                        <input type="file" name="csv_file" id="csv_file" accept=".csv,text/csv" class="hidden">
                        <label for="csv_file" class="inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-3 rounded-md text-sm cursor-pointer">
                            Pilih File
                        </label>
                        <div id="csv-file-status" class="inline-flex items-center space-x-2">
                            <span id="csv-file-icon" class="hidden text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span id="csv-file-name" class="text-sm text-gray-600 max-w-[220px] truncate" title="Tidak ada file yang dipilih">Tidak ada file yang dipilih</span>
                        </div>
                    </div>
                        <button type="submit" id="csv-upload-btn" disabled class="ml-2 bg-indigo-400 cursor-not-allowed text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 text-sm">
                            Upload
                        </button>
                        <script>
                            // Compact file input: update displayed filename + icon when file selected
                            const csvInput = document.getElementById('csv_file');
                            const csvNameSpan = document.getElementById('csv-file-name');
                            const csvIcon = document.getElementById('csv-file-icon');
                            const uploadBtn = document.getElementById('csv-upload-btn');
                            if (csvInput && csvNameSpan) {
                                csvInput.addEventListener('change', function() {
                                    const file = this.files && this.files.length ? this.files[0] : null;
                                    if (file) {
                                        csvNameSpan.textContent = file.name;
                                        csvNameSpan.title = file.name;
                                        if (csvIcon) csvIcon.classList.remove('hidden');
                                        if (uploadBtn) {
                                            uploadBtn.disabled = false;
                                            uploadBtn.classList.remove('bg-indigo-400','cursor-not-allowed');
                                            uploadBtn.classList.add('bg-indigo-600');
                                        }
                                    } else {
                                        csvNameSpan.textContent = 'Tidak ada file yang dipilih';
                                        csvNameSpan.title = 'Tidak ada file yang dipilih';
                                        if (csvIcon) csvIcon.classList.add('hidden');
                                        if (uploadBtn) {
                                            uploadBtn.disabled = true;
                                            uploadBtn.classList.add('bg-indigo-400','cursor-not-allowed');
                                            uploadBtn.classList.remove('bg-indigo-600');
                                        }
                                    }
                                });
                            }
                        </script>
                    </button>
                </form>

                {{-- DOWNLOAD TEMPLATE CSV --}}
                <a href="{{ route('admin.mahasiswa.template') }}" class="ml-3 inline-flex items-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-3 rounded-md text-sm">
                    Download Template CSV
                </a>
            </div>
            {{-- Tabel Data --}}
            <div class="overflow-x-auto border border-gray-200 rounded-md">
                <table class="min-w-full divide-y divide-gray-200" id="data-table">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" onclick="sortTable(0)">NIM ↓</th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" onclick="sortTable(1)">Nama ↓</th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" onclick="sortTable(2)">J.K. ↓</th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" onclick="sortTable(3)">Prodi ↓</th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" onclick="sortTable(4)">Tgl Masuk ↓</th>
                            <th class="cursor-pointer px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" onclick="sortTable(7)">Status Saat Ini ↓</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                            {{-- Kolom yang disembunyikan untuk tampilan bersih --}}
                            <th class="hidden">Semester Awal</th>
                            <th class="hidden">Status Awal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                        @foreach ($mahasiswa as $mhs)
                            <tr data-mhs="{{ json_encode($mhs) }}" class="hover:bg-gray-50 transition duration-100">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $mhs->nim }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mhs->nama }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mhs->jenis_kelamin }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $mhs->jenjang_prodi }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ date('Y-m-d', strtotime($mhs->tanggal_masuk)) }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 hidden">{{ $mhs->semester_awal }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 hidden">{{ $mhs->status_awal_mhs }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $mhs->status_saat_ini == 'Aktif' ? 'bg-green-100 text-green-800' :
                                        ($mhs->status_saat_ini == 'Lulus' ? 'bg-indigo-100 text-indigo-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $mhs->status_saat_ini }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="openEditModal({{ $mhs->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3 font-semibold">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs) }}" method="POST" class="inline delete-form" data-nama="{{ $mhs->nama }}" data-nim="{{ $mhs->nim }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- KONTROL PAGINATION --}}
            <div id="pagination-controls" class="mt-4 flex flex-wrap justify-between items-center border-t pt-4">
                <div class="text-sm text-gray-700 mb-2 sm:mb-0">
                    Menampilkan <span id="start-index" class="font-semibold">1</span> hingga <span id="end-index" class="font-semibold">5</span> dari <span id="total-rows" class="font-semibold">0</span> data
                </div>
                <div class="space-x-1 flex">
                    <button onclick="changePage('first')" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150">
                        &lt;&lt; Awal
                    </button>
                    <button onclick="changePage(currentPage - 1)" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150">
                        &lt; Sebelumnya
                    </button>
                    <span id="page-info" class="px-3 py-1 text-sm font-bold text-indigo-700 bg-indigo-100 rounded-md">
                        Halaman 1
                    </span>
                    <button onclick="changePage(currentPage + 1)" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150">
                        Berikutnya &gt;
                    </button>
                    <button onclick="changePage('last')" class="pagination-btn px-3 py-1 text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150">
                        Akhir &gt;&gt;
                    </button>
                </div>
            </div>
        </div>


    </main>

    {{-- MODAL EDIT --}}
    <div id="edit-modal" class="modal fixed inset-0 bg-gray-900 bg-opacity-70 hidden items-center justify-center z-50 transition duration-300" onclick="if(event.target.id === 'edit-modal') closeEditModal()">
        <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition duration-300 scale-100">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 flex justify-between items-center">
                <span>Edit Data Mahasiswa</span>
                <button type="button" onclick="closeEditModal()" class="text-gray-500 hover:text-gray-900 text-3xl leading-none">&times;</button>
            </h3>
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NIM</label>
                        <input type="text" id="edit_nim" name="nim" required readonly class="w-full border border-gray-200 p-3 rounded-md bg-gray-100 cursor-not-allowed text-gray-600">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="edit_nama" name="nama" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select id="edit_jenis_kelamin" name="jenis_kelamin" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenjang - Prodi</label>
                        <input type="text" id="edit_jenjang_prodi" name="jenjang_prodi" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                    </div>

                    {{-- PERUBAHAN TANGGAL MASUK: Tipe kembali ke TEXT dan diberi placeholder format DD/MM/YYYY --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Masuk</label>
                        <input type="text" id="edit_tanggal_masuk" name="tanggal_masuk" placeholder="Cth: 31/08/2023" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                        <small id="date-warning" class="text-red-500 hidden mt-1">Format tanggal salah. Gunakan DD/MM/YYYY.</small>
                    </div>
                    {{-- SEMESTER AWAL DIPINDAHKAN KE SINI --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester Awal</label>
                        <input type="text" id="edit_semester_awal" name="semester_awal" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status Awal Mahasiswa</label>
                        <select id="edit_status_awal_mhs" name="status_awal_mhs" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white">
                            <option value="Peserta Didik Baru">Peserta Didik Baru</option>
                            <option value="Pindahan">Pindahan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status Saat Ini</label>
                        <select id="edit_status_saat_ini" name="status_saat_ini" required class="w-full border border-gray-300 p-3 rounded-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 bg-white">
                            <option value="Aktif">Aktif</option>
                            <option value="Lulus">Lulus</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                            <option value="Hilang">Hilang</option>
                        </select>
                    </div>

                    <div class="md:col-span-4 flex justify-end space-x-3 mt-4">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-150">
                            Batal
                        </button>
                        <button type="submit" id="save-edit-button" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-150 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
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

        const table = document.getElementById('data-table');
        const headers = table.getElementsByTagName('TH');
        const tableBody = document.getElementById('table-body');
        const allRows = Array.from(tableBody.querySelectorAll('tr'));
        let filteredRows = [...allRows];

        // --- FUNGSI UTAMA RENDERING DAN PAGINATION ---

        function getCellValue(row, index) {
            // Index data kolom: NIM(0), Nama(1), JK(2), Prodi(3), TglMasuk(4), SemesterAwal(5-hidden), StatusAwal(6-hidden), StatusSaatIni(7), Aksi(8)
            const allCells = row.querySelectorAll('td');
            const targetCell = allCells[index];
            if (!targetCell) return ''; // Handle case where index is out of bounds (e.g., trying to sort 'Aksi')

            if (index === 7) { // Kolom Status Saat Ini
                const span = targetCell.querySelector('span');
                return span ? span.textContent.trim() : targetCell.textContent.trim();
            }
            return targetCell.textContent.trim();
        }

        function renderTable() {
            const totalRowsCount = filteredRows.length;
            totalPages = Math.ceil(totalRowsCount / rowsPerPage);

            if (currentPage < 1) currentPage = 1;
            if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
            if (totalRowsCount === 0) currentPage = 1;

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const pageRows = filteredRows.slice(start, end);

            while (tableBody.firstChild) {
                tableBody.removeChild(tableBody.firstChild);
            }

            if (totalRowsCount === 0) {
                const noDataRow = document.createElement('tr');
                noDataRow.innerHTML = `<td colspan="9" class="px-4 py-6 text-center text-gray-500 font-medium">Data tidak ditemukan.</td>`;
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

            // **PERUBAHAN UNTUK UPDATE JUMLAH DATA DI TOMBOL EXPORT**
            document.getElementById('export-count').textContent = totalRowsCount;
            // **AKHIR PERUBAHAN**

            const isFirstPage = currentPage === 1;
            const isLastPage = currentPage === totalPages || totalPages === 0;

            const buttons = document.querySelectorAll('.pagination-btn');
            if (buttons.length >= 4) {
                buttons[0].disabled = isFirstPage;
                buttons[1].disabled = isFirstPage;
                buttons[2].disabled = isLastPage;
                buttons[3].disabled = isLastPage;
            }
        }

        function changePage(newPage) {
            let targetPage = newPage;

            if (newPage === 'first') {
                targetPage = 1;
            } else if (newPage === 'last') {
                targetPage = totalPages;
            }

            if (targetPage >= 1 && targetPage <= totalPages) {
                currentPage = targetPage;
                renderTable();
            }
        }

        // --- FUNGSI SORTING ---

        function sortTable(columnIndex) {
            // Kolom index data: 0:NIM, 1:Nama, 2:JK, 3:Prodi, 4:TglMasuk, [5: Semester Awal], [6: Status Awal], 7: Status Saat Ini, 8: Aksi
            if (columnIndex === 8) return; // Jangan sort kolom 'Aksi'

            const currentDirection = sortDirection[columnIndex] === 'asc' ? 'desc' : 'asc';
            sortDirection[columnIndex] = currentDirection;

            // Teks Header untuk mengatur ikon panah
            const headerTexts = ["NIM", "Nama", "J.K.", "Prodi", "Tgl Masuk", "Semester Awal", "Status Awal", "Status Saat Ini", "Aksi"];

            // Atur ikon panah pada kolom yang terlihat (0, 1, 2, 3, 4, 7)
            const visibleHeaderIndices = [0, 1, 2, 3, 4, 7, 8]; // Mapping ke index data
            const visibleHeaders = [headers[0], headers[1], headers[2], headers[3], headers[4], headers[5], headers[6]]; // Menggunakan index header yang sebenarnya (0 sampai 6)

            for (let i = 0; i < visibleHeaders.length; i++) {
                let dataIndex = visibleHeaderIndices[i];
                let text = headerTexts[dataIndex];

                if (dataIndex !== 8) { // Kolom yang bisa di-sort (Index 0-5 dari visibleHeaders)
                    visibleHeaders[i].innerHTML = text + ' ↓'; // Reset default
                    if (dataIndex === columnIndex) {
                        visibleHeaders[i].innerHTML = text + (currentDirection === 'asc' ? ' ↑' : ' ↓');
                    }
                }
            }


            // Proses sorting
            filteredRows.sort((a, b) => {
                const aCells = a.querySelectorAll('td');
                const bCells = b.querySelectorAll('td');

                let aVal = getCellValue(a, columnIndex);
                let bVal = getCellValue(b, columnIndex);

                // Konversi tipe data
                if (columnIndex === 4) { // Kolom Tanggal Masuk
                    aVal = new Date(aVal);
                    bVal = new Date(bVal);
                } else if (columnIndex === 0 && !isNaN(Number(aVal)) && !isNaN(Number(bVal))) { // Kolom NIM (Numerik)
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
            const searchString = input.value.toUpperCase().trim();

            if (searchString === "") {
                filteredRows = [...allRows];
            } else {
                const keywords = searchString.split(/\s+/).filter(k => k.length > 0);

                filteredRows = allRows.filter(row => {
                    const allCells = row.querySelectorAll('td');
                    // Ambil teks dari kolom yang dicari: NIM (0), Nama (1), Prodi (3)
                    const nimText = allCells[0].textContent.toUpperCase();
                    const namaText = allCells[1].textContent.toUpperCase();
                    const prodiText = allCells[3].textContent.toUpperCase();

                    const rowText = `${nimText} ${namaText} ${prodiText}`;

                    // Cek apakah SEMUA kata kunci ditemukan dalam teks baris
                    return keywords.every(keyword => rowText.includes(keyword));
                });
            }

            currentPage = 1;
            renderTable();
        }

        // ===============================================
        // --- FUNGSI MODAL EDIT (Diperbarui) ---
        // ===============================================

        /**
         * Konversi tanggal dari format YYYY-MM-DD (database) ke DD/MM/YYYY (tampilan user)
         */
        function formatDateToDMY(dateString) {
            if (!dateString) return '';
            // Asumsi dateString sudah dalam format YYYY-MM-DD
            const [year, month, day] = dateString.split('-');
            return `${day}/${month}/${year}`;
        }

        /**
         * Konversi tanggal dari format DD/MM/YYYY (input user) ke YYYY-MM-DD (format kirim)
         */
        function formatDateToYMD(dateString) {
            if (!dateString) return '';
            const parts = dateString.split('/');
            if (parts.length === 3) {
                // parts[0]=DD, parts[1]=MM, parts[2]=YYYY
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }
            return '';
        }

        /**
         * Fungsi untuk validasi format tanggal DD/MM/YYYY
         */
        function validateDate(dateString) {
            const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/;
            return regex.test(dateString);
        }

        function openEditModal(mahasiswaId) {
            const row = allRows.find(r => {
                const mhsData = JSON.parse(r.dataset.mhs);
                return mhsData.id === mahasiswaId;
            });

            if (!row) {
                console.error("Data mahasiswa tidak ditemukan untuk ID:", mahasiswaId);
                return;
            }

            const mhs = JSON.parse(row.dataset.mhs);
            const editForm = document.getElementById('edit-form');
            const modal = document.getElementById('edit-modal');

            // Set action form
            editForm.action = `/admin/mahasiswa/${mahasiswaId}`; // Ganti dengan route yang benar di Laravel

            // Isi nilai-nilai form
            document.getElementById('edit_nim').value = mhs.nim;
            document.getElementById('edit_nama').value = mhs.nama;
            document.getElementById('edit_jenjang_prodi').value = mhs.jenjang_prodi;

            // PERUBAHAN UTAMA DI SINI:
            // 1. Pastikan mhs.tanggal_masuk diubah menjadi string, lalu split untuk menghilangkan time/timezone.
            // 2. Jika mhs.tanggal_masuk adalah objek, konversi ke string dulu. Jika string, gunakan langsung.
            let rawDate = String(mhs.tanggal_masuk);

            // Baris ini akan memecah '2023-08-31 T00:00:00.000000Z' menjadi '2023-08-31'
            const dateYMD = rawDate.split(' ')[0].split('T')[0];

            // Mengisi Tanggal Masuk dengan format DD/MM/YYYY
            document.getElementById('edit_tanggal_masuk').value = formatDateToDMY(dateYMD);

            document.getElementById('edit_semester_awal').value = mhs.semester_awal;

            // Mengisi nilai default untuk elemen SELECT
            document.getElementById('edit_jenis_kelamin').value = mhs.jenis_kelamin;
            document.getElementById('edit_status_awal_mhs').value = mhs.status_awal_mhs;
            document.getElementById('edit_status_saat_ini').value = mhs.status_saat_ini;

            // Reset validasi
            document.getElementById('date-warning').classList.add('hidden');
            document.getElementById('save-edit-button').disabled = false;

            // Tampilkan modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // --- EVENT LISTENER UNTUK VALIDASI DAN RE-FORMAT TANGGAL SAAT SUBMIT ---
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            const dateInput = document.getElementById('edit_tanggal_masuk');
            const dateWarning = document.getElementById('date-warning');
            const saveButton = document.getElementById('save-edit-button');

            const originalDate = dateInput.value.trim();

            if (!validateDate(originalDate)) {
                e.preventDefault();
                dateWarning.classList.remove('hidden');
                saveButton.disabled = true;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Format tanggal harus DD/MM/YYYY.',
                    confirmButtonColor: '#e11d48'
                }).then(() => dateInput.focus());
            } else {
                // Hapus peringatan
                dateWarning.classList.add('hidden');
                saveButton.disabled = false;

                // Konversi nilai input tanggal ke format YYYY-MM-DD sebelum dikirim ke backend Laravel
                const formattedDate = formatDateToYMD(originalDate);
                dateInput.value = formattedDate; // Nilai ini yang akan dikirim saat submit
            }
        });

        // --- EVENT LISTENER UNTUK HIDE WARNING SAAT INPUT BERUBAH ---
        document.getElementById('edit_tanggal_masuk').addEventListener('input', function() {
            document.getElementById('date-warning').classList.add('hidden');
            document.getElementById('save-edit-button').disabled = false;
        });

        function exportToCSV() {
            const searchInput = document.getElementById('search-input').value.trim();
            // Ambil semua header kolom yang terlihat (0, 1, 2, 3, 4, 7) + 5, 6
            // Kolom visible: 0:NIM, 1:Nama, 2:JK, 3:Prodi, 4:TglMasuk, 7:StatusSaatIni
            // Kolom hidden: 5:SemesterAwal, 6:StatusAwal
            const columnIndices = [0, 1, 2, 3, 4, 5, 6, 7];
            const headerLabels = [
                'NIM', 'Nama', 'Jenis Kelamin', 'Jenjang - Prodi',
                'Tanggal Masuk', 'Semester Awal', 'Status Awal Mahasiswa', 'Status Saat Ini'
            ];

            let csv = headerLabels.join(',') + '\n';

            filteredRows.forEach(row => {
                const cols = row.querySelectorAll('td');
                const rowData = columnIndices.map(i => {
                    let cellValue = getCellValue(row, i);
                    // Bersihkan data dari koma (ganti dengan spasi atau hilangkan) dan pastikan diapit kutip
                    cellValue = cellValue.replace(/"/g, '""'); // Escaping double quotes
                    if (cellValue.includes(',') || cellValue.includes('\n') || cellValue.includes('"')) {
                        cellValue = `"${cellValue}"`;
                    }
                    return cellValue;
                });
                csv += rowData.join(',') + '\n';
            });

            // Buat nama file
            const date = new Date().toISOString().slice(0, 10); // YYYY-MM-DD
            let filename = `Data_Mahasiswa_UNS_${date}`;

            if (searchInput) {
                // Bersihkan input search untuk nama file
                const safeSearch = searchInput.replace(/[^a-z0-9]/gi, '_').substring(0, 30);
                filename += `_Filter_${safeSearch}`;
            }

            filename += '.csv';

            // Proses download
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');

            if (link.download !== undefined) {
                const url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download', filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            console.log(`Exported ${filteredRows.length} rows to ${filename}`);
        }

        // --- INISIALISASI ---

        document.addEventListener('DOMContentLoaded', () => {
            renderTable();

            // Attach SweetAlert confirmation to delete forms
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const nama = this.dataset.nama || '';
                    const nim = this.dataset.nim || '';
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        html: `Yakin ingin menghapus data <strong>${nama}</strong> (${nim})?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then(result => {
                        if (result.isConfirmed) {
                            // submit the form programmatically
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
