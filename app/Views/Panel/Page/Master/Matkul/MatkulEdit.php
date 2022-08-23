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
                    <li class="breadcrumb-item active">Edit Mata Kuliah</li>
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
                            <label for="nama" class="col-3 text-end control-label col-form-label ">Nama</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="text" class="form-control " id="nama" name="nama" placeholder="Nama Mata Kuliah" value="<?= $item->nama ?>" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="semester" class="col-3 text-end control-label col-form-label ">SKS</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="number" class="form-control" id="semester" name="sks" placeholder="Jumlah SKS" value="<?= $item->sks ?>" required>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-0">
                            <label for="semester" class="col-3 text-end control-label col-form-label ">Semester</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <input type="number" class="form-control" id="semester" name="semester" placeholder="Jumlah semester" value="<?= $item->semester ?>" required>
                            </div>
                        </div>

                       

                        <div class="form-group row align-items-center mb-0">
                            <label for="dosen_id" class="col-3 text-end control-label col-form-label ">Dosen</label>
                            <div class="col-9 border-start pb-2 pt-2">
                                <!-- Select -->
                                <select class="select2 form-control custom-select" id="dosen_id" name="dosen_id" style="width: 100%; height:36px;">

                                    <?php foreach ($dosen as $d) : ?>
                                        <option value="<?= $d->id ?>" <?= $d->id == $item->dosen->id ? 'selected' : '' ?>><?= $d->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="p-3 border-top">
                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn badge btn-primary rounded-pill px-4 waves-effect waves-light" name="add">
                                Simpan
                            </button>
                            <a role="button" class="btn badge btn-danger rounded-pill px-4 waves-effect waves-light" href="<?= route_to('data-matkul') ?>">
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