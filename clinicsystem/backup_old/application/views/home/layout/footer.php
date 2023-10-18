<!-- Footer Starts -->
<footer class="main-footer">
    <!-- Footer Area Starts -->
    <div class="footer-area">
        <!-- Nested Container Starts -->
        <div class="container px-md-0">
            <div class="row">
                <!-- Hosptial Information Starts -->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h4>Address</h4>
                    <ul class="list-unstyled address-list">
                        <li class="clearfix address">
                            <i class="fas fa-map-marker-alt"></i> <?php echo $cms_setting['address']; ?>
                        </li>
                        <li class="clearfix">
                            <i class="fas fa-phone"></i> <?php echo $cms_setting['mobile_no']; ?>
                        </li>
                        <li class="clearfix">
                            <i class="fas fa-fax"></i></i> <?php echo $cms_setting['fax']; ?>
                        </li>
                        <li class="clearfix">
                            <i class="fas fa-envelope"></i> <a href="mailto:<?php echo $cms_setting['email']; ?>"><?php echo $cms_setting['email']; ?></a>
                        </li>
                    </ul>
                </div>
                <!-- Hosptial Information Ends -->
                <!-- Services Starts -->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h4>Links</h4>
                    <ul class="list-unstyled quick-links">
                        <?php
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
                        <li><a href="<?php echo $url; ?>"><i class="fa fa-angle-right"></i>
                                <?php echo $row['title']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- Services Ends -->
                <!-- Twitter Starts -->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h4>FOLLOW US</h4>
                    <ul class="social">
                        <li><a href="<?php echo $cms_setting['facebook_url']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="<?php echo $cms_setting['twitter_url']; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="<?php echo $cms_setting['youtube_url']; ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="<?php echo $cms_setting['google_plus']; ?>" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="<?php echo $cms_setting['linkedin_url']; ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="<?php echo $cms_setting['instagram_url']; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="<?php echo $cms_setting['pinterest_url']; ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                    </ul>
                </div>
                <!-- Twitter Ends -->
            </div>
        </div>
        <!-- Nested Container Ends -->
    </div>
    <!-- Footer Area Ends -->
    <!-- Copyright Starts -->
    <div class="copyright">
        <div class="container px-md-0 clearfix text-center">
            <?php echo $cms_setting['footer_text']; ?>
        </div>
    </div>
    <!-- Copyright Ends -->
</footer>
<!-- Footer Ends -->

<a href="#" class="back-to-top"><i class="far fa-arrow-alt-circle-up"></i></a>
<!-- JS Files -->
<script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/plugins/shuffle/jquery.shuffle.modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/custom.js"></script>