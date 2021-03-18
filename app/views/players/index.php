<div class="container mt-4">
	<div class="row">
		<div class="col-6">
			<h3>List of Players</h3>
			<?php foreach( $data['players'] as $player ) : ?>
			<ul>
				<li><?=$player['name'] ?></li>
				<li><?=$player['team'] ?></li>
				<li><?=$player['position'] ?></li>
				<li><?=$player['height'] ?></li>
				<li><?=$player['weight'] ?></li>
			</ul>
			<?php endforeach; ?>
		</div>
	</div>
</div>