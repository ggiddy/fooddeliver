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
              <li id="time">tim</li>
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
            <li><a href="<?php echo base_url();?>admin/get_serviced" class="active navbar-inverse">Serviced Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_accounts">Manage Accounts</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_items">Manage Items</a></li>
            <li><a href="<?php echo base_url();?>admin/sign_out">Logout</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Serviced Orders</h1>
          
          <div class="table-responsive">
            <table class="table table-striped">
                <thead class="navbar-inverse">
                <tr> 
                  <th>Block</th>
                  <th>Room</th>
                  <th>Customer Name</th>
                  <th>Orders</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                  <!---------------attributes for styling up the labels-------->
                  <?php $label_attr = array('class'=>'label label-success', 'name'=>'handled', 'id'=>'no_click');?>
                  <!------------------------------------------------------------>
                  <?php foreach ($records->result() as $service):?>
                  <tr>
                      <td><?php echo $service->block;?></td>
                      <td><?php echo $service->room;?></td>
                      <td><?php echo $service->cust_name;?></td>
                      <td><?php echo $service->customer_orders; ?></td>
                      <td><?php echo $service->total; ?></td>
                      <td><?php echo anchor('admin/get_serviced', 'Handled', $label_attr); ?></td>
                      
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table> 
                  <?php if(isset($pagination)){ echo $pagination; }?>
          </div>
        </div>
      </div>
    </div>