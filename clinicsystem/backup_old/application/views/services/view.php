<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-wheelchair"></i> <?php echo translate('Services') . " " . translate('list'); ?></h4>
			</header>
			<div class="panel-body mb-md">
				<div class="export_title"><?php echo translate('Services') . " " . translate('list'); ?></div>
				<table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%" id="table-export">
					<thead>
						<tr>
							<th><?php echo translate('sl'); ?></th>
							<th><?php echo translate('Name'); ?></th>
							<th><?php echo translate('Amount'); ?></th>
							<th><?php echo translate('From date'); ?></th>
							<th><?php echo translate('To date'); ?></th>
							<th><?php echo translate('Action'); ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						if (count($services_list)) { foreach($services_list as $row):
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo html_escape($row->name); ?></td>
							<td><?php echo html_escape($row->amount); ?></td>
							<td><?php echo html_escape($row->from_date); ?></td>
							<td><?php echo html_escape($row->to_date); ?></td>
							<td>
							
								<a href="<?php echo base_url('services/edit/' . $row->id); ?>" class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"><i class="fas fa-pen-nib"></i></a>
							
								<?php echo btn_delete('services/services_delete/' . $row->id); ?>
							
							</td>
						</tr>
						<?php endforeach; }?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>