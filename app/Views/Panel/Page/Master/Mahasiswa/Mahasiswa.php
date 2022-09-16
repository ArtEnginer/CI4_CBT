<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Mahasiswa</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">List Mahasiswa</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="<?= route_to('data-mahasiswa-add') ?>" class="btn app-btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
                            <!-- import -->
                            <a href="<?= route_to('data-mahasiswa-import') ?>" class="btn app-btn-primary shadow-sm"><i class="fas fa-file-import fa-sm text-white-50"></i> Import</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left datatables-init">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Alamat</th>
                                <th>Tahun Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($items as $key => $item) : ?>
                                <tr>
                                    <td class="cell"><?= $no++ ?></td>
                                    <td class="cell"><?= $item->nama ?></td>
                                    <td class="cell"><?= $item->nim ?></td>
                                    <td class="cell"><?= $item->alamat ?></td>
                                    <td class="cell"><?= $item->tahun_masuk ?></td>
                                    <td class="cell">
                                        <a class="btn badge bg-warning" href="<?= route_to('data-mahasiswa-edit', $item->id) ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn badge bg-danger" onclick="btnConfirm('<?= route_to('data-mahasiswa-delete', $item->id) ?>','Hapus')"><i class="fas fa-trash"></i></a>
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