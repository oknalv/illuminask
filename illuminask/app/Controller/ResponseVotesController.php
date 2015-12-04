<?php
	class ResponseVotesController extends AppController {
    public $components = array('Flash','Session');
		public $uses = array("Response","ResponseVote");

    public function upvote($postId = null, $responseId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Response->hasAny(array('Response.id' => $responseId, 'Response.user_id' => $user))){
				$this->Flash->error("You cannot vote your own response");
			}
			else{
				if($this->ResponseVote->hasAny(
					array('ResponseVote.user_id' => $user)
					))
					$this->ResponseVote->deleteAll(array('ResponseVote.user_id' => $user, 'ResponseVote.response_id' => $responseId));
				$this->ResponseVote->save(array('user_id' => $user, 'response_id' => $responseId, 'liked' => 1));
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }

    public function downvote($postId = null, $responseId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Response->hasAny(array('Response.id' => $responseId, 'Response.user_id' => $user))){
				$this->Flash->error("You cannot vote your own response");
			}
			else{
				if($this->ResponseVote->hasAny(
					array('ResponseVote.user_id' => $user)
					))
					$this->ResponseVote->deleteAll(array('ResponseVote.user_id' => $user, 'ResponseVote.response_id' => $responseId));
				$this->ResponseVote->save(array('user_id' => $user, 'response_id' => $responseId, 'liked' => 0)); //CAMBIAR SI CAMBIA COMO ALMACENAR VOTOS NEGATIVOS, PROBABLEMENTE NECESARIO
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }


    public function remove($postId = null, $responseId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Response->hasAny(array('Response.id' => $responseId, 'Response.user_id' => $user))){
				$this->Flash->error("You cannot vote your own response");
			}
			else{
				if($this->ResponseVote->hasAny(
					array('ResponseVote.user_id' => $user)
					))
					$this->ResponseVote->deleteAll(array('ResponseVote.user_id' => $user, 'ResponseVote.response_id' => $responseId));
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }
  }
