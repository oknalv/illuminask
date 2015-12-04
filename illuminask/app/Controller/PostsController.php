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
				$find_params=array('order' =>'Post.date DESC');
				$conditions = array();
				if(isset($this->request->query['search'])){
					$search = $this->request->query['search'];
					$conditions['OR'] = array('Post.title like' => '%'.$search.'%',
						'Post.content like' => '%'.$search.'%');
				}
				switch($sort){
					case 'newest':
						if(!empty($conditions))
							$find_params['conditions'] = $conditions;
						break;
					case 'today':
						$interval = new DateInterval("P1D");
						$date = (new DateTime())->sub($interval);
						$conditions["Post.date >="] = $date->format("Y-m-d H:i:s");
						$find_params["conditions"] = $conditions;
						break;
					case 'week':
						$interval = new DateInterval("P1W");
						$date = (new DateTime())->sub($interval);
						$conditions["Post.date >="] = $date->format("Y-m-d H:i:s");
						$find_params["conditions"] = $conditions;
						break;
					case 'month':
						$interval = new DateInterval("P1M");
						$date = (new DateTime())->sub($interval);
						$conditions["Post.date >="] = $date->format("Y-m-d H:i:s");
						$find_params["conditions"] = $conditions;
						break;
					case 'voted':
						if(!empty($conditions))
							$find_params['conditions'] = $conditions;
						break;
					default:
						$this->redirect(array('action' => 'index'));
						break;
				}
				$posts = $this->Post->find("all", $find_params);
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
	                $this->Flash->success('Your question has been published');
	        		$this->redirect(array('action' => 'view', $this->Post->getId()));
	            }
	            else{
	              $this->Flash->error('Your question could not been published');
	        			$this->redirect(array('action' => 'index'));
	            }
	        }
	    }

		public function edit($id = null) {
		    if (!$id) {
		        $this->Flash->error('Invalid question');
	        	$this->redirect(array('action' => 'index'));
		    }

		    $post = $this->Post->findById($id);
		    if (!$post) {
		        $this->Flash->error('Invalid question');
	        	$this->redirect(array('action' => 'index'));
		    }

		    if ($this->request->is(array('post'))) {
		        $this->Post->id = $id;
	        	$this->request->data['Post']['user_id']=$this->Session->read("Auth.User.id");
	        	if(!$this->Post->hasAny(array(
	        		"user_id" => $this->Session->read("Auth.User.id"),
	        		"id" => $id))){
			        $this->Flash->error('You are not the owner of this question');
		        	$this->redirect(array('action' => 'index'));
	        	}
		        if ($this->Post->save($this->request->data)) {
		            $this->Flash->success('Your question has been updated');
	        		$this->redirect(array('action' => 'view', $this->Post->getId()));
		        }
		        $this->Flash->error('Unable to update your question');
	        	$this->redirect(array('action' => 'view', $this->Post->getId()));
		    }
		}

		public function delete($id) {
		    if (!$this->request->is('post')) {
		        throw new MethodNotAllowedException();
		    }
		    if ($this->Post->delete($id)) {
		        $this->Flash->success('The question has been deleted');
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
