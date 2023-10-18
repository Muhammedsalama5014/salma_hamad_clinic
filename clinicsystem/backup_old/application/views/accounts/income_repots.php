<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"> <?php echo translate('select_ground'); ?></h4>
	</header>
	<?php echo form_open($this->uri->uri_string(), array('class' => 'validate')); ?>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-offset-3 col-md-6 mb-lg">		
					<div class="form-group">
						<label class="control-label"><?php echo translate('date'); ?> <span class="required">*</span></label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fas fa-calendar-check"></i></span>
							<input type="text" class="form-control daterange" name="daterange" value="<?php echo set_value('daterange', date("Y/m/d") . ' - ' . date("Y/m/d")); ?>" required />
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<button type="submit" name="search" value="1" class="btn btn btn-default btn-block"> <i class="fas fa-filter"></i> <?php echo translate('filter'); ?></button>
				</div>
			</div>
		</footer>
	<?php echo form_close(); ?>
</section>

<?php if (isset($results)): ?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?php echo translate('income') . " " . translate('repots'); ?></h4>
	</header>
	<div class="panel-body">
		<!-- Hidden information for printing -->
		<div class="export_title">Income Repots : <?php echo _d($daterange[0]); ?> To <?php echo _d($daterange[1]); ?></div>
		<table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%" id="table-export">
			<thead>
				<tr>
					<th width="50"><?php echo translate('sl'); ?></th>
					<th><?php echo translate('account') . " " . translate('name'); ?></th>
					<th><?php echo translate('type'); ?></th>
					<th><?php echo translate('voucher') . " " . translate('head'); ?></th>
					<th><?php echo translate('ref_no'); ?></th>
					<th><?php echo translate('description'); ?></th>
					<th><?php echo translate('pay_via'); ?></th>
					<th><?php echo translate('date'); ?></th>
					<th><?php echo translate('amount') . ' (Cr.)'?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total_cr = 0;
				$count = 1;
				if(!empty($results)) {
					foreach($results as $row):
						$total_cr += $row['amount'];
				?>	
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo html_escape($row['ac_name']); ?></td>
					<td><?php echo html_escape(ucfirst($row['type'])); ?></td>
					<td><?php echo html_escape($row['v_head']); ?></td>
					<td><?php echo html_escape($row['ref']); ?></td>
					<td><?php echo html_escape($row['description']); ?></td>
					<td><?php echo html_escape($row['via_name']); ?></td>
					<td><?php echo html_escape(_d($row['date'])); ?></td>
					<td><?php echo html_escape($currency_symbol . $row['amount']); ?></td>
				</tr>
				<?php endforeach; } ?>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th><?php echo html_escape($currency_symbol . number_format($total_cr, 2, '.', '')); ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</section>
<?php endif; ?>