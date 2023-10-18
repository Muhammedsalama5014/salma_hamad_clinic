<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-notes-medical"></i> <?php echo translate('create') . " " . translate('appointment'); ?></h4>
	</header>
	<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
		<div class="panel-body">
			<div class="form-group mt-md">
				<label class="col-md-3 control-label"><?php echo translate('patient'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<?php
						$patientlist = $this->app_lib->getPatientList();
						echo form_dropdown("patient_id", $patientlist, set_value('patient_id'), "class='form-control' required data-plugin-selectTwo data-width='100%'");
					?>
				</div>
			</div>
			<div class="form-group <?php if (form_error('operate_by')) echo 'has-error'; ?>">
					<label class="col-md-3 control-label"><?php echo translate('operate by'); ?> <span class="required">*</span></label>
					<div class="col-md-6">
					    <select class="form-control operate_by" name="operate_by" required>
							<option>Select option</option>
							<option value="3">Doctor</option>
							<option value="5">Nurse</option>
							<option value="8">Therapist</option>
							<option value="9">HBO</option>
						</select>
						<span class="error"><?php echo form_error('operate_by'); ?></span>
					</div>
			</div>

			<div class="form-group <?php if (form_error('doctor_id')) echo 'has-error'; ?>">
				<label class="col-md-3 control-label"><?php echo translate('Select person'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select class="form-control doctor_id" name="doctor_id" id="adoctor_id" required>
						<option>Select option</option>
					</select>
					<span class="error"><?php echo form_error('doctor_id'); ?></span>
				</div>
			</div>

			
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('Appointment Status'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select name="status" class="form-control status" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="status" required>
						<option value=""><?php echo translate('select'); ?></option>
						<option value="1"><?php echo translate('Confirmed'); ?></option>
						<option value="3"><?php echo translate('Ok'); ?></option>
						<option value="4"><?php echo translate('Not Confirmed'); ?></option>
						<option value="5"><?php echo translate('Cancelled'); ?></option>
						<option value="6"><?php echo translate('Waiting'); ?></option>
						<option value="7"><?php echo translate('Received'); ?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('appointment') . " " . translate('date'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<input type="text" class="form-control" data-plugin-datepicker name="appointment_date" required value="<?php echo date('Y-m-d'); ?>" id="appointment_date" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('time_slot'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select name="available_schedule" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="available_schedule" required>
						<option value=""><?php echo translate('select'); ?></option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('Select Services'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select name="service_id" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="service_id" required>
						<option>Select Services</option>
						<?php 
							foreach ($services as $ser) {
						?>
							<option value="<?php echo $ser['id']; ?>" data-patient_price="<?php echo $ser['patient_price']; ?>" ><?php echo $ser['name']; ?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('Services fee'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<input type="number" class="form-control" name="consultation_fees" readonly value="0.00" id="consultation_fees" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('discount'); ?></label>
				<div class="col-md-6">
					<input type="number" class="form-control" name="discount" value="0.00" id="discount" onchange="netBillCalculation()" onkeyup="netBillCalculation(this.value)"  />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('net') . " " . translate('payable'); ?></label>
				<div class="col-md-6">
					<input type="number" class="form-control" name="net_payable" readonly value="0.00" id="net_payable" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('remarks'); ?></label>
				<div class="col-md-6 mb-md">
					<textarea name="remarks" class="form-control"></textarea>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-2 col-md-offset-3">
					<button type="submit" class="btn btn-default btn-block" name="save" value="1">
						<i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?>
					</button>
				</div>
			</div>	
		</footer>
	<?php echo form_close(); ?>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$('#service_id').on('change', function(){
			let patient_price = $(this).find(':selected').attr('data-patient_price');
		 	$('#consultation_fees').val(patient_price);
            netBillCalculation();
		});
		$('#appointment_date, #adoctor_id,#status').on('change', function(){
			var doctor_id = $('#adoctor_id').val();
			var appointment_date = $('#appointment_date').val();
			if (doctor_id !== "" && appointment_date !== "") {
				$('#discount').val('0.00');
				$("#available_schedule").html("<option value=''><?php echo translate('exploring'); ?>...</option>");
				var status = $('#status').val();
	            $.ajax({
	                url: "<?php echo base_url('ajax/get_appointment_schedule'); ?>",
	                type: "POST",
	                data: {'appointment_date' : appointment_date, 'doctor_id' : doctor_id, status:status},
	                dataType: 'html',
	                success: function (data) {
	                	var response = jQuery.parseJSON(data);
	                    $('#available_schedule').html(response.schedule);
	                    //$('#consultation_fees').val(response.fees);
	                    netBillCalculation();
	                }
	            });
			}
		});
	});

	var base_url = "<?php echo base_url();?>"
	$('.operate_by').on('change', function(){
		var role = $(this).val();

		$.get(base_url+'/employee/getempbyrole/'+role, function(data, status){
			var option = "<option value=''>Select option</option>";
			data = JSON.parse( data );
			for (var i=0;i<data.length;i++) {
				option+="<option value='"+data[i].id+"'>"+data[i].name+' ( '+data[i].staff_id+" )</option>";
			}
			$('.doctor_id').html(option);
	    
	 	});
	});
</script>