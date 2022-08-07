<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Soal Ujian</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Ujian</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('ujian-atur') ?>">Atur Ujian</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0">Soal <?= $item->tipe ?> <?= $item->matkul->nama ?></h6>
        <h6 class="m-0"><?= $item->waktu ?></h6>
    </div>
    <div class="card-body">
        <?php if ($item->soal_pilgan) : ?>
        <?php $num = 1; ?>
        <?php foreach ($item->soal_pilgan as $id => $soal) : ?>
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <?= empty($soal->img) ? '' : '<img src="' . base_url("soal/$item->token_ujian/pilgan/$soal->nomor") . "/$soal->img" . '" class="card-img-top" alt="img">' ?>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Soal Pilgan Nomor <?= $num++ ?></h6>
                        <div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success text-light dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Opsi
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item<?= ($soal->img) ? '' : ' pilgan-img' ?>"
                                            href="<?= ($soal->img) ? route_to('soal-pilgan-img-delete', $item->id, $soal->nomor) : '#!' ?>"
                                            data-id="<?= $item->id ?>" data-nomor="<?= $soal->nomor ?>"><?= ($soal->img) ? 'Hapus Gambar' : 'Tambahkan
                                            Gambar' ?></a>
                                    </li>
                                    <li><a class="dropdown-item pilgan-edit" href="<?= route_to('ujian-pilgan-edit') ?>"
                                            data-id="<?= $item->id ?>" data-nomor="<?= $soal->nomor ?>">Edit</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item pilgan-delete"
                                            href="<?= route_to('ujian-pilgan-delete') ?>" data-id="<?= $item->id ?>"
                                            data-nomor="<?= $soal->nomor ?>">Hapus</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="m-0 mb-2"><?= $soal->soal ?></p>
                        <ul class="list-group">
                            <?php $abc = "A"; ?>
                            <?php shuffle($soal->pilihan) ?>
                            <?php foreach ($soal->pilihan as $index => $pilgan) : ?>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center pt-0 pb-0 <?= ($pilgan->valid) ? ' list-group-item-success' : '' ?>">
                                <span><?= $abc++ ?>.</span>
                                <div class="w-100 p-2"><?= $pilgan->text ?></div>
                                <?= ($pilgan->valid) ? '<span class="badge bg-primary rounded-pill flex-shrink-1"><i
                                        class="bi bi-check-lg"></i></span>' : '<span></span>' ?>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>