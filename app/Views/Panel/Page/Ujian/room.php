<?php
// dd($soal)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Codeigniter 4 &amp; App Theme">
    <meta name="author" content="MrFrost">
    <meta name="keywords" content="codeigniter, bootstrap, bootstrap 5, theme, responsive, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>CBT</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sc-2.0.7/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/css/tempus-dominus.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css"
        integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/portal') ?>/css/portal.css">
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/portal') ?>/css/panel.css">
</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                    role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-user-dropdown dropdown"><img
                                    src="<?= base_url('assets/portal') ?>/images/user.png" alt="user profile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="#!"><img class="logo-icon me-2"
                            src="<?= base_url('assets/portal') ?>/images/app-logo.svg" alt="logo"><span
                            class="logo-text">CBT</span></a>

                </div>
                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1 mx-2">
                    <?php if ($pilgan) : ?>
                    <?php $num = 1 ?>
                    <h5 class="m-2">Pilihan Ganda</h5>
                    <?php foreach ($pilgan as $pil) : ?>
                    <button data-tipe="pilgan" data-token="<?= $item->token_ujian ?>" data-nomor="<?= $num ?>"
                        class="btn app-btn-secondary ujian-nomor pilgan-<?= $num ?><?= $tipe == 'pilgan' && $nomor == $num ? ' active' : '' ?>"><?= $num++ ?></button>
                    <?php endforeach ?>
                    <?php endif ?>
                    <?php if ($essay) : ?>
                    <?php $num = 1 ?>
                    <h5 class="m-2">Essay</h5>
                    <?php foreach ($essay as $e) : ?>
                    <button data-tipe="essay" data-token="<?= $item->token_ujian ?>" data-nomor="<?= $num ?>"
                        class="btn app-btn-secondary ujian-nomor essay-<?= $num ?><?= $tipe == 'essay' && $nomor == $num ? ' active' : '' ?>"><?= $num++ ?></button>
                    <?php endforeach ?>
                    <?php endif ?>
                </nav>
            </div>
        </div>
    </header>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="app-card app-card-stats-table h-100 shadow-sm soal-body">
                            <form class="form" action="<?= route_to('ujian-jawab', $token, $tipe, $nomor) ?>"
                                method="POST">
                                <?php if ($tipe == 'pilgan') : ?>
                                <div class="app-card-header p-3">
                                    <div class="row text-center">
                                        <h4 class="app-card-title">Soal Pilgan Nomor <?= $soal->nomor ?></h4>
                                    </div>
                                </div>
                                <div class="app-card-body p-3 p-lg-4">
                                    <?= view($config->theme['panel'] . '_message_block') ?>
                                    <?= ($soal->img) ? '<img src="' . base_url("soal/$token/pilgan/$soal->nomor") . "/$soal->img" . '" class="img-fluid rounded mx-auto d-block">' : '' ?>
                                    <p for="token" class="mb-2"><?= $soal->soal ?></p>
                                    <?php $char = 'A' ?>
                                    <?php shuffle($soal->pilihan) ?>
                                    <?php $num = 1 ?>
                                    <input type="hidden" name="tipe" value="pilgan">
                                    <?php foreach ($soal->pilihan as $pg) : ?>
                                    <div class="mb-3">
                                        <input type="radio" class="btn-check" name="jawaban" id="option<?= $num ?>"
                                            value="<?= $pg->id ?>" <?= $jawaban == $pg->id ? 'checked' : '' ?>>
                                        <label class="btn app-btn-secondary"
                                            for="option<?= $num++ ?>"><?= $char++ ?>.</label>
                                        <?= $pg->text ?>
                                    </div>
                                    <?php endforeach ?>
                                </div>
                                <?php endif ?>
                                <?php if ($tipe == 'essay') : ?>
                                <div class="app-card-header p-3">
                                    <div class="row text-center">
                                        <h4 class="app-card-title">Soal Essay Nomor <?= $soal->nomor ?></h4>
                                    </div>
                                </div>
                                <div class="app-card-body p-3 p-lg-4">
                                    <?= view($config->theme['panel'] . '_message_block') ?>
                                    <?= ($soal->img) ? '<img src="' . base_url("soal/$token/essay/$soal->nomor") . "/$soal->img" . '" class="img-fluid rounded mx-auto d-block">' : '' ?>
                                    <p for="token" class="mb-2"><?= $soal->soal ?></p>
                                    <input type="hidden" name="tipe" value="essay">
                                    <textarea id="summernote" name="jawaban"><?= $jawaban ?></textarea>
                                </div>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="app-footer">
            <div class="container d-flex justify-content-between py-3">
                <button type="submit" data-token="<?= $item->token_ujian ?>" value="prev"
                    class="btn app-btn-secondary ujian-prev" name="act">Sebelumnya</button>
                <?php if (($tipe == 'pilgan' && $jumlah_essay < 1) || ($tipe == 'essay' && $jumlah_essay == $nomor)) : ?>
                <button type="submit" data-token="<?= $item->token_ujian ?>" value="done"
                    class="btn btn-next app-btn-primary ujian-done" name="act">Selesai</button>
                <?php else : ?>
                <button type="submit" data-token="<?= $item->token_ujian ?>" value="next"
                    class="btn btn-next app-btn-secondary ujian-next" name="act">Selanjutnya</button>
                <?php endif ?>
            </div>
        </footer>
    </div>
    <div class="modal-loading">
        <!-- Place at bottom of page -->
    </div>

    <!-- Assets -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"
        integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sc-2.0.7/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.2/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/js/tempus-dominus.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="<?= base_url('assets/portal') ?>/js/app.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/portal') . '/js/panel.js' ?>"></script>
    <script>
    $(document).ready(function() {
        $("#summernote").summernote();
    });
    </script>

</body>

</html>