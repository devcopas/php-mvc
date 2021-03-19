<div class="container mt-4">
	<div class="card" style="width: 18rem;">
	<div class="card-body">
		<h5 class="card-title"><?= $data['player']['name'] ?></h5>
		<p class="card-text"><?= $data['player']['team'] ?></p>
	</div>
	<ul class="list-group list-group-flush">
		<li class="list-group-item"><?= $data['player']['position'] ?></li>
		<li class="list-group-item"><?= $data['player']['height'] ?> kg</li>
		<li class="list-group-item"><?= $data['player']['weight'] ?> cm</li>
	</ul>
	<div class="card-body">
		<a href="<?= BASEURL ?>/players" class="card-link">Back</a>
	</div>
	</div>
</div>