<div class="container mt-4">
	<div class="row">
		<div class="col-6">
			<h3>List of Players</h3>
			<ul class="list-group">
				<?php foreach( $data['players'] as $player ) : ?>
					<li class="list-group-item" >
					 	<a href="<?= BASEURL; ?>/players/detail/<?= $player['id']; ?>"><?= $player['name']; ?></a>
					 </li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>