<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<?php $user = user() ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Selamat Datang, <?= $user->getDetail()->nama ?></h1>
</div>
<?php if (in_groups('Admin')) : ?>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type m-1">Mahasiswa</h4>
                <div class="stats-figure"><?= $mahasiswa ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type mb-1">Dosen</h4>
                <div class="stats-figure"><?= $dosen ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type mb-1">Mata Kuliah</h4>
                <div class="stats-figure"><?= $matkul ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type mb-1">Ruang</h4>
                <div class="stats-figure"><?= $ruang ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
</div>
<?php else : ?>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-4">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type mb-1">Mata Kuliah</h4>
                <div class="stats-figure"><?= $matkul ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type mb-1">Ujian Belum Selesai</h4>
                <div class="stats-figure"><?= $ujian_belum ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type mb-1">Ujian Sudah Selesai</h4>
                <div class="stats-figure"><?= $ujian_sudah ?></div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
</div>
<?php endif ?>

<?= $this->endSection() ?>