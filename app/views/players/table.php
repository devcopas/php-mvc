<?php if( count($data['players']) > 0 ) : ?>
<?php foreach( $data['players'] as $key=>$player) : ?>
	<tr>
		<th scope="row" class="table-data__no"><?= $key + 1; ?></th>
		<td class="table-data__player">
		<a href="<?= BASEURL; ?>/players/detail/<?= $player['id']; ?>" class="text-reset text-decoration-none">
		<div class="d-flex flex-column flex-lg-row ">
		<p class="fw-normal me-1 mb-0" ><?= $player['name']['first'] ?></p>
		<p class="mb-0"><?= $player['name']['last'] ?></p>
		</div>
		</a>
	</td>
		<td><?= $player['team'] ?></td>
		<td><?= $player['position'] ?></td>
		<td><?= $player['height'] ?></td>
		<td class="text-center"><div class="w-25 text-end"><?= $player['weight'] ?></div></td>
		<td>
		<div class="dropstart">
			<span class="option-icon" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="bi bi-three-dots-vertical"></i>
			</span>
			<ul class="dropdown-menu">
				<li><a href="<?= BASEURL; ?>/players/edit/<?= $player['id']; ?>" class="dropdown-item edit-btn update-btn" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $player['id']; ?>" >Edit</a></li>
				<li><a href="<?= BASEURL; ?>/players/delete/<?= $player['id'];  ?>" onclick="return confirm('Are you sure you want to delete <?= strtoupper($player['name']); ?> ?')" class="dropdown-item">Delete</a></li>
			</ul>	
		</div>
		</td>
	</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan="7">
	<p class="text-center fs-5 my-5">Nothing found, try searching again.</p>
</td></tr>
<?php endif; ?>