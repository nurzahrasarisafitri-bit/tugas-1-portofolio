<?php
include_once '../koneksi.php';
include_once '../models/Studies.php';

$nama = $_POST['nama'] ?? '';
$idlevel = $_POST['idlevel'] ?? '';
$keterangan = $_POST['keterangan'] ?? '';
$tahun_lulus = $_POST['tahun_lulus'] ?? '';
$tombol = $_POST['proses'] ?? '';
$idx = $_POST['idx'] ?? ''; // ID untuk proses ubah

$foto_sekolah = '';

if (isset($_FILES['foto_sekolah']) && $_FILES['foto_sekolah']['error'] == 0) {
    // Jika ada file baru yang diupload
    $file_tmp = $_FILES['foto_sekolah']['tmp_name'];
    $file_name = $_FILES['foto_sekolah']['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    
    // Nama file baru agar unik
    $foto_sekolah = 'studies_' . time() . '.' . $file_ext;
    $upload_dir = '../IMG/';

    // Buat folder jika belum ada
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    // Pindahkan file
    move_uploaded_file($file_tmp, $upload_dir . $foto_sekolah);
} else {
    // Jika tidak ada upload file baru
    if ($tombol == 'ubah' && !empty($idx)) {
        // Ambil nama foto lama dari database agar tidak hilang saat update
        $obj_temp = new Studies();
        $current_data = $obj_temp->getStudies($idx);
        $foto_sekolah = $current_data['foto_sekolah'];
    } else {
        $foto_sekolah = ''; // Untuk simpan baru tanpa foto
    }
}

$data = [
    $nama,          // ? 1
    $idlevel,       // ? 2
    $keterangan,    // ? 3
    $tahun_lulus,   // ? 4
    $foto_sekolah,  // ? 5
];

$obj_studies = new Studies();

switch ($tombol) {
    case 'simpan':
        $obj_studies->simpan($data);
        break;

    case 'ubah':
        $data[] = $idx; // ? 6 untuk WHERE id = ?
        $obj_studies->ubah($data);
        break;

    case 'hapus':
        $id_hapus = $_POST['id'] ?? '';
        $obj_studies->hapus($id_hapus);
        break;
}

header('Location: ../index.php?hal=studies_list');
exit;