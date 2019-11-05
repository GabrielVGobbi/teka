<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE-2.4.5 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>app/assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>app/assets/css/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>app/assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>app/assets/css/AdminLTE-2.4.5/plugins/iCheck/square/blue.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color:#204286a1;">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html" style="    color:#000;"><b>Style</b>Admin</a>
        </div>
        <div class="login-box-body" style="border-radius:10px">
            <p class="login-box-msg">Faça o login no painel administrativo</p>
            <form method="post" action="<?php echo BASE_URL_PAINEL; ?>login/index_post">
                <div class="form-group has-feedback">
                    <input style="border-radius:5px" type="text" class="form-control" placeholder="Usuario" name="login">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input style="border-radius:5px" type="password" class="form-control" placeholder="Senha" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>

                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" style="border-radius:5px" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                </div>
                <?php if (isset($error) && !empty($error)) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="callout callout-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Ops!</h4>
                                <span><?php echo $error ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>