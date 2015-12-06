<?php
	class PostVotesController extends AppController {
    public $components = array('Flash','Session');
		public $uses = array("Post","PostVote");

    public function upvote($postId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Post->hasAny(array('Post.id' => $postId, 'Post.user_id' => $user))){
				$this->Flash->error("You cannot vote your own question");
			}
			else{
				$this->PostVote->deleteAll(array('PostVote.user_id' => $user, 'PostVote.post_id' => $postId));
				$this->PostVote->save(array('user_id' => $user, 'post_id' => $postId, 'liked' => 1));
				$this->updateVotesCounter($postId);
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }

    public function downvote($postId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Post->hasAny(array('Post.id' => $postId, 'Post.user_id' => $user))){
				$this->Flash->error("You cannot vote your own question");
			}
			else{
				$this->PostVote->deleteAll(array('PostVote.user_id' => $user, 'PostVote.post_id' => $postId));
				$this->PostVote->save(array('user_id' => $user, 'post_id' => $postId, 'liked' => 0));
				$this->updateVotesCounter($postId);
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }


    public function remove($postId = null){
      $user = $this->Session->read("Auth.User.id");
			if($this->Post->hasAny(array('Post.id' => $postId, 'Post.user_id' => $user))){
				$this->Flash->error("You cannot vote your own question");
			}
			else{
				$this->PostVote->deleteAll(array('PostVote.user_id' => $user, 'PostVote.post_id' => $postId));
				$this->updateVotesCounter($postId);
			}
			$this->redirect(array(
				'controller' => 'posts',
				'action' => 'view', $postId
			));
    }

		private function updateVotesCounter($postId){
			$count = 0;
			$votes = $this->PostVote->find("all", array("conditions" => array(
				"PostVote.post_id" => $postId, "PostVote.liked" => 1
			)));
			$count += count($votes);
			$votes = $this->PostVote->find("all", array("conditions" => array(
				"PostVote.post_id" => $postId, "PostVote.liked" => 0
			)));
			$count -= count($votes);
			$post = $this->Post->find("first",array("conditions" => array("Post.id" => $postId)));
			$post['Post']["votes"] = $count;
			$this->Post->save($post);
		}
  }
