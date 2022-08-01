<?php if (session()->has('message')) : ?>
	<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
		<!-- icon success -->
		<div class="mr-3">
			<i class="fas fa-check-circle fa-2x"></i>
		</div>
		<strong><?= session('message') ?></strong>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
	<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		<!-- icon danger -->
		<div class="mr-3">
			<i class="fas fa-exclamation-triangle fa-2x"></i>
		</div>
		<strong><?= session('error') ?></strong>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>

<?php endif ?>

<?php if (session()->has('errors')) : ?>
	<ul class="alert alert-danger">
		<?php foreach (session('errors') as $error) : ?>
			<li><?= $error ?></li>
		<?php endforeach ?>
	</ul>
<?php endif ?>