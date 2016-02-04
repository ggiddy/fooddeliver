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
            <li><a href="<?php echo base_url();?>admin/admin_area">Pending Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/get_serviced">Serviced Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_accounts" class="active navbar-inverse">Manage Accounts</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_items">Manage Items</a></li>
            <li><a href="<?php echo base_url();?>admin/sign_out">Logout</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Staff Accounts </h1>
        <?php $new_admin_attr = array('class' => 'btn btn-default btn-info'); ?>  
        <?php echo anchor('admin/create_account', 'Add New Account', $new_admin_attr)?>
        <br/>  
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>First Name</th>  
                  <th>Last Name</th>
                  <th>Username</th>
                  <th>Email Address</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              
                  <?php foreach ($accounts as $account):?>
                  <tr>
                      <td><?php echo $account->first_name;?></td>
                      <td><?php echo $account->last_name;?></td>
                      <td><?php echo $account->username;?></td>
                      <td><?php echo $account->email_address; ?></td>
                      <td><?php echo anchor('admin/delete_account/'.$account->id, 'Delete');?></td>
                  </tr>
                  <?php endforeach; ?>
                  
              </tbody>
            </table>      
          </div>
        </div>
      </div>
    </div>