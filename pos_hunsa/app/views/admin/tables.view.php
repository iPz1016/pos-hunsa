<div class="table-responsive">

	<table class="table table-striped table-hover">
		<tr class="fs-5">
			<th class="fw-black">Table ID</th>
			<th class="fw-black">Status</th>
			<th class="fw-black">Order</th>
			<th>
				<a href="index.php?pg=table-new">
					<button class="btn btn-primary btn-sm p-2"><i class="fa fa-plus"></i> Add table</button>
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
							echo "<a class='text-success'><i class='fa fa-check'></i>  Enable</a>";
						} else {
							echo "<a class='text-danger'><i class='fa fa-times'></i>  Disable</a>";
						}

						?>
						</a>
					</td>
					<td>
						<?php
						if($table['disable'] == 1)
						{
							echo "<a class='text-danger'><i class='fa fa-times'></i>  Disable</a>";
						}else
						if ($table['orders_id'] == 0) {
							echo "<a class='text-success'><i class='fa fa-check'></i>  Available</a>";
						}
						else {
							echo "<a class='text-primary' href='index.php?pg=order&orders_id=".$table['orders_id']."' ><i class='fa fa-stop-circle'></i>  Busy</a>";
						}

						?>
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
				<td></td>
				<td><a href="index.php?pg=table-delete">
						<button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Delete table</button>
					</a></td>
			</tr>
		<?php endif; ?>
	</table>
	<br>

</div>