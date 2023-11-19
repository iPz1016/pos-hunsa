<div class="table-responsive">
	
	<table class="table table-striped table-hover">
		<tr>
			<th>ID</th><th>Username</th><th>First name</th><th>Last name</th><th>role</th>
			<th>
				<a href="index.php?pg=signup">
					<button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add new</button>
				</a>
			</th>
		</tr>

		<?php if (!empty($users)):?>
			<?php foreach ($users as $user):?>
	 		<tr>
				<td>
					<a href="index.php?pg=profile&id=<?=$user['id']?>">
					<?=esc($user['id'])?>
					</a>
				</td>

				<td>
					<a href="index.php?pg=profile&id=<?=$user['id']?>">
						<?=esc($user['username'])?>
					</a>	
				</td>
				<td><?=esc($user['firstname'])?></td>
				<td><?=esc($user['lastname'])?></td>
				<td><?=esc($user['role'])?></td>
				
				<td>
					<a href="index.php?pg=edit-user&id=<?=$user['id']?>">
						<button class="btn btn-success btn-sm">Edit</button>
					</a>
					<a href="index.php?pg=delete-user&id=<?=$user['id']?>">
						<button class="btn btn-danger btn-sm" <?php if(Auth::get('id')==$user['id']) echo "disabled"; ?>>Delete</button>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		<?php endif;?>
		
	</table>

	<?php $pager->display(count($users))?>
</div>