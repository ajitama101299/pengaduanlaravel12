<h2>Buat Pengaduan Baru</h2>
<form method="POST" action="{{ route('pengaduan.store') }}">
    @csrf
    <input type="text" name="judul" placeholder="Judul" required>
    <textarea name="isi" placeholder="Isi Pengaduan" required></textarea>
    <button type="submit">Kirim</button>
</form>
