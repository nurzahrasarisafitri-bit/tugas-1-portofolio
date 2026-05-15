<?php
$keyword = $_GET['keyword'] ?? '';

if (isset($_SESSION['MEMBER'])) {
    $ar_judul = ['NO', 'NAMA SEKOLAH', 'JENJANG', 'TAHUN LULUS', 'KETERANGAN', 'FOTO', 'ACTION'];
} else {
    $ar_judul = ['NO', 'NAMA SEKOLAH', 'JENJANG', 'TAHUN LULUS', 'KETERANGAN', 'FOTO'];
}

$obj_studies = new Studies();

if (!empty($keyword)) {
    $rs = $obj_studies->cari($keyword);
} else {
    $rs = $obj_studies->index();
}
?>

<h3>Daftar Riwayat Pendidikan</h3>

<div class="d-flex justify-content-between mb-3">
    <?php if (isset($_SESSION['MEMBER'])) { ?>
        <a href="index.php?hal=studies_form" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Riwayat
        </a>
    <?php } ?>

    <?php if (!empty($keyword)) { ?>
        <div>
            Menampilkan hasil: <strong>"<?= htmlspecialchars($keyword) ?>"</strong> 
            <a href="index.php?hal=studies_list" class="btn btn-secondary btn-sm ms-2">Reset</a>
        </div>
    <?php } ?>
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <?php
            foreach($ar_judul as $jdl) {
                echo '<th>'.$jdl.'</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach($rs as $studies){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $studies['nama'] ?></td>
            <td><?= $studies['nama_level'] ?></td> <td><?= $studies['tahun_lulus'] ?></td>
            <td><?= $studies['keterangan'] ?></td>
            <td width="15%">
                <?php
                // Cek foto di folder IMG (pastikan huruf besar/kecil folder sesuai)
                if(!empty($studies['foto_sekolah'])){ ?>
                    <img src="IMG/<?= $studies['foto_sekolah'] ?>" width="100%" class="img-thumbnail" />
                <?php } else { ?>
                    <img src="IMG/nophoto.jpg" width="100%" class="img-thumbnail" />
                <?php } ?>
            </td>
            
            <?php if (isset($_SESSION['MEMBER'])) { ?> 
                <td>
                    <form method="POST" action="controller/studies.php">
                        <a href="index.php?hal=studies_detail&id=<?= $studies['id'] ?>"
                            title="Detail" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        
                        <a href="index.php?hal=studies_form&id=<?= $studies['id'] ?>"
                            title="Ubah" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <?php if ($_SESSION['MEMBER']['role'] == 'admin') { ?>
                            <button type="submit" title="Hapus" class="btn btn-danger btn-sm" 
                                    name="proses" value="hapus" onclick="return confirm('Yakin hapus data ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                            <input type="hidden" name="id" value="<?= $studies['id'] ?>" />
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