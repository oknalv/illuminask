<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

	class UsersController extends AppController {

		public function beforeFilter() {
		    parent::beforeFilter();
		    // Allow users to register and logout.
		    $this->Auth->allow('add', 'logout');
		}

		public function login(){
			if(AuthComponent::user('id'))
				return $this->redirect(array(
					'controller' => 'posts',
					'action' => 'index'));
			$this->layout= 'main';
		}

		public function doLogin() {
		    if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		        	$this->Flash->success('Login successful');
		            return $this->redirect($this->referer());
		        }
		        $this->Flash->error('Invalid username or password, try again');
		        return $this->redirect(array(
					'controller' => 'users',
					'action' => 'login'));
		    }
		}

		public function logout() {
    		return $this->redirect($this->Auth->logout());
		}

		public function add() {
	        if ($this->request->is('post')) {
	            $this->User->create();
	            if($this->User->findByName($this->request->data["User"]["name"]))
		            $this->Flash->error('The user already exists');
            	else if($this->User->save($this->request->data))
	                $this->Flash->success('The user has been created');
	            else
	            	$this->Flash->error('The user could not be created, try again');
				return $this->redirect(array(
					'controller' => 'posts',
					'action' => 'index'));
	        }
	    }

		public function view($id){
			$this->layout= 'main';
			$this->set('user', $this->User->find('first',array("conditions" => array("User.id" => $id))));
		}

		public function changePassword(){
			if(AuthComponent::user('id') && $this->request->is('post')){
				$passwordHasher = new BlowfishPasswordHasher();
				$user = $this->User->find('first',array("conditions" => array("User.id" => $this->Session->read("Auth.User.id"))));
				$storedPass = $user['User']['password'];
				$oldPass = $this->data['User']['oldPass'];
				$newHash = Security::hash($oldPass, 'blowfish', $storedPass);
				if($newHash === $storedPass){
					if($this->data['User']['newPass'] == $this->data['User']['conNewPass']){
						$newPass = $this->data['User']['newPass'];
						$user['User']['password'] = $newPass;
						$this->User->save($user);
						$this->Flash->success("Password successfuly changed");
					}
					else
						$this->Flash->error("The new passwords do not match");
				}
				else
					$this->Flash->error("The old password is wrong");
			}
			else
				$this->Flash->error("You are not logged in");
			$this->redirect($this->referer());
		}
	}
