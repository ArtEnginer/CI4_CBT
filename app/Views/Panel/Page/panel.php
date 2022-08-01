<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Dashboard</h1>
    <a href="#" class="btn app-btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
</div>
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <div class="app-icon-holder mb-2 dashboard">
                    <i class="bi bi-receipt"></i>
                </div>
                <h4 class="stats-type m-1">Mahasiswa</h4>
                <div class="stats-figure">3</div>
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
                <div class="stats-figure">5</div>
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
                <div class="stats-figure">8</div>
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
                <div class="stats-figure">6</div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Stats List</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="#">View report</a>
                        </div>
                        <!--//card-header-actions-->
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet eros vel diam
                    semper mollis.</div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>