<?php
	include_once 'AppModel.php';

	class Response extends AppModel{

		public $name = 'Response';
		public $belongsTo = 'User';
		public $hasMany = 'ResponseVote';

	}
