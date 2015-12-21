<!-- File: /app/View/Posts/view.ctp -->

  <div><!--pregunta-->
    <div class="custom-question-header col-sm-12 col-md-12"><!-- div titulo-->
      <h2 class="custom-question-title custom-generated-content">
          <?php
            echo $this->Html->image("iconoPregunta.svg", array(
              "alt" => "question",
              'class' => "custom-iconoPregunta"
            ));
            echo $post['Post']['title'];?>
      </h2>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12"><!--div manos y cuerpo-->
      <div class="col-xs-3 col-sm-1 col-md-1 col-md-1 custom-votes"><!-- div manitos-->
        <?php if(!AuthComponent::user("id") || $post['User']['id'] == $this->Session->read("Auth.User.id")){ ?>
          <div><i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i></div>
          <div class="custom-votes-number"><?=  $post["Post"]['votes'];?></div>
          <div><i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i></div>
        <?php } else {
          $upvoted = false;
          $downvoted = false;
          foreach($post['PostVote'] as $vote){
            if($vote['user_id'] == $this->Session->read("Auth.User.id")){
              if($vote['liked']==1)
                $upvoted = true;
              else
                $downvoted = true;
              break;
            }
          }?>
          <div>
            <?php if(!$upvoted)
              echo $this->Html->link(
                "<i class='glyphicon glyphicon-hand-up custom-glyphicon-votes'></i>",array(
                'controller' => 'post_votes',
                'action' => 'upvote', $post['Post']['id']
                ), array("escape" => false)
              );
            else
              echo $this->Html->link("<i class='glyphicon glyphicon-hand-up custom-glyphicon-votes custom-voted'></i>",array(
                'controller' => 'post_votes',
                'action' => 'remove', $post['Post']['id']
              ), array("escape" => false)
            ); ?>
          </div>
          <div class="custom-votes-number"><?= $post["Post"]['votes'];?></div>
          <div>
            <?php if(!$downvoted)
              echo $this->Html->link("<i class='glyphicon glyphicon-hand-down custom-glyphicon-votes'></i>",array(
                'controller' => 'post_votes',
                'action' => 'downvote', $post['Post']['id']
              ), array("escape" => false)
            );
            else
              echo $this->Html->link("<i class='glyphicon glyphicon-hand-down custom-glyphicon-votes custom-voted'></i>",array(
                'controller' => 'post_votes',
                'action' => 'remove', $post['Post']['id']
              ), array("escape" => false)
            ); ?>
            </div>
        <?php } ?>
      </div>
      <div class="col-xs-9 col-sm-11 col-md-11 custom-question-description custom-generated-content"><!-- div cuerpo-pregunta-->
          <div class="custom-square-user"><?php echo $post['Post']['content']?></div>
          <div class="custom-author">
            <?php
              $ago=$this->Date->ago($post['Post']['date']);
              echo sprintf(__("Asked %s",sprintf(__('%s ago'),sprintf(__($ago['units']),__($ago['value'])))));
              echo " ".sprintf(__("by %s"),$this->Html->link($post['User']['name'], array(
                'controller' => 'users',
                'action' => 'view',$post['User']['id']),
                array('class' => 'custom-user-link')
              ));
            ?>
          </div>
      </div>
    </div>
    <div><!-- comentarios-->
      <div class="col-xs-12 col-sm-12 col-md-12">
        <h4><a class="custom-comment-link" role="button" data-toggle="collapse" href="#collapsePostComment" aria-expanded="false" aria-controls="collapsePostComment"><?= __("Comments"); ?></a></h4>
        <div class="custom-insert-comment col-xs-12 col-sd-12 col-md-12 collapse" id="collapsePostComment">
          <?php foreach($post['Postcomment'] as $postcomment){ ?>
            <div class="col-xs-12 col-sm-12 col-lg-12 custom-generated-content custom-comment">
              "<?= $postcomment['content']; ?>"<br><?= sprintf(__("by %s",
                $this->Html->link($postcomment['User']['name'], array(
                  'controller' => 'users',
                  'action'=> 'view', $postcomment['User']['id']),
                  array('class' => 'custom-user-link')))); ?>
            </div>
          <?php } ?>
          <div>
            <?php if(AuthComponent::user('id')){
              echo "<div class='custom-label'>".__("Add a comment")."</div>";
            echo $this->Form->create("Postcomment", array(
              'action' => 'add'));
            echo $this->Form->input('content',array(
              "type" => "textarea",
              "class" => "form-control input-lg custom-textarea",
              "rows" => "4",
              "label" => false));?>
              <div class="form-group col-xs-12 col-sm-4 col-lg-3 col-xl-2">
            <?php
            echo $this->Form->button(__("Send"),array(
              "class" => "btn custom-btn col-xs-6 col-sm-6 col-lg-6",
              "type" => "submit"));
            echo $this->Form->button(__("Reset"),array(
              "class" => "btn custom-btn col-xs-6 col-sm-6 col-lg-6",
              "type" => "reset")); ?>
              </div>
              <?php echo $this->Form->input("post_id",array("value" => $post['Post']['id'], "type" => "hidden"));
            echo $this->Form->end(); } ?>
          </div>
        </div>
      </div>
    </div>
  </div><!--fin div preguntas-->
  <div class="col-xs-12 col-sd-12 col-md-12 custom-line-separator">
  </div>
  <div class="col-xs-12 col-sd-12 col-md-12"><!-- nueva respuesta-->
    <?php if(AuthComponent::user('id')) { ?>
      <?php echo $this->Form->create('Response', array(
        "class" => "form-group",
        "action" => "add"
        )); ?>
        <h4><?= __("Enter a response"); ?></h4>
        <div class="form-group">
        <?php echo $this->Form->input('content',array(
            "type" => "textarea",
            "class" => "form-control input-lg custom-textarea",
            "label" => false
        ));?>
        </div>
        <div class="form-group col-xs-12 col-sm-4 col-lg-3 col-xl-2">
          <?php echo $this->Form->button(__("Send"),array(
              "class" => "btn custom-btn col-xs-6 col-sm-6 col-lg-6",
              "type" => "submit"
          ));?>
          <?php echo $this->Form->button(__("Reset"),array(
              "class" => "btn custom-btn col-xs-6 col-sm-6 col-lg-6",
              "type" => "reset"
          ));?>
          <?php echo $this->Form->input("post_id",array("value" => $post['Post']['id'], "type" => "hidden")); ?>
        </div>
      <?php echo $this->Form->end(); ?>
    <?php } else { ?>
        <h4><a href ="#" class="custom-comment-link" data-toggle="modal" data-target="#login"><?= __("To enter a response, please log in"); ?></a></h4>
    <?php } ?>
  </div>
  <div><!-- div respuestas-->
    <div class=" col-xs-12 col-sd-12 col-md-12">
      <h3><?php
            $responses = count($post['Response']);
            if($responses == 1)
              echo sprintf(__("%s answer"),$responses);
            else
              echo sprintf(__("%s answers"),$responses);
          ?>
      </h3>
    </div>
    <?php foreach($post['Response'] as $response){ ?>
    <div class="col-xs-12 col-sd-12 col-md-12 custom-line-separator">
    </div>
    <div><!-- div una respuesta-->
      <div class="col-xs-12 col-sm-12 col-md-12"><!--div manos y cuerpo-->
        <div class="col-xs-3 col-sm-1 col-md-1 custom-votes"><!--div manos respuesta-->
          <?php if(!AuthComponent::user("id") || $response['user_id'] == $this->Session->read("Auth.User.id")){ ?>
            <div><i class="glyphicon glyphicon-hand-up custom-glyphicon-votes"></i></div>
            <div class="custom-votes-number"><?= $response['votes'];?></div>
            <div><i class="glyphicon glyphicon-hand-down custom-glyphicon-votes"></i></div>
          <?php } else {
            $upvoted = false;
            $downvoted = false;
            foreach($response['ResponseVote'] as $vote){
              if($vote['user_id'] == $this->Session->read("Auth.User.id")){
                if($vote['liked']==1)
                  $upvoted = true;
                else
                  $downvoted = true;
                break;
              }
            }?>
          <div>
            <?php if(!$upvoted)
              echo $this->Html->link(
                "<i class='glyphicon glyphicon-hand-up custom-glyphicon-votes'></i>",array(
                'controller' => 'response_votes',
                'action' => 'upvote', $post['Post']['id'], $response['id']
                ), array("escape" => false)
              );
            else
              echo $this->Html->link("<i class='glyphicon glyphicon-hand-up custom-glyphicon-votes custom-voted'></i>",array(
                'controller' => 'response_votes',
                'action' => 'remove', $post['Post']['id'], $response['id']
              ), array("escape" => false)
            ); ?>
          </div>
          <div class="custom-votes-number"><?= $response["votes"];?></div>
          <div>
            <?php if(!$downvoted)
              echo $this->Html->link("<i class='glyphicon glyphicon-hand-down custom-glyphicon-votes'></i>",array(
                'controller' => 'response_votes',
                'action' => 'downvote', $post['Post']['id'], $response['id']
              ), array("escape" => false)
            );
            else
              echo $this->Html->link("<i class='glyphicon glyphicon-hand-down custom-glyphicon-votes custom-voted'></i>",array(
                'controller' => 'response_votes',
                'action' => 'remove', $post['Post']['id'], $response['id']
              ), array("escape" => false)
            ); ?>
          </div>
          <?php } ?>
          <!--<div><i class="glyphicon glyphicon-ok custom-glyphicon-best"></i></div>-->
        </div>
        <div class="col-xs-9 col-sm-11 col-md-11 custom-answer-description"><!-- div cuerpo respuesta -->
          <div class="custom-square-user"><?= $response['content'];?></div>
          <div class="custom-author">
              <?php
                $ago=$this->Date->ago($response['date']);
                echo sprintf(__("Answered %s",sprintf(__('%s ago'),sprintf(__($ago['units']),__($ago['value'])))));
                echo " ".sprintf(__("by %s"),$this->Html->link($response["User"]["name"], array(
                  'controller' => 'users',
                  'action' => 'view',$response["User"]["id"]),
                  array('class' => 'custom-user-link')
                ));
              ?>
          </div>
        </div>
      </div>
      <div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <h4><a class="custom-comment-link" role="button" data-toggle="collapse" href="#collapseResponseComment<?= $response['id']; ?>" aria-expanded="false" aria-controls="ccollapseResponseComment<?= $response['id']; ?>"><?= __("Comments"); ?></a></h4>
          <div class="custom-insert-comment col-xs-12 col-sd-12 col-md-12 collapse" id="collapseResponseComment<?= $response['id']; ?>">
            <?php foreach($response['Responsecomment'] as $responsecomment){ ?>
              <div class="col-xs-12 col-sm-12 col-lg-12 custom-generated-content custom-comment">
                "<?= $responsecomment['content']; ?>"<br><?= sprintf(__("by %s",
                  $this->Html->link($responsecomment['User']['name'], array(
                    'controller' => 'users',
                    'action'=> 'view', $responsecomment['User']['id']),
                    array('class' => 'custom-user-link')))); ?>
              </div>
            <?php } ?>
            <div>
              <?php if(AuthComponent::user("id")) {
              echo "<div class='custom-label'>".__("Add a comment")."</div>";
              echo $this->Form->create("Responsecomment", array(
                'action' => 'add'));
              echo $this->Form->input('content',array(
                "type" => "textarea",
                "class" => "form-control input-lg custom-textarea",
                "rows" => "4",
                "label" => false));?>
                <div class="form-group col-xs-12 col-sm-4 col-lg-3 col-xl-2">
              <?php echo $this->Form->button(__("Send"),array(
                "class" => "btn custom-btn col-xs-6 col-sm-6 col-lg-6",
                "type" => "submit"));
              echo $this->Form->button(__("Reset"),array(
                "class" => "btn custom-btn col-xs-6 col-sm-6 col-lg-6",
                "type" => "reset"));?>
              </div>
              <?php
              echo $this->Form->input("response_id",array("value" => $response['id'], "type" => "hidden"));
              echo $this->Form->end(); }?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
