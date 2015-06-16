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
            <li><a href="<?php echo base_url();?>admin/admin_area" class="active navbar-inverse">Pending Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/get_serviced">Serviced Orders</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_accounts">Manage Accounts</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_items">Manage Items</a></li>
            <li><a href="<?php echo base_url();?>admin/sign_out">Logout</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Pending Orders</h1>

          <div class="table-responsive">
            <table class="table table-striped">
                <thead class="navbar-inverse">
               <div>
                    <tr>  
                      <th>Block</th>
                      <th>Room</th>
                      <th>Customer Name</th>
                      <th>Orders</th>
                      <th>Total Amount</th>
                      <th>Handle</th>
                    </tr>
                </div>
              </thead>
              <tbody>
                  <?php foreach ($orders as $order):?>
                  <tr>
                      <td><?php echo $order->block;?></td>
                      <td><?php echo $order->room;?></td>
                      <td><?php echo $order->cust_name;?></td>
                      <td><?php echo $order->customer_orders; ?></td>
                      <td><?php echo $order->total; ?></td>
                      <td><?php echo anchor('admin/handle_orders/'.$order->id, 'handle');?></td>
                      
                  </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>      
          </div>
        </div>
      </div>
    </div>