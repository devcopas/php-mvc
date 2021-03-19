<div class="container mt-3">
	<div class="row">
		<div class="col-6">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
			Add Player
			</button>
			<br><br>
			<h3>Player List</h3>
			<ul class="list-group">
				<?php foreach( $data['players'] as $player ) : ?>
					<li class="list-group-item" >
					 	<a href="<?= BASEURL; ?>/players/detail/<?= $player['id']; ?>"><?= $player['name']; ?></a>
					 </li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="formModalLabel">Add Players Data</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="<?= BASEURL; ?>/players/add" method="post">
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
			</div>
			<div class="mb-3">
				<label for="team" class="form-label">Team</label>
				<input type="text" class="form-control" id="team" name="team" aria-describedby="teamHelp">
			</div>
			<div class="mb-3">
				<label for="position" class="form-label">Position</label>
				<select class="form-select" id="position" name="position" aria-label="Default select example">
					<option value="Guard">Guard</option>
					<option value="Forward">Forward</option>
					<option value="Center">Center</option>
				</select>
			</div>
			<div class="mb-3">
				<label for="height" class="form-label">Height</label>
				<input type="number" class="form-control" id="height" name="height" aria-describedby="heightHelp">
			</div>
			<div class="mb-3">
				<label for="weight" class="form-label">Weight</label>
				<input type="number" class="form-control" id="weight" name="weight" aria-describedby="weightHelp">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Add Data</button>
			</form>
		</div>
		</div>
	</div>
	</div>
</div>