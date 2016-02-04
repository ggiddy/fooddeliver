<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="">Admin Panel</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
             
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h3 class="lead">Admin Options</h3>
            <ul class="nav navbar-nav nav-sidebar">
            <li><a href="<?php echo base_url();?>admin/admin_area"">Pending Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/get_serviced">Serviced Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_accounts" class="active navbar-inverse">Manage Accounts</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_items">Manage Items</a></li>
            <li><a href="<?php echo base_url();?>admin/sign_out">Logout</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header lead">Create Staff Account</h3>
                <div class="well">
                    <?php echo validation_errors('<p style="color: red; font-style: italic">','</p>'); ?>
                      <fieldset> 
                        <?php $registerattr = array('class'=>'form-group form-horizontal');?>
                        <?php echo form_open('admin/create_member', $registerattr); ?>
                        <?php $first_attr= array('class'=>'form-control', 'placeholder'=>'First Name', 'name'=>'first_name' )?>
                        <?php echo form_input($first_attr); ?>
                        <br/>
                        <?php $last_attr= array('class'=>'form-control', 'placeholder'=>'Last Name', 'name'=>'last_name' )?>
                        <?php echo form_input($last_attr); ?>
                        <br/>
                        <?php $user_attr= array('class'=>'form-control', 'placeholder'=>'User Name', 'name'=>'username' )?>
                        <?php echo form_input($user_attr, set_value('username')); ?>
                        <br/>
                        <?php $pas_attr= array('class'=>'form-control', 'placeholder'=>'Password', 'name'=>'password' )?>
                        <?php echo form_password($pas_attr); ?>
                        <br/>
                        <?php $pass_attr= array('class'=>'form-control', 'placeholder'=>'Password Confirm', 'name'=>'password2' )?>
                        <?php echo form_password($pass_attr); ?>
                        <br/>
                        <?php $email_attr= array('class'=>'form-control', 'placeholder'=>'Email', 'name'=>'email_address' )?>
                        <?php echo form_input($email_attr); ?>
                        <br/>
                        <?php $status_attr= array('name'=>'status', 'type'=>'checkbox', 'value'=> 1)?>
                        <?php echo form_label('Super Admin', 'status')?>
                         <?php echo form_input($status_attr); ?>
                        <br/>
                        </div>
                         <?php $create_attr= array('class'=>'btn btn-success', 'name'=>'submit' )?>    
                       <?php echo form_submit($create_attr, 'Create Account'); ?>                
        </fieldset>
          
          </div>
        </div>
      </div>