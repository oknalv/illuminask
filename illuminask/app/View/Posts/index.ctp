<!-- File: /app/View/Posts/index.ctp -->

  <div id="questions">
    <?php foreach ($posts as $post): ?>
    <div class="custom-question col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-3 col-xs-3 custom-counter-container">
        <div class="col-md-4 custom-counter">
          <span class="custom-counter-number">7</span><br>
          <span class="custom-counter-text">votes</span>
        </div>
        <div class="col-md-4 custom-counter">
          <span class="custom-counter-number">10</span><br>
          <span class="custom-counter-text">answers</span>
        </div>
        <div class="col-md-4 custom-counter">
          <span class="custom-counter-number">500</span><br>
          <span class="custom-counter-text">views</span>
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
        <div class="custom-question-title-data">by
          <?php
            echo $this->Html->link($post['User']['name'], array(
              'controller' => 'users',
              'action' => 'view',$post['User']['id']),
              array('class' => 'custom-a')
            );?>

          <?php
            $interval = ((new DateTime())->diff(new DateTime($post['Post']['date'])));
            echo $interval->format("%a")?> hours ago</div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
