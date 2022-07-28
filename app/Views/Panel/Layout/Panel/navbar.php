<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#!">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">CBT <sup>SI</sup> UP</div>
</a>
<hr class="sidebar-divider my-0">
<div class="sidebar-heading">
    Panel
</div>
<li class="nav-item <?= $menuactive == 'dashboard' ? 'active' : '' ?>">
    <a class=" nav-link " href=" <?= route_to('') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<li class="nav-item <?= $menuactive == 'master' ? 'active' : '' ?>">
    <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Master</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= route_to('data-mahasiswa') ?>">Mahasiswa</a>
            <a class="collapse-item" href="<?= route_to('data-dosen') ?>">Dosen</a>
            <a class="collapse-item" href="<?= route_to('data-ruang') ?>">Ruang</a>
            <a class="collapse-item" href="<?= route_to('data-matkul') ?>">Mata Kuliah</a>
            <a class="collapse-item" href="<?= route_to('data-kuliah') ?>">Kuliah</a>
            <a class="collapse-item" href="<?= route_to('data-ujian') ?>">Ujian</a>
        </div>
    </div>
</li>