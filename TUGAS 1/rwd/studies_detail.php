<?php
$id = $_REQUEST['id']; 
$model = new Studies(); 
$rs = $model->getStudies($id); 
?>

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <?php
            if (!empty($rs['foto_sekolah']) && file_exists('IMG/' . $rs['foto_sekolah'])) {
            ?>
                <img src="IMG/<?= $rs['foto_sekolah'] ?>" class="img-fluid rounded-start" alt="Foto Sekolah" />
            <?php
            } else {
            ?>
                <img src="IMG/nophoto.jpg" class="img-fluid rounded-start" alt="No Photo" />
            <?php } ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $rs['nama'] ?></h5>
                
                <p class="card-text">
                    <strong>Jenjang:</strong> <?= $rs['nama_level'] ?> <br />
                    
                    <strong>Tahun Lulus:</strong> <?= $rs['tahun_lulus'] ?> <br />
                    
                    <strong>Keterangan:</strong> <br />
                    <?= $rs['keterangan'] ?>
                </p>
                
                <p class="card-text">
                    <a href="index.php?hal=studies_list" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>