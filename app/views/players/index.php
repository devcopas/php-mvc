<div class="container mt-3">

	<?php Flasher::showFlash(); ?>

	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#formModal">
			Add Player
			</button>
			<br><br>
			<h3>Player Data List</h3>
			<div class="table-responsive">
			<table class="table table-hover align-middle">
				<thead class="table-light">
					<tr>
					<th scope="col" class="border-end">No</th>
					<th scope="col">Player</th>
					<th scope="col" class="team-heading">Team</th>
					<th scope="col">Position</th>
					<th scope="col">Height</th>
					<th scope="col">Weight</th>
					<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $data['players'] as $key=>$player) : ?>
					<tr>
						<th scope="row" class="border-end"><?= $key + 1; ?></th>
						<td><a href="<?= BASEURL; ?>/players/detail/<?= $player['id']; ?>" class="text-reset text-decoration-none"><?= $player['name'] ?></a></td>
						<td><?= $player['team'] ?></td>
						<td><?= $player['position'] ?></td>
						<td><?= $player['height'] ?></td>
						<td><?= $player['weight'] ?></td>
						<td>
						<div class="dropstart">
							<span class="option-icon" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-three-dots-vertical"></i>
							</span>
							<ul class="dropdown-menu">
								<li><a href="<?= BASEURL; ?>/players/edit/<?= $player['id']; ?>" class="dropdown-item edit-btn" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $player['id']; ?>" >Edit</a></li>
								<li><a href="<?= BASEURL; ?>/players/delete/<?= $player['id'];  ?>" onclick="return confirm('Are you sure you want to delete <?= strtoupper($player['name']); ?> ?')" class="dropdown-item">Delete</a></li>
							</ul>	
						</div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="formModalLabel">Add Player Data</h5>
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
				<select class="form-select text-muted" id="team" name="team" aria-label="Team select example">
					<option selected disabled>Select team</option>
					<?php foreach( $data['teams'] as $team ) : ?>
					<option value="<?= $team; ?>" class="text-dark"><?= $team; ?></option>
					<?php endforeach ; ?>
				</select>
			</div>
			<div class="mb-3">
				<label for="position" class="form-label">Position</label>
				<select class="form-select text-muted" id="position" name="position" aria-label="Position select example">
					<option selected disabled>Select position</option>
					<?php foreach($data['positions'] as $position ) : ?>
					<option value="<?= $position; ?>" class="text-dark"><?= $position; ?></option>
					<?php endforeach; ?>
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