 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="">Fast Food</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li><a target="blank" href="<?php echo base_url();?>admin">Admin</a></li>
          </ul>
        </div>
      </div>
    </div>

<div class="container-fluid" id="searchDiv">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h3 class="lead">Menu</h3>
        <form role="search">
      </form>
            <div id="resultsDiv">
             <?php foreach ($products as $product): ?>
              <ul class="nav nav-sidebar">
              <div class="well-sm">
              <?php echo form_open('home/add');?>
              <li><?php echo $product->item_name;?></li>
              <li><?php echo "Ksh.".$product->price;?></li>
              <?php echo form_hidden('id', $product->id); ?>
              <?php $submit_attr = array('class' => 'btn btn-warning btn-sm', 'name'=>'submit', 'value'=>'Add To Cart');?>
              <?php echo form_submit($submit_attr);?>
              <?php echo form_close(); ?>
              </div>
               </ul>
            <?php endforeach;?>
             </div>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Fast delivery</h1>

          <?php if($cart = $this->cart->contents()):?>
          
          <h2 class="sub-header">Your Cart</h2>
          <div class="table-responsive">
            <table class="table table-striped1">
              <thead>
                <tr>
                  <th>Item</th>
                  <th></th>
                  <th>Quantity</th>
                  <th>Price(Ksh.)</th>
                  <th>Update</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cart as $item): ?>
                  <tr>
                    <td><?php echo $item['name'];?></td>
                    <?php echo form_open('home/update'); ?>
                    <?php $qty_attr = array('id'=>'qty', 'name'=>'qty', 'value'=>$item['qty']); ?>
                    <?php $hidden_attr = array('name' => 'id', 'type'=>'hidden', 'size'=>'32', 'value'=>$item['rowid']); ?>
                    <td><?php echo form_input($hidden_attr); ?></td>
                    <td><?php echo form_input($qty_attr); ?></td>
                    <td><?php echo $item['subtotal'];?></td>
                    <?php $update_attr = array('class' => 'btn btn-success btn-sm', 'name'=>'update', 'value'=>'Update');?>
                    <td><?php echo form_submit($update_attr); ?></td>
                    <?php echo form_close();?>
                    <td><?php echo anchor('home/remove/'.$item['rowid'], 'Remove'); ?></td>
                  </tr>
                 
                <?php endforeach; ?>
              <tr class="total">  
		<td colspan="2"><strong>Total (Ksh.)</strong></td>
                <td></td>
                <td><strong><?php echo $this->cart->total(); ?></strong></td>
                <td></td>
                <td><a href="<?php echo base_url();?>home/buy" class = 'btn btn-warning btn-sm'><span class='glyphicon glyphicon-shopping-cart'></span> Buy</a></td>
              </tr>  
              </tbody>
            </table>      
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>