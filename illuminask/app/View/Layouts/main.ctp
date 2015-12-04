<!DOCTYPE html>
<html>
  <head>
  	<?php echo $this->Html->charset(); ?>
		<title><?php echo $this->fetch('title'); ?></title>
    <?php
      echo $this->Html->meta('icon','icon.png',array('type' => 'icon'));
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
              <?php
              if(!isset($sort)) $sort = "";
              echo $this->Form->create("Post", array(
                "class" => "navbar-form navbar-right",
                "type" => "get",
                "role" => "search",
                "action" => "index/$sort"
              ));?>
              <div class="input-group">
                <?= $this->Form->input('search',array(
                  "class" => "form-control custom-search-input",
                  "placeholder" => __('search'),
                  "label" => false,
                  "div" => false
                )); ?>
                <span class="input-group-btn">
                  <?= $this->Form->button("<i class='glyphicon glyphicon-search'></i>", array(
                    "class" => "btn btn-default custom-search-btn",
                    "type" => "submit"
                  )); ?>
                </span>
              </div>
              <?= $this->Form->end(); ?>
            <ul class="nav navbar-nav navbar-right">
              <?php if(AuthComponent::user('id')) { ?>
                <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#newPost"><?= __("new question");?></a></li>
                <li>
                  <?= $this->Html->link(__("log out"), array(
                    'controller' => 'users',
                    'action' => 'logout'),
                    array('class' => 'custom-navbar-a custom-btn')
                  ); ?>
                </li>
              <?php } else { ?>
                <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#register"><?= __("sign up");?></a></li>
                <li><a href="#" class="custom-navbar-a custom-btn" data-toggle="modal" data-target="#login"><?= __("log in");?></a></li>
              <?php }?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle custom-navbar-a custom-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <?= __("language") ?>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                foreach(Configure::read("Config.languages") as $code => $language) {?>
                <li>
                    <?= $this->Html->link($language, array(
                      'controller' => 'language',
                      'action' => 'change', $code
                    )
                    ); ?>
                </li>
                <?php } ?>
                </ul>
              </li>
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
            <?php
              $selected=array("newest"=>"","today"=>"","week"=>"","month"=>"","voted"=>"");
              if(isset($sort))
                $selected[$sort] =" class='active'";
            ?>
            <li<?= $selected['newest']; ?>>
              <?= $this->Html->link(__("Newest"), array(
                'controller' => 'posts',
                'action' => 'index', 'newest'
              )); ?>
            </li>
            <li<?= $selected['today']; ?>>
              <?= $this->Html->link(__("Today"), array(
                'controller' => 'posts',
                'action' => 'index', 'today'
              )); ?>
            </li>
            <li<?= $selected['week']; ?>>
              <?= $this->Html->link(__("Week"), array(
                'controller' => 'posts',
                'action' => 'index', 'week'
              )); ?>
            </li>
            <li<?= $selected['month']; ?>>
              <?= $this->Html->link(__("Month"), array(
                'controller' => 'posts',
                'action' => 'index', 'month'
              )); ?>
            </li>
            <li<?= $selected['voted']; ?>>
              <?= $this->Html->link(__("Voted"), array(
                'controller' => 'posts',
                'action' => 'index', 'voted'
              )); ?>
            </li>
          </ul>
        </div>
        <div id="cuerpo" class="col-xs-12 col-sm-9 col-md-10 custom-cuerpo">
          <!-- AQUÍ ES DONDE VA EL CUERPO DE LA APLICACIÓN, LA PARTE NO COMÚN -->
          <?=
          $this->Flash->render();
          ?>
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
                  <?php
                  if(!isset($sort)) $sort = "";
                  echo $this->Form->create("Post", array(
                    "class" => "navbar-form navbar-right",
                    "type" => "get",
                    "role" => "search",
                    "action" => "index/$sort"
                  ));?>
                  <div class="input-group">
                    <?= $this->Form->input('search',array(
                      "class" => "form-control custom-search-input",
                      "placeholder" => __('search'),
                      "label" => false,
                      "div" => false
                    )); ?>
                    <span class="input-group-btn">
                      <?= $this->Form->button("<i class='glyphicon glyphicon-search'></i>", array(
                        "class" => "btn btn-default custom-search-btn",
                        "type" => "submit"
                      )); ?>
                    </span>
                  </div>
                  <?= $this->Form->end(); ?>
              <div class="container-fluid">
                <ul class="nav navbar-nav">
                  <?php if(AuthComponent::user('id')) { ?>
                    <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#newPost" class="custom-navbar-a custom-btn"><?= __("new question");?></a></li>
                    <li class="col-xs-6">
                      <?= $this->Html->link(__("log out"), array(
                        'controller' => 'users',
                        'action' => 'logout'),
                        array('class' => 'custom-navbar-a custom-btn')
                      ); ?>
                    </li>
                  <?php }
                  else { ?>
                    <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#register" class="custom-navbar-a custom-btn"><?= __("sign up");?></a></li>
                    <li class="col-xs-6"><a href="#" data-toggle="modal" data-target="#login" class="custom-navbar-a custom-btn"><?= __("log in");?></a></li>
                  <?php } ?>
                </ul>
              </div>
              <div id="menu" class="custom-menu-mobile">
                <div class="custom-title-mobile"role="button" data-toggle="collapse" href="#collapseCateg" aria-expanded="false" aria-controls="collapseCateg">
                  <?= __("Categories"); ?>
                  <span class="caret"></span>
                </div>
                <div class="collapse" id="collapseCateg">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"><?= __("Newest"); ?></a></li>
                    <li><a href="#"><?= __("Today"); ?></a></li>
                    <li><a href="#"><?= __("Week"); ?></a></li>
                    <li><a href="#"><?= __("Month"); ?></a></li>
                    <li><a href="#"><?= __("Voted"); ?></a></li>
                  </ul>
                </div>
                <hr>
                <div class="custom-title-mobile" role="button" data-toggle="collapse" href="#collapseLang" aria-expanded="false" aria-controls="collapseLang">
                  <?= __("Change language") ?>
                  <span class="caret"></span>
                </div>
                <div class="collapse" id="collapseLang">
                  <ul class="nav nav-pills nav-stacked">
                    <?php
                    foreach(Configure::read("Config.languages") as $code => $language) {?>
                      <li>
                          <?= $this->Html->link($language, array(
                            'controller' => 'language',
                            'action' => 'change', $code
                          )
                          ); ?>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
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
                  "action" => "doLogin"
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
      <?php if(AuthComponent::user('id')) { ?>
      <!-- Modal newpost -->
      <div class="modal fade" id="newPost" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content custom-form">
            <div class="modal-body center-block">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="custom-modal-title"><?= __("New question"); ?></h1>
                <?php echo $this->Form->create('Post', array(
                  "class" => "form-group",
                  "action" => "add"
                )); ?>
                    <fieldset>
                        <div class="form-group">
                        <?php echo $this->Form->input('title',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Title"),
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('content',array(
                            "type" => "textarea",
                            "placeholder" => __("Content"),
                            "class" => "form-control input-lg",
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->button(__("Submit"),array(
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
      <?php } ?>
    </div>
  </body>
</html>
