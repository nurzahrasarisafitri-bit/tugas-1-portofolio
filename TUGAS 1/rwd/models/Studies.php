<?php
class Studies
{
    private $koneksi;

    public function __construct()
    {
        global $dbh; 
        if ($dbh) {
            $this->koneksi = $dbh;
        } else {
            include_once 'koneksi.php';
            $this->koneksi = $dbh;
        }
    }

    // 1. Mengambil semua data
    public function index()
    {
        try {
            $sql = "SELECT studies.*, level.nama AS nama_level
                    FROM studies 
                    INNER JOIN level ON level.id = studies.idlevel
                    ORDER BY studies.id DESC";
            $rs = $this->koneksi->query($sql);
            return $rs;
        } catch (PDOException $e) {
            die("Error Index: " . $e->getMessage());
        }
    }

    // 2. Menyimpan data baru (Optimasi Line 31)
    public function simpan($data)
    {
        try {
            $sql = "INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah)
                    VALUES (?, ?, ?, ?, ?)";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute($data);
        } catch (PDOException $e) {
            // Menangkap error 'Server gone away' atau paket terlalu besar
            die("Gagal Simpan: " . $e->getMessage());
        }
    }

    // 3. Mengambil satu data spesifik
    public function getStudies($id)
    {
        try {
            $sql = "SELECT studies.*, level.nama AS nama_level
                    FROM studies
                    INNER JOIN level ON level.id = studies.idlevel
                    WHERE studies.id = ?";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute([$id]);
            return $ps->fetch();
        } catch (PDOException $e) {
            die("Error Detail: " . $e->getMessage());
        }
    }

    // 4. Memperbarui data
    public function ubah($data)
    {
        try {
            $sql = "UPDATE studies SET 
                    nama = ?, 
                    idlevel = ?, 
                    keterangan = ?, 
                    tahun_lulus = ?, 
                    foto_sekolah = ? 
                    WHERE id = ?";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute($data);
        } catch (PDOException $e) {
            die("Error Update: " . $e->getMessage());
        }
    }

    // 5. Menghapus data
    public function hapus($id)
    {
        try {
            $sql = "DELETE FROM studies WHERE id = ?";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute([$id]);
        } catch (PDOException $e) {
            die("Error Hapus: " . $e->getMessage());
        }
    }

    // 6. Mencari data
    public function cari($keyword)
    {
        try {
            $sql = "SELECT studies.*, level.nama AS nama_level
                    FROM studies 
                    INNER JOIN level ON level.id = studies.idlevel
                    WHERE studies.nama LIKE ? OR level.nama LIKE ?
                    ORDER BY studies.id DESC";
            $ps = $this->koneksi->prepare($sql);
            $key = "%$keyword%";
            $ps->execute([$key, $key]); 
            return $ps->fetchAll();
        } catch (PDOException $e) {
            die("Error Cari: " . $e->getMessage());
        }
    }
}