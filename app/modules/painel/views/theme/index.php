<html style="height: auto; min-height: 100%;">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Stylling Admin-SLY</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery-ui/jquery-ui.min.js"></script>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/template.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/iCheck/all.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/js/wheelmenu.css">
  <style>
    .wheel-button:hover {
      color: white;
    }

    .wheel li a,
    .wheel li a:visited {
      background: rgba(0, 0, 0, 0.65);
      border-radius: 50px;
      font-weight: bold;
      padding: 10px;
      text-align: center;
      width: 80px;
      height: 59px;
      border: 1px solid black;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.5);
      -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.5);
      -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.5);
      color: white;
      -moz-transition: all 0.25s ease;
      -webkit-transition: all 0.25s ease;
      -o-transition: all 0.25s ease;
      transition: all 0.25s ease;
    }

    .wheel li a:hover {
      background: rgba(0, 0, 0, 0.8);
    }
  </style>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>app/assets/js/jquery.wheelmenu.min.js"></script>


  <link href="<?php echo BASE_URL; ?>node_modules/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />

  <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js' type='text/javascript'></script>

  <link href='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css' type='text/css' rel='stylesheet'>
  <script>
    $(function() {
      $("#sortable").sortable();
      $("#sortable").disableSelection();
    });
  </script>

  <script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>';
    var BASE_URL_PAINEL = '<?php echo BASE_URL_PAINEL; ?>';
  </script>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="sidebar-mini skin-blue-light sidebar<?php echo $this->user->getCliente() == true ? '' : '-collapse' ?>" style="height: auto; min-height: 100%;">
  <div class="wrapper" style="height: auto; min-height: 100%;">

    <header class="main-header">

      <a href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/index2.html" class="logo">
        <span class="logo-mini"><b>A</b>ST</span>
        <span class="logo-lg"><b>Admin</b>Style</span>
      </a>
      <!-- Menu Cliente -->

      <nav class="navbar navbar-static-top">


        <?php if ($this->user->getCliente() == false) : ?>
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <?php endif; ?>
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </a>
          <?php if (!$this->user->getCliente() == false) : ?>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Meus Looks <span class="sr-only">(current)</span></a></li>
              </ul>

            </div>
          <?php endif; ?>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php if (!$this->user->isClient()) : ?>
                    <img src="<?php echo ($this->user->getPhoto()) ?>" class="user-image" alt="User Image">
                  <?php endif; ?>
                  <span class="hidden-xs"><?php echo $this->user->getName(); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <?php if (!$this->user->isClient()) : ?>
                      <img src="<?php echo ($this->user->getPhoto()) ?>" class="img-circle" alt="User Image">
                    <?php endif; ?>

                    <p>
                      <?php echo $this->user->getName(); ?>
                    </p>
                  </li>

                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo BASE_URL_PAINEL; ?>/login/logout" class="btn btn-default btn-flat">Logout</a>
                    </div>

                  </li>
                </ul>
              </li>
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
      </nav>
    </header>


    <!-- Menu Administrador -->
    <?php if ($this->user->getCliente() == false) : ?>
      <aside class="main-sidebar ">
        <section class="sidebar" style="height: auto;">
          <div class="user-panel">
            <div class="pull-left image">
              <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
            </div>
            <div class="pull-left info">

            </div>
          </div>
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Buscar">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>

          <?php if ($this->user->hasPermission('dashboard_itens')) : ?>
            <ul class="sidebar-menu tree" data-widget="tree">
              <li class="header">NAVEGAÇÃO</li>
              <li class="">
                <a href="<?php echo BASE_URL_PAINEL; ?>clientes">
                  <i class="fa fa-fw fa-user-plus"></i> <span>Clientes</span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo BASE_URL_PAINEL; ?>clientes/add"><i class="fa fa-fw fa-plus"></i> Adicionar</a></li>
                  <li><a href="#"><i class="fa fa-fw fa-file-pdf-o"></i> Relatorio</a></li>
                </ul>
              </li>
            
              <li class="">
                <a href="<?php echo BASE_URL_PAINEL; ?>calendario">
                  <i class="fa fa-calendar"></i> <span>Calendario</span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo BASE_URL_PAINEL; ?>clientes/add"><i class="fa fa-fw fa-plus"></i> Adicionar</a></li>
                  <li><a href="#"><i class="fa fa-fw fa-file-pdf-o"></i> Relatorio</a></li>
                </ul>
              </li>
            </ul>
          <?php endif; ?>
        </section>
      </aside>
    <?php endif; ?>

    <div class="content<?php echo $this->user->getCliente() == true ? '' : '-wrapper' ?>" style="min-height: 1136px;">
      <?php if ($this->user->getCliente() == true) : ?>
        <div class="container">
        <?php endif; ?>
        <section class="content-header">
          <h1>
            <?php echo ucfirst($titlePage); ?>
            <small> <?php echo isset($tableInfo['cli_nome']) ? ucFirst($tableInfo['cli_nome']) : $titlePage; ?> </small>
          </h1>
          <ol class="breadcrumb">

          </ol>
        </section>
        <?php if ($this->user->getCliente() == true) : ?>
        </div>
      <?php endif; ?>

      <section class="content">

        <?php $this->loadView($viewName, $viewData, false); ?>
      </section>
    </div>

    <footer class="main-footer" style="<?php echo $this->user->getCliente() == false ? '' : ' margin-left: 0px;' ?>">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright © 2019 <a href="#">iGobbi</a>.</strong> All rights
      reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
  </div>



  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/js/demo.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/js/script.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo BASE_URL; ?>node_modules/toastr/build/toastr.min.js"></script>
  <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/plugins/iCheck/icheck.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css">
  <script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>


  <?php if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) : ?>
    <script>
      $(function() {
        toastr.<?php echo $_SESSION['alert']['tipo']; ?>('<?php echo $_SESSION['alert']['mensagem'] ?>');
      });
    </script>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>

</body>

</html>