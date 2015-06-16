 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Fill In Your Location</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('home/add_to_orders'); ?>
                            <fieldset>
                                <div class="form-group">
                                    <?php echo validation_errors('<p style="color: red; font-style: italic">','</p>');?>
                                   <?php $name_attr = array('name'=>'name', 'class'=>'form-control', 'placeholder'=> 'Name'); ?>
                                   <?php echo form_input($name_attr); ?>
                                </div>
                                <div class="form-group">
                                   <?php $block_attr = array('name'=>'block', 'class'=>'form-control', 'placeholder'=> 'Block/Building name'); ?>
                                   <?php echo form_input($block_attr); ?>
                                </div>
                                 <div class="form-group">
                                   <?php $room_attr = array('name'=>'room', 'class'=>'form-control', 'placeholder'=> 'Room'); ?>
                                   <?php echo form_input($room_attr); ?>
                                </div>
                                
                                <input type="submit" value="Submit"class="btn btn-default btn-warning btn-block">
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>