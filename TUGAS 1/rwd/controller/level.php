<?php
include_once '../koneksi.php';
include_once '../models/Level.php';

$proses = $_POST['proses'] ?? '';
$nama = $_POST['nama'] ?? '';
$idx = $_POST['idx'] ?? ''; // Untuk Update
$id_hapus = $_POST['id'] ?? ''; // Untuk Hapus (dari list)

$obj_level = new Level();

switch ($proses) {
    case 'simpan':
        if (!empty($nama)) $obj_level->simpan([$nama]);
        break;

    case 'ubah':
        if (!empty($nama) && !empty($idx)) $obj_level->ubah([$nama, $idx]);
        break;

    case 'hapus':
        if (!empty($id_hapus)) $obj_level->hapus($id_hapus);
        break;
}

header('Location: ../index.php?hal=level_list');
exit;