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
    <title>Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sc-2.0.7/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/css/tempus-dominus.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/portal') ?>/css/portal.css">
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/portal') ?>/css/panel.css">
</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <?= view($config->theme['panel'] . 'navbar') ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="#!"><img class="logo-icon me-2" src="<?= base_url('assets/portal') ?>/images/app-logo.svg" alt="logo"><span class="logo-text">CBT</span></a>

                </div>
                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <?= view($config->theme['panel'] . 'sidebar-top') ?>
                </nav>
                <div class="app-sidepanel-footer">
                    <nav class="app-nav app-nav-footer">
                        <?= view($config->theme['panel'] . 'sidebar-bottom') ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <?= $this->renderSection('main') ?>
            </div>
        </div>

        <footer class="app-footer">
            <div class="container text-center py-3">
                <?= view($config->theme['panel'] . 'footer') ?>
            </div>
        </footer>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <!-- Assets -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js" integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sc-2.0.7/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.2/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/Eonasdan/tempus-dominus@master/dist/js/tempus-dominus.js" crossorigin="anonymous"></script>
    <?= view($config->theme['panel'] . 'script') ?>
    <script src="<?= base_url('assets/portal') ?>/js/app.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/portal') . '/js/panel.js' ?>"></script>
    <script>
        function btnConfirm(data, act) {
            if (act == 'hapus') {
                var text = "Data yang dihapus tidak dapat dikembalikan!"
                var icon = "warning"
            }
            Swal.fire({
                title: "Yakin ingin " + act + " data ini?",
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: "#15a362",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, " + act + "!",
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value) {
                        $(location).prop("href", data);
                    }
                }
            });
        }
    </script>
</body>

</html>