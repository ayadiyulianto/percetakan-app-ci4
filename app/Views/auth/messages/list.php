<?php if (!empty($messages)) : ?>
	<?php foreach ($messages as $message) : ?>
		<div class="alert alert-info" role="alert">
			<?= esc($message) ?>
		</div>
	<?php endforeach ?>
<?php endif ?>
