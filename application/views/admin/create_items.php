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
            <li><a href="<?php echo base_url();?>admin/manage_accounts">Manage Accounts</a></li>
            <li><a href="<?php echo base_url();?>admin/manage_items" class="active navbar-inverse">Manage Items</a></li>
            <li><a href="<?php echo base_url();?>admin/sign_out">Logout</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 class="page-header lead">Add New Item</h3>
                <div class="well">
                    <?php echo validation_errors('<p style="color: red; font-style: italic">','</p>'); ?>
                      <fieldset> 
                        <?php $item_attr = array('class'=>'form-group form-horizontal');?>
                        <?php echo form_open('admin/add_item', $item_attr); ?>
                        <?php $name_attr= array('class'=>'form-control', 'placeholder'=>'Item Name', 'name'=>'item_name' )?>
                        <?php echo form_input($name_attr); ?>
                        <br/>
                        <?php $price_attr= array('class'=>'form-control', 'placeholder'=>'Price', 'name'=>'price' )?>
                        <?php echo form_input($price_attr); ?>
                        
                        </div>
                         <?php $add_attr= array('class'=>'btn btn-success', 'name'=>'submit' )?>    
                       <?php echo form_submit($add_attr, 'Add Item'); ?>                
        </fieldset>
          
          </div>
        </div>
      </div>
    </div>