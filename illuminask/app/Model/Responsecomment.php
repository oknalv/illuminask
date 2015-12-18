<?php
  include_once 'AppModel.php';

  class Responsecomment extends AppModel{

    public $name = 'Responsecomment';
    public $belongsTo = 'User';

    public $validate = array(
        'content' => array(
            'rule' => 'notBlank'
        )
    );

  }
