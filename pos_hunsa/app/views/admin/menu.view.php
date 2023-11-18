<div class="table-responsive">

	<table class="table table-striped table-hover">
		<tr>
			<th>Menu id</th>
			<th>Name</th>
			<th>Type</th>
			<th>Price</th>
			<th>Image</th>
			<th>Disable</th>
			<th>
				<a href="index.php?pg=menu-new">
					<button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add new</button>
				</a>
			</th>
		</tr>

		<?php if (!empty($products)) : ?>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= esc($product['menu_id']) ?></td>
					<td>
						<a href="index.php?pg=menu-edit&id=<?= $product['menu_id'] ?>">
							<?= esc(strtoupper($product['menu_name'])) ?>
						</a>
					</td>
					<td><?= esc($product['menu_type']) ?></td>
					<td><?= esc($product['menu_price']) ?></td>
					<td>
						<img src="<?= crop($product['menu_img']) ?>" style="width: 100%;max-width:100px;">
					</td>
					<td>
						<?php
						if($product['disable']==0)
						{
							echo "Enable";
						}
						else
						{
							echo "Disable";
						}
						?>
					</td>
					<td>
						<a href="index.php?pg=menu-edit&id=<?= $product['menu_id'] ?>">
							<button class="btn btn-success btn-sm">Edit</button>
						</a>
						<a href="index.php?pg=menu-delete&id=<?= $product['menu_id'] ?>">
							<button class="btn btn-danger btn-sm">Delete</button>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>

	</table>
</div>