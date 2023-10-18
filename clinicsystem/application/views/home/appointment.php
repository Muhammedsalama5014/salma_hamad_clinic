<?php
$patient_id = "";
if (loggedin_role_id() == 7) {
	$patient_id = $this->session->userdata('uniqueid');
}
?>
<!-- Main Banner Starts -->
<div class="main-banner" style="background: url(<?php echo base_url('uploads/frontend/banners/' . $page_data['banner_image']); ?>) center top;">
    <div class="container px-md-0">
        <h2><span><?php echo $page_data['page_title']; ?></span></h2>
    </div>
</div>
<!-- Main Banner Ends -->
<!-- Breadcrumb Starts -->
<div class="breadcrumb">
    <div class="container px-md-0">
        <ul class="list-unstyled list-inline">
            <li class="list-inline-item"><a href="<?php echo base_url('home') ?>">Home</a></li>
            <li class="list-inline-item active"><?php echo $page_data['page_title']; ?></li>
        </ul>
    </div>
</div>
<!-- Breadcrumb Ends -->
<!-- Main Container Starts -->
<div class="container px-md-0 main-container">
    <h3 class="main-heading2 mt-0"><?php echo $page_data['title']; ?></h3>
    <?php echo $page_data['description']; ?>
    <div class="box2 form-box">
        <?php
        if($this->session->flashdata('success')) {
            echo '<div class="alert alert-success"><i class="icon-text-ml far fa-check-circle"></i>' . $this->session->flashdata('success') . '</div>';
        }
        if($this->session->flashdata('error')) {
            echo '<div class="alert alert-error"><i class="icon-text-ml far fa-check-circle"></i>' . $this->session->flashdata('error') . '</div>';
        }
        ?>
        <div class="tabs-panel tabs-product">
            <div class="nav nav-tabs">
                <a class="nav-item nav-link <?php echo $active_tab == 1 ? 'active' : ''; ?>" data-toggle="tab"
                    href="#new-patient" role="tab" aria-controls="tab-details" aria-selected="true">New Patient</a>
                <a class="nav-item nav-link <?php echo $active_tab == 2 ? 'active' : ''; ?>" data-toggle="tab"
                    href="#old-patient" role="tab" aria-controls="tab-video" aria-selected="false">Old Patient</a>
            </div>
            <div class="tab-content clearfix">
                <div class="tab-pane fade show <?php echo $active_tab == 1 ? 'active' : ''; ?>" id="new-patient" role="tabpanel" aria-labelledby="tab-new-patient">
                    <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal')); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="new_patient_name">Patient Name <span class="required">*</span></label>
                                    <input type="text" name="new_patient_name" id="new_patient_name" class="form-control"
                                        value="<?php echo set_value('new_patient_name'); ?>" />
                                    <span class="text-danger"><?php echo form_error('new_patient_name'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="new_patient_gender">Patient Gender <span class="required">*</span></label>
                                    <select id="new_patient_gender" name="new_patient_gender" class="form-control select2">
                                        <option value="">Select</option>
                                        <option value="male" <?php if(set_value('new_patient_gender') == 'male') echo 'selected'; ?>>Male</option>
                                        <option value="female" <?php if(set_value('new_patient_gender') == 'female') echo 'selected'; ?>>Female</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('new_patient_gender'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="birthday">Patient Birthday <span class="required">*</span></label>
                                    <input type="text" class="form-control date" name="birthday" value="<?php echo set_value('birthday'); ?>" id="birthday" />
                                    <span class="text-danger"><?php echo form_error('birthday'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_email">Patient Email <span class="required">*</span></label>
                                    <input type="text" id="new_email" name="new_patient_email" value="<?php echo set_value('new_patient_email'); ?>" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('new_patient_email'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Patient Phone <span class="required">*</span></label>
                                    <input type="text" id="new_phone" name="new_patient_phone" value="<?php echo set_value('new_patient_phone'); ?>" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('new_patient_phone'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username <span class="required">*</span></label>
                                    <input type="text" name="new_username" id="new_username" value="<?php echo set_value('new_username'); ?>" class="form-control" />
                                    <span class="text-danger"><?php echo form_error('new_username'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="new_password">Password <span class="required">*</span></label>
                                    <input type="password" name="new_password" value="<?php echo set_value('new_password'); ?>" id="new_password"  class="form-control" />
                                    <span class="text-danger"><?php echo form_error('new_password'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_phone">Appointment Date <span class="required">*</span></label>
                            <input type="text" class="form-control date" name="new_appointment_date" value="<?php echo set_value('new_appointment_date', $today); ?>" id="new_appointment_date" />
                            <span class="text-danger"><?php echo form_error('new_appointment_date'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">Doctor <span class="required">*</span></label>
                            <?php
                                $doctorlist = $this->app_lib->getDoctorlListFront();
                                echo form_dropdown("new_doctor_id", $doctorlist, set_value("new_doctor_id"), "class='form-control select2' id='new_doctor_id' ");
                            ?>
                            <span class="text-danger"><?php echo form_error('new_doctor_id'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="new_time_slots">Time Slots <span class="required">*</span></label>
                            <select name="new_time_slots" class="form-control select2" id="new_time_slots">
                                <option value="">Select Time Slots</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('time_slots'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <span class="required">*</span></label>
                            <textarea class="form-control" id="new_message" name="new_message"
                                placeholder="Enter Message"><?php echo set_value('new_message'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('new_message'); ?></span>
                        </div>
                        <?php if ($cms_setting['captcha_status'] == 'enable'): ?>
                        <div class="form-group">
                            <?php echo $recaptcha['widget']; echo $recaptcha['script']; ?>
                            <span class="text-danger"><?php echo form_error('g-recaptcha-response'); ?></span>
                        </div>
                        <?php endif; ?>
                        <button type="submit" name="new_patient" value="1" class="btn btn-1">Book Appointment</button>
                    <?php echo form_close(); ?>
                </div>

                <div class="tab-pane <?php echo $active_tab == 2 ? 'active' : ''; ?>" id="old-patient" role="tabpanel" aria-labelledby="tab-old-patient">
                    <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal')); ?>
                        <div class="form-group">
                            <label for="patient_id">Patient ID <span class="required">*</span></label>
                            <input type="text" name="patient_id" id="patient_id" value="<?php echo set_value('patient_id', $patient_id); ?>" <?php echo ($patient_id == "" ? "" : "readonly") ?> class="form-control" />
                            <span class="text-danger"><?php echo form_error('patient_id'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="old_appointment_date">Appointment Date <span class="required">*</span></label>
                            <input type="text" class="form-control date" name="old_appointment_date" value="<?php echo set_value('old_appointment_date', $today); ?>" id="old_appointment_date" />
                        </div>
                        <div class="form-group">
                            <label for="old_doctor_id">Doctor <span class="required">*</span></label>
                            <?php
                                $doctorlist = $this->app_lib->getDoctorlListFront();
                                echo form_dropdown("old_doctor_id", $doctorlist, set_value("old_doctor_id"), "class='form-control select2' id='old_doctor_id'");
                            ?>
                            <span class="text-danger"><?php echo form_error('old_doctor_id'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="old_time_slots">Time Slots <span class="required">*</span></label>
                            <select name="old_time_slots" class="form-control select2" id="old_time_slots">
                                <option value="">Select Time Slots</option>
                            </select>
                            <span class="text-danger"><?php echo form_error('old_time_slots'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <span class="required">*</span></label>
                            <textarea class="form-control" id="old_message" name="old_message" placeholder="Enter Message"><?php echo set_value('old_message'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('old_message'); ?></span>
                        </div>
                        <button type="submit" name="old_patient" value="1" class="btn btn-1">Book Appointment</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var new_appointment_date = "<?php echo set_value('new_appointment_date', $today); ?>";
        var new_doctor_id = "<?php echo set_value('new_doctor_id', $doctor_id); ?>";
        var new_time_slots = "<?php echo set_value('new_time_slots'); ?>";
        getDoctorSchedule(new_appointment_date, new_doctor_id, 'new_time_slots', new_time_slots);

        var old_appointment_date = "<?php echo set_value('old_appointment_date', $today); ?>";
        var old_doctor_id = "<?php echo set_value('old_doctor_id', $doctor_id); ?>";
        var old_time_slots = "<?php echo set_value('old_time_slots'); ?>";
        getDoctorSchedule(old_appointment_date, old_doctor_id, 'old_time_slots', old_time_slots);

        $('#old_appointment_date, #old_doctor_id').on('change', function() {
            var appointment_date = $('#old_appointment_date').val();
            var doctor_id = $('#old_doctor_id').val();
            getDoctorSchedule(appointment_date, doctor_id, 'old_time_slots');
        });

        $('#new_appointment_date, #new_doctor_id').on('change', function() {
            var appointment_date = $('#new_appointment_date').val();
            var doctor_id = $('#new_doctor_id').val();
            getDoctorSchedule(appointment_date, doctor_id, 'new_time_slots');
        });
    });
</script>