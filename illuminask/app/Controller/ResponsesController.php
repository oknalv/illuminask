<?php
	class ResponsesController extends AppController {

    	public function add() {
	        if ($this->request->is('post')) {
	        	$this->request->data['Response']['date']=date("Y-m-d H:i:s");
	        	$this->request->data['Response']['user_id']=$this->Session->read("Auth.User.id");
	            if ($this->Response->save($this->request->data)) {
	                $this->Flash->success('Your response has been published');
	        		$this->redirect($this->referer());
	            }
	            else{
	                $this->Flash->error('Your response could not been published');
	        		$this->redirect($this->referer());
	            }
	        }
	    }
	}