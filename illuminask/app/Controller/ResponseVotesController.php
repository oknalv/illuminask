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
				$this->ResponseVote->deleteAll(array('ResponseVote.user_id' => $user, 'ResponseVote.response_id' => $responseId));
				$this->ResponseVote->save(array('user_id' => $user, 'response_id' => $responseId, 'liked' => 1));
				$this->updateVotesCounter($responseId);
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
				$this->ResponseVote->deleteAll(array('ResponseVote.user_id' => $user, 'ResponseVote.response_id' => $responseId));
				$this->ResponseVote->save(array('user_id' => $user, 'response_id' => $responseId, 'liked' => 0));
				$this->updateVotesCounter($responseId);
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
				$this->ResponseVote->deleteAll(array('ResponseVote.user_id' => $user, 'ResponseVote.response_id' => $responseId));
				$this->updateVotesCounter($responseId);
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }

		private function updateVotesCounter($responseId){
			$count = 0;
			$votes = $this->ResponseVote->find("all", array("conditions" => array(
				"ResponseVote.response_id" => $responseId, "ResponseVote.liked" => 1
			)));
			$count += count($votes);
			$votes = $this->ResponseVote->find("all", array("conditions" => array(
				"ResponseVote.response_id" => $responseId, "ResponseVote.liked" => 0
			)));
			$count -= count($votes);
			$response = $this->Response->find("first",array("conditions" => array("Response.id" => $responseId)));
			$response['Response']["votes"] = $count;
			$this->Response->save($response);
		}
  }
