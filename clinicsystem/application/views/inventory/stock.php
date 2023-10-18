<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#chemicallist" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('stock') . ' ' . translate('list'); ?></a>
			</li>

		</ul>
		<div class="tab-content">
			<div id="chemicallist" class="tab-pane active mb-md">
				<div class="export_title"><?php echo translate('stock') . " " . translate('report'); ?></div>
				<table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%" id="table-export">
					<thead>
						<tr>
							<th><?php echo translate('sl'); ?></th>
							<th><?php echo translate('bill_no'); ?></th>
							<th><?php echo translate('stock_by'); ?></th>
							<th><?php echo translate('category'); ?></th>
							<th><?php echo translate('name'); ?></th>
							<th><?php echo translate('date'); ?></th>
							<th><?php echo translate('quantity'); ?></th>
							<th><?php echo translate('available') . " " . translate('quantity'); ?></th>
							<th><?php echo translate('remarks'); ?></th>
							<th><?php echo translate('action'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						if(!empty($stocktlist)) {
							foreach ($stocktlist as $row):
								?>	
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo html_escape($row['inovice_no']); ?></td>
							<td><?php echo html_escape($row['staff_name']) . " (". $row['staff_id'] . ")"; ?></td>
							<td><?php echo html_escape($row['category_name']); ?></td>
							<td><?php echo html_escape($row['chemical_name']); ?></td>
							<td><?php echo html_escape(_d($row['date'])); ?></td>
							<td><?php echo html_escape($row['stock_quantity']); ?></td>
							<td><?php echo html_escape($row['available_stock']); ?></td>
							<td><?php echo html_escape($row['remarks']); ?></td>
							<td>
								<?php if (get_permission('chemical_stock', 'is_edit')): ?>
									<a href="<?php echo base_url('inventory/chemical_stock_edit/' . html_escape($row['id'])); ?>" class="btn btn-circle icon btn-default" data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"> 
										<i class="fas fa-pen-nib"></i>
									</a>
								<?php endif; if (get_permission('chemical_stock', 'is_delete')): ?>
									<?php echo btn_delete('inventory/chemical_stock_delete/' . html_escape($row['id'])); ?>
								<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; }?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</section>