<?php
$obj_studies = new Studies();

$keyword = $_GET['keyword'] ?? ''; 

$rs = $obj_studies->cari($keyword);

if (isset($_SESSION['MEMBER'])) {
    $ar_judul = ['NO', 'NAMA SEKOLAH', 'JENJANG', 'TAHUN LULUS', 'KETERANGAN', 'FOTO', 'ACTION'];
} else {
    $ar_judul = ['NO', 'NAMA SEKOLAH', 'JENJANG', 'TAHUN LULUS', 'KETERANGAN', 'FOTO'];
}
?>

<h3>Hasil Pencarian Studies</h3>

<div class="d-flex justify-content-between mb-3">
    <div>
        <p>Menampilkan hasil untuk: <strong><?= htmlspecialchars($keyword) ?></strong></p>
        <a href="index.php?hal=studies_list" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Utama
        </a>
    </div>
    
    <?php if(isset($_SESSION['MEMBER'])) { ?>
        <a href="index.php?hal=studies_form" class="btn btn-primary h-50">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
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
        foreach($rs as $row) {
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_level'] ?></td> <td><?= $row['tahun_lulus'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td>
                <?php 
                $foto = (!empty($row['foto_sekolah'])) ? $row['foto_sekolah'] : 'nophoto.jpg';
                ?>
                <img src="IMG/<?= $foto ?>" width="70px" class="img-thumbnail" />
            </td>
            
            <?php if(isset($_SESSION['MEMBER'])) { ?>
            <td>
                <form method="POST" action="controller/studies.php">
                    <a href="index.php?hal=studies_detail&id=<?= $row['id'] ?>" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="index.php?hal=studies_form&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <?php if($_SESSION['MEMBER']['role'] == 'admin') { ?>
                        <button type="submit" name="proses" value="hapus" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">
                            <i class="bi bi-trash"></i>
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
        
        if(count($rs) == 0) {
            echo '<tr><td colspan="7" class="text-center text-danger">Data tidak ditemukan untuk kata kunci tersebut.</td></tr>';
        }
        ?>
    </tbody>
</table>