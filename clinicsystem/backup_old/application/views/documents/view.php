<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-wheelchair"></i> <?php echo translate('Documents ') . " " . translate('list'); ?></h4>
			</header>
			<div class="panel-body mb-md">
				<div class="export_title"><?php echo translate('Documents ') . " " . translate('list'); ?></div>
				<table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%" id="table-export">
					<thead>
						<tr>
							<th><?php echo translate('sl'); ?></th>
							<th><?php echo translate('Name'); ?></th>
							<th><?php echo translate('Expiry Date'); ?></th>
							<th><?php echo translate('Notify Admin'); ?></th>
							<th><?php echo translate('Document Type'); ?></th>
							<th><?php echo translate('DOC'); ?></th>
							<th><?php echo translate('Action'); ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						if (count($doc_list)) { foreach($doc_list as $row):
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo html_escape($row->name). ' '.html_escape($row->staff_id); ?></td>
							<td><?php echo html_escape($row->expiry_date); ?></td>
							<td><?php echo date('Y-m-d H:i', strtotime($row->admin_notify)); ?></td>
							<td><?php echo html_escape($row->doc_type); ?></td>
							<td>
								<a href="<?php echo base_url('/uploads/attachments/documents/').$row->file_name; ?>" target="_blank">View</a>
							</td>
							<td>
							
								<a href="<?php echo base_url('documents/edit/' . $row->id); ?>" class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"><i class="fas fa-pen-nib"></i></a>
							
								<?php echo btn_delete('documents/documents_delete/' . $row->id); ?>
							
							</td>
						</tr>
						<?php endforeach; }?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>