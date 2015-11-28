<?php
	class UsersController extends AppController {

		public function beforeFilter() {
		    parent::beforeFilter();
		    // Allow users to register and logout.
		    $this->Auth->allow('add', 'logout');
		}

		public function login() {
		    if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		        $this->Flash->success('Login successful');
		            return $this->redirect($this->referer());
		        }
		        $this->Flash->error('Invalid username or password, try again');
		    }
		}

		public function logout() {
    		return $this->redirect($this->Auth->logout());
		}

		public function add() {
	        if ($this->request->is('post')) {
	            $this->User->create();
	            if ($this->User->save($this->request->data)) {
	                $this->Flash->success('The user has been saved');
	                return $this->redirect(array(
	                	'controller' => 'posts',
	                	'action' => 'index'));
	            }
	            $this->Flash->error(
	                'The user could not be saved. Please, try again.'
	            );
							print_r($this->User->invalidFields());
							return $this->redirect(array(
								'controller' => 'posts',
								'action' => 'index'));
	        }
	    }
	}
