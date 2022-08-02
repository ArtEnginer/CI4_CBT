<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Ujian</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">List Ujian</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left datatables-init">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($items as $key => $item) : ?>
                            <tr>
                                <td class="cell"><?= $no++ ?></td>
                                <td class="cell"><?= $item->kuliah->matkul->nama ?></td>
                                <td class="cell"><?= $item->waktu ?></td>
                                <td class="cell"><span
                                        class="badge bg-<?= $item->status->getStyle() ?>"><?= $item->status ?></span>
                                </td>
                                <td class="cell">
                                    <?php if ($item->status->code < 1) : ?>
                                    <a class="btn app-btn-secondary"
                                        href="<?= route_to('ujian-atur-upload', $item->id) ?>">Upload Soal</a>
                                    <?php else : ?>
                                    <a class="btn app-btn-primary"
                                        href="<?= route_to('ujian-atur-selesai', $item->id) ?>">Selesaikan</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>