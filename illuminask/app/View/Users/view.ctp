
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
  </div><!--datos-->
</div>
<div class="col-xs-12"><!--posts y respuestas-->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#questions" data-toggle="tab" class="custom-a"><?= __("questions"); ?></a></li>
    <li><a href="#answers" data-toggle="tab" class="custom-a"><?= __("answers"); ?></a></li>
  </ul>
  <div class="tab-content">
    <div id="questions" class="tab-pane fade in active">questions</div>
    <div id="answers" class="tab-pane fade">answers</div>
  </div>
</div>
