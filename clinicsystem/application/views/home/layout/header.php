<!-- Header Starts -->
	<header class="main-header">
	<!-- Nested Container Starts -->
	<!-- Top Bar Starts -->
		<div class="top-bar d-none d-md-block">
			<div class="container px-md-0">
			<div class="row">
				<div class="col-md-6 col-sm-12"><?php echo $cms_setting['working_hours']; ?></div>
				<div class="col-md-6 col-sm-12">
					<ul class="list-unstyled list-inline">
						<li class="list-inline-item"><a href="mailto:support@gmail.com">
							<i class="far fa-envelope"></i> <?php echo $cms_setting['email']; ?>
						</a></li>
						<li class="list-inline-item"><i class="fas fa-phone-volume"></i> <?php echo $cms_setting['mobile_no']; ?></li>
<?php if (!is_loggedin()) { ?>
						<li class="list-inline-item"><a href="<?php echo base_url('authentication'); ?>"><i class="fas fa-user-lock"></i> Login</a></li>
<?php }else{ ?>
						<li class="list-inline-item"><a href="<?php echo base_url('dashboard'); ?>"><i class="fas fa-home"></i> Dashboard</a></li>
<?php } ?>
					</ul>
				</div>
			</div>
			</div>
		</div>
	<!-- Top Bar Ends -->
	<!-- Navbar Starts -->
		<div class="stricky" id="strickyMenu">
			<div class="container px-md-0">
			<nav id="nav" class="navbar navbar-expand-lg" role="navigation">
				<div class="container px-md-0">
				<!-- Logo Starts -->
					<a href="<?php echo base_url(); ?>" class="navbar-brand">
						<img src="<?php echo base_url('uploads/frontend/images/' . $cms_setting['logo']); ?>" alt="Logo">
					</a>
				<!-- Logo Ends -->
				<!-- Collapse Button Starts -->
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon fa fa-bars"></span>
					</button>
				<!-- Collapse Button Ends -->
				<!-- Navbar Collapse Starts -->
					<div id="mainNav" class="navbar-collapse collapse">
						<ul class="nav navbar-nav ml-auto navbar-style3">
							<?php
							if ($this->uri->segment(3)) {
								$active_menu = $this->uri->segment(3);
							}else{
								$active_menu = $this->uri->segment(2,'index');
							}
							$result = web_menu_list(1);
							foreach ($result as $row) {
								$url = "#";
								if ($row['system']) {
									$url = base_url('home/' . $row['alias']);
								}else{
									if ($row['ext_url']) {
										$url = $row['ext_url_address'];
									}else{
										$url = base_url('home/page/' . $row['alias']);
									}
								}
							?>
								<li class="nav-item <?php echo $active_menu == $row['alias'] ? 'active' : ''; ?>">
									<a href="<?php echo $url; ?>" class="nav-link" <?php echo $row['open_new_tab'] ? "target='_blank'" : ''; ?> ><?php echo $row['title']; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				<!-- Navbar Collapse Ends -->
				</div>
			</nav>
		</div>
	</div>
	<!-- Navbar Ends -->
<!-- Nested Container Ends -->
</header>
<!-- Header Ends -->