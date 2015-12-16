<?php
  include_once 'AppModel.php';

  class Postcomment extends AppModel{

    public $name = 'Postcomment';
    public $belongsTo = 'User';

    public $validate = array(
        'content' => array(
            'rule' => 'notBlank'
        )
    );

  }
