<?php
$obj_level = new Level();
$rs = $obj_level->index(); 

//------------proses edit data----------------
@$id = $_REQUEST['id']; 
$obj_studies = new Studies(); 
if(!empty($id)){
    $row = $obj_studies->getStudies($id); 
}
else {
    $row = []; 
}
?>
<div class="container px-5 my-5">
    <h3>Form Studies</h3>
    <form id="studiesForm" method="POST" action="controller/studies.php" enctype="multipart/form-data">
        
        <div class="form-floating mb-3">
            <input class="form-control" name="nama" value="<?= @$row['nama'] ?>" id="namaStudies" type="text" placeholder="Nama Sekolah/Instansi" required />
            <label for="namaStudies">Nama Sekolah / Instansi</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" name="idlevel" id="levelStudies" aria-label="Level Studies" required>
                <option value="">-- Pilih Jenjang --</option>
                <?php
                foreach($rs as $level){
                    $sel = ($level['id'] == @$row['idlevel']) ? "selected" : "" ;
                ?>
                <option value="<?= $level['id'] ?>" <?= $sel ?>><?= $level['nama'] ?></option>
                <?php } ?>
            </select>
            <label for="levelStudies">Jenjang Pendidikan</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" name="tahun_lulus" value="<?= @$row['tahun_lulus'] ?>" id="tahunLulus" type="number" placeholder="Tahun Lulus" required />
            <label for="tahunLulus">Tahun Lulus</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" style="height: 100px"><?= @$row['keterangan'] ?></textarea>
            <label for="keterangan">Keterangan / Alamat</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" name="foto_sekolah" id="fotoStudies" type="file" accept="image/*" />
            <label for="fotoStudies">Upload Foto Sekolah</label>
            <?php if(!empty($row['foto_sekolah']) && file_exists('IMG/' . $row['foto_sekolah'])): ?>
                <small class="d-block mt-2">Foto Saat Ini: <a href="IMG/<?= $row['foto_sekolah'] ?>" target="_blank"><?= $row['foto_sekolah'] ?></a></small>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <?php
            if(empty($id)){ 
            ?>
                <button class="btn btn-primary" name="proses" type="submit" value="simpan">Simpan</button>
            <?php
            }
            else{ 
            ?>
                <button class="btn btn-success" name="proses" type="submit" value="ubah">Ubah</button>
                <input type="hidden" name="idx" value="<?= $id ?>" />
            <?php } ?>
            <a href="index.php?hal=studies_list" class="btn btn-info">Kembali</a>
        </div>
    </form>
</div>