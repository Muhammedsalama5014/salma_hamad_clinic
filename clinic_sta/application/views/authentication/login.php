<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width,initial-scale=1" name="viewport">
		<meta name="keywords" content="">
		<meta name="author" content="techtune">
		<meta name="description" content="">
		<title><?php echo translate('login'); ?></title>
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>">
		<!-- Web Fonts  -->
		<link href="<?php echo is_secure('fonts.googleapis.com/css?family=Signika:300,400,600,700'); ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/all.min.css'); ?>">
		<script src="<?php echo base_url('assets/vendor/jquery/jquery.js'); ?>"></script>
		<!-- Sweetalert js/css -->
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/sweetalert/sweetalert-custom.css'); ?>">
		<script src="<?php echo base_url('assets/vendor/sweetalert/sweetalert.min.js'); ?>"></script>
		<!-- login page style css -->
		<link rel="stylesheet" href="<?php echo base_url('assets/login_page/css/style.css'); ?>">
		<script type="text/javascript">
			var base_url = '<?php echo base_url() ?>';
		</script>
	</head>
	<body>
        <div class="auth-main">
            <div class="container">
                <!-- image and information -->
                <div  style="background-color: white !important; height: 600px; z-index:10;border-radius: 10px;" class="col-lg-4 col-lg-offset-1 col-md-4 col-sm-12  fitxt-center">
                    <div   class="">
                    
                        <div class="image-hader">
                            <h2   style="color: #2d2c2c !important;margin-top: 50px;" ><?php echo translate('welcome_to'); ?></h2>
                        </div>
                        <div  style="margin-top: 90px;"  class="center p-b-img">
                            <img  src="<?php echo base_url('uploads/app_image/logo.png'); ?>" height="250" alt="img">
                        </div>
                    <!-------     <div class="address">
                            <p><?php echo html_escape($global_config['address']); ?></p>
                        </div>		 --------->	
                    <!-------    <div class="f-social-links center">
                            <a href="<?php echo html_escape($global_config['facebook_url']); ?>" target="_blank">
                                <span class="fab fa-facebook-f"></span>
                            </a>
                            <a href="<?php echo html_escape($global_config['twitter_url']); ?>" target="_blank">
                                <span class="fab fa-twitter"></span>
                            </a>
                            <a href="<?php echo html_escape($global_config['linkedin_url']); ?>" target="_blank">
                                <span class="fab fa-linkedin-in"></span>
                            </a>
                            <a href="<?php echo html_escape($global_config['youtube_url']); ?>" target="_blank">
                                <span class="fab fa-youtube"></span>
                            </a>
                        </div>  ------>
                    </div>
                   
                </div>
                <!-- Login -->
                <div   class="col-lg-6  col-md-6  col-sm-12  no-padding">
                    <div style="background-color: rgb(157,211,195) !important;" class="sign-area">
                        <div class="sign-hader">
                            
                            <h2 style="color: #2d2c2c !important;" ><?php echo html_escape($global_config['institute_name']); ?></h2>
                        </div>
						<?php echo form_open($this->uri->uri_string()); ?>
                            <div class="form-group <?php if (form_error('username')) echo 'has-error'; ?>">
                                <div class="input-group input-group-icon">
                                    <span class="input-group-addon">
                                        <span class="icon">
                                            <i class="far fa-user"></i>
                                        </span>
                                    </span>
                                    <input style="color:black;" type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="<?php echo translate('username'); ?>" />
                                </div>
								<span class="error"><?php echo form_error('username'); ?></span>
                            </div>
                            <div class="form-group <?php if (form_error('password')) echo 'has-error'; ?>">
                                <div class="input-group input-group-icon">
                                    <span class="input-group-addon">
                                        <span class="icon"><i class="fas fa-unlock-alt"></i></span>
                                    </span>
                                    <input style="color:black;" type="password" class="form-control input-rounded" name="password" value="" id="password" placeholder="<?php echo translate('password'); ?>" />
                                </div>
								<span class="error"><?php echo form_error('password'); ?></span>
                            </div>
                            <div class="forgot-text">
                                <div class="checkbox-replace">
                                    <label style="color: #2d2c2c !important;" class="i-checks"><input type="checkbox" name="remember" id="remember"><i></i > <?php echo translate('remember'); ?></label>
                                </div>
                                <div class="">
                                    <a href="<?php echo base_url('authentication/forgot'); ?>"><?php echo translate('lose_your_password'); ?> ?</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btn_submit" class="btn btn-block btn-round" >
                                    <i class="fas fa-sign-in-alt"></i> <?php echo translate('login'); ?>
                                </button>
                            </div>
                            <div class="sign-footer">
                                <p> © 2022 Developed by   <a href="https://smarttargetkwt.com/" target="_blank"> SmartTarget   </a> </p>
                                
                                
                            
                                                           
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-placeholder/jquery-placeholder.js'); ?>"></script>
		<!-- Backstretch JS -->
		<script src="<?php echo base_url('assets/login_page/js/jquery.backstretch.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/login_page/js/custom.js'); ?>"></script>

		<?php
		$alertclass = "";
		if($this->session->flashdata('alert-message-success')){
			$alertclass = "success";
		} else if ($this->session->flashdata('alert-message-error')){
			$alertclass = "error";
		} else if ($this->session->flashdata('alert-message-info')){
			$alertclass = "info";
		}
		if($alertclass != ''):
			$alert_message = $this->session->flashdata('alert-message-'. $alertclass);
		?>
			<script type="text/javascript">
				swal({
					toast: true,
					position: 'top-end',
					type: '<?php echo $alertclass; ?>',
					title: '<?php echo $alert_message; ?>',
					confirmButtonClass: 'btn btn-default',
					buttonsStyling: false,
					timer: 8000
				})
			</script>
		<?php endif; ?>
	</body>
</html>