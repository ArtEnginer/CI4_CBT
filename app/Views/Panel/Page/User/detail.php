<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<?php $item->detail = $item->getDetail() ?>
<?php $item->roles = $item->getRoles() ?>
<?php $item->role = new stdClass ?>
<?php foreach ($item->roles as $id => $role) {
    $item->role->id = $id;
    $item->role->name = $role;
}
unset($item->roles) ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="app-page-title mb-0">Detail Pengguna</h1>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Detail Pengguna <?= $item->detail->nama ?></h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <table class="table">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>: <?= $item->detail->nama ?></td>
                    </tr>
                    <tr>
                        <th><?= $item->role->id == 1 ? 'User Login' : ($item->role->id == 2 ? 'NIM' : 'NIP') ?></th>
                        <td>: <?= $item->username ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>: <?= $item->email ?></td>
                    </tr>
                    <?php if ($item->role->id != 1) : ?>
                    <tr>
                        <th>Alamat</th>
                        <td>: <?= $item->detail->alamat ?></td>
                    </tr>
                    <?php endif ?>
                    <?php if ($item->role->id == 2) : ?>
                    <tr>
                        <th>Tahun Masuk</th>
                        <td>: <?= $item->detail->tahun_masuk ?></td>
                    </tr>
                    <?php endif ?>
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>: <?= $item->role->name ?></td>
                    </tr>
                </table>
                <div class="text-center">
                    <a href="<?= route_to('user') ?>" role="button" class="btn app-btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>