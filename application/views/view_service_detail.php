<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $res['banner']; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1><?php echo $res['heading']; ?></h1>
		</div>
	</div>
</div>


<div class="single-service-area pt_30 pb_60">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-8">
				

				<div class="service-main-photo">
					<img src="<?php echo base_url(); ?>public/uploads/<?php echo $res['photo']; ?>" alt="service photo">
				</div>
				

				<div class="single-service-text recent-single-text pt_30">
					<p>
						<?php echo $res['content']; ?>
					</p>
				</div>

			</div>

			
			<div class="col-lg-3 col-md-4">
				<div class="sidebar">
					<div class="sidebar-item category">
						<h3><?php echo SERVICES; ?></h3>
						<ul>
							<?php
							foreach ($service_by_heading as $row) {
								?>
								<li><a href="<?php echo base_url(); ?>service/view/<?php echo $row['id']; ?>"><?php echo $row['heading']; ?></a></li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>