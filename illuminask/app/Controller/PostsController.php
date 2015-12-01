<?php
	class PostsController extends AppController {

  		public $helpers = array('Html', 'Form', 'Flash', 'Votes');
    	public $components = array('Flash','Session');
    	public $uses = array("Post","PostVisit");

  		public function index($sort = null) {
				$this->layout= 'main';
				if($sort == null)
					$sort = 'newest';
				$this->set('sort',$sort);
				switch($sort){
					case 'newest':
						$posts = $this->Post->find("all", array('order' => 'Post.date DESC'));
						break;
					case 'today':
						$interval = new DateInterval("P1D");
						$date = (new DateTime())->sub($interval);
						$posts = $this->Post->find("all", array(
							'conditions' => array("Post.date >=" => $date->format("Y-m-d H:i:s")),
							'order' => 'Post.date DESC'));
						break;
					case 'week':
						$interval = new DateInterval("P1W");
						$date = (new DateTime())->sub($interval);
						$posts = $this->Post->find("all", array(
							'conditions' => array("Post.date >=" => $date->format("Y-m-d H:i:s")),
							'order' => 'Post.date DESC'));
						break;
					case 'month':
						$interval = new DateInterval("P1M");
						$date = (new DateTime())->sub($interval);
						$posts = $this->Post->find("all", array(
							'conditions' => array("Post.date >=" => $date->format("Y-m-d H:i:s")),
							'order' => 'Post.date DESC'));
						break;
					case 'voted':
						$posts = $this->Post->find("all", array('order' => 'Post.date DESC'));
						break;
					default:
						$this->redirect(array('action' => 'index'));
						break;
				}
        $this->set('posts', $posts);
    	}

    	public function view($id = null) {
    		if(AuthComponent::user('id'))
    			$this->addVisit($id);
				$this->layout= 'main';
        $this->set('post', $this->Post->find('first', array(
					'conditions' => array(
						'Post.id' => $id
					),
					'recursive' => 2)));
    	}

    	public function add() {
	        if ($this->request->is('post')) {
	        	$this->request->data['Post']['date']=date("Y-m-d H:i:s");
	        	$this->request->data['Post']['user_id']=$this->Session->read("Auth.User.id");
	            if ($this->Post->save($this->request->data)) {
	                $this->Flash->success('Your post has been published');
	        		$this->redirect(array('action' => 'view', $this->Post->getId()));
	            }
	            else{
	              $this->Flash->error('Your post could not been published');
	        			$this->redirect(array('action' => 'index'));
	            }
	        }
	    }

		public function edit($id = null) {
		    if (!$id) {
		        $this->Flash->error('Invalid post');
	        	$this->redirect(array('action' => 'index'));
		    }

		    $post = $this->Post->findById($id);
		    if (!$post) {
		        $this->Flash->error('Invalid post');
	        	$this->redirect(array('action' => 'index'));
		    }

		    if ($this->request->is(array('post'))) {
		        $this->Post->id = $id;
	        	$this->request->data['Post']['user_id']=$this->Session->read("Auth.User.id");
	        	if(!$this->Post->hasAny(array(
	        		"user_id" => $this->Session->read("Auth.User.id"),
	        		"id" => $id))){
			        $this->Flash->error('You are not the owner of this post');
		        	$this->redirect(array('action' => 'index'));
	        	}
		        if ($this->Post->save($this->request->data)) {
		            $this->Flash->success('Your post has been updated');
	        		$this->redirect(array('action' => 'view', $this->Post->getId()));
		        }
		        $this->Flash->error('Unable to update your post');
	        	$this->redirect(array('action' => 'view', $this->Post->getId()));
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
