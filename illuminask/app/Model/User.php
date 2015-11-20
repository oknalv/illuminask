<?php
	
	App::uses('AppModel', 'Model');
	App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

	class User extends AppModel{

		public $name = 'User';

		public $validate = array(
	        'name' => array(
	            'required' => array(
	                'rule' => 'notBlank',
	                'message' => 'A username is required'
	            )
	        ),
	        'password' => array(
	            'required' => array(
	                'rule' => 'notBlank',
	                'message' => 'A password is required'
	            )
	        ),
	        'confirmPassword' => array(
	            'required' => array(
	                'rule' => 'notBlank',
	                'message' => 'A password is required'
	            ),
	            'compare' => array(
	            	'rule' => array('validate_passwords'),
	            	'message' => "Passwords don't match"
	            )
        	),
	        'email' => array(
	            'required' => array(
	                'rule' => 'notBlank',
	                'rule' => 'email',
	                'message' => 'An email is required'
	            )
	        )
	    );

		public function beforeSave($options = array()) {
		    if (isset($this->data[$this->alias]['password'])) {
		        $passwordHasher = new BlowfishPasswordHasher();
		        $this->data[$this->alias]['password'] = $passwordHasher->hash(
		            $this->data[$this->alias]['password']
		        );
		    }
		    return true;
		}

		public function validate_passwords(){
			return $this->data[$this->alias]['password'] === $this->data[$this->alias]['confirmPassword'];
		}
	}
