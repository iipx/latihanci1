<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin/login');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Project</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/project" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php if($error): ?>
			<div class="callout callout-danger">
				<p>
					<?php echo $error; ?>
				</p>
			</div>
			<?php endif; ?>

			<?php if($success): ?>
			<div class="callout callout-success">
				<p><?php echo $success; ?></p>
			</div>
			<?php endif; ?>

			<?php echo form_open_multipart(base_url().'admin/project/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Project Name <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Description </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="description" value="<?php if(isset($_POST['description'])){echo $_POST['description'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Project Start</label>
							<div class="col-sm-6">
								<input type="date" autocomplete="off" class="form-control" name="start" value="<?php if(isset($_POST['start'])){echo $_POST['start'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Project End </label>
							<div class="col-sm-6">
								<input type="date" autocomplete="off" class="form-control" name="end" value="<?php if(isset($_POST['end'])){echo $_POST['end'];} ?>">
							</div>
						</div>
						
						
						
						<!-- <div class="form-group">
							<label for="" class="col-sm-2 control-label">Status </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="status" value="<?php if(isset($_POST['status'])){echo $_POST['status'];} ?>">
							</div>
						</div> -->
						
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Select Status <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="status" style="width:300px;">
				            		<option value="">Select Status</option>
									<option value="1">Aktif</option>
									<option value="2">Pending</option>
									<option value="3">Closed</option>
				            	</select>
				            </div>
				        </div>
						
						
						<div class="form-group">
								<input type="hidden" autocomplete="off" class="form-control" name="owner" value="<?php if(isset($_POST['owner'])){echo $_POST['owner'];} ?>">
						</div>


						<div class="form-group">
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

</section>
