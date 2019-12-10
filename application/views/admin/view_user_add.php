<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin/login');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add User</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/user" class="btn btn-primary btn-sm">View All</a>
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

			<?php echo form_open_multipart(base_url().'admin/user/add',array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Name <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="full_name" value="<?php if(isset($_POST['full_name'])){echo $_POST['full_name'];} ?>">
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Select Role <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="role" style="width:300px;">
				            		<option value="">Select role</option>
				            		<?php
									foreach ($all_role as $row) {
										?>
										<option value="<?php echo $row; ?>"><?php echo $row; ?></option>
										<?php
									}
									?>
				            	</select>
				            </div>
				        </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Photo <span>*</span></label>
							<div class="col-sm-9" style="padding-top:5px">
								<input type="file" name="photo">(Only jpg, jpeg, gif and png are allowed)
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Password </label>
							<div class="col-sm-6">
								<input type="password" autocomplete="off" class="form-control" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Email </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Phone </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="status" value="<?php if(isset($_POST['status'])){echo $_POST['status'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Token </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="token" value="<?php if(isset($_POST['token'])){echo $_POST['token'];} ?>">
							</div>
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
