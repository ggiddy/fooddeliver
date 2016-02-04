 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Order Placed Successfully</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('home'); ?>
                            <fieldset>
                                <div class="form-group">
                                    <p>Please be patient while we service your order</p>
                                </div>
                                <input type="submit" value="OK"class="btn btn-default btn-success btn-block">
                            </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>