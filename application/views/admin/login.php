<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("admin/_partials/head"); ?>
</head>
<body class="bg-full-login">
  <div class="container">
    <div class=" card-body dev_loginlogo">
      <img class="imgloginlogo" src="<?php echo base_url('upload/logo/bklogo3.svg'); ?>" alt="">
    </div>
    <div class="card card-login mx-auto dev_loginbox">
      <div class="card-header">Login
      </div>
      
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/login/autho') ?>" enctype="multipart/form-data">
          <?php if ($this->session->flashdata('login')): ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('login'); ?>
            
          </div>
          <?php endif; ?>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="user_username" class="form-control <?php echo form_error('user_username')? 'is-invalid':'' ?>" name="user_username" placeholder="User Namaa" required="required" autofocus="autofocus">
              <label for="user_username">User Name</label>
            </div>
            <div class="invalid-feedback">
              <?php echo form_error('user_username'); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="user_password" name="user_password" class="form-control <?php echo form_error('user_password')? 'is-invalid':'' ?>" placeholder="Password" required="required">
              <label for="user_password">Password</label>
            </div>
            <div class="invalid-feedback">
              <?php echo form_error('user_password'); ?>
            </div>
          </div>
          <!-- <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div> -->
          <input class="btn btn-primary btn-block" type="submit" name="btn" value="Login" />
        </form>
        <div class="text-center">
        
         
        </div>
      </div>
    </div>
  </div>


<?php $this->load->view("admin/_partials/js"); ?>

</body>
</html>