<?php $currency_symbol = $global_config['currency_symbol']; ?>
<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"> <?php echo translate('select_ground'); ?></h4>
	</header>
    <?php echo form_open($this->uri->uri_string()); ?>
		<div class="panel-body">
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
		<h4 class="panel-title"><i class="fas fa-list-ol"></i> <?php echo translate('paid') . " " . translate('bill') . " " . translate('report'); ?></h4>
	</header>
	<div class="panel-body">
		<div class="export_title">Paid Bill Report : <?php echo _d($daterange[0]); ?> To <?php echo _d($daterange[1]); ?></div>
		<table class="table table-bordered table-hover table-condensed tbr-top" cellspacing="0" width="100%" id="table-export">
			<thead>
				<tr>
					<th><?php echo translate('sl'); ?></th>
					<th><?php echo translate('bill_no'); ?></th>
					<th><?php echo translate('patient') . " " . translate('fileid'); ?></th>
					<th><?php echo translate('patient') . " " . translate('name'); ?></th>
					<th><?php echo translate('patient') . " " . translate('civilid'); ?></th>
					<th><?php echo translate('patient') . " " . translate('mobile'); ?></th>
					<th><?php echo translate('referral'); ?></th>
					<th><?php echo translate('category'); ?></th>
					<th><?php echo translate('total') . " " . translate('bill'); ?></th>
					<th><?php echo translate('discount'); ?></th>
					<th><?php echo translate('net') . " " . translate('payable'); ?></th>
					<th><?php echo translate('paid'); ?></th>
					<th><?php echo translate('billing') . " " . translate('date'); ?></th>
					<th><?php echo translate('action'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$count = 1;
				$total_bill = 0;
				$total_discount = 0;
				$total_tax = 0;
				$total_netpayable = 0;
				$total_paid = 0;
				if (!empty($results)){ foreach ($results as $row):
					$total_bill += $row['total'];
					$total_discount += $row['discount'];
					$total_tax += $row['tax_amount'];
					$total_netpayable += $row['net_amount'];
					$total_paid += $row['paid'];
				?>	
				<tr>
					<td><?php echo $count++ ; ?></td>
					<td><?php echo html_escape($row['bill_no']); ?></td>
					<td><?php echo html_escape($row['patient_id']); ?></td>					
					<td><?php echo html_escape($row['patient_name'] . " - " . $row['patient_id']); ?></td>
					<td><?php echo html_escape($row['patient_civilid']); ?></td>
					<td><?php echo html_escape($row['patient_mobile']); ?></td>
					<td><?php echo html_escape($row['referral_name']); ?></td>
					<td><?php echo html_escape($this->billing_model->get_category_bill_list($row['id']));?></td>				
					<td><?php echo html_escape( number_format($row['total'], 2, '.', '')); ?></td>
					<td><?php echo html_escape( number_format($row['discount'], 2, '.', '')); ?></td>
					<td><?php echo html_escape( number_format($row['net_amount'], 2, '.', '')); ?></td>
					<td><?php echo html_escape( number_format($row['paid'], 2, '.', '')); ?></td>
					<td><?php echo html_escape(_d($row['date'])); ?></td>
					<td>
					<?php if (get_permission('lab_test_bill', 'is_view')): ?>
						<a href="<?php echo base_url('billing/test_bill_invoice/' . html_escape($row['id']) . "/" . html_escape($row['hash'])); ?>" target="_blank" class="btn btn-circle icon btn-default" data-toggle="tooltip" data-original-title="<?php echo translate('bill_view'); ?>"> <i class="fas fa-eye"></i></a>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; }?>
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
					<th><?php echo html_escape( number_format($total_bill, 2, '.', '')); ?></th>
					<th><?php echo html_escape( number_format($total_discount, 2, '.', '')); ?></th>
					<th><?php echo html_escape( number_format($total_netpayable, 2, '.', '')); ?></th>
					<th><?php echo html_escape( number_format($total_paid, 2, '.', '')); ?></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</section>
<?php endif; ?>