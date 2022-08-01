<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Data Ruangan</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">Ruangan</li>
                </ol>

            </div>
        </div>
    </div>
</div>

<div class="card mb-1">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="text-end">

                    <a href="<?= route_to('data-ruang-add') ?>" class="btn btn-success btn-sm btn-rounded">
                        <!-- icon add -->
                        <i class="fas fa-plus"></i>
                        <span>Tambah</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped datatables-init" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Jumlah Tampung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($items as $key => $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item->nama ?></td>
                                    <td><?= $item->tampung ?></td>
                                    <td>
                                        <a href="<?= route_to('data-ruang-edit', $item->id) ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= route_to('data-ruang-delete', $item->id) ?>" class="btn btn-danger btn-sm">
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