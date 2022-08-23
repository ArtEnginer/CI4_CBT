<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Manajemen Pengguna</h1>
</div>
<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">List Pengguna</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <div class="dropdown">
                                <button class="btn btn-success shadow-sm dropdown-toggle text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= route_to('data-mahasiswa-add') ?>">Mahasiswa</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?= route_to('data-dosen-add') ?>">Dosen</a></li>
                                </ul>
                            </div>
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
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($items as $key => $item) : ?>
                                <?php $detail = $item->getDetail() ?>
                                <?php $roles = $item->getRoles() ?>
                                <?php foreach ($roles as $id => $role) {
                                    $role = [
                                        'role_id' => $id,
                                        'role_name' => $role,
                                    ];
                                } ?>
                                <tr>
                                    <td class="cell"><?= $no++ ?></td>
                                    <td class="cell"><?= $detail->nama ?></td>
                                    <td class="cell"><?= $role['role_name'] ?></td>
                                    <td class="cell">
                                        <a class="btn badge bg-primary" href="<?= route_to('user-detail', $item->id) ?>"><i class="fas fa-eye"></i></a>
                                        <a class="btn badge bg-warning" href="<?= route_to('user-edit-password', $item->id) ?>"><i class="fas fa-key"></i></a>
                                        <a class="btn badge bg-danger" onclick="btnConfirm('<?= route_to('user-delete', $role['role_name'], $item->id) ?>','Hapus')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="<?= route_to('ujian-data-riwayat') ?>" role="button" class="btn app-btn-secondary">Riwayat</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>