<style type="text/css">
.card-profile > .card-body ul > li {
    padding: 4px 4px;
    border-bottom: 1px dotted #ddd;
}

.card-profile > .card-body ul > li:last-of-type {
    padding-bottom: none;
}
</style>
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
    <!-- Doctor Profile Starts -->
    <div class="row">
        <!-- Profile Spec Starts -->
        <div class="col-md-5 col-sm-12">
            <div class="profile-block">
                <div class="card card-profile rounded-0">
                    <div class="card-header text-center">
                        <img src="<?php echo $this->app_lib->get_image_url('staff/' . $doctor['photo']); ?>" alt="Doctor Profile Image" class="img-fluid">
                        <h3 class="card-title text-left"><?php echo $doctor['name']; ?></h3>
                        <p class="caption text-left"><?php echo $doctor['designation_name']; ?>, <?php echo $doctor['department_name']; ?></p>
                    </div>
                    <div class="card-body">
                        <h4 class="pro-h-b"><i class="far fa-clock"></i> Schedule<div></div></h4>
                        <ul class="list-unstyled">
                            <?php
								$appointment = $this->db->get_where('schedule', array('doctor_id' => $doctor['id']))->result_array();
								if (count($appointment)) {
									foreach ($appointment as $row) {
									?>
                            <li class="row">
                                <span class="col-md-4 col-sm-12"><strong><?php echo $row['day']; ?></strong></span>
                                <span class="col-md-8 col-sm-12"><?php echo date("h:i A", strtotime($row['time_start'])) . ' - ' . date("h:i A", strtotime($row['time_end'])); ?></span>
                            </li>
                            <?php 
                            } }else{
                                echo '<strong>No Appointment Slots Available.</strong>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="card-footer text-center text-lg-left">
                        <div class="clearfix">
                            <div class="float-lg-left">
                                <ul class="list-unstyled list-inline sm-links">
                                    <li class="list-inline-item"><a href="<?php echo $doctor['facebook_url']; ?>"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo $doctor['linkedin_url']; ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo $doctor['twitter_url']; ?>"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                            <div class="float-lg-right">
                                <a href="<?php echo base_url('home/appointment/' . $doctor['id']); ?>" class="btn btn-1 text-uppercase">Book An Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Spec Ends -->
        <!-- Profile Details Starts -->
        <div class="col-md-7 col-sm-12">
            <div class="profile-details">
                <h3 class="main-heading2"><?php echo $doctor['name']; ?></h3>
                <?php echo $doctor['biography']; ?>
            </div>
        </div>
        <!-- Profile Details Ends -->
    </div>
    <!-- Doctor Profile Ends -->
</div>
<!-- Main Container Ends -->