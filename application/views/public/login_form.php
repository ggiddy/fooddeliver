 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('home/validate_credentials'); ?>
                            <fieldset>
                                <div class="form-group">
                                   <?php $uname_attr = array('name'=>'username', 'class'=>'form-control', 'placeholder'=> 'Username'); ?>
                                   <?php echo form_input($uname_attr); ?>
                                </div>
                                <div class="form-group">
                                    <?php $pass_attr = array('name'=>'password', 'type'=>'password', 'class'=>'form-control', 'placeholder'=> 'Password'); ?>
                                   <?php echo form_input($pass_attr); ?>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Login"class="btn btn-default btn-info btn-block">
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>