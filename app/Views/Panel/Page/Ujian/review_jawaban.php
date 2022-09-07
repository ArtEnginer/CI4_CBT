<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Review Jawaban</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Ujian</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('ujian-review') ?>">Review</a>
                    </li>
                    <li class="breadcrumb-item active">Jawaban</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<form method="POST">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h6 class="m-0">Jawaban <?= $items->ujian->tipe ?> <?= $items->ujian->matkul->nama ?>
                <?= $items->mahasiswa->nama ?></h6>
            <h6 class="m-0"><?= $items->ujian->waktu ?></h6>
        </div>
        <div class="card-body">
            <?php if ($items->multi) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0">Soal Pilgan</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-2">
                                <?php $num = 1; ?>
                                <?php $valid = 1; ?>
                                <?php $benar = 0; ?>
                                <?php $salah = 0; ?>
                                <?php foreach ($items->ujian->soal_pilgan as $id => $soal) : ?>
                                <?php
                                        foreach ($soal->pilihan as $k => $v) :
                                            if ($v->valid) {
                                                $valid = $v->id;
                                            }
                                        endforeach;
                                        ?>
                                <?php if (isset($items->jawaban->jawab_pilgan->{$soal->nomor}) && ($valid == $items->jawaban->jawab_pilgan->{$soal->nomor}->jawaban)) : ?>
                                <?php $benar++; ?>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center pt-0 pb-0 list-group-item-success">
                                    <div class="w-100 p-2">Nomor #<?= $soal->nomor ?></div>
                                    <span class="badge bg-primary rounded-pill flex-shrink-1"><i
                                            class="bi bi-check-lg"></i></span>
                                </li>
                                <?php else : ?>
                                <?php $salah++; ?>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center pt-0 pb-0 list-group-item-danger">
                                    <div class="w-100 p-2">Nomor #<?= $soal->nomor ?></div>
                                    <span class="badge bg-danger rounded-pill flex-shrink-1"><i
                                            class="bi bi-x-lg"></i></span>
                                </li>
                                <?php endif ?>
                                <?php endforeach ?>
                            </ul>

                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0">Nilai</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="alert alert-success d-flex justify-content-between"
                                                role="alert">
                                                <span>Benar</span>
                                                <span>: <?= "<b>$benar</b>" ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="alert alert-danger d-flex justify-content-between" role="alert">
                                                <span>Salah</span>
                                                <span>: <?= "<b>$salah</b>" ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="pilgan" name="pilgan"
                                                    placeholder="0-100" required>
                                                <label for="pilgan">Masukkan
                                                    Nilai</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    Nilai Pilgan per butir
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0">Soal Essay</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionEssay">
                                <?php $num = 1; ?>
                                <?php foreach ($items->ujian->soal_essay as $id => $soal) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading<?= $num ?>">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $num ?>"
                                            aria-expanded="false" aria-controls="flush-collapse<?= $num ?>">
                                            Nomor #<?= $num ?>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse<?= $num ?>" class="accordion-collapse collapse"
                                        aria-labelledby="flush-heading<?= $num++ ?>" data-bs-parent="#accordionEssay">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="card mb-3">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            <h6 class="m-0">Soal</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <?= empty($soal->img) ? '' : '<img src="' . base_url("soal/{$items->ujian->token_ujian}/essay/$soal->nomor") . "/$soal->img" . '" class="card-img-top" alt="img">' ?>
                                                            <p class="m-0 mb-2"><?= $soal->soal ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="card mb-3">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            <h6 class="m-0">Jawaban</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <?= $items->jawaban->jawab_essay->{$soal->nomor}->jawaban ?? null ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="card mb-3">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">
                                                            <h6 class="m-0">Nilai</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-floating mb-3">
                                                                <input type="number" class="form-control"
                                                                    id="floatingInput<?= $soal->nomor ?>"
                                                                    name="<?= $soal->nomor ?>" placeholder="0-100"
                                                                    required>
                                                                <label for="floatingInput<?= $soal->nomor ?>">Masukkan
                                                                    Nilai</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn app-btn-primary">
                        Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>