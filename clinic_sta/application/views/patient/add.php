<div class="row">
	<div class="col-md-12">
		<section class="panel">

<?php $data = $this->session->flashdata('data');?>


            <?php echo form_open_multipart($this->uri->uri_string()); ?>
			<input name="form_type" type="hidden" value="add">

				<div class="panel-heading">
					<h4 class="panel-title"><i class="fas fa-wheelchair"></i> <?php echo translate('create') . " " . translate('patient'); ?></h4>
				</div>
				<div class="panel-body">
					<!-- basic details -->
					<div class="headers-line mt-md">
						<i class="fas fa-user-check"></i> <?php echo translate('basic') . " " . translate('details'); ?>
					</div>
					
					<div class="row">
						<div class="col-md-4 mb-sm">
							<div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('name'); ?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-user"></i></span>
									<input class="form-control" name="name" type="text" value="<?php echo $data['name']; ?>">
								</div>
								<span class="error"><?php echo form_error('name'); ?></span>
							</div>
						</div>

						<?php /*<div class="col-md-4 mb-sm">
							<div class="form-group <?php if (form_error('patient_id')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('patient file id'); ?></label>
									<input class="form-control" name="patient_id" type="text" value="<?php echo $data['patient_id']; ?>">
								<span class="error"><?php echo form_error('patient_id'); ?></span>
							</div>
						</div>*/?>
						
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('gender'); ?></label>
								<?php
									$array = array(
										"" => translate('select'),
										"male" => translate('male'),
										"female" => translate('female')
									);
									echo form_dropdown("gender", $array, $data['gender'], "class='form-control' data-plugin-selectTwo data-width='100%'
									data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"><?php echo form_error('gender'); ?></span>
							</div>
						</div>
						<br>

						<div class="col-md-7 mb-sm">
							<div class="form-group ">
								<label class="control-label">Nationality <span class="required"></span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-user"></i></span>
									<input class="form-control" name="nationality" value="<?php echo $data['nationality']; ?>" type="text" >
								</div>
								
							</div>
						</div>

						<div class="col-md-5 mb-sm">
							<div class="form-group ">
								<label class="control-label">Civil ID <span class="required"></span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-user"></i></span>
									<input class="form-control" id="nationalid" name="nationalid" value="<?php echo $data['nationalid']; ?>"  onchange="age_update(this.value)" type="number" min="0" >
								</div>
								
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-6 mb-sm">
								<div class="form-group ">
									<label class="control-label">Patient Case <span class="required"></span></label>
									<input type="text" class="form-control" value="<?php echo $data['patientcase']; ?>" name="patientcase"  >	
								</div>
						</div>

						<div class="col-md-6 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('Known_us_from'); ?><span class="required"></span></label>
								<?php
									$maritalArray = array(
										''  => translate('select'),
										'facebook' => translate('facebook'),
										'instagram' => translate('instagram'),
										'twitter' => translate('twitter')
									);
									echo form_dropdown("knownusfrom", $maritalArray, $data['knownusfrom'], "class='form-control' data-plugin-selectTwo
									data-width='100%' data-minimum-results-for-search='Infinity' ");
								?>
							</div>
						</div>

						<div class="col-md-6 mb-sm">
								<div class="form-group ">
									<label class="control-label">Patient Job <span class="required"></span></label>
									<input type="text" class="form-control" value="<?php echo $data['job']; ?>" name="job"  >	
								</div>
						</div>

						<div class="col-md-6 mb-sm">
								<div class="form-group ">
									<label class="control-label">Debit Balance  <span class="required"></span></label>
									<input type="text" class="form-control" value="<?php echo $data['debitbalance']; ?>" name="debitbalance"  >	
								</div>
						</div>

						<div class="col-md-6 mb-sm">
								<div class="form-group ">
									<label class="control-label">Credit Balance <span class="required"></span></label>
									<input type="text" class="form-control" value="<?php echo $data['creditbalance']; ?>" name="creditbalance"  >	
								</div>
						</div>

						<div class="col-md-6 mb-sm">
								<div class="form-group ">
									<label class="control-label">Tel <span class="required"></span></label>
									<input type="text" class="form-control" value="<?php echo $data['tel']; ?>" name="tel"  >	
								</div>
						</div>

				</div>

					<div class="row">
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('birthday'); ?></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
									<input class="form-control" name="birthday" id="patient_birthday" value="<?php echo $data['birthday']; ?>" data-plugin-datepicker
									data-plugin-options='{ "startView": 2 }' type="text">
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group <?php if (form_error('age')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('age'); ?> <span class="required"></span></label>
								<input type="text" class="form-control" name="age" id="age" value="<?php echo $data['age']; ?>">
								<span class="error"><?php echo form_error('age'); ?></span>
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('marital_status'); ?></label>
								<?php
									$maritalArray = array(
										''  => translate('select'),
										'1' => translate('single'),
										'2' => translate('married'),
										'3' => translate('Divorced'),
										'4' => translate('Widower')
									);
									echo form_dropdown("marital_status", $maritalArray, $data['marital_status'], "class='form-control' data-plugin-selectTwo
									data-width='100%' data-minimum-results-for-search='Infinity' ");
								?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('mobile_no')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('mobile_no'); ?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
									<input class="form-control" name="mobile_no" type="text" value="<?php echo $data['mobile_no']; ?>" required>
								</div>
								<span class="error"><?php echo form_error('mobile_no'); ?></span>
							</div>
						</div>
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('email')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('email'); ?> <span class="required"></span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-envelope-open"></i></span>
									<input type="email" class="form-control" name="email" id="email" value="<?php echo $data['email']; ?>" />
								</div>
								<span class="error"><?php echo form_error('email'); ?></span>
							</div>
						</div>
					</div>

					<div class="row">
						<!-- 
						<div class="col-md-4 mb-md">
							<div class="form-group <?php if (form_error('category_id')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('category'); ?> <span class="required">*</span></label>
								<?php
									echo form_dropdown("category_id", $categorylist, $data['category_id'] , "class='form-control' id='category_id' 
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"><?php echo form_error('category_id'); ?></span>
							</div>
						</div>
						-->
						<div class="col-md-2 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('blood_group'); ?></label>
								<?php
									$bloodlist = $this->app_lib->get_blood_group();
									echo form_dropdown("blood_group", $bloodlist, $data['blood_group'], "class='form-control' data-plugin-selectTwo
									data-width='100%' data-minimum-results-for-search='Infinity' ");
								?>
							</div>
						</div>
						<div class="col-md-2 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('blood_pressure'); ?></label>
								<input type="text" class="form-control" name="blood_pressure" value="<?php echo $data['blood_pressure']; ?>">
							</div>
						</div>
						<div class="col-md-2 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('height'); ?></label>
								<input type="text" class="form-control" name="height" value="<?php echo $data['height']; ?>">
							</div>
						</div>
						<div class="col-md-2 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('weight'); ?></label>
								<input type="text" class="form-control" name="weight" value="<?php echo $data['weight']; ?>">
							</div>
						</div>
					</div>
			
					<div class="row">
						<div class="col-md-12 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('address'); ?></label>
								<textarea class="form-control" rows="3" name="address" placeholder="<?php echo translate('address'); ?>" ><?php echo $data['address']; ?></textarea>
							</div>
						</div>
					</div>
					
					<div class="row mb-md">
						<div class="col-md-12">
							<div class="form-group">
								<label for="input-file-now"><?php echo translate('profile_picture'); ?></label>
								<input type="file" name="user_photo" class="dropify" data-allowed-file-extensions="jpg png" data-height="120" />
							</div>
						</div>
					</div>

					<!-- emergency contact -->
					<div class="headers-line">
						<i class="fas fa-pencil-ruler"></i> <?php echo translate('emergency_contact'); ?>
					</div>

					<div class="row">
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('guardian'); ?></label>
								<input class="form-control" name="guardian" type="text" value="<?php echo $data['guardian']; ?>">
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group>">
								<label class="control-label"><?php echo translate('relationship'); ?></label>
								<input class="form-control" name="relationship" type="text" value="<?php echo $data['relationship']; ?>">
							</div>
						</div>
						<div class="col-md-4 mb-sm">
							<div class="form-group">
								<label class="control-label"><?php echo translate('mobile_no'); ?></label>
								<input class="form-control" name="gua_mobileno" type="text" value="<?php echo $data['gua_mobileno']; ?>">
							</div>
						</div>

					</div>

					<!-- login details 
					<div class="headers-line">
						<i class="fas fa-user-lock"></i> <?php echo translate('login_details'); ?>
					</div>

					<div class="row mb-lg">
						<div class="col-md-6 mb-sm">
							<div class="form-group <?php if (form_error('username')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('username'); ?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-user-lock"></i></span>
									<input type="username" class="form-control" name="username" id="username" value="<?php echo $data['username']; ?>" />
								</div>
								<span class="error"><?php echo form_error('username'); ?></span>
							</div>
						</div>
						<div class="col-md-3 mb-sm">
							<div class="form-group <?php if (form_error('password')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('password'); ?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
									<input type="password" class="form-control" name="password" value="<?php echo $data['password']; ?>" />
								</div>
								<span class="error"><?php echo form_error('password'); ?></span>
							</div>
						</div>
						<div class="col-md-3 mb-sm">
							<div class="form-group <?php if (form_error('retype_password')) echo 'has-error'; ?>">
								<label class="control-label"><?php echo translate('retype_password'); ?> <span class="required">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock-alt"></i></span>
									<input type="password" class="form-control" name="retype_password"  value="<?php echo $data['retype_password']; ?>" />
								</div>
								<span class="error"><?php echo form_error('retype_password'); ?></span>
							</div>
						</div>
					</div>
					-->
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
<script>
	$('.mobile_no').on('change', function(){
		
		var value = $(this).val();
		$.post(base_url+'patient/checkbyphone',
			{
				phone: $(this).val()
			},
		function(data, status){
			let datafinal = JSON.parse(data);
			if (datafinal.status == false) {
				alert("Patient already exist with this phone number");
				$('.mobile_no').val('');
			}
			
		});

	})
</script>