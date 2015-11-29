<?php
	class PostsController extends AppController {

  		public $helpers = array('Html', 'Form', 'Flash');
    	public $components = array('Flash','Session');
    	public $uses = array("Post","PostVisit");

  		public function index() {
			$this->layout= 'main';
			$posts = $this->Post->find("all");
        	$this->set('posts', $posts);
    	}

    	public function view($id = null) {
    		if(AuthComponent::user('id'))
    			$this->addVisit($id);
			$this->layout= 'main';
        	$this->set('post', $this->Post->findById($id));
    	}

    	public function add() {
	        if ($this->request->is('post')) {
	        	$this->request->data['Post']['date']=date("Y-m-d H:i:s");
	            if ($this->Post->save($this->request->data)) {
	                $this->Flash->success('Your post has been published');
	            }
	            else{
	                $this->Flash->error('Your post could not been published');
	            }
	        }
	        $this->redirect(array('action' => 'index'));
	    }

		public function edit($id = null) {
		    if (!$id) {
		        throw new NotFoundException(__('Invalid post'));
		    }

		    $post = $this->Post->findById($id);
		    if (!$post) {
		        throw new NotFoundException(__('Invalid post'));
		    }

		    if ($this->request->is(array('post', 'put'))) {
		        $this->Post->id = $id;
		        if ($this->Post->save($this->request->data)) {
		            $this->Flash->success(__('Your post has been updated'));
		            return $this->redirect(array('action' => 'index'));
		        }
		        $this->Flash->error(__('Unable to update your post'));
		    }

		    if (!$this->request->data) {
		        $this->request->data = $post;
		    }
		}

		public function delete($id) {
		    if (!$this->request->is('post')) {
		        throw new MethodNotAllowedException();
		    }
		    if ($this->Post->delete($id)) {
		        $this->Flash->success('The post has been deleted');
		        $this->redirect(array('action' => 'index'));
		    }
		}

		private function addVisit($id){
			if(!$this->PostVisit->hasAny(array(
				'PostVisit.user_id' => $this->Session->read("Auth.User.id"),
				'PostVisit.post_id' => $id
				))){
				$this->PostVisit->save(
					array("PostVisit" => array(
						"user_id" => $this->Session->read("Auth.User.id"),
						"post_id" => $id
						)
					)
				);
			}
		}

	}
