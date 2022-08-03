<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Data Ujian</h1>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Detail Ujian <?= $item->kuliah->matkul->nama ?></h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <table class="table">
                    <tr>
                        <th>Mata Kuliah</th>
                        <td>: <?= $item->kuliah->matkul->nama ?></td>
                    </tr>
                    <tr>
                        <th>Ruang Ujian</th>
                        <td>: <?= $item->ruang->nama ?></td>
                    </tr>
                    <tr>
                        <th>Waktu Ujian</th>
                        <td>: <?= $item->waktu ?></td>
                    </tr>
                    <tr>
                        <th>Durasi</th>
                        <td>: <?= $item->tenggat ?> menit</td>
                    </tr>
                    <tr>
                        <th>Tipe</th>
                        <td>: <?= $item->tipe ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: <span class="badge bg-<?= $item->status->getStyle() ?>"><?= $item->status ?></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Token Ujian</th>
                        <td>: <?= $item->token_ujian ?></td>
                    </tr>
                    <tr>
                        <th>Token Akses</th>
                        <td>: <?= $item->token_akses ?></td>
                    </tr>
                </table>
                <div class="text-center">
                    <a href="<?= route_to('ujian-data') ?>" role="button" class="btn app-btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>