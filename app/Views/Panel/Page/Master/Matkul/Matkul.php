<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Mata Kuliah</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">List Mata Kuliah</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="<?= route_to('data-matkul-add') ?>" class="btn app-btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
                            <a href="<?= route_to('data-matkul-import') ?>" class="btn app-btn-primary shadow-sm"><i class="fas fa-file-import fa-sm text-white-50"></i> Import</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table app-table-hover datatables-init" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Matkul</th>
                                <th>Jumlah SKS</th>
                                <th>Semester</th>
                                <!-- <th>Ruangan</th> -->
                                <th>Dosen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($items as $key => $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item->kode?></td>
                                    <td><?= $item->nama ?></td>
                                    <td><?= $item->sks ?></td>
                                    <td><?= $item->semester ?></td>
                                    <td><?= $item->dosen->nama ?></td>
                                    <td>
                                        <a href="<?= route_to('data-matkul-edit', $item->id) ?>" class="btn badge bg-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="btnConfirm('<?= route_to('data-matkul-delete', $item->id) ?>','Hapus')" class="btn badge bg-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
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