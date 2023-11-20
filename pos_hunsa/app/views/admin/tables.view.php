<div class="table-responsive">

	<table class="table table-striped table-hover">
		<tr>
			<th>Table ID</th>
			<th>Status</th>
			<th>
				<a href="index.php?pg=table-new">
					<button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add table</button>
				</a>
			</th>
		</tr>

		<?php if (!empty($table_info)) : ?>
			<?php foreach ($table_info as $table) : ?>
				<tr>
					<td>
						<?= esc($table['table_id']) ?>
						</a>
					</td>

					<td>
						<?php
						if ($table['disable'] == 0) {
							echo "<i class='fa fa-check'></i>  Enable";
						} else {
							echo "<i class='fa fa-times'></i>  Disable";
						}

						?>
						</a>
					</td>

					<td>
						<a href="index.php?pg=table-edit&id=<?= $table['table_id'] ?>">
							<button class="btn btn-success btn-sm">Edit</button>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td><a href="index.php?pg=table-delete">
						<button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Delete table</button>
					</a></td>
			</tr>
		<?php endif; ?>
	</table>
	<br>

</div>