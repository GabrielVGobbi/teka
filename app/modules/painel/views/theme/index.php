<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Style</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
  
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">

  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/iCheck/icheck.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo BASE_URL; ?>app/assets/js/script.js"></script>

</head>

<body class="fixed skin-blue layout-top-nav" style="background-color:##ededed">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo BASE_URL;?>painel/home" class="navbar-brand"><b>Admin</b>Style</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
            
            </ul>
          </div>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="<?php echo BASE_URL;?>login/logout">  
                    <span class="hidden-xs"> Teka </span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="user-header">
                      <p>
                        <?php echo $this->userInfo['userName']['login']; ?>
                      </p>
                    </li>
                    <li class="user-body">
                      <div class="row">
                        <div class="col-xs-4 text-center">
                          <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Friends</a>
                        </div>
                      </div>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="<?php echo BASE_URL; ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>

        </div>
      </nav>
    </header>
    <div class="content-wrapper">
      <div class="container">
        <section class="content-header">
          <h1 style="text-align: center;">
            <?php echo ucfirst($viewData['titlePage']) ?>
          </h1>
        </section>
        <section class="content">
          <?php $this->loadView($viewName, $viewData, false); ?>
        </section>
      </div>
    </div>
    <?php if (isset($_SESSION['alert'])) : ?>
      <aside class="control-sidebar control-sidebar-light control-sidebar-open" style="margin-top: 10px;display:none;right: 18px !important;">
        <div class="goaway" id="goaway">
          <div class="center">
            <div class="alert alert-<?php echo $_SESSION['alert']['tipo']; ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <?php echo $_SESSION['alert']['mensagem']; ?>
            </div>
          </div>
        </div>
      </aside>
    <?php endif; ?>
    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.1
        </div>
        <strong></strong> All rights reserved.
      </div>
    </footer>
  </div>

  <script src="<?php echo BASE_URL; ?>node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/js/demo.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/moment/min/moment.min.js"></script>
  <script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>';
  </script>

  <?php if (isset($_SESSION['form'])) : ?>
    <script type="text/javascript">
      var title = '<?php echo $_SESSION['form']['success']; ?>';
      var text = '<?php echo $_SESSION['form']['mensagem']; ?>';
      var icon = '<?php echo $_SESSION['form']['type']; ?>';
      var pageController = '<?php echo $viewData['pageController']; ?>';

      swal({
          title: title,
          text: text,
          icon: icon,
          buttons: 'OK',
        })
        .then((value) => {

          <?php unset($_SESSION['form']); ?>
          /*window.location.href = BASE_URL+pageController;*/
        });
    </script>
  <?php endif; ?>
</body>

</html>