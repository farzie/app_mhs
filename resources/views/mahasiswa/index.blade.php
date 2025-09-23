@extends('template')

@section('content')
<h1>SIMA SISTEM MAHASISWA</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('mahasiswa.store') }}" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama Mahasiswa">
    <button type="submit">Tambah Mahasiswa</button>
</form>

<table border="1">
    <tr><th>ID</th><th>Nama</th><th>Aksi</th></tr>
    @foreach($mahasiswa as $mhs)
    <tr>
        <td>{{ $mhs->id }}</td>
        <td>{{ $mhs->nama }}</td>
        <td>
            <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <input type="text" name="nama" placeholder="Nama Baru">
                <button type="submit">Update</button>
            </form>
            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection