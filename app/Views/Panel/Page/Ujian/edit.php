<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Data Ujian</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Master Data</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('ujian-data') ?>">Data Ujian</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>

            </div>
        </div>
    </div>
</div>

<?= view($config->theme['panel'] . '_message_block') ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form class="form-horizontal r-separator border-top" method="POST">
                    <div class="card-body">
                        <div class="form-group row align-items-center mb-0">
                            <label for="kuliah_id" class="col-3 text-end control-label col-form-label">Kuliah</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <select class="form-select" aria-label="kuliah_id" name="kuliah_id" id="kuliah_id"
                                    required>
                                    <option value="">Pilih Kuliah</option>
                                    <?php
                                    foreach ($kuliah as $kl) : ?>
                                    <option value="<?= $kl->id ?>"
                                        <?= $kl->id == $item->kuliah->id ? ' selected' : '' ?>><?= $kl->matkul->nama ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="ruang_id" class="col-3 text-end control-label col-form-label">Ruang</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <select class="form-select" aria-label="ruang_id" name="ruang_id" id="ruang_id"
                                    required>
                                    <option value="">Pilih Ruang Ujian</option>
                                    <?php
                                    foreach ($ruang as $r) : ?>
                                    <option value="<?= $r->id ?>" <?= $r->id == $item->ruang->id ? ' selected' : '' ?>>
                                        <?= $r->nama ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="alamat" class="col-3 text-end control-label col-form-label">Waktu</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <div class='input-group' id='datetimepicker' data-td-target-input='nearest'
                                    data-td-target-toggle='nearest'>
                                    <input id='datetimepickerInput' type='text' class='form-control'
                                        data-td-target='#datetimepicker' name="waktu" value="<?= $item->waktu ?>"
                                        required />
                                    <span class='input-group-text' data-td-target='#datetimepicker'
                                        data-td-toggle='datetimepicker'>
                                        <span class='fa-solid fa-calendar'></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="tenggat" class="col-3 text-end control-label col-form-label">Tenggat</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <div class="input-group">
                                    <input type="number" name="tenggat" id="tenggat" class="form-control"
                                        placeholder="Tenggat Ujian" value="<?= $item->tenggat ?>" required>
                                    <span class="input-group-text">Menit</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="tipe" class="col-3 text-end control-label col-form-label">Tipe</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <select class="form-select" aria-label="Tipe" name="tipe" id="tipe" required>
                                    <option value="">Pilih Tipe Ujian</option>
                                    <option value="UTS" <?= 'UTS' == $item->tipe ? ' selected' : '' ?>>UTS</option>
                                    <option value="UAS" <?= 'UAS' == $item->tipe ? ' selected' : '' ?>>UAS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-top">
                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn app-btn-primary" name="add">
                                Simpan
                            </button>
                            <a role="button" class="btn app-btn-secondary" href="<?= route_to('ujian-data') ?>">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>