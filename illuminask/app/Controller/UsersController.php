<?php
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
	}
