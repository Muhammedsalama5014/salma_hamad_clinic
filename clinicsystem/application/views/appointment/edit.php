<section class="panel">
	<header class="panel-heading">
		<h4 class="panel-title"><i class="fas fa-notes-medical"></i> <?php echo translate('edit') . " " . translate('appointment'); ?></h4>
	</header>
    <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
		<input type="hidden" name="appointment_id" id="appointment_id" value="<?php echo html_escape($appointment['id']); ?>">
		<div class="panel-body">
			<div class="form-group mt-md">
				<label class="col-md-3 control-label"><?php echo translate('patient'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<?php
					echo form_dropdown("patient_id", $patientlist, set_value('patient_id',$appointment['patient_id']), "class='form-control'
					required data-plugin-selectTwo data-width='100%'");
					?>
				</div>
			</div>
			<div class="form-group <?php if (form_error('operate_by')) echo 'has-error'; ?>">
						<label class="col-md-3 control-label"><?php echo translate('operate by'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<select class="form-control operate_by" name="operate_by" required>
								<option>Select option</option>
								<option value="3" <?php if($appointment['operate_by']==3){echo "selected"; } ?>>Doctor</option>
								<option value="5" <?php if($appointment['operate_by']==5){echo "selected"; } ?>>Nurse</option>
								<option value="8" <?php if($appointment['operate_by']==8){echo "selected"; } ?>>Therapist</option>
								<option value="9" <?php if($appointment['operate_by']==9){echo "selected"; } ?>>HBO</option>
							</select>
							<span class="error"><?php echo form_error('operate_by'); ?></span>
						</div>
			</div>
			<div class="form-group <?php if (form_error('doctor_id')) echo 'has-error'; ?>">
				<label class="col-md-3 control-label"><?php echo translate('Select person'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select class="form-control doctor_id" name="doctor_id" required id="adoctor_id">
						<option>Select option</option>
					</select>
					<span class="error"><?php echo form_error('doctor_id'); ?></span>
				</div>
			</div>
			<!-- <div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('doctor'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<?php echo form_dropdown("doctor_id", $doctorlist, set_value('doctor_id',$appointment['doctor_id']), "class='form-control' 
					id='adoctor_id' required data-plugin-selectTwo data-width='100%'");?>
				</div>
			</div> -->
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('Appointment Status'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select name="status" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="status2" required>
						<option value=""><?php echo translate('select'); ?></option>
						<option value="1" <?php if($appointment['status']==="1"){echo "selected"; }?>><?php echo translate('Confirmed'); ?></option>
						<option value="3" <?php if($appointment['status']==="3"){echo "selected"; }?>><?php echo translate('Ok'); ?></option>
						<option value="4" <?php if($appointment['status']==="4"){echo "selected"; }?>><?php echo translate('Not Confirmed'); ?></option>
						<option value="5" <?php if($appointment['status']==="5"){echo "selected"; }?>><?php echo translate('Cancelled'); ?></option>
						<option value="6" <?php if($appointment['status']==="6"){echo "selected"; }?>><?php echo translate('Waiting'); ?></option>
						<option value="7" <?php if($appointment['status']==="7"){echo "selected"; }?>><?php echo translate('Received'); ?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('appointment') . " " . translate('date'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="appointment_date" required value="<?php echo html_escape($appointment['appointment_date']); ?>" id="appointment_date" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('time_slot'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<select id="available_schedule" name="available_schedule" data-plugin-selectTwo data-width="100%" class="form-control" required>
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
							<option value="<?php echo $ser['id']; ?>" data-patient_price="<?php echo $ser['patient_price']; ?>" <?php if($appointment['service_id']===$ser['id']){echo "selected"; }?> ><?php echo $ser['name']; ?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('Services fees'); ?> <span class="required">*</span></label>
				<div class="col-md-6">
					<input type="number" class="form-control" name="consultation_fees" readonly value="<?php echo html_escape($appointment['consultation_fees']); ?>" id="consultation_fees" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('discount'); ?></label>
				<div class="col-md-6">
					<input type="number" class="form-control" name="discount" value="<?php echo html_escape($appointment['discount']); ?>" id="discount" onchange="netBillCalculation()" onkeyup="netBillCalculation()"  />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('net') . " " . translate('payable'); ?></label>
				<div class="col-md-6">
					<input type="number" class="form-control" name="net_payable" readonly value="0.00" id="net_payable" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?php echo translate('message'); ?> </label>
				<div class="col-md-6 mb-md">
					<textarea name="remarks" class="form-control"><?php echo html_escape($appointment['remarks']); ?></textarea>
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
	var appointment_id = $('#appointment_id').val();
    $(document).ready(function () {
        $('#appointment_date').datepicker({
        	orientation: "bottom",
            format: "yyyy-mm-dd",
            autoclose: true,
        })

		$("#adoctor_id, #appointment_date,#status").on("change", function() {
			var adoctor_id = $('#adoctor_id').val();
			var appointment_date = $('#appointment_date').val();
			getDoctorSchedule(adoctor_id, appointment_date, 0)
        });

		var doctor_id = "<?php echo html_escape($appointment['doctor_id']); ?>";
		var appointment_date = "<?php echo html_escape($appointment['appointment_date']); ?>";
		var schedule = "<?php echo html_escape($appointment['schedule']); ?>";
		getDoctorSchedule(doctor_id, appointment_date, schedule);
	})

	function getDoctorSchedule(doctor_id, appointment_date, schedule_id){
		if (doctor_id !== "" && appointment_date !== "") {
			$("#available_schedule").html("<option value=''><?php echo translate('exploring'); ?>...</option>");
			var status = $('#status').val();

	        $.ajax({
	            url: "<?php echo base_url('ajax/get_appointment_schedule'); ?>",
	            type: "POST",
	            data: {'appointment_id' : appointment_id, 'appointment_date' : appointment_date, 'doctor_id' : doctor_id, 'schedule_id' : schedule_id, 'status':status},
	            dataType: 'html',
	            success: function (data) {
	            	var response = JSON.parse(data);
	                $('#available_schedule').html(response.schedule);
	                //$('#consultation_fees').val(response.fees);
	                netBillCalculation();
	            }
	        });
		}
	}
	$('#service_id').on('change', function(){
			let patient_price = $(this).find(':selected').attr('data-patient_price');
		 	$('#consultation_fees').val(patient_price);
            netBillCalculation();
		});

	var base_url = "<?php echo base_url();?>"
	var operate_by = $('.operate_by').val();
	var doctor_id = "<?php echo $appointment['doctor_id'];?>";
	$('.operate_by').on('change', function(){
		var role = $(this).val();
		getbyrole(role);
		
	});
	function getbyrole (role) {
		$.get(base_url+'/employee/getempbyrole/'+role, function(data, status){
			var option = "<option value=''>Select option</option>";
			data = JSON.parse( data );
			for (var i=0;i<data.length;i++) {
				var selected = "";
				if (data[i].id==doctor_id) {
					selected = "selected"
				}
				option+="<option value='"+data[i].id+"' "+selected+">"+data[i].name+' ( '+data[i].staff_id+" )</option>";
			}
			$('.doctor_id').html(option);
	    
	 	});
	}
	getbyrole (operate_by) ;
</script>