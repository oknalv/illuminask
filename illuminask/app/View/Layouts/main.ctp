<!DOCTYPE html>
<html>
  <head>
  	<?php echo $this->Html->charset(); ?>
		<title><?php echo $this->fetch('title'); ?></title>
    <?php
		  echo $this->Html->css('bootstrap.min');
		  echo $this->Html->css('custom');
      echo $this->Html->script('jquery.min');
      echo $this->Html->script('bootstrap');
      echo $this->Html->script('custom');
    ?>
  </head>
  <body>
    <div id="cabecera">
      <nav class="navbar navbar-default custom-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
              <?php
                echo $this->Html->image("logo4.svg", array(
                  "alt" => "Illuminask",
                  'class' => "custom-logo",
                  'url' => array('controller' => 'posts', 'action' => 'index')
                ));
              ?>
            <a href="#" id="showHiddenMenu" class="btn btn-default hidden-lg hidden-md hidden-sm custom-hidden-menu-btn" data-toggle="modal" data-target="#menuMobile">
              <i class="glyphicon glyphicon-menu-hamburger"></i>
            </a>
          </div>
          <div class="hidden-xs">
            <form class="navbar-form navbar-right" role="search">
              <div class="input-group">
                <input type="text" class="form-control custom-search-input" placeholder="search">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default custom-search-btn">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#register">sign up</a></li>
              <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#login"">log in</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div id="cuerpoymenu" class="container-fluid custom-container-fluid">
      <div class="row custom-row-lateral-bar">
        <div id="menu" class="col-sm-3 col-md-2 hidden-xs custom-menu affix">
          <div class="custom-title">Categories</div>
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#">Newest</a></li>
            <li><a href="#">Today</a></li>
            <li><a href="#">Week</a></li>
            <li><a href="#">Month</a></li>
            <li><a href="#">Voted</a></li>
          </ul>
        </div>
        <div id="cuerpo" class="col-xs-12 col-sm-9 col-md-10 custom-cuerpo">
          <!-- AQUÍ ES DONDE VA EL CUERPO DE LA APLICACIÓN, LA PARTE NO COMÚN -->
    			<?php echo $this->fetch('content'); ?>
        </div>
      </div>
    </div>
    <div>
      <!-- METER AQUÍ LOS MODALES -->
      <div id="menuMobile" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content custom-modal">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title custom-modal-title">Menu</h4>
              <div class="input-group">
                <input type="text" class="form-control custom-search-input" placeholder="search">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default custom-search-btn">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#register" class="custom-navbar-a custom-btn">sign up</a></li>
                  <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#login" class="custom-navbar-a custom-btn">log in</a></li>
                </ul>
              </div>
              <div id="menu" class="custom-menu-mobile">
                <div class="custom-title-mobile">Categories</div>
                <ul class="nav nav-pills nav-stacked">
                  <li class="active"><a href="#">Newest</a></li>
                  <li><a href="#">Today</a></li>
                  <li><a href="#">Week</a></li>
                  <li><a href="#">Month</a></li>
                  <li><a href="#">Voted</a></li>
                </ul>
                   </div>
               </div>
            </div>
        </div>
      </div>


      <!-- Modal register -->
      <div class="modal fade" id="register" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content custom-form">
            <div class="modal-body center-block">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="custom-modal-title">Register</h1>
              <form class="form">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="User Name">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" placeholder="Confirm password">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="Email">
                </div>
                <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block custom-btn" >Register</button>
                    </div>
              </form>
                  </div>
          </div>
          </div>
      </div>
        <!-- Modal login -->
      <div class="modal fade" id="login" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content custom-form">
            <div class="modal-body center-block">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="custom-modal-title">Login</h1>
              <form class="form">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" placeholder="User Name">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" placeholder="Password">
                </div>
                <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block custom-btn" >Sign in</button>
                    </div>
                  </form>
            </div>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>
