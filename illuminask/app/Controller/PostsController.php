<?php
	class PostsController extends AppController {

  		public $helpers = array('Html', 'Form', 'Flash');
    	public $components = array('Flash');

			private function ago($date){
				$units = "";
				$value = "";
				$interval = (new DateTime())->diff(new DateTime($date));
				if($interval->y > 0){
					$value = $interval->format("%y");
					if($interval->y == 1)
						$units = "%s year";
					else
						$units = "%s years";
				}
				else if($interval->m > 0){
					$value = $interval->format("%m");
					if($interval->m == 1)
						$units = "%s month";
					else
						$units = "%s months";
				}
				else if($interval->d > 0){
					$value = $interval->format("%d");
					if($interval->d == 1)
						$units = "%s day";
					else
						$units = "%s days";
				}
				else if($interval->h > 0){
					$value = $interval->format("%h");
					if($interval->h == 1)
						$units = "%s hour";
					else
						$units = "%s hours";
				}
				else if($interval->i > 0){
					$value = $interval->format("%i");
					if($interval->i == 1)
						$units = "%s minute";
					else
						$units = "%s minutes";
				}
				else{
					$value = $interval->format("%s");
					if($interval->s == 1)
						$units = "%s seconds";
					else
						$units = "%s seconds";
				}
				return array("value" => $value, "units" => $units);
			}

  		public function index() {
					$this->layout= 'main';
					$posts = $this->Post->find("all");
					foreach($posts as $i=>$post){
						$posts[$i]["Post"]["ago"] = $this->ago($post['Post']['date']);
						/*$interval = ((new DateTime())->diff(new DateTime($post['Post']['date'])));
						if($interval->days != null){
							$posts[$i]["Post"]["ago"]["value"] = $interval->format("%a");
							$posts[$i]["Post"]["ago"]["units"] = "days";
						}
						else if($interval)
						print_r($interval);
						die();*/
					}
        	$this->set('posts', $posts);
    	}

    	public function view($id = null) {
					$this->layout= 'main';
        	$this->set('post', $this->Post->findById($id));
    	}

    	public function add() {
	        if ($this->request->is('post')) {
	        	$this->request->data['Post']['date']=date("Y-m-d H:i:s");
	            if ($this->Post->save($this->request->data)) {
	                $this->Flash->success('Your post has been saved.');
	                $this->redirect(array('action' => 'index'));
	            }
	        }
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
		            $this->Flash->success(__('Your post has been updated.'));
		            return $this->redirect(array('action' => 'index'));
		        }
		        $this->Flash->error(__('Unable to update your post.'));
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
		        $this->Flash->success('The post with id: ' . $id . ' has been deleted.');
		        $this->redirect(array('action' => 'index'));
		    }
		}

	}
