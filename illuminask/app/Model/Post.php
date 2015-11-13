<?php
	include_once 'AppModel.php';

	class Post extends AppModel{

		public $name = 'Post';

		public $validate = array(
	        'title' => array(
	            'rule' => 'notBlank'
	        ),
	        'content' => array(
	            'rule' => 'notBlank'
	        )
    	);
	}