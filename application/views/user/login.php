<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ITAsset Management | Log in</title>
        <link href='<?php echo base_url("assets/img/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon'/>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">  
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">        
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/js/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet"> 
		<link href="<?php echo base_url('assets/css/main_style.css'); ?>" rel="stylesheet" >

    </head>
    
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#" ><b class="primary-color">SIMITA v.2.5</b></a><br>
                <p class="italic" style="font-size:20px">SIstem Management IT Aset</p>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Login Dengan User & Password </p>
                    <?php
                        echo form_open('login/auth');                       
                        if (validation_errors() || $this->session->flashdata('result_login')) {
                        ?>

                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('result_login'); ?>
                        </div>    
                    <?php } ?>
                    <div class="form-group has-feedback">
                        <input type="text" autocomplete="off" name="username" class="form-control" placeholder="User Name"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" id="pwd" class="form-control" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
           
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Ingatkan Saya
                                
                                </label>
                            </div>                        
                        </div><!-- /.col -->
                        
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-shield" aria-hidden="true"></i> Masuk</button>
                        </div><!-- /.col -->
                    </div>
                </form>                
                <!-- <a href="#">Lupa Password</a><br> -->

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script> 
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> 
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/js/plugins/iCheck/icheck.min.js'); ?>"></script>       
        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    
    </body>
</html>
