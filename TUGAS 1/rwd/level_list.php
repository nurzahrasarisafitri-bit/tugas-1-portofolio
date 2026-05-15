<?php
// 1. Ciptakan object dari class Level
$obj_level = new Level();
// 2. Panggil fungsi index untuk mendapatkan seluruh data level
$rs = $obj_level->index(); 

// 3. Tentukan judul kolom tabel berdasarkan status login
if (isset($_SESSION['MEMBER'])) {
    $ar_judul = ['NO', 'NAMA JENJANG', 'AKSI'];
} else {
    $ar_judul = ['NO', 'NAMA JENJANG'];
}
?>

<div class="container-fluid px-4">
    <h3 class="mt-4 text-primary">Daftar Jenjang Pendidikan</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?hal=home">Dashboard</a></li>
        <li class="breadcrumb-item active">Master Data Level</li>
    </ol>

    <?php if (isset($_SESSION['MEMBER'])) { ?>
        <a href="index.php?hal=level_form" class="btn btn-primary mb-3 shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Jenjang
        </a>
    <?php } ?>

    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-table me-1"></i> Data Level
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <?php
                        foreach ($ar_judul as $jdl) {
                            echo "<th>$jdl</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rs as $row) {
                    ?>
                        <tr>
                            <td width="10%"><?= $no ?></td>
                            <td><strong><?= $row['nama'] ?></strong></td>
                            
                            <?php if (isset($_SESSION['MEMBER'])) { ?>
                                <td width="20%">
                                    <form method="POST" action="controller/level.php">
                                        <a href="index.php?hal=level_form&id=<?= $row['id'] ?>" 
                                           title="Ubah Jenjang" class="btn btn-warning btn-sm shadow-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <?php if ($_SESSION['MEMBER']['role'] == 'admin') { ?>
                                            <button type="submit" name="proses" value="hapus" 
                                                    class="btn btn-danger btn-sm shadow-sm" 
                                                    onclick="return confirm('Anda yakin ingin menghapus jenjang <?= $row['nama'] ?>?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                        <?php } ?>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>