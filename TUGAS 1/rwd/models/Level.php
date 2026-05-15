<?php
class Level
{
    private $koneksi;

    public function __construct()
    {
        // Mengambil variabel koneksi $dbh dari file koneksi.php
        global $dbh;
        $this->koneksi = $dbh;
    }

    /**
     * Mengambil semua data jenjang pendidikan
     */
    public function index()
    {
        $sql = "SELECT * FROM level ORDER BY id DESC";
        // Menggunakan query langsung karena tidak ada parameter
        return $this->koneksi->query($sql);
    }

    /**
     * Mengambil satu data berdasarkan ID (untuk mode Edit/Detail)
     */
    public function getLevel($id)
    {
        $sql = "SELECT * FROM level WHERE id = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch();
    }

    /**
     * Menambah data level baru
     */
    public function simpan($data)
    {
        $sql = "INSERT INTO level (nama) VALUES (?)";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    /**
     * Mengubah data level yang sudah ada
     */
    public function ubah($data)
    {
        // Parameter: [nama, id]
        $sql = "UPDATE level SET nama=? WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute($data);
    }

    /**
     * Menghapus data level
     */
    public function hapus($id)
    {
        $sql = "DELETE FROM level WHERE id = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
    }
}