<!-- File: /app/View/Posts/index.ctp -->

  <div id="questions">
    <?php foreach ($posts as $post): ?>
    <div class="custom-question col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-3 col-xs-3 custom-counter-container">
        <div class="col-md-4 custom-counter">
          <span class="custom-counter-number"><?= $this->Votes->calculate($post["PostVote"]); ?></span><br>
          <span class="custom-counter-text"><?= __("votes"); ?></span>
        </div>
        <div class="col-md-4 custom-counter">
          <span class="custom-counter-number"><?= count($post["Response"]); ?></span><br>
          <span class="custom-counter-text"><?= __("answers"); ?></span>
        </div>
        <div class="col-md-4 custom-counter">
          <span class="custom-counter-number"><?= count($post["PostVisit"]); ?></span><br>
          <span class="custom-counter-text"><?= __("views"); ?></span>
        </div>
      </div>
      <div class="col-md-9 col-xs-9" class="custom-question-title">
        <div class="custom-question-title-link">
            <?php
            echo $this->Html->link($post['Post']['title'], array(
              'controller' => 'posts',
              'action' => 'view', $post['Post']['id']),
              array('class' => "custom-a")
              );?>
        </div>
        <div class="custom-question-title-data"><?= sprintf(__("by %s"),
            $this->Html->link($post['User']['name'], array(
              'controller' => 'users',
              'action' => 'view',$post['User']['id']),
              array('class' => 'custom-a')
            ));?>

          <?php
            $ago=$this->Date->ago($post['Post']['date']);
            echo sprintf(__('%s ago'),sprintf(__($ago['units']),__($ago['value'])));?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
