<style>
	.noti-icon{
		position: absolute;
	    color: white;
	    background: #ffbd2e;
	    border-radius: 110px;
	    width: 22px;
	}
	.blink {
	 animation: 2s linear infinite condemned_blink_effect;
	}
	@keyframes condemned_blink_effect {
	  0% {
	    visibility: hidden;
	  }
	  50% {
	    visibility: hidden;
	  }
	  100% {
	    visibility: visible;
	  }
	}
</style>
<header class="header">
	<div class="logo-env" style="background-color: white ;">
		<a href="<?php echo base_url('dashboard'); ?>" class="logo"><img src="<?php echo base_url('uploads/app_image/logo-small.png'); ?>" height="40"></a>
		<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="header-left hidden-xs">
		<ul class="header-menu">
			<!-- Sidebar Toggle Button -->
			<li>
				<div class="header-menu-icon sidebar-toggle" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
					<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</li>
			<!-- Full Screen Button -->
			<li>
				<div class="header-menu-icon s-expand"><i class="fas fa-expand"></i></div>
			</li>
        <?php
        if(get_permission('patient', 'is_add') ||
        get_permission('lab_test_bill', 'is_add') ||
        get_permission('commission_withdrawal', 'is_view') ||
        get_permission('appointment', 'is_add') ||
        get_permission('voucher', 'is_view') ||
        get_permission('accounting_reports', 'is_view')){
        ?>
			<!-- Shortcut Box -->
			<li>
				<div class="header-menu-icon dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-th"></i>
				</div>
				<div class="dropdown-menu header-menubox">
					<div class="short-q">
						<div class="menu-icon-grid">
						<?php if(get_permission('patient', 'is_add')){ ?>
							<a href="<?php echo base_url('patient/create'); ?>"><i class="fas fa-wheelchair"></i> <?php echo translate('create') . " " . translate('patient'); ?></a>
						<?php } if(get_permission('lab_test_bill', 'is_add')) { ?>
							<a href="<?php echo base_url('billing/test_bill_add'); ?>"><i class="fas fa-donate"></i> <?php echo translate('create') . " " . translate('test') . " " . translate('bill'); ?></a>
						<?php } if(get_permission('commission_withdrawal', 'is_view')) { ?>
							<a href="<?php echo base_url('referral/withdrawal'); ?>"><i class="fas fa-hand-holding-usd"></i> <?php echo translate('commission') . " " . translate('withdrawal'); ?></a>
						<?php } if(get_permission('appointment', 'is_add')){ ?>
							<a href="<?php echo base_url('appointment/add'); ?>"><i class="fas fa-notes-medical"></i> <?php echo translate('create') . " " . translate('appointment'); ?></a>
						<?php } if(get_permission('voucher', 'is_view')){ ?>
							<a href="<?php echo base_url('accounts/voucher'); ?>"><i class="fas fa-money-check"></i> <?php echo translate('create') . " " . translate('voucher'); ?></a>
						<?php } if(get_permission('accounting_reports', 'is_view')){ ?>
							<a href="<?php echo base_url('accounts/incomevsexpense'); ?>"><i class="fas fa-chart-line"></i> <?php echo translate('income_vs_expense'); ?></a>
						<?php } ?>
						</div>
					</div>
				</div>
			</li>
		<?php } ?>
		</ul>

		<?php if (get_permission('patient', 'is_view')) { ?>
		<!-- Search Box -->
		<span class="separator hidden-sm"></span>
        <form method="post" action="<?php echo base_url('patient/search'); ?>" class="search nav-form">
            <?php echo $this->app_lib->generate_csrf(); ?>
			<div class="input-group input-search">
				<input type="text" class="form-control" name="search_text" placeholder="<?php echo translate('patient') . " " . translate('search'); ?>">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
				</span>
			</div>
		<?php echo form_close(); ?>
		<?php } ?>
	</div>

	<div class="header-right">
		<ul class="header-menu">
			<!-- Languages Switcher -->
			<li>
				<a href="<?php echo base_url('home'); ?>" target="_blank" class="header-menu-icon" data-toggle="tooltip" data-placement="bottom"
				data-original-title="<?php echo translate('visit_home_page'); ?>">
					<i class="fas fa-globe"></i>
				</a>
			</li>
			<!-- Languages Switcher -->
			<li>
				<a href="#" class="dropdown-toggle header-menu-icon" data-toggle="dropdown">
					<i class="far fa-flag"></i>
				</a>
				<div class="dropdown-menu header-menubox">
					<div class="notification-title">
						<i class="far fa-flag"></i> <?php echo translate('language'); ?>
					</div>
					<div class="content hbox">
						<div class="scrollable visible-slider" data-plugin-scrollable>
							<div class="scrollable-content">
								<ul>
								<?php
								$set_lang = $this->session->userdata('set_lang');
								$languages = $this->db->select('*')->where('status', 1)->get('language_list')->result();
								foreach($languages as $lang) :
								?>
									<li>
										<a href="<?php echo base_url('language/set_language/' . $lang->lang_field); ?>">
											<img src="<?php echo html_escape($this->app_lib->get_lang_image_url($lang->id)); ?>" alt="<?php echo html_escape($lang->lang_field); ?>"> <?php echo ucfirst($lang->name); ?> <?php echo ($set_lang == $lang->lang_field ? '<i class="fas fa-check"></i>' : ''); ?>
										</a>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<?php 
					$set_lang = $this->session->userdata('set_lang');
					$today = date('Y-m-d');
					$today_time = date('Y-m-d H:i');

					//$expiry_noti = $this->db->select('documents.*, staff.name, staff.staff_id')->join('staff', 'documents.user_id = staff.id')->where('expiry_date <=', $today )->where('admin_notify <=', $today_time)->get('documents')->result();
					$expiry_noti = $this->db->select('documents.*, staff.name, staff.staff_id')->join('staff', 'documents.user_id = staff.id')->where('admin_notify', $today)->get('documents')->result();
					$notifications_data = [];
					$unread = 0;
					
					foreach ($expiry_noti as $expir) {
						if ($expir->is_read == 0) {
							$unread = $unread+1;
						}
						$notifications_data[] = [
							'text'=>$expir->name.' '.$expir->doc_type. ' expire on ' . $expir->expiry_date,
							'url' => base_url('documents/edit/').$expir->id,
						];
					}

					//Getting for asserts
					$assert_data = $this->db->select('*')->where('admin_not_datetime<=', $today_time)->where('unit_ratio<min_qty_noti')->where('unread', 0)->get('chemical')->result();
					foreach ($assert_data as $assertdata) {
						if ($assertdata->unread == 0) {
							$unread = $unread+1;
						}
						
						$notifications_data[] = [
							'text'=>$assertdata->name.' assets Reached to its minimum quantity '.$assertdata->min_qty_noti,
							'url' => base_url('inventory/chemical_edit/').$assertdata->id,
						];
					}

					//Getting for asserts
					$chemical_stock = $this->db->select('*')->where('admin_not_datetime<=', $today_time)->where('stock_quantity<min_qty_noti')->where('unread', 0)->get('chemical_stock')->result();
					foreach ($chemical_stock as $chemicalstock) {
						if ($chemicalstock->unread == 0) {
							$unread = $unread+1;
						}
						
						$notifications_data[] = [
							'text'=>$chemicalstock->inovice_no.' stock Reached to its minimum quantity '.$chemicalstock->min_qty_noti,
							'url' => base_url('inventory/chemical_stock_edit/').$assertdata->id,
						];
					}
					
				?>
				<a href="#" class="dropdown-toggle header-menu-icon noti-click" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<?php
						if($unread>0) {
					?>
					<span class="noti-icon blink"> <?php echo $unread; ?> </span>
					<?php }else { ?>
					<span class="noti-icon" style="background-color: rgb(157,211,195);" > <?php echo $unread; ?> </span>
					
					<?php }?>
				</a>
				<div class="dropdown-menu header-menubox">
					<div class="notification-title">
						<i class="far fa-bell"></i> <?php echo translate('Notifications'); ?>
					</div>
					<div class="content hbox">
						<div class="scrollable visible-slider" data-plugin-scrollable>
							<div class="scrollable-content">
								<ul>
								<?php
								
								foreach($notifications_data as $noit) :
								?>
									<li>
										<a href="<?php echo $noit['url']; ?>">
											<?php echo $noit['text']; ?>
										</a>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>

		<?php
			if (loggedin_role_id() == 7) {
				$userProfileImg = $this->app_lib->get_image_url($this->session->userdata('logger_photo'));
			}else{
				$userProfileImg = $this->app_lib->get_image_url('staff/' . $this->session->userdata('logger_photo'));
			}
		?>
		<!-- Profile Box -->
		<span class="separator"></span>
		<div id="userbox" class="userbox">
			<a href="#" data-toggle="dropdown">
				<figure class="profile-picture">
					<img src="<?php echo html_escape($userProfileImg); ?>" alt="user-image" height="35">
				</figure>
			</a>
			<div class="dropdown-menu">
				<ul class="dropdown-user list-unstyled">
					<li class="user-p-box">
						<div class="dw-user-box">
							<div class="u-img">
								<img src="<?php echo html_escape($userProfileImg); ?>" alt="user">
							</div>
							<div class="u-text">
								<h4><?php echo html_escape($this->session->userdata('name')); ?></h4>
								<p class="text-muted"><?php echo ucfirst(loggedin_role_name()); ?></p>
								<a href="<?php echo base_url('authentication/logout'); ?>" class="btn btn-danger btn-xs"><i class="fas fa-sign-out-alt"></i> <?php echo translate('logout'); ?></a>
							</div>
						</div>
					</li>
					<li role="separator" class="divider"></li>
					<li><a href="<?php echo base_url('profile'); ?>"><i class="fas fa-user-shield"></i> <?php echo translate('profile'); ?></a></li>
					<li><a href="<?php echo base_url('profile/password'); ?>"><i class="fas fa-mars-stroke-h"></i> <?php echo translate('reset_password'); ?></a></li>
				<?php if(get_permission('global_setting', 'is_view')) { ?>
					<li role="separator" class="divider"></li>
					<li><a href="<?php echo base_url('settings'); ?>"><i class="fas fa-toolbox"></i> <?php echo translate('global') . " " . translate('settings'); ?></a></li>
				<?php } ?>
					<li role="separator" class="divider"></li>
					<li><a href="<?php echo base_url('authentication/logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?php echo translate('logout'); ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</header>