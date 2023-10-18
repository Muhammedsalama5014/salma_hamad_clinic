<div class="row">
	<div class="col-md-12">
		<section class="panel">
            <?php echo form_open_multipart($this->uri->uri_string()); ?>
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fas fa-wheelchair"></i> <?php echo translate('create') . " " . translate('Document'); ?></h4>
				</div>
				<div class="panel-body">
					<!-- basic details -->
					
					<div class="row">
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('user_id')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('Employee Name'); ?> <span class="required">*</span></label>
								<select name="user_id" class="form-control" required>	
									<option value="">Select Employee</option>
									<?php 
										foreach ($stafflist as $staf) {
									?>
										<option value="<?= $staf->id; ?>"><?= $staf->name. '('.$staf->staff_id.')';?></option>
									<?php } ?>
								</select>	
									
								<span class="error"><?php echo form_error('user_id'); ?></span>
							</div>
						</div>
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('doc_type')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('Doc Type'); ?> <span class="required">*</span></label>
								<select name="doc_type" class="form-control" required>	
									<option value="MOH">MOH</option>
									<option value="Visa">Visa</option>
									<option value="Passport">Passport</option>
									<option value="CivilId">Civil Id</option>
									
								</select>	
									
								<span class="error"><?php echo form_error('doc_type'); ?></span>
							</div>
						</div>
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('expiry_date')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('Expiry Date'); ?> <span class="required">*</span></label>
								
									<input class="form-control" name="expiry_date" type="date"   value="<?php echo set_value('expiry_date'); ?>" required>
								<span class="error"><?php echo form_error('expiry_date'); ?></span>
							</div>
						</div>
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('Admin Notify')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('admin_notify'); ?><span class="required">*</span></label>
								
									<input class="form-control" name="admin_notify" type="datetime-local" value="<?php echo set_value('admin_notify'); ?>" required>
								<span class="error"><?php echo form_error('admin_notify'); ?></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="input-file-now"><?php echo translate('Doc File'); ?></label>
								<input type="file" name="document_file" class="dropify"  data-height="120" required />
							</div>
						</div>
				
						
					</div>

					
					</div>

				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button type="submit" name="save" value="1" class="btn btn btn-default btn-block"><i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?></button>
						</div>
					</div>
				</footer>
			<?php echo form_close(); ?>
		</section>
	</div>
</div>