<!-- File: /app/View/Users/login.ctp -->
            <div class="modal-body center-block">
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