<div style="font-family:Arial, sans-serif;color:#111">
    <h3>Notifikasi Perubahan Data oleh Admin</h3>

    <p>Hai {{ $user->nama ?? $user->akun }},</p>

    @if($action === 'created')
        <p>Data Anda telah <strong>ditambahkan</strong> oleh administrator.</p>
    @elseif($action === 'updated')
        <p>Data Anda telah <strong>diperbarui</strong> oleh administrator.</p>
    @elseif($action === 'deleted')
        <p>Data Anda telah <strong>dihapus</strong> oleh administrator.</p>
    @else
        <p>Ada perubahan pada data Anda oleh administrator.</p>
    @endif

    @if(!empty($details))
        <p>Rincian perubahan:</p>
        <ul>
            @foreach($details as $key => $value)
                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
            @endforeach
        </ul>
    @endif

    <p>Jika ada yang tidak sesuai, silakan hubungi administrator.</p>
    <p>Salam,<br>SIMUNS</p>
</div>