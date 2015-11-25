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
                <input type="text" class="form-control custom-search-input" placeholder="<?= __('search');?>">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default custom-search-btn">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#register"><?= __("sign up");?></a></li>
              <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#login"><?= __("log in");?></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div id="cuerpoymenu" class="container-fluid custom-container-fluid">
      <div class="row custom-row-lateral-bar">
        <div id="menu" class="col-sm-3 col-md-2 hidden-xs custom-menu affix">
          <div class="custom-title"><?= __("Categories"); ?></div>
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><?= __("Newest"); ?></a></li>
            <li><a href="#"><?= __("Today"); ?></a></li>
            <li><a href="#"><?= __("Week"); ?></a></li>
            <li><a href="#"><?= __("Month"); ?></a></li>
            <li><a href="#"><?= __("Voted"); ?></a></li>
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
              <h4 class="modal-title custom-modal-title"><?= __("Menu"); ?></h4>
              <div class="input-group">
                <input type="text" class="form-control custom-search-input" placeholder="<?= __("search"); ?>">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default custom-search-btn">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </span>
              </div>
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#register" class="custom-navbar-a custom-btn"><?= __("sign up");?></a></li>
                  <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#login" class="custom-navbar-a custom-btn"><?= __("log in");?></a></li>
                </ul>
              </div>
              <div id="menu" class="custom-menu-mobile">
                <div class="custom-title-mobile"><?= __("Categories"); ?></div>
                <ul class="nav nav-pills nav-stacked">
                  <li class="active"><a href="#"><?= __("Newest"); ?></a></li>
                  <li><a href="#"><?= __("Today"); ?></a></li>
                  <li><a href="#"><?= __("Week"); ?></a></li>
                  <li><a href="#"><?= __("Month"); ?></a></li>
                  <li><a href="#"><?= __("Voted"); ?></a></li>
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
              <h1 class="custom-modal-title"><?= __("Register"); ?></h1>
                <?php echo $this->Form->create('User', array(
                  "class" => "form-group",
                  "action" => "add"
                )); ?>
                    <fieldset>
                        <div class="form-group">
                        <?php echo $this->Form->input('name',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("User Name"),
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('password',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Password"),
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('confirmPassword',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Confirm Password"),
                            "type" => "password",
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('email',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Email"),
                            "type" => "email",
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->button(__("Register"),array(
                            "class" => "btn btn-primary btn-lg btn-block custom-btn",
                            "type" => "submit"
                        ));?>
                        </div>
                    </fieldset>
                        <?php echo $this->Form->end(); ?>
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
              <h1 class="custom-modal-title"><?= __("Log in"); ?></h1>
                <?php echo $this->Flash->render('auth'); ?>
                <?php echo $this->Form->create('User', array(
                  "class" => "form-group",
                  "action" => "login"
                )); ?>
                    <fieldset>
                        <div class="form-group">
                        <?php echo $this->Form->input('name',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("User Name"),
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('password',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Password"),
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->button(__("Log in"),array(
                            "class" => "btn btn-primary btn-lg btn-block custom-btn",
                            "type" => "submit"
                        ));?>
                        </div>
                    </fieldset>
                        <?php echo $this->Form->end(); ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </body>
</html>
