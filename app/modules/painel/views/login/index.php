<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>STYLE | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/iCheck/square/blue.css">

    <link href="<?php echo BASE_URL; ?>node_modules/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo BASE_URL; ?>node_modules/toastr/build/toastr.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page" style="background-color:rgb(238, 230, 219);">
    <div class="login-box">

        <div class="login-logo">
            <div class="row" style="margin-bottom:25px;">
                <div class="text-center">
                    <img src="<?php echo BASE_URL; ?>app/assets/imagens/logo.png" style="width: 20%;">
                </div>
            </div>

            <a href="../../index2.html" style="    color:#000;"><b>Style</b>Admin</a>
        </div>
        <div class="" style="border-radius:10px">
            <p class="login-box-msg">Faça o login no painel administrativo</p>
            <form method="post" action="<?php echo BASE_URL_PAINEL; ?>login/index_post">
                <div class="form-group has-feedback">
                    <input style="border-radius:5px;height: 40px;" type="text" class="form-control" placeholder="login" name="login">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input style="border-radius:5px;height: 40px;" type="password" class="form-control" placeholder="senha" name="password">
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
                        <button type="submit" style="border-radius: 5px;color: #000;background: rgb(238, 230, 219);border-color: #000;" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>

</html>

<?php if (isset($error) && !empty($error)) : ?>
    <script>
        $(function() {
            toastr.error('<?php echo $error ?>');
        });
    </script>
<?php endif; ?>

<?php if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) : ?>
    <script>
        $(function() {  
            toastr.<?php echo $_SESSION['alert']['tipo'];?> ('<?php echo $_SESSION['alert']['mensagem'] ?>');
        });
    </script>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>