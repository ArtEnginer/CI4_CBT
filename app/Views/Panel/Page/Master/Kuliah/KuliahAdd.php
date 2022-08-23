<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Data Mata Kuliah</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Mata Kuliah</li>
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
                            <label for="mahasiswa_id" class="col-3 text-end control-label col-form-label ">Nama Mahasiswa</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <select class="form-control" id="mahasiswa_id" name="mahasiswa_id">
                                    <option value="">Pilih Mahasiswa</option>
                                    <?php foreach ($mahasiswa as $m) : ?>
                                        <option value="<?= $m->id ?>"><?= $m->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="matakuliah_id" class="col-3 text-end control-label col-form-label ">Mata Kuliah</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <select class="form-control" id="matakuliah_id" name="matakuliah_id">
                                    <option value="">Pilih Mata Kuliah</option>
                                    <?php foreach ($matkul as $m) : ?>
                                        <option value="<?= $m->id ?>"><?= $m->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Tahun -->
                        <div class="form-group row align-items-center mb-0">
                            <label for="tahun" class="col-3 text-end control-label col-form-label ">Tahun</label>
                            <div class="col-9 border-start pb-2 pt-2">
                               <!-- select -->
                                <select class="form-control" id="tahun" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                   <?php
                                    for ($i = date('Y'); $i > date('Y') - 7; $i--) :
                                   ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Uts -->
                        <div class="form-group row align-items-center mb-0">
                            <label for="uts" class="col-3 text-end control-label col-form-label ">UTS</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control" id="uts" name="uts" placeholder="UTS">
                            </div>
                        </div>
                        <!-- Uas -->
                        <div class="form-group row align-items-center mb-0">
                            <label for="uas" class="col-3 text-end control-label col-form-label ">UAS</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control" id="uas" name="uas" placeholder="UAS">
                            </div>
                        </div>


                    </div>
                    <div class="p-3 border-top">
                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn badge btn-primary rounded-pill px-4 waves-effect waves-light" name="add">
                                Simpan
                            </button>
                            <a role="button" class="btn badge btn-danger rounded-pill px-4 waves-effect waves-light" href="<?= route_to('data-kuliah') ?>">
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