<ul class="app-menu list-unstyled accordion" id="menu-accordion">
    <li class="nav-item">
        <a class="nav-link <?= $menuactive == 'dashboard' ? 'active' : '' ?>" href="<?= route_to('') ?>">
            <span class="nav-icon">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                    <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                </svg>
            </span>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <?php if (in_groups('Admin') || in_groups('Dosen')) : ?>
        <li class="nav-item has-submenu">
            <a class="nav-link <?= $menuactive == 'master' ? 'active' : '' ?> submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
                <span class="nav-icon">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                        <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                    </svg>
                </span>
                <span class="nav-link-text">Master</span>
                <span class="submenu-arrow">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </span>
            </a>
            <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                <ul class="submenu-list list-unstyled">
                    <?php if (in_groups('Admin')) : ?>
                        <li class="submenu-item">
                            <a class="submenu-link" href="<?= route_to('data-mahasiswa') ?>">Mahasiswa</a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link" href="<?= route_to('data-dosen') ?>">Dosen</a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link" href="<?= route_to('data-matkul') ?>">Mata Kuliah</a>
                        </li>
                    <?php endif; ?>

                    <?php if (in_groups('Admin')||in_groups('Dosen')) : ?>

                        <li class="submenu-item">
                            <a class="submenu-link" href="<?= route_to('data-kuliah') ?>">Kuliah</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>
    <?php endif ?>
    <li class="nav-item has-submenu">
        <a class="nav-link <?= $menuactive == 'ujian' ? 'active' : '' ?> submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-book">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                </svg>
            </span>
            <span class="nav-link-text">Ujian</span>
            <span class="submenu-arrow">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
            </span>
        </a>
        <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">
            <ul class="submenu-list list-unstyled">
                <?php if (in_groups('Admin')) : ?>
                    <li class="submenu-item">
                        <a class="submenu-link" href="<?= route_to('ujian-data') ?>">Data Ujian</a>
                    </li>
                    <li class="submenu-item">
                        <a class="submenu-link" href="<?= route_to('ujian-riwayat') ?>">Riwayat Ujian</a>
                    </li>
                <?php endif ?>
                <?php if (in_groups('Dosen')) : ?>
                    <li class="submenu-item">
                        <a class="submenu-link" href="<?= route_to('ujian-atur') ?>">Atur Ujian</a>
                    </li>
                    <li class="submenu-item">
                        <a class="submenu-link" href="<?= route_to('ujian-review') ?>">Review Jawaban</a>
                    </li>
                <?php endif ?>
                <?php if (in_groups('Mahasiswa')) : ?>
                    <li class="submenu-item">
                        <a class="submenu-link" href="<?= route_to('ujian-jadwal') ?>">Jadwal Ujian</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </li>
    <?php if (in_groups('Admin')) : ?>
        <li class="nav-item">
            <a class="nav-link <?= $menuactive == 'user' ? 'active' : '' ?>" href="<?= route_to('user') ?>">
                <span class="nav-icon">
                    <!-- svg user -->
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />

                    </svg>
                </span>
                <span class="nav-link-text">Pengguna</span>
            </a>
        </li>
    <?php endif ?>
</ul>