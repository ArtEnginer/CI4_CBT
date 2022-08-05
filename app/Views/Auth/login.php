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
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/portal') ?>/css/portal.css">
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/portal') ?>/css/panel.css">
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img
                                class="logo-icon me-2" src="<?= base_url('assets/portal') ?>/images/app-logo.svg"
                                alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-5"><?= lang('Auth.loginTitle') ?></h2>
                    <div class="auth-form-container text-start">
                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <form action="<?= url_to('login') ?>" method="post" class="auth-form login-form">
                            <?= csrf_field() ?>
                            <?php if ($config->validFields === ['email']) : ?>
                            <div class="email mb-3">
                                <label class="sr-only" for="login"><?= lang('Auth.email') ?></label>
                                <input id="login" name="login" type="email"
                                    class="form-control signin-email <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?= lang('Auth.email') ?>" required="required">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="email mb-3">
                                <label class="sr-only" for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                <input id="login" name="login" type="text"
                                    class="form-control signin-email <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?= lang('Auth.emailOrUsername') ?>" required="required">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="password mb-3">
                                <label class="sr-only" for="password"><?= lang('Auth.password') ?></label>
                                <input id="password" name="password" type="password"
                                    class="form-control signin-password <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    placeholder="<?= lang('Auth.password') ?>" required="required">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">
                                        <?php if ($config->allowRemembering) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember"
                                                name="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                            <label class="form-check-label" for="remember">
                                                <?= lang('Auth.rememberMe') ?>
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php if ($config->activeResetter) : ?>
                                        <div class="forgot-password text-end">
                                            <a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn app-btn-primary w-100 theme-btn mx-auto"><?= lang('Auth.loginAction') ?></button>
                            </div>
                        </form>

                        <?php if ($config->allowRegistration) : ?>
                        <div class="auth-option text-center pt-5"><?= lang('Auth.needAnAccount') ?> ? <a
                                class="text-link" href="<?= url_to('register') ?>">Daftar</a>.</div>
                        <?php endif; ?>
                    </div>

                </div>

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                                style="color: #fb866a;"></i> by <a class="app-link"
                                href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for
                            developers</small>

                    </div>
                </footer>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">
                    <div class="h-100"></div>
                    <div class="overlay-content p-3 p-lg-4 rounded">
                        <h5 class="mb-3 overlay-title">CBT SI Universitas Peradaban</h5>
                        <div>CBT adalah Ujian Potensi Akademik yang diselenggarakan dengan menggunakan komputer.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


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

    <script src="<?= base_url('assets/portal') . '/js/panel.js' ?>"></script>

</body>

</html>