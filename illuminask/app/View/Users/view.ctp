
<div class="col-xs-12"><!--datos-->
  <div class="col-xs-12 col-sm-2 col-md-2"><!--imagen-->
    <?php
    echo $this->Html->image("user-default.svg", array(
      "alt" => "user",
      'class' => "img img-responsive"
    ));?>
  </div>
  <div class="col-xs-12 col-sm-10 col-md-10">
    <h1><?= $user['User']['name']; ?></h1>
    <h4><?= $user['User']['fullname']; ?></h4>
    <?php if($user['User']['id'] == $this->Session->read("Auth.User.id")) { ?>
      <a href="" class="btn custom-btn" data-toggle="modal" data-target="#passModal"><?= __("Change password");?></a>
      <div class="modal fade" id="passModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content custom-form">
            <div class="modal-body center-block">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h1 class="custom-modal-title"><?= __("Change password"); ?></h1>
                <?php echo $this->Form->create('User', array(
                  "class" => "form-group",
                  "action" => "changePassword"
                )); ?>
                    <fieldset>
                        <div class="form-group">
                        <?php echo $this->Form->input('oldPass',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Old password"),
                            "type" => "password",
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('newPass',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("New password"),
                            "type" => "password",
                            "label" => false
                        ));?>
                        </div>
                        <div class="form-group">
                        <?php echo $this->Form->input('conNewPass',array(
                            "class" => "form-control input-lg",
                            "placeholder" => __("Confirm new password"),
                            "type" => "password",
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
  </div><!--datos-->
</div>
<div class="col-xs-12"><!--posts y respuestas-->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#questions" data-toggle="tab" class="custom-a"><?= __("questions"); ?></a></li>
    <li><a href="#answers" data-toggle="tab" class="custom-a"><?= __("answers"); ?></a></li>
  </ul>
  <div class="tab-content">
    <div id="questions" class="tab-pane fade in active">
    <?php
      foreach($user['Post'] as $post){
        echo "hola";
      } ?>
    </div>
    <div id="answers" class="tab-pane fade">answers</div>
  </div>
</div>
