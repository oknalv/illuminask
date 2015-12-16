<?php
	include_once 'AppModel.php';

	class Post extends AppModel{

		public $name = 'Post';
		public $belongsTo = 'User';
		public $hasMany = array('PostVote', 'Response' => array('order' => "Response.votes DESC"), 'PostVisit', 'Postcomment');

		public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'content' => array(
            'rule' => 'notBlank'
        )
  	);

	}
